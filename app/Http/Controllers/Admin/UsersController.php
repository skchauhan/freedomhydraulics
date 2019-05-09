<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
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
            $users = User::where('id', '!=', '1')->where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")->orderBy('id', 'desc')->paginate($perPage);
        } else {
            $users = User::where('id', '!=', '1')->latest()->paginate($perPage);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name');
        return view('admin.users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'status' => 'required'
        ]);
        
        $requestData = $request->all();

        $requestData['password'] = bcrypt($request->password);
        
        User::create($requestData);

        return redirect('admin/users')->with('flash_message', 'User added!');
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
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
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
        $roles = Role::pluck('name', 'name');
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles'));
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
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($id)],
            'status' => 'required'
        ]);
        
        $requestData = $request->all();        
        
        $user = User::findOrFail($id);
        $user->update($requestData);

        return redirect('admin/users')->with('flash_message', 'User updated!');
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
        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }

    /**
     * [changePassword description]
     * @return [type] [description]
     */
    public function changePassword()
    {
        return view('admin.users.change-password');
    }

    /**
     * [updatePassword description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updatePassword( Request $request )
    {
        $validatedData = $request->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        $userId = $request->user_id;
        if(!empty($userId)) {
            $arrUserData = User::find($userId);
            $hashedPassword = $arrUserData->makeVisible('password')->password;

            if (\Hash::check($request->old_password, $hashedPassword)) {
                $user = User::where(['id'=>$userId])->update(['password'=>bcrypt($request->password)]);
                if(isset($user)) {
                    return redirect('admin/change-password')->with('flash_message', 'Successfully has been updated') ;    
                } else {
                    return redirect('admin/change-password')->with('error_flash_message', 'Somthing went wrong please try again!') ;    
                }
            } else {
                return redirect('admin/change-password')->with('error_flash_message', 'Old password doesn\'t match!') ;    
            }
        } else {
            return redirect('admin/change-password')->with('error_flash_message', 'User Id not found!');
        }
    }
}
