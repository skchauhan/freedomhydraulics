<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\HelperTrait;
use App\Http\Requests;
use App\ProductCategory;
use App\ProductTranslation;
use App\ProductSlider;
use App\ProductSpecification;
use App\Product;
use App\ProductTab;
use Illuminate\Http\Request;

class ProductController extends Controller
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
            $product = Product::whereHas('productTranslate', function($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%$keyword%");
                })->latest()->paginate($perPage);
        } else {
            $product = Product::with('sliders')->orderBy('id', 'desc')->get();
        }

        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $allCategory = ProductCategory::all();
        $arrCategory = $this->parentChildCategory($allCategory);
        $arrProductTabs = ProductTab::all();
        return view('admin.product.create', compact('arrCategory', 'arrProductTabs'));
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
            'category_id' => 'required',
            'name.*' => 'required|distinct',
            'name' => 'required|unique:product_translations',
            'slider_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'slider_image.*' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        $objSpecification = $request->specifications;
        $category_id = $request->category_id;
        $status = $request->status;
        $images = $request->file('slider_image');

        $objProduct = Product::create(['category_id'=>$category_id, 'status'=>$status]);

        if(isset($objProduct)) {
            $intCount = count($request->language_code);

            //Add specification
            if(!empty($objSpecification)) {
                foreach ($objSpecification as $key => $data) {
                    $arrSpect = $objProduct->specifications()->create(['product_id'=>$objProduct->id]);
                    for ($i=0; $i < count($data); $i++) { 
                        $desc = !empty($data[$i]) ? $data[$i] : '';
                        $lang = $request->language_code[$i];
                        $arrSpect->specificationTranslate()->create(['tab_id'=>$key, 'language_code'=>$lang, 'description'=>$desc]);
                    }
                }
            }

            // Add product translation
            for ($i=0; $i < $intCount; $i++) {
                $lngCode = $request->language_code[$i];    
                $strName = $request->name[$i];    
                $strKeywords = $request->meta_keywords[$i];
                $strDescriptions = $request->meta_description[$i];
                $objProduct->productTranslate()->create(['language_code'=>$lngCode, 'name'=>$strName, 'meta_keywords'=>$strKeywords, 'meta_description'=>$strDescriptions]);
            }

            // Add Product slider 
            for ($i=0; $i < count($request->content); $i++) {
                $image = !empty($images[$i]) ? $images[$i] : '';

                if(!empty($image)) {
                    $name = time() .$i. '.' . $image->getClientOriginalExtension();
                    $image->move(public_path()."/product", $name);
                } else {
                    $name = '';
                }

                if(!empty($name)) {
                    $arrSlider = $objProduct->sliders()->create(['image'=>$name]);
                    $intCountLangDesc = count($request->content[0]);
                    $content =  !empty($request->content[$i]) ? $request->content[$i] : '';

                    if(isset($intCountLangDesc)) {
                        for ($j=0; $j < $intCountLangDesc; $j++) {
                            $languageCode = $request->language_code[$j];
                            $strContent = !empty($content[$j]) ? $content[$j] : ' ';
                            $arrSlider->sliderTranslate()->create(['language_code'=>$languageCode, 'description'=>$strContent]);
                        }
                    }
                }
            }

            return redirect('admin/products')->with('flash_message', 'Product added!');    
        }
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
        $product = Product::findOrFail($id);

        return view('admin.product.show', compact('product'));
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
        $allCategory = ProductCategory::all();
        $arrCategory = $this->parentChildCategory($allCategory);
        $arrProductTabs = ProductTab::all();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product', 'arrCategory', 'arrProductTabs'));
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
        $objSpecification = $request->specifications;

        $product = Product::findOrFail($id);
        $product->update(['category_id'=>$request->category_id, 'status'=>$request->status]);

        $images = $request->file('slider_image');

        if(isset($product)) { 
            $arrSliderImage = [];
            if(!empty($product->sliders)) {
                $arrSliderImage = $product->sliders->toArray();
            }
            
            $intCount = count($request->language_code);

            ProductTranslation::where('product_id', $product->id)->delete();
            ProductSlider::where('product_id', $product->id)->delete();
            ProductSpecification::where('product_id', $product->id)->delete();

            //update specification
            if(!empty($objSpecification)) {
                foreach ($objSpecification as $key => $data) {
                    $arrSpect = $product->specifications()->create(['product_id'=>$product->id]);
                    for ($i=0; $i < count($data); $i++) { 
                        $desc = !empty($data[$i]) ? $data[$i] : '';
                        $lang = $request->language_code[$i];
                        $arrSpect->specificationTranslate()->create(['tab_id'=>$key, 'language_code'=>$lang, 'description'=>$desc]);
                    }
                }
            }

            //Update Product translation
            for ($i=0; $i < $intCount; $i++) {
                $lngCode = $request->language_code[$i];
                $strName = $request->name[$i];
                $strKeywords = $request->meta_keywords[$i];
                $strDescriptions = $request->meta_description[$i];

                $product->productTranslate()->create(['language_code'=>$lngCode, 'name'=>$strName, 'meta_keywords'=>$strKeywords, 'meta_description'=>$strDescriptions]);
            }

            // Update Product slider 
            for ($i=0; $i < count($request->content); $i++) {
                
                $image = !empty($images[$i]) ? $images[$i] : '';
                if(!empty($image)) {
                    $name = time() .$i. '.' . $image->getClientOriginalExtension();
                    $image->move(public_path()."/product", $name);
                } else {
                    $name = !empty($arrSliderImage[$i]['image']) ? $arrSliderImage[$i]['image'] : '';
                }

                if(!empty($name)) {
                    $arrSlider = $product->sliders()->create(['image'=>$name]);
                    $intCountLangDesc = count($request->content[0]);
                    $content =  !empty($request->content[$i]) ? $request->content[$i] : '';

                    if(isset($intCountLangDesc)) {
                        for ($j=0; $j < $intCountLangDesc; $j++) {
                            $languageCode = $request->language_code[$j];
                            $arrSlider->sliderTranslate()->create(['language_code'=>$languageCode, 'description'=>$content[$j]]);
                        }
                    }
                }
            }
            return redirect('admin/products')->with('flash_message', 'Product updated!');
        } else {
            return redirect('admin/products')->with('flash_message', 'Something went wrong!');
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
        Product::destroy($id);

        return redirect('admin/products')->with('flash_message', 'Product deleted!');
    }
}