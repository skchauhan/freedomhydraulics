<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategoryTranslation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news_category_translations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['news_category_id', 'language_code', 'name', 'meta_keywords', 'meta_description'];

    
}
