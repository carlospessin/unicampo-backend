<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GoogleMapsController extends Controller
{
    public function index() {
        return view('welcome');
    }
}
