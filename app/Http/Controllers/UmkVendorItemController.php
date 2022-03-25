<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmkItemVendor;
use App\Models\ProcurementItem;
use App\Utilities\FlashMessage;

class UmkVendorItemController extends Controller
{
    public function assignVendor(ProcurementItem $item, Request $request)
    {
        if($item->has_vendor_bast){
            $vendorItem = UmkItemVendor::find($item->vendorBast->id);
            $vendorItem->vendor_id = $request->vendor_id;
            $vendorItem->save();
        } else {
            $vendorItem = new UmkItemVendor();
            $vendorItem->vendor_id = $request->vendor_id;
            $vendorItem->item_id = $item->id;
            $vendorItem->save();  
        }
        return redirect()->route('procurement.show', [$item->procurement_id, 1])->with('message', 
            new FlashMessage('Vendor telah berhasil diassign!', 
                FlashMessage::SUCCESS));
    }
}
