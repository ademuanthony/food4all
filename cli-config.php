<?php
// cli-config.php
require_once "app/config/db-config.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);