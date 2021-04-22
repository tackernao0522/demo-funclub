<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'your_name',
        'your_email',
        'your_message',
    ];
}
