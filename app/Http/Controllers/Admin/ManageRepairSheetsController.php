<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ManageRepairSheet;
use App\RepairSheets;
use Illuminate\Http\Request;

class ManageRepairSheetsController extends Controller
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
            $managerepairsheets = ManageRepairSheet::where('category', 'LIKE', "%$keyword%")
                ->orWhere('modal_name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('instruction', 'LIKE', "%$keyword%")
                ->orWhere('instruction_caption', 'LIKE', "%$keyword%")
                ->orWhere('cad', 'LIKE', "%$keyword%")
                ->orWhere('enerpac', 'LIKE', "%$keyword%")
                ->orWhere('simplex', 'LIKE', "%$keyword%")
                ->orWhere('power_team', 'LIKE', "%$keyword%")
                ->orWhere('williams', 'LIKE', "%$keyword%")
                ->orWhere('ram-pac', 'LIKE', "%$keyword%")
                ->orWhere('bva', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $managerepairsheets = ManageRepairSheet::latest()->paginate($perPage);
        }

        return view('admin.manage-repair-sheets.index', compact('managerepairsheets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.manage-repair-sheets.create');
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

        $requestData = $request->except('repair_sheet_caption', 'repair_sheet');

        $repairSheet = ManageRepairSheet::create($requestData);
        
        $images = $request->file('repair_sheet');

        if(!empty($request->repair_sheet_caption)) {
            for ($i=0; $i < count($request->repair_sheet_caption); $i++) {
                $image = !empty($images[$i]) ? $images[$i] : '';
                if(!empty($image)) {
                    $name = time() .$i. '.' . $image->getClientOriginalExtension();
                    $image->move(public_path()."/repair_sheets", $name);
                } else {
                    $name = '';
                }

                $strCaption = $request->repair_sheet_caption[$i];
                $repairSheet->repairSheet()->create(['repair_sheet_caption'=>$strCaption, 'repair_sheet'=>$name]);
            }
        }

        return redirect('admin/manage-repair-sheets')->with('flash_message', 'ManageRepairSheet added!');
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
        $managerepairsheet = ManageRepairSheet::findOrFail($id);

        return view('admin.manage-repair-sheets.show', compact('managerepairsheet'));
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
        $managerepairsheet = ManageRepairSheet::findOrFail($id);

        return view('admin.manage-repair-sheets.edit', compact('managerepairsheet'));
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
        
        $requestData = $request->except('repair_sheet_caption', 'repair_sheet');
        
        $managerepairsheet = ManageRepairSheet::findOrFail($id);
        $managerepairsheet->update($requestData);

        if(!empty($request->repair_sheet_caption)) {
            RepairSheets::where('manage_repair_sheet_id', $id)->delete();
            
            for ($i=0; $i < count($request->repair_sheet_caption); $i++) {
                $image = !empty($images[$i]) ? $images[$i] : '';
                if(!empty($image)) {
                    $name = time() .$i. '.' . $image->getClientOriginalExtension();
                    $image->move(public_path()."/repair_sheets", $name);
                } else {
                    $name = '';
                }

                $strCaption = $request->repair_sheet_caption[$i];
                $repairSheet->repairSheet()->create(['repair_sheet_caption'=>$strCaption, 'repair_sheet'=>$name]);
            }
        }        

        return redirect('admin/manage-repair-sheets')->with('flash_message', 'ManageRepairSheet updated!');
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
        ManageRepairSheet::destroy($id);

        return redirect('admin/manage-repair-sheets')->with('flash_message', 'ManageRepairSheet deleted!');
    }
}
