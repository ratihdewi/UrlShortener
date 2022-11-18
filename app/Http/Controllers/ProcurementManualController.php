<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\ProcurementSpph;
use App\Models\SpphPenawaran;
use App\Models\Vendor;
use App\Models\ItemCategory;
use DB;

class ProcurementManualController extends Controller
{
    public function index() {
        $procurements = Procurement::all();
        return view('module.procurement.manual.index', compact(
            'procurements'
        ));
    }

    public function getSpph($proc_id, $vendor_id) {
        
        $dataSpph = ProcurementSpph::where([
            'procurement_id' => $proc_id,
            'vendor_id' => $vendor_id
        ])->first();
        
        $vendor = Vendor::where('id', $vendor_id)->first();
        $dataSpph['vendor_name'] = $vendor->name;

        return response()->json($dataSpph);
    }

    public function getVendor ($proc_id) {
        $procurement = Procurement::where('id', $proc_id)->first();
        
        $catId = array();
        foreach ($procurement->items as $item) {
            array_push($catId, $item->category_id);
        }

        $vendors = DB::table('vendors as v')
                   ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                   ->select('v.*')
                   ->where('delete', 0)
                   ->whereIn('vc.category_id', $catId)
                   ->get();
        
        return response()->json($vendors);
    }

    public function getPenawaran ($proc_id) {

        $procurement = Procurement::where('id', $proc_id)->first();
        $data = array();

        foreach($procurement->items as $item) {

            $cat = ItemCategory::where('id', $item->category_id)->first();
            $item['category_name'] = $cat->name;

            array_push($data, $item);
        }
        return response()->json($data);
    }

    public function store(Request $request) {
        
        $procurement = Procurement::where('id', $request->procurement)->first();
        $items = $procurement->items;

        foreach($request->name_vendor as $key=>$id) {

            ProcurementSpph::where([
                'procurement_id' => $procurement->id,
                'vendor_id' => $id
            ])->update([
                'no_spph' => $request->no_spph[$key],
                'status' => 3,
            ]);
            
            $prcSpph = ProcurementSpph::where(['no_spph' => $request->no_spph[$key]])->first();
            

            foreach ($items as $idx=>$item) {

                $dataSearch = [
                    'procurement_id' => $procurement->id,
                    'item_id' => $item->id,
                    'spph_id' => $prcSpph->id
                ];

                $i = $idx + ($key*sizeof($items));
                $dataInput = [
                    'keterangan' => $request->keterangan[$i],
                    'harga_satuan' => $request->harga_satuan[$i],
                    'evaluasi' => $request->evaluasi[$i],
                    'nilai' => $request->nilai[$i]
                ];

                SpphPenawaran::where($dataSearch)->update($dataInput);
            }
        }
    }
}
