<?php
include_once '../vendor/autoload.php';

$app = new \Silex\Application();

$app['debug'] = true;

$app['mongo_client'] = function() {
    return new \MongoClient();
};

$app['mongo_db'] = function() use ($app) {
    /** @var MongoClient $mongoClient */
    $mongoClient = $app['mongo_client'];
    return $mongoClient->selectDB('dupa');
};

$app['mongo_db_intervals'] = function() use ($app) {
    /** @var MongoDB $mongoDB */
    $mongoDB = $app['mongo_db'];
    return $mongoDB->selectCollection('intervals');
};

return $app;