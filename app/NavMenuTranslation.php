<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavMenuTranslation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nav_menu_translations';

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
    protected $fillable = ['nav_menu_id','language_code', 'menu'];
}
