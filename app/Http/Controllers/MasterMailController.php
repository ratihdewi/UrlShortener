<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMail;
use App\Http\Requests\MasterMailRequest;
use App\Utilities\FlashMessage;

class MasterMailController extends Controller
{
    public function index() {

        if (MasterMail::find(1) == NULL) {
            MasterMail::insert([
                'id' => 1,
                'approve_mail' => '',
                'reject_mail' => ''
            ]);
        }

        $dataMail = MasterMail::find(1);

        return view('module.master.mail.index', compact('dataMail'));
    }

    public function update (MasterMailRequest $request) {

        if (MasterMail::find(1) == NULL) {
            MasterMail::insert([
                'id' => 1,
                'approve_mail' => '',
                'reject_mail' => ''
            ]);
        }

        $dataMail = MasterMail::find(1);
        $dataMail->fill($request->all());

        $dataMail->save();
        return redirect()->route('master.mail.index')->with('message', 
        new FlashMessage('Data master Mail telah berhasil diubah!', 
            FlashMessage::SUCCESS));
    }
}

