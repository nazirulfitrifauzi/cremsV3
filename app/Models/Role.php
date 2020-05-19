<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->hasMany(User::class, 'role', 'id');
    }
}
