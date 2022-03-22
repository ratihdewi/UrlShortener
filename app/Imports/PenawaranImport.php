<?php

namespace App\Imports;

use App\Services\VendorInsertor;
use App\Models\ProcurementItem;
use App\Models\ProcurementSpph;
use App\Models\SpphPenawaran;
use App\Models\ItemCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Auth;

class PenawaranImport implements ToModel, WithBatchInserts
{
    private $procurement_id;
    private $penawaran_file_name;
    private $count = 0;
    private $no_spph = "";

    public function __construct($procurement_id, $penawaran_file_name)
    {
        $this->procurement_id = $procurement_id;
        $this->penawaran_file_name = $penawaran_file_name;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $this->count = $this->count + 1;

        if($this->count == 2){
            $this->no_spph = $row[1];
            $spph = ProcurementSpph::where('no_spph', $this->no_spph)->first();
            $spph_edit = ProcurementSpph::find($spph->id);
            $spph_edit->penawaran_file = $this->penawaran_file_name;
            $spph_edit->save();
        }

        if($this->count == 3){
            $spph = ProcurementSpph::where('no_spph', $this->no_spph)->first();
            $spph_edit = ProcurementSpph::find($spph->id);
            $spph_edit->no_surat_penawaran = $row[1];
            $spph_edit->save();
        }
        
        if($this->count >= 6){
            //get category id
            $spph = ProcurementSpph::where('no_spph', $this->no_spph)->first();
            //get item id
            $item = ProcurementItem::where('procurement_id', $this->procurement_id)->where('name', $row[1])->first();

            //cari penawaran
            $penawaran_old = SpphPenawaran::where('spph_id', $spph->id)->where('item_id', $item->id)->first();
            $penawaran = SpphPenawaran::find($penawaran_old->id);
            $penawaran->harga_satuan = $row[4];
            $penawaran->can_win = 1;
            $penawaran->keterangan = $row[7];
            $penawaran->save();
            
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

}

   