<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;

use App\Expense;
use App\User;

use DateTime;
use Auth;

class TrackerController extends Controller
{
  public function getDatas(Request $request) {
    $inputs = $request->all();
    $user = Auth::user();
    $expenses = Expense::where('expense_date', $inputs['date'])->get();
    $total = Expense::where('expense_date', $inputs['date'])->sum('expense_amount');

    return compact('user','expenses','total');
  }
  public function addExpense(ExpenseRequest $request) {
    $inputs = $request->all();
    $user = Auth::user();

    if($user['spendable_amount'] < $inputs['expense_amount']) {
      return response(null, 500);
    }

    $inputs['user_id'] = $user['id'];

    $new_spendable = $user['spendable_amount'] - $inputs['expense_amount'];

    $date = new DateTime($inputs['expense_date']);
    $inputs['expense_date'] = $date->format('Y-m-d');

    User::find($user['id'])->update(array('spendable_amount' => $new_spendable));
    Expense::create($inputs);

    return $inputs;
  }
  public function deleteExpense($id) {
    $user = Auth::user();
    $expense = Expense::where('id',$id)->get();
    $new_spendable = $user['spendable_amount'] + $expense[0]['expense_amount'];
    User::find($user['id'])->update(array('spendable_amount' => $new_spendable));
    Expense::destroy($id);
  }
}
