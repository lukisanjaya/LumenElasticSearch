<?php

namespace App\Helpers;
 
class JsonHelper {
    public static function item($data) {
        if($data) :
            $res = [
                'status_code'  => 200,
                'message' => 'Berhasil',
                'data'    => $data,
            ];
        else :
            $res = [
                'status_code'  => 404,
                'message' => 'Data tidak ditemukan',
                'data'    => null,
            ];
        endif;

        return response()->json($res, $res['status_code']);
    }

    public static function collections($data) {
        if($data) :
            $meta = [
                "current_page"  => $data->currentPage(),
                "last_page"     => $data->lastPage(),
                "prev_page_url" => $data->previousPageUrl(),
                "next_page_url" => $data->nextPageUrl(),
                // "path"          => url(),
                "per_page"      => $data->perPage(),
                "from"          => $data->firstItem(),
                "to"            => $data->lastItem(),
                "total"         => $data->total(),
            ];

            $res = [
                'status_code'  => 200,
                'message' => 'Berhasil',
                'data'    => $data->getCollection(),
                'meta'    => $meta
            ];
        else :
            $res = [
                'status_code'  => 404,
                'message' => 'Data tidak ditemukan',
                'data'    => null,
            ];
        endif;

        return response()->json($res, $res['status_code']);
    }
}