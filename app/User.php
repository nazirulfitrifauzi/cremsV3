<?php

namespace App;

use App\Models\Attendance;
use App\Models\Claim;
use App\Models\Leave;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $sortable = ['name', 'email', 'role', 'avatar', 'active'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'user_id', 'id');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role', 'id');
    }
}
