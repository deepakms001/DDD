<?php

namespace Lucid\Foundation\Exceptions\Handler;

use Lucid\Domains\Http\Jobs\JsonErrorResponseJob;
use Lucid\Foundation\Exceptions\InvalidInputException;
use Lucid\Foundation\Traits\JobDispatcherTrait;
use Lucid\Foundation\Traits\MarshalTrait;
use Exception;
use Laravel\Lumen\Exceptions\Handler;

class JsonExceptionsHandler extends Handler
{
    use MarshalTrait;
    use JobDispatcherTrait;

    public function report(Exception $e)
    {
        parent::report($e);
    }

    public function render($request, Exception $e)
    {
        if (env('APP_DEBUG') == true && $request->has('debug')) {
            return parent::render($request, $e);
        }

        $fieldErrors = [];
        if ($e instanceof InvalidInputException) {
            $fieldErrors = $e->getFieldErrors();
        }

        return $this->run(JsonErrorResponseJob::class, [
            'message' => $e->getMessage(),
            'fieldErrors' => $fieldErrors,
            'code'    => get_class($e),
            'status'  => ($e->getCode() < 100 || $e->getCode() >= 600) ? 400 : $e->getCode()
        ]);
    }
}
