<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'status'
    ];

    protected static function boot()
    {
        parent::boot();

        /*static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('status', 1);
        });*/

    }

}
