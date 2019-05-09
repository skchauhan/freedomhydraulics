<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSlider extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_sliders';

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
    protected $fillable = ['product_id', 'image'];


    /**
     * @return has Many Slider
    */
    public function sliderTranslate()
    {
        return $this->hasMany( 'App\ProductSliderTranslation', 'product_slider_id' )->where('language_code', session('cur_lang', 'en'));
    }


    /**
     * @return has Many Slider
    */
    public function sliderAllTranslate()
    {
        return $this->hasMany( 'App\ProductSliderTranslation', 'product_slider_id' );
    }




}
