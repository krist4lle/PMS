<?php

namespace App\Exceptions;

use Exception;

class ProjectHasIssuesException extends Exception
{
    protected $message = 'Project has active Issues';

    protected $code = 'E016';
}
