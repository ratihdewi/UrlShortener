<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Role;
use App\Models\MasterJabatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Auth;

class UserImport implements ToModel, WithBatchInserts, WithCalculatedFormulas
{
    private $count = 0;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $this->count = $this->count + 1;
        
        if (!is_null($row[0])) {

            if($this->count >= 2){

                $role = Role::where('name', $row[3])->first();
                $jabatan = MasterJabatan::where('name', $row[4])->first();

                if(!isset($jabatan->name)){
                    $idJabatan = NULL;
                } else {
                    $idJabatan = $jabatan->id;
                }

                $isPengadaan = 0;

                if ($role->id == 2 || $role->id == 3){
                    $isPengadaan = $role->id;
                }

                $data = array(
                    'name' => $row[0],
                    'username' => $row[1],
                    'email' => $row[1].'@universitaspertamina.ac.id',
                    'role_id' => $role->id,
                    'unit_kerja' => $row[2],
                    'jabatan_id' => $idJabatan,
                    'is_pengadaan' => $isPengadaan,
                    'password' => bcrypt('password'),
                    'password_real' => 'password'
                );

                User::create($data);
            }
        }
        
    }

    public function batchSize(): int
    {
        return 1000;
    }

}

   