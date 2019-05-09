<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\News;
use App\User;
use App\NewsCategory;
use App\NewsTranslation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\HelperTrait;

class NewsController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index( Request $request )
    {

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $news = News::whereHas('newsTranslate', function($q) use ($keyword) {
                $q->where('title', 'LIKE', "%$keyword%")->orWhere('content', 'LIKE', "%$keyword%");
            })->orderBy('id', 'desc')->paginate($perPage);
        } else {
            $news = News::latest()->paginate($perPage);
        }
        
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name', 'id');

        $users->prepend('Select One', 0);

        $allCategory = NewsCategory::all();

        $arrCategory = $this->parentNewsChildCategory($allCategory);

        return view('admin.news.create', compact('users', 'arrCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $newsData = [];
        $validatedData = $request->validate([
            'title.*' => 'required|distinct',
            'title' => 'required|unique:news_translations',
            'content.*' => 'required|distinct',
            'content' => 'required|unique:news_translations',            
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'meta_keywords.*' => 'required|distinct',
            'meta_keywords' => 'required|unique:news_translations',
            'meta_description.*' => 'required|distinct',
            'meta_description' => 'required|unique:news_translations',
            'img_alt.*' => 'required|distinct',
            'img_alt' => 'required|unique:news_translations,image_alt',
        ]);

        $requestData = $request->except(['author_id', 'status']);
        
        $file = $request->file('image');

        if($file) {
            $name = time() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move(public_path()."/news", $name);
            $newsData['image'] = $name;
        }
        $newsData['category_id'] = $request->category_id;
        $newsData['author_id'] = $request->author_id;

        $news = News::create($newsData);

        $intCount = count($request->language_code);

        for ($i=0; $i < $intCount; $i++) {
            $strTitle = $request->title[$i];
            $strLangCode = $request->language_code[$i];
            $strContent = $request->content[$i];
            $strKeywords = $request->meta_keywords[$i];
            $strDescriptions = $request->meta_description[$i];
            $strImgAlt = $request->img_alt[$i];

            $news->newsTranslate()->create(['language_code'=>$strLangCode, 'title'=>$strTitle, 'content'=>$strContent, 'meta_keywords'=>$strKeywords, 'meta_description'=>$strDescriptions, 'image_alt'=>$strImgAlt]);
        }

        return redirect('admin/news')->with('flash_message', 'News added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $news = News::findOrFail($id);

        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $users = User::pluck('name', 'id');
        $users->prepend('Select One');

        $allCategory = NewsCategory::all();

        $arrCategory = $this->parentNewsChildCategory($allCategory);

        $news = News::findOrFail($id);

        return view('admin.news.edit', compact('news', 'users', 'arrCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        /*$validatedData = $request->validate([
            'title.*' => 'required|distinct',
            'title' => 'required|unique:news_translations',
            'contetn.*' => 'required|distinct',
            'contetn' => 'required|unique:news_translations',            
            'meta_keywords.*' => 'required|distinct',
            'meta_keywords' => 'required|unique:news_translations',
            'meta_description.*' => 'required|distinct',
            'meta_description' => 'required|unique:news_translations',
            'img_alt.*' => 'required|distinct',
            'img_alt' => 'required|unique:news_translations,image_alt',
        ]);*/
            
        $requestData = $request->except(['_method', '_token','image', 'title', 'content', 'language_code', 'meta_keywords', 'meta_description', 'img_alt']);

        $file = $request->file('image');
        if(!empty($file)) {
            $name = time() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move(public_path()."/news", $name);
            $requestData['image'] = $name;            
        }

        $news = News::where('id', $id)->update($requestData);

        if($news) {
            NewsTranslation::where('news_id', $id)->delete();
            
            $intCount = count($request->language_code);
            for ($i=0; $i < $intCount; $i++) {
                $strTitle = $request->title[$i];
                $strLangCode = $request->language_code[$i];
                $strContent = $request->content[$i];
                $strKeywords = $request->meta_keywords[$i];
                $strDescriptions = $request->meta_description[$i];
                $strImgAlt = $request->img_alt[$i];

                NewsTranslation::create(['news_id'=>$id, 'language_code'=>$strLangCode, 'title'=>$strTitle, 'content'=>$strContent, 'meta_keywords'=>$strKeywords, 'meta_description'=>$strDescriptions, 'image_alt'=>$strImgAlt]);
            }
        }

        return redirect('admin/news')->with('flash_message', 'News updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        News::destroy($id);

        return redirect('admin/news')->with('flash_message', 'News deleted!');
    }
}
