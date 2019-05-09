<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\HelperTrait;

use App\NewsCategory;
use App\NewsCategoryTranslation;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $newscategory = NewsCategory::whereHas('categoryTranslate', function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%$keyword%");
            })->orderBy('id', 'desc')->paginate($perPage);
        } else {
            $newscategory = NewsCategory::latest()->paginate($perPage);
        }

        // $newscategory = NewsCategory::has('categoryTranslate')->orderBy('id', 'desc')->get();

        return view('admin.news-category.index', compact('newscategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $allCategory = \App\NewsCategory::with('categoryTranslate')->where('parent_id', '=', 0)->get();
        $arrCategory = $this->twoTablePluck($allCategory);
        return view('admin.news-category.create', compact('arrCategory'));
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
        $validatedData = $request->validate([
            'name.*' => 'required|distinct',
            'name' => 'unique:news_category_translations',
            'meta_keywords.*' => 'required|distinct',
            'meta_keywords' => 'required|unique:news_translations',
            'meta_description.*' => 'required|distinct',
            'meta_description' => 'required|unique:news_translations',
        ]);

        $newsCategory = NewsCategory::create(['parent_id'=>$request->parent_id]);

        $intCount = count($request->language_code);

        for ($i=0; $i < $intCount; $i++) {
            $strName = $request->name[$i];
            $strCode = $request->language_code[$i];
            $strMetaKey = $request->meta_keywords[$i];
            $strMetaDesc = $request->meta_description[$i];

            $newsCategory->categoryTranslate()->create(['language_code'=>$strCode, 'name'=>$strName, 'meta_keywords'=>$strMetaKey, 'meta_description'=>$strMetaDesc]);
        }

        return redirect('admin/news-category')->with('flash_message', 'NewsCategory added!');
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
        $newscategory = NewsCategory::findOrFail($id);
        return view('admin.news-category.show', compact('newscategory'));
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
        $allCategory = \App\NewsCategory::with('categoryTranslate')->where([['parent_id', '=', 0], ['id', '!=', $id]])->get();
        $arrCategory = $this->twoTablePluck($allCategory);
        $newscategory = NewsCategory::with('categoryAllTranslate')->findOrFail($id);
        return view('admin.news-category.edit', compact('newscategory', 'arrCategory'));
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
        $requestData = $request->all();

        $newsCategory = NewsCategory::where('id', $id)->update(['parent_id'=>$request->parent_id]);

        if($newsCategory) {
            NewsCategoryTranslation::where('news_category_id', $id)->delete();

            // NewsCategoryTranslation::create(['news_category_id'=>$id, 'language_code'=>$strCode, 'name'=>$strName]);
            $intCount = count($request->language_code);

            for ($i=0; $i < $intCount; $i++) {
                $strName = $request->name[$i];
                $strCode = $request->language_code[$i];
                $strMetaKeyWord = $request->meta_keywords[$i];
                $strMetaDesc = $request->meta_description[$i];

                NewsCategoryTranslation::create(['news_category_id'=>$id, 'language_code'=>$strCode, 'name'=>$strName, 'meta_keywords'=>$strMetaKeyWord, 'meta_description'=>$strMetaDesc]);
            }
            
            return redirect('admin/news-category')->with('flash_message', 'NewsCategory updated!');
        }
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
        NewsCategory::destroy($id);

        return redirect('admin/news-category')->with('flash_message', 'NewsCategory deleted!');
    }
}
