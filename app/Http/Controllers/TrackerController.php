<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;

use App\Expense;
use App\User;

use DateTime;
use Auth;
use DB;

class TrackerController extends Controller
{
  public function getDatas(Request $request) {
    $inputs = $request->all();
    $user = Auth::user();
    $expenses = Expense::where('expense_date', $inputs['date'])->where('user_id', $user['id'])->get();
    $total = Expense::where('expense_date', $inputs['date'])->where('user_id', $user['id'])->sum('expense_amount');

    return compact('user','expenses','total');
  }
  public function addExpense(ExpenseRequest $request) {
    try {
      DB::beginTransaction();

      $inputs = $request->all();
      $user = Auth::user();
  
      if($user['spendable_amount'] < $inputs['expense_amount']) {
        return response(null, 400);
      }
  
      $inputs['user_id'] = $user['id'];
  
      $new_spendable = $user['spendable_amount'] - $inputs['expense_amount'];
  
      $date = new DateTime($inputs['expense_date']);
      $inputs['expense_date'] = $date->format('Y-m-d');
  
      User::find($user['id'])->update(array('spendable_amount' => $new_spendable));
      Expense::create($inputs);

      DB::commit();
    } catch(\Exception $ex) {
      DB::rollBack();
    }
  }

  public function editExpense(ExpenseRequest $request) {
    try {
      $inputs = $request->all();
      Expense::find($inputs['id'])->update(array('expense_description' => $inputs['expense_description']));
    } catch(\Exception $ex) {

    }
  }
  public function deleteExpense($id) {
    try {
      DB::beginTransaction();

      $user = Auth::user();
      $expense = Expense::where('id',$id)->get();
      $new_spendable = $user['spendable_amount'] + $expense[0]['expense_amount'];
      User::find($user['id'])->update(array('spendable_amount' => $new_spendable));
      Expense::destroy($id);

      DB::commit();
    } catch(\Exception $ex) {
      DB::rollBack();
    }
    
  }
}
