<?php

// Tested on PHP 5.2, 5.3

// This snippet (and some of the curl code) due to the Facebook SDK.
if (!function_exists('curl_init')) {
  throw new Exception('Stripe needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('Stripe needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
  throw new Exception('Stripe needs the Multibyte String PHP extension.');
}

// Stripe singleton
require(dirname(__FILE__) . '/Stripe/Stripe.php');

// Utilities
require(dirname(__FILE__) . '/Stripe/Util/Util.php'); // Stripe v4.0 Util.php file is placed under Util folder
// require(dirname(__FILE__) . '/Stripe/Util.php');
require(dirname(__FILE__) . '/Stripe/Util/Set.php');
require(dirname(__FILE__) . '/Stripe/Util/RequestOptions.php');
require(dirname(__FILE__) . '/Stripe/Util/AutoPagingIterator.php');

//HTTPClient
require(dirname(__FILE__) . '/Stripe/HttpClient/ClientInterface.php');
require(dirname(__FILE__) . '/Stripe/HttpClient/CurlClient.php');

// Errors
// Stripe v4.0 errors are placed under Error folder
require(dirname(__FILE__) . '/Stripe/Error/Base.php');
require(dirname(__FILE__) . '/Stripe/Error/Api.php');
require(dirname(__FILE__) . '/Stripe/Error/ApiConnection.php');
require(dirname(__FILE__) . '/Stripe/Error/Authentication.php');
require(dirname(__FILE__) . '/Stripe/Error/Card.php');
require(dirname(__FILE__) . '/Stripe/Error/InvalidRequest.php');
require(dirname(__FILE__) . '/Stripe/Error/RateLimit.php');
// require(dirname(__FILE__) . '/Stripe/Error.php');
// require(dirname(__FILE__) . '/Stripe/ApiError.php');
// require(dirname(__FILE__) . '/Stripe/ApiConnectionError.php');
// require(dirname(__FILE__) . '/Stripe/AuthenticationError.php');
// require(dirname(__FILE__) . '/Stripe/CardError.php');
// require(dirname(__FILE__) . '/Stripe/InvalidRequestError.php');
// require(dirname(__FILE__) . '/Stripe/RateLimitError.php');

// Plumbing
// require(dirname(__FILE__) . '/Stripe/Object.php');
require(dirname(__FILE__) . '/Stripe/JsonSerializable.php');
require(dirname(__FILE__) . '/Stripe/StripeObject.php');
require(dirname(__FILE__) . '/Stripe/ApiRequestor.php');
require(dirname(__FILE__) . '/Stripe/ApiResponse.php');
require(dirname(__FILE__) . '/Stripe/ApiResource.php');
require(dirname(__FILE__) . '/Stripe/Collection.php');
require(dirname(__FILE__) . '/Stripe/SingletonApiResource.php');
require(dirname(__FILE__) . '/Stripe/AttachedObject.php');
require(dirname(__FILE__) . '/Stripe/FileUpload.php');
//require(dirname(__FILE__) . '/Stripe/List.php');

// Stripe API Resources
require(dirname(__FILE__) . '/Stripe/ExternalAccount.php');
require(dirname(__FILE__) . '/Stripe/Account.php');
require(dirname(__FILE__) . '/Stripe/BankAccount.php');
require(dirname(__FILE__) . '/Stripe/Card.php');
require(dirname(__FILE__) . '/Stripe/Balance.php');
require(dirname(__FILE__) . '/Stripe/BalanceTransaction.php');
require(dirname(__FILE__) . '/Stripe/Charge.php');
require(dirname(__FILE__) . '/Stripe/Customer.php');
require(dirname(__FILE__) . '/Stripe/Invoice.php');
require(dirname(__FILE__) . '/Stripe/InvoiceItem.php');
require(dirname(__FILE__) . '/Stripe/Plan.php');
require(dirname(__FILE__) . '/Stripe/Subscription.php');
require(dirname(__FILE__) . '/Stripe/Token.php');
require(dirname(__FILE__) . '/Stripe/Coupon.php');
require(dirname(__FILE__) . '/Stripe/Event.php');
require(dirname(__FILE__) . '/Stripe/Transfer.php');
require(dirname(__FILE__) . '/Stripe/Recipient.php');
require(dirname(__FILE__) . '/Stripe/Refund.php');
require(dirname(__FILE__) . '/Stripe/ApplicationFee.php');
