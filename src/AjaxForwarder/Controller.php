<?php
namespace AAlakkad\AjaxForwarder;

use AAlakkad\AjaxForwarder\Repositories\ApiRepository;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \Request;
use \Response;

class Controller extends BaseController
{
    use DispatchesCommands, ValidatesRequests;

    protected $api;

    public function __construct(ApiRepository $api)
    {
        $this->api = $api;
    }

    public function handleGet($path = '')
    {
        // Check the request is AJAX
        if (!Request::ajax()) {
            // @TODO remove the comment from return after finish development
            // return;
        }
        // get AJAX request data
        $data = Request::all();
        // pass the request to the remote server
        $response    = $this->api->sendRequest($path, $data);
        $contentType = $response->getHeader('Content-Type');
        $content     = $response->getBody()->getContents();
        $status      = $response->getStatusCode();

        // @TODO: log:
        // + User
        // + ajax request
        // + response status code (200, 404, etc.)
        // + the whole response if the status code isn't (200)

        // Sending response back to the user
        return response($content, $status)
            ->header('Content-Type', $contentType);
    }
}
