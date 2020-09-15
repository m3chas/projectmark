<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogImport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'posts_imported', 'started_at', 'finished_at', 'status', 'notes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

}
