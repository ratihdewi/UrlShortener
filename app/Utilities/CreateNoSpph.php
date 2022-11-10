<?php

namespace App\Utilities;
use App\Models\ProcurementSpph;

class CreateNoSpph
{
	public function createNo()
	{
		$spph = ProcurementSpph::where('created_at', 'LIKE', '%'.date('Y').'-%')->latest()->first();
        $count = ProcurementSpph::where('created_at', 'LIKE', '%'.date('Y').'-%')->count();
		if(is_null($spph)){
			return '0001/UP-WR2.2.2/UND/'.$this->getRomawi(date('n')).'/'.date('Y');
		} else {
			$no_order = sprintf('%04d', $count+1);
            $nomor_surat = $no_order.'/UP-WR2.2.2/UND/'.$this->getRomawi(date('n')).'/'.date('Y');

            while (ProcurementSpph::where('no_spph', $nomor_surat)->exists()) {
                $no_order++;
                $no_order = sprintf('%04d', $no_order);
                $nomor_surat = $no_order.'/UP-WR2.2.2/UND/'.$this->getRomawi(date('n')).'/'.date('Y');
            }
            return $nomor_surat;
		}
	}

    private function getRomawi($bln){
        switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }

}


