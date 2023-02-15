<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcurementSpph;
use App\Models\SpphPenawaran;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Procurement;
use App\Models\Bapp;
use App\Http\Requests\BappRequest;
use App\Utilities\FlashMessage;
use App\Services\LogsInsertor;
use PDF;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Mail\BappLoseMail;

class BappController extends Controller
{
    public function input(Procurement $procurement)
    {
        $users = User::where('jabatan_id', '<>', 0)->where('jabatan_id', '<=', 10)->orWhere('role_id', 2)->get();
        return view('module.procurement.detail.bapp_input', compact('procurement', 'users'));
    }

    public function show(Procurement $procurement)
    {
        $vendor_count = 0;
        foreach($procurement->spphs as $row){
            if($row->has_penawaran){
                $vendor_count++;
            }
        }
        
        $vendor_spph = 0;
        foreach($procurement->spphs as $row){
            if($row->status === 2 || $row->status === 3){
                $vendor_spph++;
            }
        }

        $min_price = $procurement->penawarans->where('can_win', 1)->groupBy('item_id')->map(function($group, $groupName) {
            return [
                'item_id' => $groupName,
                'penawaran_id' => $group->firstWhere('harga_total', $group->min('harga_total'))->id
            ];
        });

        return view('module.procurement.detail.bapp_show', compact('procurement', 'vendor_count', 'min_price', 'vendor_spph'));
    }

    public function edit(Procurement $procurement)
    {
        $users = User::where('jabatan_id', '<>', 0)->where('jabatan_id', '<=', 10)->orWhere('role_id', 2)->get();
        return view('module.procurement.detail.bapp_edit', compact('procurement', 'users'));
    }

