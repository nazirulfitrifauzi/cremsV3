<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Leave extends Model
{
    use Sortable;
    use SoftDeletes;

    protected $table = 'leaves';

    protected $guarded = [];

    protected $dates = [
        'start',
        'end',
    ];

    public $sortable = ['user_id', 'reason', 'type', 'start', 'end', 'days', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
