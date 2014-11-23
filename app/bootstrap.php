<?php

// set models
$dbConfig = $this->config('db');

$databaseAdapter = new \MartynBiz\Database\Adapter($dbConfig);

// set the models in service
$this->service(array(
    'models.accountsTable' => new \App\Model\Account($databaseAdapter),
    'models.usersTable' => new \App\Model\User($databaseAdapter),
));