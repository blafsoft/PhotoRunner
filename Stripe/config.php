<?php
require_once('lib/Stripe.php');

$stripe = array(
  "secret_key"      => SECRET_KEY,
  "publishable_key" => PUBLISHABLE_KEY
);

Stripe::setApiKey($stripe['secret_key']);
?>

