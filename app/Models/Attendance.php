<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'login_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
