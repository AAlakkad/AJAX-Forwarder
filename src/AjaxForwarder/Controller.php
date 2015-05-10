<?php
namespace AAlakkad\AjaxForwarder;

use AAlakkad\AjaxForwarder\Repositories\ApiRepository;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \Request;

class Controller extends BaseController
{
    use DispatchesCommands, ValidatesRequests;

    protected $api;

    public function __construct(ApiRepository $api)
    {
        $this->api = $api;
    }

    public function handelGet()
    {
        // Check the request is AJAX
        if (!Request::ajax()) {
            return;
        }
        // get AJAX request data
        $data = Request::all();
        // pass the request to the remote server
        $response = $api->sendRequest($data);

        // @TODO: log:
        // + User
        // + ajax request
        // + response status code (200, 404, etc.)
        // + the whole response if the status code isn't (200)

        // Sending response to the user
        // check if the response is json or not
        if (isJson($response)) {
            return response()->json($response);
        }
        return response($response);
    }
}
