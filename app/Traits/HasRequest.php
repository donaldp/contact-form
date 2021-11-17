<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HasRequest
{
    /**
     * incoming request instance.
     *
     * @var \Illuminate\Http\Request $request
     */
    private Request $request;

    /**
     * Configure request instance.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function using(Request $request)
    {
        $this->request = $request;

        return $this;
    }
}
