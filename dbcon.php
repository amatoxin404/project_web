<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory())
            ->withServiceAccount('pdam-1add2-firebase-adminsdk-14a1y-35b5fed621.json')
            ->withDatabaseUri('https://pdam-1add2-default-rtdb.asia-southeast1.firebasedatabase.app/');

$database = $factory->createDatabase();
$auth = $factory->createAuth();
$storage = $factory->createStorage();


?>