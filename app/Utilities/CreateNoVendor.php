<?php

namespace App\Utilities;
use App\Models\Vendor;

class CreateNoVendor
{
	public function createNo($id)
	{
        return 'VNDR-'.date('Y').'-'.$id;
	}

}


