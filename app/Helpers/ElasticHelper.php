<?php

namespace App\Helpers;

use Elasticsearch\ClientBuilder;
 
class ElasticHelper {
    public static function store($type, $data) {
        $params = [
            'index' => 'es_lumen',
            'type'  => $type,
            'id'    => $data->id,
            'body'  => $data
        ];

        $client = ClientBuilder::create()
                    ->setHosts(['localhost:9200'])
                    ->build();

        $client->index($params);

        return true;
    }

    public static function update($type, $data) {
        $params = [
            'index' => 'es_lumen',
            'type'  => $type,
            'id'    => $data->id,
            'body'  => $data
        ];

        $client = ClientBuilder::create()
                    ->setHosts(['localhost:9200'])
                    ->build();

        $client->update($params);

        return true;
    }

    public static function search($type, $param, $val, $offset = 0, $limit = 1) {
        $params = [
            'index' => 'es_lumen',
            'type'  => $type,
            'body' => [
                "from" => $offset,
                "size" => $limit,
                'query' => [
                    'match' => [
                        $param => $val
                    ]
                ]
            ]
        ];

        $client = ClientBuilder::create()
                    ->setHosts(['localhost:9200'])
                    ->build();

        $res = $client->search($params);

        return $res['hits']['hits'];
    }
}