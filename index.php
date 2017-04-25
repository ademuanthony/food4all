<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 6:15 AM
 */

$loader = require 'vendor/autoload.php';
$loader->register();

use Symfony\Component\HttpFoundation\Request;
use Framework\Event\RequestEvent;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Framework\TinyMvc;
use Globals\Utility;
use Globals\AppConstants;

require_once 'app/Globals/common-functions.php';

$scriptFolder = __DIR__;
$config = array_merge(require_once 'app/config/db-config.php', require_once 'app/config/config.php');

$request = Request::createFromGlobals();

// Our framework is now handling itself the request
$app = new Framework\Core($config);

//events
$app->on('request', function (RequestEvent $event) {
    // let's assume a proper check here
    if ('/admin' == $event->getRequest()->getPathInfo()) {
        echo 'Access Denied!';
        exit;
    }
});

//di
$container = new ContainerBuilder();
$container
    ->register('request', 'Symfony\Component\HttpFoundation\Request');


//route registration
require_once 'app/config/route-config.php';
require_once 'lib/YaLinqo/Linq.php';

require_once 'vendor/RedBeanPHP4_3_2/rb.php';
$app->db = R::setup( 'mysql:host='.$config['db_host'].';dbname='.$config['db_name'],
    $config['db_username'], $config['db_password'] );
R::freeze(true);




TinyMvc::$app = $app;
/*$response = $app->handle($request);
$response->send();
exit();*/

try{
    $response = $app->handle($request);
}catch (Exception $ex){
    Utility::slackDebug('Internal Error', $ex->getMessage().' TRACE: '.$ex->getTraceAsString());
    $response = new \Symfony\Component\HttpFoundation\Response('Error in processing request. '.($config['env'] == 'dev'?$ex->getMessage():''), 500);
}finally{
    $response->send();
    exit();
}

