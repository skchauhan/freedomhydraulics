<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Dealer;
use App\DealerCategory;
use App\DealerTranslation;
use Illuminate\Http\Request;
use App\Http\HelperTrait;

class DealerController extends Controller
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
            $dealer = Dealer::where('category', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $dealer = Dealer::latest()->paginate($perPage);
        }

        return view('admin.dealer.index', compact('dealer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $allCategory = DealerCategory::with('dealerCategoryAllTranslate')->get();        

        $arrDealerCategory = $this->getDealerCategory( $allCategory );

        return view('admin.dealer.create', compact('arrDealerCategory'));
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
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'phone' => 'required',
            'title.*' => 'required',
            'title' => 'required|unique:dealer_translations'
        ]);

        $requestData = $request->except(['language_code', 'title', 'address_1', 'address_2']);
        
        $dealer = Dealer::create($requestData);

        if(isset($dealer)) {
            $intLang = count($request->language_code);
            for ($i=0; $i < $intLang; $i++) { 
                $strLang = $request->language_code[$i];
                $strTitle = $request->title[$i];
                $strAddress1 = $request->address_1[$i];
                $strAddress2 = $request->address_2[$i];

                $dealer->dealerTranslate()->create(['language_code'=>$strLang, 'title'=> $strTitle, 'address_1'=> $strAddress1, 'address_2'=> $strAddress2]);
            }
        }

        return redirect('admin/dealer')->with('flash_message', 'Dealer added!');
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
        $dealer = Dealer::findOrFail($id);

        return view('admin.dealer.show', compact('dealer'));
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
        $dealer = Dealer::findOrFail($id);

        $allCategory = DealerCategory::with('dealerCategoryAllTranslate')->get();        

        $arrDealerCategory = $this->getDealerCategory( $allCategory );

        return view('admin.dealer.edit', compact('dealer', 'arrDealerCategory'));
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
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'phone' => 'required',
            'title.*' => 'required',
            'title' => 'required'
        ]);

        $requestData = $request->except(['language_code', 'title', 'address_1', 'address_2']);
        
        $dealer = Dealer::findOrFail($id);
        $dealer->update($requestData);

        if(isset($dealer)) {
            DealerTranslation::where(['dealer_id'=>$id])->delete();

            $intLang = count($request->language_code);
            for ($i=0; $i < $intLang; $i++) { 
                $strLang = $request->language_code[$i];
                $strTitle = $request->title[$i];
                $strAddress1 = $request->address_1[$i];
                $strAddress2 = $request->address_2[$i];

                DealerTranslation::create(['dealer_id'=>$id, 'language_code'=>$strLang, 'title'=> $strTitle, 'address_1'=> $strAddress1, 'address_2'=> $strAddress2]);
            }
        }

        return redirect('admin/dealer')->with('flash_message', 'Dealer updated!');
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
        Dealer::destroy($id);

        return redirect('admin/dealer')->with('flash_message', 'Dealer deleted!');
    }
}
