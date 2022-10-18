<?php

namespace Garcia\Podbean\Exceptions;

class NotAbleToConnectionException extends \RuntimeException
{
    /**
     * @var string
     */
    protected $message = "Not able to connect to the Podbean, API. Invalid credentials.";
}
