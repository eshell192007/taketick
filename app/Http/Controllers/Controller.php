<?php

namespace Helpdesk\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function beforeCall()
    {
    }

    protected function afterCall()
    {
    }

    public function callAction($method, $parameters)
    {
        $this->beforeCall();
        $response = parent::callAction($method, $parameters);
        $this->afterCall();
        return $response;
    }
}
