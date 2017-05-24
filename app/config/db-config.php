<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 2:19 PM
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/*$paths = array("app/Models");
$isDevMode = false;*/

// the connection configuration myesto5_root
$dbParams_dev = array(
    'driver'   => 'pdo_mysql',
    'db_host'     => '127.0.0.1',
    'db_name'   => 'food4all',
    'db_username'     => 'root',
    'db_password' => '0000'
);

$dbParams_cli = array(
    'driver'   => 'pdo_mysql',
    'db_host'     => 'myestores.com.ng:3306',
    'db_name'   => 'myesto5_myestores',
    'db_username'     => 'myesto5_root',
    'db_password' => 'myestores@1'
);

$dbParams_prod = array(
    'driver'   => 'pdo_mysql',
    'db_host'     => 'mysql5011.smarterasp.net',
    'db_name'   => 'db_9a9b4e_food',
    'db_username'     => '9a9b4e_food',
    'db_password' => 'ojima123'
);

$dbParams_staging = array(
    'driver'   => 'pdo_mysql',
    'db_host'     => 'mysql5011.smarterasp.net',
    'db_name'   => 'db_9a9b4e_food',
    'db_username'     => '9a9b4e_food',
    'db_password' => 'ojima123'
);


/*$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams_dev, $config);
return $entityManager;*/

return $dbParams_dev;