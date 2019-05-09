<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use App\PageTranslation;
use Illuminate\Http\Request;

class PageController extends Controller
{
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
            $pages = Page::whereHas('pagesTranslate', function($q) use ($keyword) {
                $q->where('title', 'LIKE', "%$keyword%")->orWhere('content', 'LIKE', "%$keyword%");
            })->orderBy('id', 'desc')->paginate($perPage);
        } else {
            $pages = Page::latest()->paginate($perPage);
        }

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'title.*' => 'required|distinct',
            'title' => 'required|unique:page_translations',
            'content.*' => 'required|distinct',
            'content' => 'required|unique:page_translations',
            'meta_keywords.*' => 'required|distinct',
            'meta_keywords' => 'required|unique:news_translations',
            'meta_description.*' => 'required|distinct',
            'meta_description' => 'required|unique:news_translations'
        ]);

        $page = Page::create(['status'=>1]);

        $intCount = count($request->language_code);

        for ($i=0; $i < $intCount; $i++) {
            $strTitle = $request->title[$i];
            $strContent = $request->content[$i];
            $strLangCode = $request->language_code[$i];
            $strMetaKey = $request->meta_keywords[$i];
            $strMetaDesc = $request->meta_description[$i];

            $page->pagesTranslate()->create(['language_code'=>$strLangCode, 'title'=>$strTitle, 'content'=>$strContent, 'meta_keywords'=>$strMetaKey, 'meta_description'=>$strMetaDesc]);
        }

        return redirect('admin/pages')->with('flash_message', 'Page added!');
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
        $page = Page::findOrFail($id);

        return view('admin.pages.show', compact('page'));
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
        $page = Page::findOrFail($id);

        return view('admin.pages.edit', compact('page'));
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

        $page = Page::findOrFail($id);
        $page->update(['status'=>$request->status]);

        $intCount = count($request->language_code);

        if(isset($page)) { 

            PageTranslation::where('page_id', $id)->delete();

            for ($i=0; $i < $intCount; $i++) {
                $strTitle = $request->title[$i];
                $strContent = $request->content[$i];
                $strLangCode = $request->language_code[$i];
                $strMetaKey = $request->meta_keywords[$i];
                $strMetaDesc = $request->meta_description[$i];

                PageTranslation::create(['page_id'=>$id, 'language_code'=>$strLangCode, 'title'=>$strTitle, 'content'=>$strContent, 'meta_keywords'=>$strMetaKey, 'meta_description'=>$strMetaDesc]);
            }
        }

        return redirect('admin/pages')->with('flash_message', 'Page updated!');
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
        Page::destroy($id);

        return redirect('admin/pages')->with('flash_message', 'Page deleted!');
    }
}
