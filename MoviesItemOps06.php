<?php
/**
 * Copyright 2010-2019 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * This file is licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License. A copy of
 * the License is located at
 *
 * http://aws.amazon.com/apache2.0/
 *
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations under the License.
*/

require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$config = json_decode(file_get_contents('config/credentials.json'));

$client = new DynamoDbClient([
    'version' => 'latest',
    'region'  => 'us-east-2',
    'credentials' => [
        'key'     => $config->aws_key,
        'secret'  => $config->aws_secret,
    ],
]);

$marshaler = new Marshaler();

$tableName = 'Movies';

$tableName = 'Movies';

$year = 2015;
$title = 'The Big New Movie';

$key = $marshaler->marshalJson('
    {
        "year": ' . $year . ', 
        "title": "' . $title . '"
    }
');

/**
 * This will fail because "The Big New Movie" has a rating greater than 5.
 * You can change the value below to make it delete "The Big New Movies".
 */
$eav = $marshaler->marshalJson('
    {
        ":val": 5 
    }
');

$params = [
    'TableName' => $tableName,
    'Key' => $key, 
    'ConditionExpression' => 'info.rating <= :val',
    'ExpressionAttributeValues'=> $eav
];

try {
    $result = $client->deleteItem($params);
    echo "Deleted item.\n";

} catch (DynamoDbException $e) {
    echo "Unable to delete item:\n";
    echo $e->getMessage() . "\n";
}

