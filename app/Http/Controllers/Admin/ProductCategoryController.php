<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\HelperTrait;

use App\ProductCategory;
use App\ProductCategoryTranslation;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
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
            $productcategory = ProductCategory::whereHas('categoryTranslate', function($q) use ( $keyword ) {
                $q->where('name', 'LIKE', "%$keyword%");
            })->paginate($perPage);
        } else {
            $productcategory = ProductCategory::latest()->paginate($perPage);
        }

        return view('admin.product-category.index', compact('productcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $allCategory = \App\ProductCategory::with('categoryTranslate')->where('parent_id', '=', 0)->get();
        $arrCategory = $this->twoTablePluck($allCategory);

        return view('admin.product-category.create', compact('arrCategory'));
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
            'category_order' => 'required|unique:product_categories',
            'name.*' => 'required|distinct',
            'name' => 'required|unique:product_category_translations',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'meta_keywords.*' => 'required|distinct',
            'meta_keywords' => 'required|unique:news_translations',
            'meta_description.*' => 'required|distinct',
            'meta_description' => 'required|unique:news_translations',
        ]);

        $requestData = $request->except('language_code', 'name');

        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $request->file('image')->move(public_path()."/product", $fileName);

        $requestData['image'] = $fileName;
        
        $productCategory = ProductCategory::create($requestData);

        if(isset($productCategory)) {
            $intCount = count($request->language_code);
            for ($i=0; $i < $intCount; $i++) {
                $strName = $request->name[$i];
                $strCode = $request->language_code[$i];
                $strImageAlt = $request->img_alt[$i];
                $strKeywords = $request->meta_keywords[$i];
                $strDescriptions = $request->meta_description[$i];

                $productCategory->categoryTranslate()->create(['language_code'=>$strCode, 'name'=>$strName, 'image_alt'=>$strImageAlt, 'meta_keywords'=>$strKeywords, 'meta_description'=>$strDescriptions]);
            }
        }

        return redirect('admin/product-category')->with('flash_message', 'ProductCategory added!');
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
        $productcategory = ProductCategory::findOrFail($id);

        return view('admin.product-category.show', compact('productcategory'));
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
        $allCategory = \App\ProductCategory::with('categoryTranslate')->where([['parent_id', '=', 0], ['id', '!=', $id]])->get();
        $arrCategory = $this->twoTablePluck($allCategory);

        $productcategory = ProductCategory::findOrFail($id);
        return view('admin.product-category.edit', compact('productcategory', 'arrCategory'));
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
        $validatedData = $request->validate([
            'category_order' => 'required|unique:product_categories,category_order,'.$id,
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        
        $requestData = $request->except('language_code', 'name', '_method', '_token');

        $file = $request->file('image');
        if(!empty($file)) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move(public_path()."/product", $fileName);
            $requestData['image'] = $fileName;
        }

        $productCategory = ProductCategory::where('id', $id)->update($requestData);

        if(isset($productCategory)) {
            ProductCategoryTranslation::where('product_category_id', $id)->delete();

            $intCount = count($request->language_code);
            for ($i=0; $i < $intCount; $i++) {
                $strName = $request->name[$i];
                $strImageAlt = $request->img_alt[$i];
                $strKeywords = $request->meta_keywords[$i];
                $strDescriptions = $request->meta_description[$i];

                ProductCategoryTranslation::create(['product_category_id'=>$id, 'language_code'=>$strCode, 'name'=>$strName, 'image_alt'=>$strImageAlt, 'meta_keywords'=>$strKeywords, 'meta_description'=>$strDescriptions]);
            }

        }

        return redirect('admin/product-category')->with('flash_message', 'ProductCategory updated!');
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
        ProductCategory::destroy($id);

        return redirect('admin/product-category')->with('flash_message', 'ProductCategory deleted!');
    }
}
