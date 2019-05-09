<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nav_menus';

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
    protected $fillable = ['order', 'slug', 'status'];

    /**
     * @return Nav Menus Translate
     */
    public function navMenuTranslate()
    {
        return $this->hasOne( 'App\NavMenuTranslation', 'nav_menu_id' )->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * @return Nav Menus All Translate
     */
    public function navMenusAllTranslate()
    {
        return $this->hasMany( 'App\NavMenuTranslation', 'nav_menu_id' );
    }

    
}
