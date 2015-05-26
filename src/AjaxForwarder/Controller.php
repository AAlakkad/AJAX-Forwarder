<?php
namespace AAlakkad\AjaxForwarder;

use AAlakkad\AjaxForwarder\Repositories\ApiRepository;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \Auth;
use \Exception;
use \Log;
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
            return;
        }
        // get AJAX request data
        $data = Request::all();
        try {
            // pass the request to the remote server
            $response    = $this->api->sendRequest($path, $data);
            $contentType = $response->getHeader('Content-Type');
            $content     = $response->getBody()->getContents();
            $status      = $response->getStatusCode();
        } catch (Exception $e) {
            $contentType = 'application/json';
            if ($e instanceof ClientException) {
                $errorMessage = 'Not found.';
                $status       = $e->getCode();
            } elseif ($e instanceof ConnectException) {
                $errorMessage = 'Connection timeout';
                $status       = 408;
            } elseif (isset($e->response) and $e->response !== null) {
                $status = $e->response->getStatusCode();
            } else {
                $status       = 400;
                $errorMessage = $e->getMessage();
            }

            $content = json_encode([
                'error'   => true,
                'status'  => $status,
                'message' => $errorMessage,
            ]);
        }

        // Log requests
        $logData = [
            'user'   => Auth::user()->id,
            'path'   => $path,
            'data'   => $data,
            'status' => $status,
        ];
        if ($status == 200) {
            Log::info("Ajax Forwarder request.", $logData);
        } else {
            // the status code isn't 200, so there's a problem
            $logData['content'] = $content;
            Log::warning("Ajax Forwarder request.", $logData);
        }

        // Sending response back to the user
        return response($content, $status)
            ->header('Content-Type', $contentType);
    }
}
