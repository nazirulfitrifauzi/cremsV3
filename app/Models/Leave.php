<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leaves';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'start',
        'end',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
