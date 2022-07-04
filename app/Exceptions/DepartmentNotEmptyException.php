<?php

namespace App\Exceptions;

use Exception;

class DepartmentNotEmptyException extends Exception
{
    protected $message = 'Department is not empty';

    protected $code = 'E013';
}
