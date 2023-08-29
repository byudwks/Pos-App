<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Selling;


class ItemController extends Controller
{
    public function index()
    {
        return view('item', [
            'items' => Item::latest()->get()
        ]);
    }

    public function additem(Request $request)
    {
        $Additems = $request->validate([
            'name_item'         => 'required | max:50 |',
            'selling_price'     => 'required | max:50 |',
            'purchase_price'    => 'required | max:50 |',
            'unit'              => 'required | max:50 |',
            'category'          => 'required | max:50 |',
        ]);


        $Additems = new Item;
        $Additems->item_code        = mt_rand(10, 9999);
        $Additems->name_item        = $request->name_item;
        $Additems->selling_price    = $request->selling_price;
        $Additems->purchase_price   = $request->purchase_price;
        $Additems->unit             = $request->unit;
        $Additems->category         = $request->category;
        $Additems->save();

        return back();
    }

    public function edititem(Request $request, $id=null)
    {
        if($request->isMethod('post')) {

            $EditItem = $request->all();

            Item::Where(['id'=>$id])->update([
                'name_item'         =>$EditItem['name_item'], 
                'selling_price'     =>$EditItem['selling_price'], 
                'purchase_price'    =>$EditItem['purchase_price'], 
                'unit'              =>$EditItem['unit'],
                'category'          =>$EditItem['category'],
                ]);

            return redirect()->back();
        }

        else {
            //
        }
    }

    public function deleteitem(Item $item) {

        $CheckOrder = Selling::where('item_id', $item->id)->first();

            if ($CheckOrder != null ) {
                return back()->with('error', 'item is being ordered !!!');
            }

        $item->delete($item->id); 
        return back()->with('success', 'deleted Item !!!');
            
    }
}
