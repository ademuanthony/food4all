<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 10:54 AM
 */
use Globals\AppConstants;

return array(
    "root" => $scriptFolder,
    'appFolder' => "$scriptFolder/app",
    'AppTitle' => 'Food For All Nations',
    'base_upline' => 'S01C4RXY',
    'db' => require_once 'app/config/db-config.php',
    'env' => 'dev',
    AppConstants::FOOD_PERCENTAGE => 30,
    AppConstants::CASH_PERCENTAGE => 70,
    AppConstants::REGISTRATION_FEE => 50,
    AppConstants::REFERRAL_EARNING => 15,
    AppConstants::ACCESS_MERC_ID => '02083'
);