<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Selling;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    public function index()
    {
        $CountItem  = Item::all();
        $Selling    = Selling::with('item')->latest()->get();

        return view('selling', [
            'Items'     => $CountItem,
            'Sellings'  => $Selling
        ]);
    }

    public function neworder(Request $request)
    {

        $NewOrder = $request->validate([
            'item_id'       => 'required',
            'consumer_name' => 'required | max:50 |',
            'amount'        => 'required'
        ]);

        $getItem = Item::find($request['item_id']);

        $CheckItem = Item::find($getItem->id)->unit;
            if ($request['amount'] > $CheckItem) {
                return back()->with('error', 'Item stock is not available !!!');;
            }

        $NewOrder = new Selling;
        $NewOrder->item_id          = $getItem->id;
        $NewOrder->faktur_date      = Carbon::now();
        $NewOrder->no_faktur        = mt_rand(10, 9999);
        $NewOrder->consumer_name    = $request->consumer_name; 
        $NewOrder->item_code        = $getItem->item_code; 
        $NewOrder->amount           = $request->amount; 
        $NewOrder->unit_price       = $getItem->selling_price; 
        $NewOrder->total_price      = $NewOrder->amount * $getItem->selling_price; 
        $NewOrder->save();

        $ChangeItem = Item::find($getItem->id);
        $ChangeItem->unit -= $request->amount;
        $ChangeItem->save();
        

        return back()->with('success', 'Order successfully created.');
    }

    public function editorder(Request $request, $id=null)
    {
        if($request->isMethod('post')) {

            $EditOrder = $request->all();
           
            Selling::Where(['id'=>$id])->update([
                'consumer_name' =>$EditOrder['consumer_name'], 
                'amount'        =>$EditOrder['amount'],
                ]);
            
            $ChangeSelling = Selling::find($id);
            $ChangeSelling->total_price = $ChangeSelling->unit_price * $EditOrder['amount'];
            $ChangeSelling->save();

            return redirect()->back();
        }

        else {
            //
        }
    }

    public function deleteorder(Selling $selling) {

        $selling->destroy($selling->id);

        $ChangeItem = Item::find($selling->item_id);
        $ChangeItem->unit += $selling->amount;
        $ChangeItem->save();

        return back();

    }
}
