<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
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
            $generalsettings = GeneralSetting::where('key', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $generalsettings = GeneralSetting::latest()->paginate($perPage);
        }

        $site_logo_id = GeneralSetting::where('key', 'logo')->first()->id;

        return view('admin.general-settings.index', compact('generalsettings', 'site_logo_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.general-settings.create');
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
            'key' => 'required|unique:general_settings',
            'value' => 'required|unique:general_settings'
        ]);
        
        $requestData = $request->all();
        $requestData['key'] = str_replace(' ', '_', $request->key);
        
        GeneralSetting::create($requestData);

        return redirect('admin/general-settings')->with('flash_message', 'General Setting added!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteSetting( Request $request )
    {       
        $id = $request->id;

        if(isset($id)) {            
            GeneralSetting::where('id', $id)->delete();
        }

        return redirect('admin/general-settings')->with('flash_message', 'News deleted!');
    }

    /**
     * update a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateCreate(Request $request)
    {

        $requestData = $request->except('_token');

        if(!empty($requestData['id'])) {
            $count = count($requestData['id']);
            if($count > 0) {
                for ($i=0; $i < $count; $i++) { 
                    $id = $requestData['id'][$i];
                    $value = $requestData['value'][$i];
                    GeneralSetting::where('id', $id)->update(['value'=>$value]);
                }
            }
        }

        return redirect('admin/general-settings')->with('flash_message', 'General Setting updated!');
    }

    /**
     * [uploadLogo description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function uploadLogo( Request $request )
    {
        $file = $request->file('logo');
        $intId = $request->id;
        if(!empty($file)) {
            $name = time() . '.' . $file->getClientOriginalExtension();
            $request->file('logo')->move(public_path()."/images/", $name);
            GeneralSetting::where('id', $intId)->update(['value'=>$name]);
        }
        return redirect('admin/general-settings')->with('flash_message', 'Upload logo!');
    }

    
}
