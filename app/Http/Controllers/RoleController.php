<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\RoleRequest;
use App\Utilities\FlashMessage;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('module.master.role.index', compact('roles'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());
        return redirect()->route('master.role.index')->with('message', 
            new FlashMessage('Berhasil menambahkan data.', 
                FlashMessage::SUCCESS));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/Role  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('master.role.index')->with('message', 
            new FlashMessage('Role telah berhasil dihapus!', 
                FlashMessage::WARNING));
    }
}
