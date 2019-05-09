<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dealers';

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
    protected $fillable = ['category', 'city', 'state', 'postal_code', 'country', 'latitude', 'longitude', 'phone', 'fax', 'link', 'status'];

    
    /**
     * @return News Translate
     */
    public function dealerTranslate()
    {
        return $this->hasOne( 'App\DealerTranslation', 'dealer_id' )->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * @return dealer All Translate
     */
    public function dealerAllTranslate()
    {
        return $this->hasMany( 'App\DealerTranslation', 'dealer_id' );
    }

    /**
     * @return news category
     */
    public function dealerCategory()
    {
        return $this->belongsTo('App\DealerCategoryTranslations', 'category', 'dealer_category_id')->where('language_code', session('cur_lang', 'en'));
    }
       
}
