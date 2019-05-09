<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSliderTranslation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_slider_translations';

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
    protected $fillable = ['product_slider_id', 'language_code', 'description'];
}
