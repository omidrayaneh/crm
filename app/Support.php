<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
