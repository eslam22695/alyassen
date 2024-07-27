<?php


namespace App\Http\Controllers;

use App\Services\IService;

class BaseController extends Controller
{

    /**
     * @var IService
     */
    protected $service;

    public function __construct(IService $service)
    {
        $this->service = $service;
    }
}