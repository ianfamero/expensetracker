<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'debt_description', 
        'debt_amount',
        'debt_due_date'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
