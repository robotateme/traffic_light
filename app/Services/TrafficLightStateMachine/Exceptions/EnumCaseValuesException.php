<?php

namespace App\Services\TrafficLightStateMachine\Exceptions;

use Exception;

class EnumCaseValuesException extends Exception
{
    public $message = "The enum does not contain cases with this value.";
}