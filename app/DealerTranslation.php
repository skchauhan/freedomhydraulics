<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerTranslation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dealer_translations';

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
    protected $fillable = ['dealer_id', 'language_code', 'title', 'address_1', 'address_2'];
}
