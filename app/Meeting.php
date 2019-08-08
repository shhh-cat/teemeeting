<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public $table = 'meetings';

    protected $fillable = [
        'meeting_name', 'owner_id',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function owner()
    {
        return $this->belongsTo('App\User','owner_id');
    }
}
