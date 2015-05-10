<?php
namespace AAlakkad\AjaxForwarder\Repositories;

interface ApiRepository
{
    public function sendRequest(array $data);
}
