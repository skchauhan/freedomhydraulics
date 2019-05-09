<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Slider;
use App\SliderTranslation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class SliderController extends Controller
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
            $slider = Slider::where('slider_text', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $slider = Slider::latest()->paginate($perPage);
        }

        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'slider_text' => 'required|unique:slider_translations',
            'slider_text.*' => 'distinct',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        $file = $request->file('image');
        $intId = $request->id;
        if(!empty($file)) {
            $name = time() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move(public_path()."/sliders/", $name);
            $slider = Slider::create(['image'=>$name]);
            if(isset($slider)) {
                $intCount = count($request->language_code);
                for ($i=0; $i < $intCount; $i++) {
                    $strLangCode = $request->language_code[$i];
                    $strText = $request->slider_text[$i];
                    $slider->sliderTranslate()->create(['language_code'=>$strLangCode,  'slider_text'=>$strText]);
                }
            }
        }       

        return redirect('admin/slider')->with('flash_message', 'Slider added!');
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
        $slider = Slider::findOrFail($id);

        return view('admin.slider.show', compact('slider'));
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
        $slider = Slider::findOrFail($id);

        return view('admin.slider.edit', compact('slider'));
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

        $file = $request->file('image');
        if(isset($file)) {
            $name = time() . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move(public_path()."/sliders/", $name);
            $slider = Slider::where('id', $id)->update(['image'=>$name]);
        }

        $intCount = count($request->language_code);

        if($intCount > 0) {            
            SliderTranslation::where('slider_id', $id)->delete();            
            for ($i=0; $i < $intCount; $i++) {
                $strLangCode = $request->language_code[$i];
                $strText = $request->slider_text[$i];
                SliderTranslation::create(['slider_id'=>$id, 'language_code'=>$strLangCode,  'slider_text'=>$strText]);
            }
        }
        
        return redirect('admin/slider')->with('flash_message', 'Slider updated!');
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
        Slider::destroy($id);

        return redirect('admin/slider')->with('flash_message', 'Slider deleted!');
    }
}
