<?php

$nompartie = $_POST["Nom"];
$projectId = "upjv-ccm-etu-002";


use Google\Cloud\Datastore\DatastoreClient;
$datastore = new DatastoreClient([
    'projectId' => $projectId
]);
+
$key = $datastore->key('visit');
$entity = $datastore->entity($key, [
    'user_ip' => $user_ip,
    'timestamp' => new DateTime(),
]);
$datastore->insert($entity);


// Query recent visits.
$query = $datastore->query()
    ->kind('visit')
    ->order('timestamp', 'DESCENDING')
    ->limit(10);
$results = $datastore->runQuery($query);