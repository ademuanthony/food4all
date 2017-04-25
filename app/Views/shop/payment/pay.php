<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 11/24/2016
 * Time: 8:24 AM
 */
/** @var $order \Models\Order */
/** @var $member \Models\Member */

use Framework\TinyMvc;
use Globals\AppConstants;
?>

<section class="section">
    <div class="title-block">
        <h1 class="title">
            Payment
        </h1>
        <p class="title-description"> Please review your order and click the place order button to make your purchase</p>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div class="card-title-block">
                            <h3 class="title">
                                Order Details
                            </h3> </div>
                        <section class="example">
                            <table class="table table-inverse">
                                <thead>
                                <tr>
                                    <th>Order Reference</th>
                                    <th>Items Count</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $order->getRef() ?></td>
                                    <td><?= $order->getItemsCount() ?></td>
                                    <td><?= $order->getDescription() ?></td>
                                    <td><?= $order->getAmount() ?></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3" style="text-align: right;">
                                        <form method="POST" id="upay_form" name="upay_form"
                                              action="https://cipg.accessbankplc.com/MerchantServices/MakePayment.aspx" target="_top">
                                            <input type="hidden" name="mercId" value="<?= TinyMvc::$config[AppConstants::ACCESS_MERC_ID] ?>">
                                            <input type="hidden" name="currCode" value="566">
                                            <input type="hidden" name="amt" value="<?= $order->getAmount() ?>">
                                            <input type="hidden" name="orderId" value="<?= $order->getRef() ?>">
                                            <input type="hidden" name="prod" value="<?= $order->getDescription() ?>">
                                            <input type="hidden" name="email" value="<?= $member->getEmailAddress() ?>">
                                            <input type="hidden" name="gatekey" value="ISW">
                                            <input class="btn btn-lg btn-primary" type="submit" name="submit" value="Make Payment">
                                        </form>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </section>
                    </div>
                </div>
            </div>

        </div>
    </section>
</section>
