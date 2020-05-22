<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function successResponse($message = null, $data = [], $code = HttpResponse::HTTP_OK)
    {
        return response()
            ->json([
                       'status'  => 'success',
                       'message' => $message,
                       'data'    => $data,
                   ], $code);
    }

    public function errorResponse($message = null, $data = [], $code = HttpResponse::HTTP_BAD_REQUEST)
    {
        return response()
            ->json([
                       'status'  => 'error',
                       'message' => $message,
                       'data'    => $data,
                   ], $code);
    }
}
