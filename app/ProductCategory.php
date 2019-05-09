<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_categories';

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
    protected $fillable = ['parent_id', 'image', 'category_order', 'status'];

    /**
     * [categoryTranslate description]
     * @return [type] [description]
     */
    public function categoryTranslate()
    {
        return $this->hasOne( 'App\ProductCategoryTranslation', 'product_category_id' )->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * [categoryTranslate description]
     * @return [type] [description]
     */
    public function categoryChldTranslate()
    {
        return $this->hasOne( 'App\ProductCategoryTranslation', 'product_category_id' );
    }

    /**
     * [categoryAllTranslate description]
     * @return [type] [description]
     */
    public function categoryAllTranslate()
    {
        return $this->hasMany( 'App\ProductCategoryTranslation', 'product_category_id' );
    }

    /**
     * [parentCategory description]
     * @return [type] [description]
     */
    public function parentCategory() 
    {
        return $this->belongsTo( 'App\ProductCategoryTranslation', 'parent_id', 'product_category_id' )->where('language_code', session('cur_lang', 'en'));
    }
}
