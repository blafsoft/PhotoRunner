<?php
include 'include/config.php';

try {
	if(!empty($_POST['stripeToken']))
	{
		require_once('Stripe/lib/Stripe.php');
		\Stripe\Stripe::setApiKey(SECRET_KEY);

		list($member, $guest) = setMemberAndGuestVars($common, $_SESSION['account']['id'], $_SESSION['guast']['email']);

		if(empty($member) && empty($guest)) {
			$msgs->add('e', 'Sorry, but we were unable to find any info about the user. Payment won\'t be processed');
			$common->redirect(APP_URL."payment.php");
		}

        $stripeCustomerId = getStripeCustomerId($member, $guest);

		$currency = getStripeCurrency($_SESSION['currency']);

		foreach($_SESSION['payment_data'] as $sellerId => $payDetails)
		{
            $seller = getSeller($common, $sellerId);

            $amount = (string)($payDetails['amount'] * 100);
            $applicationFee = (string)calcApplicationFee($payDetails['amount']);
            $descroiption = (string)getStripeChargeDescription($member, $guest, $seller, $payDetails['amount'], $_SESSION['currency']);

			$stripeDestAcctId = $seller->stripe_account_id;

			if(is_null($stripeCustomerId))
			{
				$stripeCustomerId = createStripeCustomer($_POST['stripeToken'], getBuyerEmail($member, $guest))->id;
				updateBuyer($common, $member, $guest, $stripeCustomerId);
			}

			$charge = createStripeCharge($amount, $currency, $description, $applicationFee, $stripeCustomerId, $stripeDestAcctId);

			foreach($payDetails['photos'] as $photoDetails)
			{
				$photo = getPhoto($common, $photoDetails['photo']);
				$email = getBuyerEmail($member, $guest);

				$photoAmount = null;
				if($photoDetails['type'] == 'webfileprice')
				{
					if($currency == 'usd') $photoAmount = urlencode($photo->webfileprice); else if($currency == 'eur') $photoAmount = urlencode($photo->webfilepriceeuro);
				}
				if($photoDetails['type'] == 'printfileprice')
				{
					if($photoDetails['size'] == 'A3')
					{
						if($currency == 'usd') $photoAmount = urlencode($photo->printfilepricea3); else if($currency == 'eur') $photoAmount = urlencode($photo->printfilepricea3euro);
					}
					if($photoDetails['size'] == 'A4')
					{
						if($currency == 'usd') $photoAmount = urlencode($photo->printfilepricea4); else if($currency == 'eur') $photoAmount = urlencode($photo->printfilepricea4euro);
					}
					if($photoDetails['size'] == 'A5')
					{
						if($currency == 'usd') $photoAmount = urlencode($photo->printfilepricea5); else if($currency == 'eur') $photoAmount = urlencode($photo->printfilepricea5euro);
					}
					if($photoDetails['size'] == 'othertitle')
					{
						if($currency == 'usd') $photoAmount = urlencode($photo->otherprice); else if($_SESSION['currency'] == 'eur') $photoAmount = urlencode($photo->otherpriceeuro);
					}
				}

				if($photoDetails['type'] == 'webfileprice')
				{
					$_POST['photoname'] = $photo->name;
					$_POST['photoid'] = $photo->id;
					$_POST['photographer'] = $photo->seller;
					$_POST['txnid'] = $_POST['stripeToken'];
					$_POST['amount'] = $photoAmount;
					$_POST['phototype'] = 'webfile';
					$_POST['ack'] = $_POST['stripeTokenType'];
					$_POST['size'] = $photoDetails['size'];

					$common->addpayment($_POST, $email);
				}
				if($photoDetails['type'] == 'printfileprice')
				{
					$_POST['photoid'] = $photo->id;
					$_POST['photoname'] = $photo->name;
					$_POST['photographer'] = $photo->seller;
					$_POST['txnid'] = $_POST['stripeToken'];
					$_POST['amount'] = $photoAmount;
					$_POST['phototype'] = 'printfile';
					$_POST['ack'] = $_POST['stripeTokenType'];
					$_POST['size'] = $photoDetails['size'];

					$common->addprintpayment($_POST, $email);
				}
			}
		}
		unset($_SESSION['cart']);
		$common->add('s', 'Congratulations, your transaction has been completed');
		$common->redirect(APP_URL . 'buyer/purchase-list.php');
	}
	else
	{
		$msgs->add('e', 'Error while getting Stripe token');
		$common->redirect(APP_URL . 'payment.php');
	}
}
catch(\Stripe\Error\Card $ex) {
	// Error related to the card
	$msgs->add('e', 'Stripe Card error: ' . $ex->getMessage());
	$common->redirect(APP_URL . 'payment.php');
}
catch (\Stripe\Error\Authentication $ex) {
	// Authentication with Stripe's API failed
	// (maybe you changed API keys recently)
	$msgs->add('e', 'Stripe Authentication error: ' . $ex->getMessage());
	$common->redirect(APP_URL . 'payment.php');
}
catch (\Stripe\Error\ApiConnection $ex) {
	// Network communication with Stripe failed
	$msgs->add('e', 'Stripe API Connection error: ' . $ex->getMessage());
	$common->redirect(APP_URL . 'payment.php');
}
catch (\Stripe\Error\RateLimit $ex) {
	// Stripe's rate limit exception
	$msgs->add('e', 'Stripe Rate Limit error: ' . $ex->getMessage());
	$common->redirect(APP_URL . 'payment.php');
}
catch (\Stripe\Error\InvalidRequest $ex) {
	// Invalid parameters were supplied to Stripe's API
	$msgs->add('e', 'Stripe Invalid Request error: ' . $ex->getMessage());
	$common->redirect(APP_URL . 'payment.php');
}
catch (\Stripe\Error\Api $ex) {
	// Stripe's API exception
	$msgs->add('e', 'Stripe API error: ' . $ex->getMessage());
	$common->redirect(APP_URL . 'payment.php');
}
catch (Exception $ex) {
	$msgs->add('e', 'Something went wrong. Error message: ' . $ex->getMessage());
	$common->redirect(APP_URL . 'payment.php');
}

