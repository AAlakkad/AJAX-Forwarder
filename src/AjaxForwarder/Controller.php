<?php
namespace AAlakkad\AjaxForwarder;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use DispatchesCommands, ValidatesRequests;

    public function handelGet()
    {
        // @TODOs:
        // - check the request is AJAX
        // - get AJAX request
        // - pass the request to the remote server
        // - send the response to the user
        // - log:
        //     + User
        //     + ajax request
        //     + response status code (200, 404, etc.)
        //     + the whole response if the status code isn't (200)
    }
}
