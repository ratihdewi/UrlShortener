<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Auth;

class UserImport implements ToModel, WithBatchInserts
{
    private $count = 0;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $this->count = $this->count + 1;
        
        if($this->count >= 2){
            $data['name'] = $row[0];
            $data['email'] = $row[1].'@universitaspertamina.ac.id';
            $data['username'] = $row[1];
            $data['role_id'] = $row[4];
            $data['password'] = bcrypt('password');
            $data['password_real'] = 'password';
            $data['unit_kerja'] = $row[2];
            $data['unit_kerja_id'] = $row[3];
            if($row[4]==2 || $row[4]==3){
                $data['is_pengadaan'] = $row[4];
            } else {
                $data['is_pengadaan'] = 0;
            }

            User::create($data);
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

}

   