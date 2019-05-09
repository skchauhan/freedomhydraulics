<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryTranslation extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_category_translations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_category_id', 'language_code', 'name', 'image_alt', 'meta_keywords', 'meta_description'];
}
