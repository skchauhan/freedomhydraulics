<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dealer_categories';

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
    protected $fillable = ['status'];

    /**
     * @return News Translate
     */
    public function dealerCategoryTranslate()
    {
        return $this->hasOne( 'App\DealerCategoryTranslations', 'dealer_category_id' )->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * @return dealer All Translate
     */
    public function dealerCategoryAllTranslate()
    {
        return $this->hasMany( 'App\DealerCategoryTranslations', 'dealer_category_id' )->where('language_code', session('cur_lang', 'en'));
    }
    
}
