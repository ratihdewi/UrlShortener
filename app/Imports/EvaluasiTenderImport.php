<?php

namespace App\Imports;

use App\Models\Procurement;
use App\Models\SpphPenawaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Auth;

class EvaluasiTenderImport implements ToModel, WithBatchInserts
{
    private $procurement_id;
    private $count = 0;
    private $no_spph = "";

    public function __construct($procurement_id)
    {
        $this->procurement_id = $procurement_id;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $this->count = $this->count + 1;
        
        if($this->count >= 2){
            $penawaran = SpphPenawaran::find($row[0]);
            $penawaran->evaluasi = $row[8];
            if($penawaran->spph->procurement->mechanism_id!=3){
                $penawaran->nilai = $row[9];
            }
            $penawaran->save();
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

}

   