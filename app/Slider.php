<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sliders';

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
    protected $fillable = ['image'];

    
    public function sliderTranslate()
    {
        return $this->hasOne( 'App\SliderTranslation', 'slider_id' )->where('language_code', session('cur_lang', 'en'));
    }

    public function sliderAllTranslate()
    {
        return $this->hasMany( 'App\SliderTranslation', 'slider_id' );
    }

    /*public function parentslider() 
    {
        return $this->belongsTo( 'App\SliderTranslation', 'parent_id', 'slider_id' )->where('language_code', session('cur_lang', 'en'));
    }*/
}
