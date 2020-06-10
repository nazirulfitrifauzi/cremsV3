<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Profile extends Model
{
    use Sortable;
    use SoftDeletes;

    protected $table = 'profile';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $sortable = ['user_id', 'ic_no', 'phone', 'address1', 'postcode', 'city', 'country'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
