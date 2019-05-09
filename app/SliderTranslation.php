<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'slider_translations';

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
    protected $fillable = ['slider_id', 'language_code', 'slider_text'];
}
