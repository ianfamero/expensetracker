<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HeaderController extends Controller
{
  public function getUser() {
    $user = Auth::user();

    return compact('user');
  }
}
