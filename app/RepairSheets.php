<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepairSheets extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'repair_sheets';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['repair_sheet_caption', 'repair_sheet'];
}
