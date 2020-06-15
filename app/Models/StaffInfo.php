<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class StaffInfo extends Model
{
    use Sortable;
    use SoftDeletes;

    protected $table = 'staff_info';

    protected $guarded = [];

    protected $dates = [
        'start_work',
    ];

    public $sortable = ['user_id', 'ic_no'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function staff_leave()
    {
        return $this->hasMany(StaffLeave::class, 'user_id', 'user_id');
    }

    public function staff_claim()
    {
        return $this->hasMany(StaffClaim::class, 'user_id', 'user_id');
    }
}
