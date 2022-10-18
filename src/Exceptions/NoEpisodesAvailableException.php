<?php

namespace Garcia\Podbean\Exceptions;

class NoEpisodesAvailableException extends \RuntimeException
{
    /**
     * @var string
     */
    protected $message = "There are no episodes available.";
}
