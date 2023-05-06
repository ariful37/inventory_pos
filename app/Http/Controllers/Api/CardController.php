<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CardController extends Controller
{
    public function AddToCart(Request $request,$id)
    {
    	   $product=DB::table('products')->where('id',$id)->first();

           $check =DB::table('pos')->where('pro_id',$id)->first();

           if ($check) {
             $increment =DB::table('pos')->where('pro_id',$id)->increment('pro_quantity');
             $pos=DB::table('pos')->where('pro_id',$id)->first();
             $subtotal=$pos->pro_quantity*$pos->product_price;
             DB::table('pos')->where('pro_id',$id)->update(['sub_total' => $subtotal]);

            }else{
                $data=array();
                $data['pro_id']=$id;
                $data['pro_name']=$product->product_name;
                $data['pro_quantity']=1;
                $data['product_price']=$product->selling_price;
                $data['sub_total']=$product->selling_price;
                DB::table('pos')->insert($data);
            }
    }

    public function CartProduct(){
        $cart=DB::table('pos')->get();
    	return response()->json($cart);
    }

    public function removeCart($id){
        DB::table('pos')->where('id',$id)->delete();
    	return response('done');
    }

    public function Increment($id)
    {
        $increment =DB::table('pos')->where('id',$id)->increment('pro_quantity');

        $pos=DB::table('pos')->where('id',$id)->first();

        $subtotal=$pos->pro_quantity*$pos->product_price;

        DB::table('pos')->where('id',$id)->update(['sub_total' => $subtotal]);

        return response('done');
    }


    public function Decrement($id)
     {
        $quantity =DB::table('pos')->where('id',$id)->decrement('pro_quantity');

        $pos=DB::table('pos')->where('id',$id)->first();

        $subtotal=$pos->pro_quantity*$pos->product_price;

        DB::table('pos')->where('id',$id)->update(['sub_total' => $subtotal]);

        return response('done');
    }
    public function Vats(){

        $vat=DB::table('extras')->first();

    	return response()->json($vat);
    }
}
