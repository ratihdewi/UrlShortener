<?php

namespace App\Services;
use App\Models\Logs;

class LogsInsertor
{
    /**
     * Perform insertion of new promo.
     * 
     * @param  array   $data
     * @return void
     */
    public function insert($procurement_id, $user_id, $logs, $keterangan, $proses)
    {
        Logs::create([
            'procurement_id' => $procurement_id,
            'user_id' => $user_id,
            'logs' => $logs,
            'keterangan' => $keterangan,
            'process_name' => $proses
        ]);
    }
}