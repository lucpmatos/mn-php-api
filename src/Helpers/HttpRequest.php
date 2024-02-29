<?php

namespace Src\Helpers;

class HttpRequest
{

    /** Returns API response
     * @param $data
     * @return false|string
     */
    public static function response($data = []): bool|string
    {
        header('Content-Type: application/json');
        return json_encode($data);
    }

    /** Returns request body data
     * @return bool|array
     */
    public static function getRequestBody(): bool|array
    {
        $rawBody = file_get_contents('php://input');
        return json_decode($rawBody, true);
    }

}
