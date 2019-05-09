<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTab extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_tabs';

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
    protected $fillable = ['order', 'status'];

    /**
     * [tabTranslate description]
     * @return [type] [description]
     */
    public function tabTranslate()
    {
        return $this->hasOne( 'App\ProductTabTranslation', 'product_tab_id' )->where('language_code', session('cur_lang', 'en'));
    }
    
    /**
     * [tabAllTranslate description]
     * @return [type] [description]
     */
    public function tabAllTranslate()
    {
        return $this->hasMany( 'App\ProductTabTranslation', 'product_tab_id' );
    }

    
}
