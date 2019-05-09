<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

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
    protected $fillable = ['category_id', 'author_id', 'image'];

    /**
     * @return News Translate
     */
    public function newsTranslate()
    {
        return $this->hasOne( 'App\NewsTranslation', 'news_id' )->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * @return News All Translate
     */
    public function newsAllTranslate()
    {
        return $this->hasMany( 'App\NewsTranslation', 'news_id' );
    }
       
    /**
     * @return news category
     */
    public function newsCategory()
    {
        return $this->belongsTo('App\NewsCategoryTranslation', 'category_id', 'news_category_id')->where('language_code', session('cur_lang', 'en'));
    }

    /**
     * @return News Author
     */
    public function newsAuthor()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
    
}
