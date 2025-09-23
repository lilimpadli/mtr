<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
{
    $motors = Motor::with(['pemilik', 'tarifRental'])->get();
    return view('welcome', compact('motors'));
}


   public function show($id) {
    $motor = Motor::with('tarifRental')->findOrFail($id);
    return view('motors.show', compact('motor'));
}


}
