<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class UserNotFoundException extends Exception
{

    public function __construct($message = "")
    {
        $this->message = $message;
    }

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        Log::error($this->message);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        // return response(...);
        // return false;
        return response()->view('errors.usernotfound', [], 500);
    }
}
