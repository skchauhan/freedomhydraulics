<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecificationTranslation extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_specification_translations';

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
    protected $fillable = ['product_spec_id', 'tab_id', 'language_code', 'description'];
}
