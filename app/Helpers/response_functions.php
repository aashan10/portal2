<?php 
use App\Helpers\Response;

function error($message = null, $data = [], $status_code = 400){
    $status = 'error';
    return (new Response())->message($status, $message, $data, $status_code);
}

function success($message = null, $data = [], $status_code = 200){
    $status = 'success';
    return (new Response())->message($status, $message, $data, $status_code);
}

function __redirect($message = null, $redirect_url, $status_code = 200){
    $status = 'redirect';
    $data = [
        'redirect_url' => $redirect_url
    ];
    return (new Response())->message($status, $message, $data, $status_code);
}

function unauthorized($message = null, $data = [], $status_code = 401){
    $status = 'unauthorized';
    return (new Response())->message($status, $message, $data, $status_code);
}

function notFound($message = null, $data = [], $status_code = 401){
    $status = 'not_found';
    return (new Response())->message($status, $message, $data, $status_code);
}
function invalid($message = null, $data = [], $status_code = 401){
    $status = 'invalid_data';
    return (new Response())->message($status, $message, $data, $status_code);
}
if (!function_exists('urlGenerator')) {
    /**
     * @return \Laravel\Lumen\Routing\UrlGenerator
     */
    function urlGenerator() {
        return new \Laravel\Lumen\Routing\UrlGenerator(app());
    }
}

if (!function_exists('asset')) {
    /**
     * @param $path
     * @param bool $secured
     *
     * @return string
     */
    function asset($path, $secured = false) {
        return urlGenerator()->asset($path, $secured);
    }
}