<?php

namespace Aoeng\Laravel\Support\Traits;

trait ResponseJsonActions
{
    public function responseJson($data = [], $message = null, $code = 0)
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    public function success($message = null, $data = [])
    {
        $message || $message = __('Success');

        return $this->responseJson($data, $message);
    }

    public function error($message = null, $code = 301, $data = [])
    {
        $message || $message = __('Busy');

        return $this->responseJson($data, $message, $code);
    }
}
