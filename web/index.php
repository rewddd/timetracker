<?php
$app = include '../app/bootstrap.php';


$app->get('/intervals', function() use ($app) {
    /** @var MongoCollection $intervals */
    $intervals = $app['mongo_db_intervals'];
    return new \Symfony\Component\HttpFoundation\JsonResponse(iterator_to_array($intervals->find()));
});

$app->post('/intervals', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    var_dump($request->request->all());
    $name = $request->request->get('name');
    $tags = $request->request->get('tags');
    $start = new \MongoDate( (int) $request->request->get('start') );
    $end = new \MongoDate( (int) $request->request->get('end') );

    $interval = [
        'name' => $name,
        'tags' => $tags,
        'start' => $start,
        'end' => $end
    ];

    /** @var MongoCollection $intervals */
    $intervals = $app['mongo_db_intervals'];

    $intervals->insert($interval);

    return new \Symfony\Component\HttpFoundation\JsonResponse([], 201);
});

$app->run();