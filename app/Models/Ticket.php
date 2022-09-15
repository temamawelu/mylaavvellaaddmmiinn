<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $table = 'ticket';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }


    
}
