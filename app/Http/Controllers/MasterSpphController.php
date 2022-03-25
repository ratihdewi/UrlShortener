<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterSpph;
use App\Http\Requests\MasterSpphRequest;
use App\Utilities\FlashMessage;
use Illuminate\Http\UploadedFile;

class MasterSpphController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spph = MasterSpph::find(1);
        return view('module.master.spph.index', compact('spph'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(MasterSpphRequest $request)
    {
        $spph = MasterSpph::find(1);

        $file_ttd = $request->file('ttd');
        $path = $this->upload('ttd.jpg', $file_ttd, 'img');

        $spph->fill($request->all());
        $spph->save();
        return redirect()->route('master.spph.index')->with('message', 
        new FlashMessage('Data master Spph telah berhasil diubah!', 
            FlashMessage::SUCCESS));
    }

    public function upload($name, UploadedFile $photo, $folder)
    {
        $destination_path = $folder;
		$photo->move($destination_path, $name);
    }
}
