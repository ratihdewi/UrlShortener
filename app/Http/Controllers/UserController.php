<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\MasterJabatan;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Utilities\FlashMessage;
use App\Services\UserInsertor;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('module.master.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $jabatans = MasterJabatan::all();

        $url = 'https://masayu.universitaspertamina.ac.id/api/Positions';
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $responses = json_decode(curl_exec($curl), true);
        curl_close($curl);
        $positions = $responses['data'];

        return view('module.master.user.create', compact('jabatans', 'roles', 'positions'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserInsertor $service)
    {
        if($service->insert($request->all())){
        	return redirect()->route('master.user.index')->with('message', 
            new FlashMessage('User telah berhasil ditambahkan!', 
                FlashMessage::SUCCESS));
        } else {
        	return redirect()->route('master.user.index')->with('message', 
            new FlashMessage('Gagal menambahkan user dikarenakan email sudah didaftarkan.', 
                FlashMessage::DANGER));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models/User  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('module.master.user.detail', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/User  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('master.user.index')->with('message', 
            new FlashMessage('User telah berhasil dihapus!', 
                FlashMessage::WARNING));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $jabatans = MasterJabatan::all();

        $url = 'https://masayu.universitaspertamina.ac.id/api/Positions';
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $responses = json_decode(curl_exec($curl), true);
        curl_close($curl);
        $positions = $responses['data'];

        return view('module.master.user.edit', compact('jabatans', 'user', 'roles', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->fill(collect($request->toArray())->filter()->toArray());
        if ($request->jabatan_id == 0){
            $user->jabatan_id = 0;
        }
        if($request->password!=''){
            $user->password = bcrypt($user->password);
            $user->password_real = $request->password;
        }
        if ($user->role_id == 4 || $user->role_id == 1){
            $user->is_pengadaan = 0;
        }

        $user->save();

        return redirect()->route('master.user.show', [$user])->with('message', 
            new FlashMessage('User telah berhasil diubah!', 
                FlashMessage::SUCCESS));
    }

    public function changeAccountType()
    {
        $user = User::find(Auth::user()->id);

        if($user->role_id == 2 || $user->role_id == 3){
            $user->is_pengadaan = $user->role_id;
            $user->role_id = 4;
            $user->save();
        } else {
            $user->role_id = $user->is_pengadaan;

            if($user->is_pengadaan == 4) {
                $user->is_pengadaan = 0;
            }

            else if ($user->is_pengadaan == 2 || $user->is_pengadaan == 3){
                $user->is_pengadaan = 1;
            }

            $user->save();
        }
        
        return redirect()->route('dashboard.index')->with('message', 
            new FlashMessage('Tipe user telah berhasil diubah.', 
                FlashMessage::SUCCESS));
    }

    /**
     * Import item from excel
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) {
        Excel::import(new UserImport(), $request->file('data_user'));

        return redirect()->route('master.user.index')->with('message', 
            new FlashMessage('User telah berhasil ditambahkan.', 
                FlashMessage::WARNING));
    }

    public function userExampleImport()
    {
        $file = public_path()."/templat/Template_Import_User.xlsx";
        $headers = array('Content-Type: application/vnd.ms-excel',);
        return response()->download($file, 'Template_Import_User.xlsx',$headers);
    }
}
