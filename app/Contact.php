<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name','email', 'message','resolved_by', 'resolved_on','notes','status'
    ];
}
