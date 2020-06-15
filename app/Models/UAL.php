<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UAL extends Model
{
    use SoftDeletes;

    protected $table = 'ual';

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class, 'ual', 'id');
    }
}
