<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class MasterSla extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'mechanism_type',
        'process',
        'time'
    ];

    //nama table
    protected $table = 'master_sla';

    public function realisasi($procurement_id, $type)
    {
        if($type==0){
            if($this->process=='SPPH'){
                $start_date = $this->getDate($procurement_id, "Start SPPH");
                $end_date = $this->getDate($procurement_id, "Finish SPPH");
                $exists = $this->getIfExists($procurement_id, "Start SPPH");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='Evaluasi Tender'){
                $start_date = $this->getDate($procurement_id, "Finish SPPH");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "Finish SPPH");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='BA Negosiasi dan Klarifikasi'){
                $start_date = $this->getDate($procurement_id, "Evaluasi Tender");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "Evaluasi Tender");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='BAPP'){
                $start_date = $this->getDate($procurement_id, "BA Negosiasi dan Klarifikasi");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "BA Negosiasi dan Klarifikasi");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='PO'){
                $start_date = $this->getDate($procurement_id, "BAPP");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "BAPP");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='BAST'){
                $start_date = $this->getDate($procurement_id, "PO");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "PO");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='Penilaian Vendor'){
                $start_date = $this->getDate($procurement_id, "BAST");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "BAST");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='Input SP3'){
                $start_date = $this->getDate($procurement_id, "Penilaian Vendor");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "Penilaian Vendor");
                return $this->getDiff($start_date, $end_date, $exists);
            }
        } else {
            if($this->process=='SP3'){
                $start_date = $this->getDate($procurement_id, "Start SPPH");
                $end_date = $this->getDate($procurement_id, "Input SP3");
                $exists = $this->getIfExists($procurement_id, "Start SPPH");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='BAST'){
                $start_date = $this->getDate($procurement_id, "Input SP3");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "Input SP3");
                return $this->getDiff($start_date, $end_date, $exists);
            } else if($this->process=='Input PJ'){
                $start_date = $this->getDate($procurement_id, "BAST");
                $end_date = $this->getDate($procurement_id, $this->process);
                $exists = $this->getIfExists($procurement_id, "BAST");
                return $this->getDiff($start_date, $end_date, $exists);
            }
        }

    }

    private function getDate($procurement_id, $process_name)
    {
        $log = Logs::where('procurement_id', $procurement_id)->where('process_name', $process_name)->first();
        if($log === null){
            return date('Y-m-d H:i:s');
        } else {
            return $log->created_at;
        }
    }

    private function getIfExists($procurement_id, $process_name)
    {
        $log = Logs::where('procurement_id', $procurement_id)->where('process_name', $process_name)->first();
        if($log === null){
            return false;
        } else {
            return true;
        }
    }

    private function getDiff($start_date, $end_date, $exists)
    {
        $datetime1 = new DateTime($start_date);
        $datetime2 = new DateTime($end_date);

        if($exists){
            return ($datetime1->diff($datetime2)->days == 0) ? 1 : $datetime1->diff($datetime2)->days; 
        } else {
            return '';
        }
    }
}
