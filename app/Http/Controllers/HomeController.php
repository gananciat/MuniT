<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class HomeController extends ApiController
{
	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('home');
    }
}
