<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
  public function register(RegisterRequest $request) {
    try {
      $data = $request->all();
      $data['password'] = bcrypt($data['password']);
      $data['savings_amount'] = 0;
      $data['spendable_amount'] = 0;
      $data['receivable_amount'] = 0;
      $user = User::create($data);

      return $user;
    } catch(\Exception $ex) {

    }
  }
}
