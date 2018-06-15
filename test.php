<?php

require_once "vendor/autoload.php";

$mongo = new MongoDB\Client();


// show dbs
$dbs = $mongo->listDatabases();
echo '<pre>';print_r($dbs);echo '</pre>';echo '<hr>';


// use db
$mongo->selectDatabase('sjb');


// select collection
$collection = $mongo->selectCollection('sjb','order_info');


// findOne
$doc = $collection->findOne(["id"=>"9669"]);
echo '<pre>';print_r($doc);echo '</pre>';



