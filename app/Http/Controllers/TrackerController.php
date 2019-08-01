<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class TrackerController extends Controller
{
  public function getDatas() {
    $user = Auth::user();

    return compact('user');
  }
}
