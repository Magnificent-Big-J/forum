<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = ['id'];

    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
