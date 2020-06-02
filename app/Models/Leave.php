<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Leave extends Model
{
    use Sortable;

    protected $table = 'leaves';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'start',
        'end',
    ];

    public $sortable = ['user_id', 'reason', 'type', 'start', 'end', 'halfDay', 'days', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
