<?php

namespace Aoeng\Laravel\Support\Traits;

trait ResponseJsonActions
{
    public function responseJson($data = [], $message = 'Success', $code = 0)
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    public function success($message = 'Success', $data = [])
    {
        return $this->responseJson($data, $message, 0);
    }

    public function error($message = 'Error', $code = 301, $data = [])
    {
        return $this->responseJson($data, $message, $code);
    }
}
