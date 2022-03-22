<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Http\Requests\CategoryRequest;
use App\Utilities\FlashMessage;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ItemCategory::all();
        return view('module.master.itemcategory.index', compact('categories'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $cat = ItemCategory::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        return redirect()->route('master.itemcategory.index')->with('message', 
            new FlashMessage('Berhasil menambahkan data.', 
                FlashMessage::SUCCESS));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/ItemCategory  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategory $category)
    {
        $category->delete();
        return redirect()->route('master.itemcategory.index')->with('message', 
            new FlashMessage('Item Category telah berhasil dihapus!', 
                FlashMessage::WARNING));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemCategory  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $item_category = ItemCategory::find($request->value_id);
        $item_category->name = $request->name;
        $item_category->code = $request->code;
        $item_category->save();
        return redirect()->route('master.itemcategory.index')->with('message', 
            new FlashMessage('Item Category telah berhasil diubah!', 
                FlashMessage::SUCCESS));
    }

    private function codeCreation(array $data)
    {
        $code = '';
        if($data['code_first']!=NULL && $data['code_second']!=NULL && $data['code_third']!=NULL && $data['code_fourth']!=NULL){
            $code = $data['code_first'].'-'.$data['code_second'].'-'.$data['code_third'].'-'.$data['code_fourth'];
        } else if($data['code_first']!=NULL && $data['code_second']!=NULL && $data['code_third']!=NULL && $data['code_fourth']==NULL){
            $code = $data['code_first'].'-'.$data['code_second'].'-'.$data['code_third'];
        } else if($data['code_first']!=NULL && $data['code_second']!=NULL && $data['code_third']==NULL && $data['code_fourth']==NULL){
            $code = $data['code_first'].'-'.$data['code_second'];
        } else if($data['code_first']!=NULL && $data['code_second']==NULL && $data['code_third']==NULL && $data['code_fourth']==NULL){
            $code = $data['code_first'];
        }

        return $code;
    }
}
