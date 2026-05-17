<?php

namespace App\Http\Controllers;

class DokterController extends Controller
{
    public function index()
    {
        return view('dokter.dashboard');
    }
}