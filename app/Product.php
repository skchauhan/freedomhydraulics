<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['category_id', 'status'];

    /**
     * [parentCategory description]
     * @return [type] [description]
     */
    public function parentCategory() 
    {
        return $this->belongsTo( 'App\ProductCategoryTranslation', 'category_id', 'product_category_id' )->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * @return has Many Slider
    */
    public function sliders()
    {
        return $this->hasMany( 'App\ProductSlider', 'product_id' );
    }

    /**
     * @return News Translate
     */
    public function productTranslate()
    {
        return $this->hasOne( 'App\ProductTranslation' )->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * @return News All Translate
     */
    public function productAllTranslate()
    {
        return $this->hasMany( 'App\ProductTranslation' );
    }

    /**
     * @return news category
     */
    public function productCategory()
    {
        return $this->belongsTo('App\ProductCategoryTranslation', 'category_id', 'product_category_id')->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * [sliderTrans description]
     * @return [type] [description]
     */
    public function sliderTrans()
    {
        return $this->hasManyThrough('App\ProductSliderTranslation', 'App\ProductSlider');
    }

    /**
     * [specifications description]
     * @return [type] [description]
     */
    public function specifications()
    {
        return $this->hasMany('App\ProductSpecification');
    }



    
}
