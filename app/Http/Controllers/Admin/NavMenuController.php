<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\NavMenu;
use App\NavMenuTranslation;
use Illuminate\Http\Request;

class NavMenuController extends Controller
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
            $navmenu = NavMenu::whereHas('navMenuTranslate', function($q) use ($keyword) {
                $q->where('menu', 'LIKE', "%$keyword%");
            })->where('order', 'LIKE', "%$keyword%")->orWhere('slug', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $navmenu = NavMenu::latest()->paginate($perPage);
        }

        return view('admin.nav-menu.index', compact('navmenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.nav-menu.create');
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
            'order' => 'required|unique:nav_menus',
            'slug' => 'required|unique:nav_menus',
            'menu.*' => 'required|distinct',
            'menu' => 'required|unique:nav_menu_translations',
        ]);

        $requestData = $request->except('menu', 'language_code');

        $nav_menu = NavMenu::create($requestData);

        if(isset($nav_menu)) {

            $intCount = count($request->language_code);

            for ($i=0; $i < $intCount; $i++) {
                $strMenu = $request->menu[$i];
                $strLangCode = $request->language_code[$i];

                $nav_menu->navMenuTranslate()->create(['menu'=>$strMenu, 'language_code'=>$strLangCode]);

            }
        }

        return redirect('admin/nav-menu')->with('flash_message', 'NavMenu added!');
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
        $navmenu = NavMenu::findOrFail($id);

        return view('admin.nav-menu.show', compact('navmenu'));
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
        $navmenu = NavMenu::findOrFail($id);

        return view('admin.nav-menu.edit', compact('navmenu'));
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
        $requestData = $request->except('_method', '_token', 'menu', 'language_code');

        $nav_menu = NavMenu::where('id', $id)->update($requestData);

        if(isset($nav_menu)) {

            $intCount = count($request->language_code);

            NavMenuTranslation::where('nav_menu_id', $id)->delete();

            for ($i=0; $i < $intCount; $i++) {
                $strMenu = $request->menu[$i];
                $strLangCode = $request->language_code[$i];
                NavMenuTranslation::create(['nav_menu_id'=>$id, 'menu'=>$strMenu, 'language_code'=>$strLangCode]);
            }
        }

        return redirect('admin/nav-menu')->with('flash_message', 'NavMenu updated!');
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
        NavMenu::destroy($id);

        return redirect('admin/nav-menu')->with('flash_message', 'NavMenu deleted!');
    }
}
