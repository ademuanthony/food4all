<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/23/2016
 * Time: 2:08 PM
 */

use Framework\TinyMvc;
use Globals\AppService;
?>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Earnings</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li class="active">My Purchased PIN</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->

<section class="section">
    <div class="row">
        <div class="col s12">
            <p class="title-description"> This is the list of all the pin you have bought
                <a style="margin-top: 20px;" href="#buypin" data-toggle="modal"
                   data-target="#buypin" class="btn btn-primary modal-trigger waves-effect waves-light">Buy New PIN</a>
            </p>
        </div>

    </div>

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="card-title"> PIN List </div>
                    <table class="bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Serial Number</th>
                            <th>PIN</th>
                            <th>Status</th>
                            <th>Purchase Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sn = 1; foreach($cards as $card): ?>
                            <tr>
                                <th scope="row"><?= $sn++ ?></th>
                                <td><?= $card['serial_number'] ?></td>
                                <td><?= $card['pin'] ?></td>
                                <td><?= $card['status'] == \Models\Status::Pin_Used? 'Used': 'Active' ?></td>
                                <td><?= $card['date_of_purchase'] ?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</section>


<!-- Modal -->
<div id="buypin" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form method="post" action="<?= TinyMvc::toRoute(AppService::BuyPin) ?>">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Buy Pin</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">Number of PIN</label>
                        <input required name="data[number]" type="number" class="form-control underlined">
                    </div>


                    <div class="form-group">
                        <label class="control-label">Transaction PIN</label>
                        <input required name="data[pin]" type="password" class="form-control underlined">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Payment Method</label>
                        <select required name="data[payment_method]" class="form-control">
                            <option value="ab">Account balance</option>
                            <option value="cc">Credit Card</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Buy PIN</button>
                </div>
            </div>

        </form>

    </div>
</div>