    public function store(BappRequest $request, Procurement $procurement)
    {
        $data = $request->except(['spph_date']);
        $data['procurement_id'] = $procurement->id;
        $ba = Bapp::create($data);

        $procurement->spph_sending_date = $request->spph_date;
        $procurement->save();

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan input BAPP.', 
                FlashMessage::SUCCESS));
    }

    public function update(BappRequest $request, Procurement $procurement)
    {
        $ba = Bapp::find($procurement->bapp->id);
        $data = $request->except(['spph_date']);
        $ba->fill($data);
        $ba->save();

        $procurement->spph_sending_date = $request->spph_date;
        $procurement->save();

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan pengubahan data BAPP.', 
                FlashMessage::SUCCESS));
    }

    public function done(Procurement $procurement)
    {
        //ganti status procurement
        $procurement->status = 6;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses BAPP", "", "BAPP");

        /*foreach($procurement->spphsLose as $row){
            if($row->no_surat_penawaran!=NULL){
                \Mail::to($row->vendor->email)->send(new BappLoseMail($row->vendor->name, $procurement->id));  
            }
        }*/

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil menyelesaikan proses BAPP.', 
                    FlashMessage::SUCCESS));
    }

    public function cetak(Procurement $procurement)
    {
        $isAvailable = true;
        if ($procurement->mechanism_id == 3){
            $vendor = Vendor::find($procurement->vendor_id_penunjukan_langsung);
            if($vendor->address == NULL || $vendor->no == NULL  || $vendor->no_rek == NULL){
                $isAvailable = false;
            }
        } else {
            $sumVendor = sizeof($procurement->spphsWon);
            if ($sumVendor > 0){
                foreach ($procurement->spphsWon as $spph){
                    if($spph->vendor->address == NULL || $spph->vendor->no == NULL  || $spph->vendor->no_rek == NULL) {
                        $sumVendor--;
                    }   
                }
                if ($sumVendor == 0){
                    $isAvailable = false;
                }
            }
        }

        if (!$isAvailable){
            return back()->with('message', 
                new FlashMessage('Gagal mencetak BAPP karena data vendor belum dilengkapi.', 
                    FlashMessage::DANGER));
        }

        //ini_set('max_execution_time', 6000);
        $vendor_count = 0;
        foreach($procurement->spphs as $row){
            if($row->has_penawaran){
                $vendor_count++;
            }
	}

	$vendor_spph = 0;
        foreach($procurement->spphs as $row){
            if($row->status === 2 || $row->status === 3){
                $vendor_spph++;
            }
        }

        $itemOccurences = array();
        foreach($procurement->penawarans as $row){
            $itemNb = $row->item->name;

            if(!isset($itemOccurences[$itemNb])){
                $itemOccurences[$itemNb] = 0;
            }

            $itemOccurences[$itemNb]++;
        }
        $check_name = "";

        $min_price = $procurement->penawarans->where('can_win', 1)->groupBy('item_id')->map(function($group, $groupName) {
            return [
                'item_id' => $groupName,
                'penawaran_id' => $group->firstWhere('harga_total', $group->min('harga_total'))->id
            ];
        });

        //set winner
        foreach($min_price->pluck('penawaran_id')->toArray() as $row)
        {
            $penawaran = SpphPenawaran::find($row);
            $penawaran->won = 1;
            $penawaran->save();
        }
       
        //Procurement $procurement
        $procurement = Procurement::find($procurement->id);

        //memo
        $url = 'https://apphub.universitaspertamina.ac.id/api/Disposisi?nomor_surat='.$procurement->no_memo;

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);

        if (!$response['status']) {
            return back()->with('message', new FlashMessage('Nomor Memo tidak valid', 
            FlashMessage::DANGER));
        } else {
            $data = $response['data'];
            $disposisi = array();
            $arrDis = array();
            $arrNamaJabatan = array();

            foreach ($data as $d){
                if (sizeof($disposisi) == 0){
                    array_push($disposisi, $d);
                    array_push($arrDis, $d['disposisi']);
                    array_push($arrNamaJabatan, $d['nama_jabatan']);
                } else {
                    $cekDis = in_array($d['disposisi'], $arrDis);
                    $cekNamaJabatan = in_array($d['nama_jabatan'], $arrNamaJabatan);
                    if (!$cekDis && !$cekNamaJabatan){
                        array_push($disposisi, $d);
                        array_push($arrDis, $d['disposisi']);
                        array_push($arrNamaJabatan, $d['nama_jabatan']);
                    }
                }                
            }
            array_multisort($disposisi);
            foreach ($disposisi as $key=>$dispo) {
                if (is_null($dispo['tgl_disposisi'])){
                    unset($disposisi[$key]);
                }
            }

            if (sizeof($disposisi) == 0) {
                return back()->with('message', new FlashMessage('Tanggal disposisi belum ditentukan', 
                FlashMessage::DANGER));
            }

            $total_disposisi = count($disposisi);
        }

        $pdf_name = "BAPP-".$procurement->name.'-'.$procurement->id.".pdf";
        $location = "bapp"."/";

        if($procurement->mechanism_id==3){
            $pdf_save = PDF::loadview('module.procurement.detail.bapp_cetak_pl',['total_disposisi' => $total_disposisi, 'memos' => $disposisi, 'itemOccurences' => $itemOccurences, 'check_name' => $check_name, 'procurement' => $procurement, 'vendor_count' => $vendor_count, 'min_price' => $min_price, 'vendor_spph'=> $vendor_spph]);
            $pdf_name = str_replace("/", "-", $pdf_name);
            $pdf_save->save($location.$pdf_name);
        } else {
            $pdf_save = PDF::loadview('module.procurement.detail.bapp_cetak',['total_disposisi' => $total_disposisi, 'memos' => $disposisi, 'itemOccurences' => $itemOccurences, 'check_name' => $check_name, 'procurement' => $procurement, 'vendor_count' => $vendor_count, 'min_price' => $min_price, 'vendor_spph' => $vendor_spph]);
            $pdf_name = str_replace("/", "-", $pdf_name);
            $pdf_save->save($location.$pdf_name);
        }
        
        if (!isset($procurement->tidakCetak)) {
            $file = public_path()."/".$location.$pdf_name;
            return response()->download($file);
        }        
    }
}
