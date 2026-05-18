<?php

namespace App\Http\Controllers;

class PasienController extends Controller
{
    public function index()
    {
        return view('pasien.dashboard');
    }
}