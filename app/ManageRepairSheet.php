<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageRepairSheet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manage_repair_sheets';

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
    protected $fillable = ['category', 'modal_name', 'description', 'instruction', 'instruction_caption', 'cad', 'enerpac', 'simplex', 'power_team', 'williams', 'ram-pac', 'bva'];

    
    public function repairSheet()
    {
        return $this->hasMany('App\RepairSheets');
    }
}
