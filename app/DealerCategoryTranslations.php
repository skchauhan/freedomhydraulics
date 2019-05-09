<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCategoryTranslations extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dealer_category_translations';

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
    protected $fillable = ['dealer_category_id', 'language_code', 'name'];
}
