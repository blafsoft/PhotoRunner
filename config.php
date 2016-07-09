<?php
require_once('lib/Stripe.php');

$stripe = array(
  "secret_key"      => "sk_live_f0Zb65LFbH3jQV4zGbzb1AMV",
  "publishable_key" => "pk_live_obp9GmiNdWLl0DWA5wYW6rCv"

  //"secret_key"      => "sk_test_YD7LxyFy5N4k2wThJACJJ3rh",
  //"publishable_key" => "pk_test_aPEmcSGdAZrf0EssMbHa1QRy"
);

Stripe::setApiKey($stripe['secret_key']);
?>

