<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
