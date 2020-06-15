<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class StaffLeave extends Model
{
    use Sortable;
    use SoftDeletes;

    protected $table = 'staff_leave';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $sortable = ['staff_info_id', 'ic_no', 'year'];

    public function staff_info()
    {
        return $this->belongsTo(StaffInfo::class, 'user_id', 'user_id');
    }
}
