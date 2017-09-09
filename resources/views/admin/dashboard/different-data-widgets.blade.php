<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 9/2/2017
 * Time: 4:01 PM
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row row-in">
                <div class="col-lg-3 col-sm-6 row-in-br">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-danger">
                                <i class="ti-clipboard"></i>
                            </span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15">{!! $postsLastWeek->count() !!}</h3>
                        </li>
                        <li class="col-middle">
                            <h4>Article Last Week</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar"
                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-info">
                                <i class="ti-wallet"></i>
                            </span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15">{!! $comments->count() !!}</h3>
                        </li>
                        <li class="col-middle">
                            <h4>Total Comments</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar"
                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 row-in-br">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-success">
                                <i class="ti-clipboard"></i>
                            </span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15">{!! $postsTotal !!}</h3>
                        </li>
                        <li class="col-middle">
                            <h4>Total Active</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar"
                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6  b-0">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-warning">
                                <i class="fa fa-dollar"></i>
                            </span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15">{!! empty($visitors) ? 1 : count($visitors) !!}</h3>
                        </li>
                        <li class="col-middle">
                            <h4>Net Earnings</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar"
                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
