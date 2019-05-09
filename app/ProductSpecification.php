<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_specifications';

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
    protected $fillable = ['specification'];


    /**
     * @return has Many Specification
    */
    public function specificationTranslate()
    {
        return $this->hasMany( 'App\ProductSpecificationTranslation', 'product_spec_id' )->where('language_code', session('cur_lang', 'en'));
    }


    /**
     * @return has Many Specification
    */
    public function specificationlTranslate()
    {
        return $this->hasMany( 'App\ProductSpecificationTranslation', 'product_spec_id' );
    }
}
