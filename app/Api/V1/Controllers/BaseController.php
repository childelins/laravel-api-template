<?php

namespace App\Api\V1\Controllers;

use Illuminate\Routing\Controller;
use Dingo\Api\Routing\Helpers;
use App\Traits\ResponseTrait;

class BaseController extends Controller
{
    use Helpers, ResponseTrait;
}
