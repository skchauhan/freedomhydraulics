<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DealerCategory;
use App\DealerCategoryTranslations;
use Illuminate\Http\Request;

class DealerCategoryController extends Controller
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
            $dealercategory = DealerCategory::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $dealercategory = DealerCategory::latest()->paginate($perPage);
        }

        return view('admin.dealer-category.index', compact('dealercategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.dealer-category.create');
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
        $dealerCat = DealerCategory::create(['status'=>$request->status]);

        if(isset($dealerCat)) {
            $intCount = count($request->language_code);
            for ($i=0; $i < $intCount; $i++) {
                $strName = $request->name[$i];
                $langcode = $request->language_code[$i];

                $dealerCat->dealerCategoryTranslate()->create(['language_code'=>$langcode, 'name'=>$strName]);
            }
        }

        return redirect('admin/dealer-category')->with('flash_message', 'DealerCategory added!');
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
        $dealercategory = DealerCategory::findOrFail($id);

        return view('admin.dealer-category.show', compact('dealercategory'));
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
        $dealercategory = DealerCategory::findOrFail($id);

        return view('admin.dealer-category.edit', compact('dealercategory'));
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
        $dealercategory = DealerCategory::findOrFail($id);
        $dealercategory->update(['status'=>$request->status]);

        if(isset($dealercategory)) {
            DealerCategoryTranslations::where(['dealer_category_id'=>$id])->delete();
            $intCount = count($request->language_code);
            for ($i=0; $i < $intCount; $i++) {
                $strName = $request->name[$i];
                $langcode = $request->language_code[$i];
                
                DealerCategoryTranslations::create(['dealer_category_id'=>$id, 'language_code'=>$langcode, 'name'=>$strName]);
            }
        }

        return redirect('admin/dealer-category')->with('flash_message', 'DealerCategory updated!');
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
        DealerCategory::destroy($id);

        return redirect('admin/dealer-category')->with('flash_message', 'DealerCategory deleted!');
    }
}
