<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FundRequest;
use App\Http\Requests\TransferFundsRequest;

use App\User;

use Auth;

class FundController extends Controller
{
  public function getDatas() {
    $user = Auth::user();
    $summary = array(
      array(
        'id' => 0,
        'name' => 'Savings',
        'amount' => $user['savings_amount'],
      ),
      array(
        'id' => 1,
        'name' => 'Spendable',
        'amount' => $user['spendable_amount'],
      ),
      array(
        'id' => 2,
        'name' => 'Receivable',
        'amount' => $user['receivable_amount']
      )
    );
    return compact('user', 'summary');
  }

  public function addFund(FundRequest $request) {
    $inputs = $request->all();
    $user = Auth::user();
    $amount = (int)$user['spendable_amount'] + (int)$inputs['amount'];
    User::find($user['id'])->update(array('spendable_amount' => $amount));
  }

  public function transferFunds(TransferFundsRequest $request) {
    $inputs = $request->all();
    $user = Auth::user();
    if($inputs['source'] == 0) { //savings
      if($user['savings_amount'] < $inputs['amount']) {
        return response(null, 400);
      }
      if($inputs['destination'] == 1) { //spendable
        $new_spendable = $user['spendable_amount'] + $inputs['amount'];
        $new_savings = $user['savings_amount'] - $inputs['amount'];
        $new_receivable = $user['receivable_amount'];
      } else if($inputs['destination'] == 2) { //receivable
        $new_spendable = $user['spendable_amount'];
        $new_savings = $user['savings_amount'] - $inputs['amount'];
        $new_receivable = $user['receivable_amount'] + $inputs['amount'];
      } else {
        return response(null, 405);
      }
    } else if($inputs['source'] == 1) { //spendable
      if($user['spendable_amount'] < $inputs['amount']) {
        return response(null, 400);
      }
      if($inputs['destination'] == 0) { //savings
        $new_spendable = $user['spendable_amount'] - $inputs['amount'];
        $new_savings = $user['savings_amount'] + $inputs['amount'];
        $new_receivable = $user['receivable_amount'];
      } else if($inputs['destination'] == 2) { //receivable
        $new_spendable = $user['spendable_amount'] - $inputs['amount'];
        $new_savings = $user['savings_amount'];
        $new_receivable = $user['receivable_amount'] + $inputs['amount'];
      } else {
        return response(null, 405);
      }
    } else if($inputs['source'] == 2) { //receivable
      if($user['receivable_amount'] < $inputs['amount']) {
        return response(null, 400);
      }
      if($inputs['destination'] == 0) { //savings
        $new_spendable = $user['spendable_amount'];
        $new_savings = $user['savings_amount'] + $inputs['amount'];
        $new_receivable = $user['receivable_amount'] - $inputs['amount'];
      } else if($inputs['destination'] == 1) { //spendable
        $new_spendable = $user['spendable_amount'] + $inputs['amount'];
        $new_savings = $user['savings_amount'];
        $new_receivable = $user['receivable_amount'] - $inputs['amount'];
      } else {
        return response(null, 405);
      }
    }
    User::find($user['id'])->update(
      array(
        'spendable_amount' => $new_spendable,
        'savings_amount' => $new_savings,
        'receivable_amount' => $new_receivable,
      )
    );
  }
}