function calcApplicationFee($price)
{
	return $price * 100 * (1 - SELLER_SHARE);
}

function getStripeChargeDescription($member, $guest, $seller, $price, $currency)
{
	$buyerInfo = null;
	if(!empty($member))
	{
		$buyerInfo = $member->firstname . ' ' . $member->lastname . ' (' . $member->email . ')';
	}
	else if(!empty($guest))
	{
		$buyerInfo = $guest->email;
	}
	return '[Photorunner] User ' . $buyerInfo . ' bought images from '
            . $seller->firstname . ' ' . $seller->lastname . ' (' . $seller->business_name . ') for a price of '
            . $price . ' ' . $currency;
}

function setMemberAndGuestVars($common, $memberId, $guestEmail)
{
	if(!empty($memberId))
	{
		return array(getMember($common, $memberId), null);
	} else if(!empty($guestEmail))
	{
        $guest = $common->checkrecord('pr_guests', '*', array('email' => $guestEmail));
        if(empty($guest))
        {
            $guestId = $common->insertrecord('pr_guests', array('email' => $guestEmail));
            return array(null, getGuest($common, 'id', $guestId));
        }
        return array(null, getGuest($common, 'email', $guestEmail));
	}
}

function getMember($common, $id)
{
	$conditions = array('id' => $id);
	return $common->getrecord('pr_members', '*', $conditions);
}

function getGuest($common, $condKey, $condValue)
{
	$conditions = array($condKey => $condValue);
	return $common->getrecord('pr_guests', '*', $conditions);
}

function getBuyerEmail($member, $guest)
{
	if(!empty($member))
	{
		return $member->email;
	}
	else if(!empty($guest))
	{
		return $guest->email;
	}
}

function updateBuyer($common, $member, $guest, $stripeCustomerId)
{
	if(!empty($member))
	{
		$conditions = array('id' => $member->id);
		$data = array('stripe_customer_id' => $stripeCustomerId);
		return $common->updaterecord('pr_members', $data, $conditions);
	}
	else if(!empty($guest))
	{
		$conditions = array('id' => $guest->id);
		$data = array('stripe_customer_id' => $stripeCustomerId);
		return $common->updaterecord('pr_guests', $data, $conditions);
	}
}

function getSeller($common, $sellerId)
{
	$conditions = array('id' => $sellerId);
	return $common->getrecord('pr_seller', '*', $conditions);
}

function getPhoto($common, $photoId)
{
	$conditions = array('id' => $photoId);
	return $common->getrecord('pr_photos','*',$conditions);
}

function getStripeCurrency($sessionCurr)
{
	if($sessionCurr == 'USD')
	{
		return 'usd';
	}
	else if($sessionCurr == 'EURO')
	{
		return 'eur';
	}
}

function createStripeCustomer($stripeToken, $email)
{
	$customer = \Stripe\Customer::create(array(
		'source' => $stripeToken,
		'email' => $email
	));
	return $customer;
}

function getStripeCustomerId($member, $guest)
{
	if(!empty($member))
	{
		return $member->stripe_customer_id;
	}
	else if(!empty($guest))
	{
		return $guest->stripe_customer_id;
	}
}

function createStripeCharge($amount, $currency, $description, $applicationFee, $customerId, $stripeDestAcctId)
{
	$charge = \Stripe\Charge::create(array(
		'amount' => $amount,
		'currency' => $currency,
		'customer' => $customerId,
		'description' => $description,
		'destination' => $stripeDestAcctId,
		'application_fee' => $applicationFee
	));
	return $charge;
}
?>
