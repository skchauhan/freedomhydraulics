<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

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
    protected $fillable = ['status'];

    /**
     * @return Pages Translate
     */
    public function pagesTranslate()
    {
        return $this->hasOne( 'App\PageTranslation', 'page_id' )->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * @return News All Translate
     */
    public function pagesAllTranslate()
    {
        return $this->hasMany( 'App\PageTranslation', 'page_id' );
    }

    
}
