<?php

namespace App\Traits;

trait ResponseTrait
{
    // { statusCode: 200, data: xxx }
    public function ok($data = null)
    {
        $res = ['statusCode' => 200];

        if ($data) {
            $res['data'] = $data;
        }

        return response()->json($res);
    }

    // { statusCode: 500, msg: xxx }
    public function error($msg, $code = 500)
    {
        return response()->json([
            'statusCode' => $code,
            'msg' => $msg,
        ]);
    }
}