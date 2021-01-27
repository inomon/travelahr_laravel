<?php
namespace App\Exceptions;

class InvalidApiResponseException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Encountered invalid API response from venue metadata endpoints');
    }
}
