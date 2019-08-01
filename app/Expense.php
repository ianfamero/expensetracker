<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'expense_date',
        'expense_description', 
        'expense_amount',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
