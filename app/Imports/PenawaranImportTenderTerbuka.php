<?php

namespace App\Imports;

use App\Models\ProcurementItem;
use App\Models\PenawaranTenderTerbukaItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Auth;

class PenawaranImportTenderTerbuka implements ToModel, WithBatchInserts
{
    private $penawaran_id;
    private $count = 0;

    public function __construct($penawaran_id)
    {
        $this->penawaran_id = $penawaran_id;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $this->count = $this->count + 1;
        
        if($this->count >= 2){
            //get item id
            $item = ProcurementItem::where('name', $row[1])->first();

            $penawaran = new PenawaranTenderTerbukaItem();
            $penawaran->item_id = $item->id;
            $penawaran->harga_satuan = $row[4];
            $penawaran->keterangan = $row[7];
            $penawaran->penawaran_tender_terbuka_id = $this->penawaran_id;
            $penawaran->save();
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

}

   