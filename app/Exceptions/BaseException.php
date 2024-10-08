<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseException extends Exception implements BaseExceptionInterface
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param Request $request
     * @return mixed
     */
    public function render(Request $request)
    {
        return $this->renderJson();
    }

    public function renderJson(): JsonResponse
    {
        $data = [
            'code' => $this->getExceptionCode(),
            'message' => $this->getMessage()
        ];
        if (config('app.debug'))
            $data['trace'] = $this->getTrace();

        $status = $this->getExceptionHttpStatus();
        return new JsonResponse($data, $status, [], 0);
    }
}
