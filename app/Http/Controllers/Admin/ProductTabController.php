<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ProductTab;
use App\ProductTabTranslation;
use Illuminate\Http\Request;

class ProductTabController extends Controller
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
            $producttab = ProductTab::whereHas('tabTranslate', function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%$keyword%");
            })->latest()->paginate($perPage);
        } else {
            $producttab = ProductTab::latest()->paginate($perPage);
        }

        return view('admin.product-tab.index', compact('producttab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product-tab.create');
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
            'name' => 'required|unique:product_tab_translations',
            'order' => 'required|unique:product_tabs'
        ]);

        $requestData = $request->except('language_code', 'name');
        
        $productTab = ProductTab::create($requestData);

        if(isset($productTab)) {
            $intCount = count($request->language_code);

            for ($i=0; $i < $intCount; $i++) {
                $strName = $request->name[$i];
                $strLangCode = $request->language_code[$i];
                $productTab->tabTranslate()->create(['language_code'=>$strLangCode, 'name'=>$strName]);
            }
        }

        return redirect('admin/product-tab')->with('flash_message', 'ProductTab added!');
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
        $producttab = ProductTab::findOrFail($id);

        return view('admin.product-tab.show', compact('producttab'));
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
        $producttab = ProductTab::findOrFail($id);

        return view('admin.product-tab.edit', compact('producttab'));
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
        
        $requestData = $request->except('language_code', 'name', '_method', '_token');
        
        $productTab = ProductTab::where('id', $id)->update($requestData);

        if(isset($productTab)) {
            ProductTabTranslation::where('product_tab_id', $id)->delete();

            $intCount = count($request->language_code);

            for ($i=0; $i < $intCount; $i++) {
                $strName = $request->name[$i];
                $strLangCode = $request->language_code[$i];

                ProductTabTranslation::create(['product_tab_id'=>$id, 'language_code'=>$strLangCode, 'name'=>$strName]);
            }
        }        

        return redirect('admin/product-tab')->with('flash_message', 'ProductTab updated!');
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
        ProductTab::destroy($id);

        return redirect('admin/product-tab')->with('flash_message', 'ProductTab deleted!');
    }
}
