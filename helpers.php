<?php

/**
 * Is input a valid JSON format?
 * @param string $input
 * @return bool
 */
function isJson($input)
{
    json_decode($input);
    return (json_last_error() == JSON_ERROR_NONE);
}
