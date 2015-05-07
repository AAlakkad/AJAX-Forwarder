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
        return "Handling AJAX GET request";
    }
}
