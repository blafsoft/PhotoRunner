<?php
    include("../include/config.php");
    include("../include/check-seller.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('../include/head-other.php'); ?>
        <link rel="stylesheet" href="<?php echo APP_URL; ?>css/login.css">

        <style>
            .line1{margin:0px 0px 0px 15px; padding:10px; color:#00A2B5; border-bottom:1px solid #00A2B5;}
            .line2{margin:0px 0px 0px 15px; padding:10px; color:#00A2B5;}
        </style>
    </head>
    <body style="background-color:#EBEBEB">
        <?php include('../include/header.php'); ?>

        <div class="space_account"></div>
        <div style="height:2px; background-color:#ebebeb;"></div>
        <div style="height:20px;"></div>

        <div class="container">
            <div style="width: 100%; margin: auto"></div>

            <div class="col-md-3 no-pading" style="background-color:#fff; height:auto;margin:20px 0;">
                <?php include('../include/seller-left.php'); ?>
            </div>

            <div class="col-md-9 features features-right padding_account" style="margin:20px 0;">
                <div class="col-md-12 form-module" style="max-width: 100%;">
                    <?php
                        try {
                            echo "<br />";

                            $conditions = array("id" => $_SESSION["seller"]["id"]);
                            $seller = $common->getrecord("pr_seller", "*", $conditions);

                            include("../Stripe/lib/Stripe.php");

                            \Stripe\Stripe::setApiKey(SECRET_KEY);
                            $stripeAccount = \Stripe\Account::retrieve($seller->stripe_account_id);
                            $stripeAccountStatus = $stripeAccount->details_submitted;

                            if($stripeAccountStatus) {
                                echo "<h2>Your stripe account <span style='color: green;'>ACTIVATED</span> and you are ready to go</h2>";
                            } else {
                                echo "<h2>Your stripe account is <span style='color: red;'>NOT ACTIVATED</h2></span> <br /><h2>Please activate it in order to start selling pictures</h2>";
                            }
                        } catch(Exception $ex) {
                            $common->add("e", "Something went wrong");
                        }

                        if(!empty($_SESSION["flash_messages"]))
                        {
                            echo $msgs->display();
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/foot.php'); ?>
    </body>
</html>
