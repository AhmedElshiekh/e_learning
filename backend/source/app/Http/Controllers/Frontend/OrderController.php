<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\ProductVariation;
use App\Order;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $request->validate(['qty'=>'required|integer|min:1']);
        $product = Product::find($request->product);

        if ($product->variation){
            $vari = $request->except('_token','qty','product','submit');
            $search = preg_replace("/\b[^ا-يa-zA-Z0-9:, -]/", "", str_replace('","', ',', json_encode($vari,JSON_UNESCAPED_UNICODE)));
            $search = preg_replace('/\"/','',$search);
            $search = preg_replace('/{/','',$search);
            $search = preg_replace('/}/','',$search);
            $type = $product->variations->where('name', $search)->first();
            // dd($type);
            $content = Cart::content()->where('id',$product->id);
            if($content){
                foreach ($content as $item){
                    if($item->options->first() == $type->id && $type->stock < $item->qty+$request->qty){
                        return redirect()->back()->with('error', __('This Qty Not In Stock'));

                    }
                }
            }
            if($type && $type->stock >= $request->qty){
                Cart::add($request->product, $product->name, $request->qty , $product->discount? $product->discount:$product->price,0,['type' => $type->id]);
            // dd(Cart::content());
                if ($request->get('submit') == 'addToCart'){

                    return redirect()->back()->with('success', __('Item Added'));
                }else{
                    return redirect('\checkout')->with('success', __('Item Added'));

                }
            } else {
                return redirect()->back()->with('error', __('Item Not In Stock'));
            }
        }else{
            $type = $product->variations->first();
            if($type && $type->stock >= $request->qty){
                Cart::add($request->product, $product->name, $request->qty, $product->discount? $product->discount:$product->price ,0,['type' => $type->id]);
            // dd(Cart::content());
                if ($request->get('sumbit') == 'addToCart'){

                    return redirect()->back()->with('success', __('Item Added'));
                }

            } else {
                return redirect()->back()->with('error', __('Item Not In Stock'));
            }
        }

    }


    public function deleteFromCart($rowId)
    {

        Cart::remove($rowId);
        return redirect()->back()->with('success','Done');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'time'=>'email|required',
            'product_id'=>'required',
            'address'=>'required',
            'note'=>'nullable',
        ]);
        // dd($request->all());
        $subTotal =  (float)str_replace(',','',Cart::subtotal());

        // dd( $subTotal);
        if (Cart::count() > 0 ){
            $request->merge(['total'=>$subTotal]);
            $order =   Order::Create($request->all());
            foreach (Cart::content() as $item) {
              $product = Product::find($item->id);
              $type = $item->options->first();
                $variation = ProductVariation::find($type);
                if($variation && $variation->stock >= $item->qty){
                    $order->products()->attach($item->id, ['price' =>$item->price,'quantity' => $item->qty,'product_variation_id' => $type]);
                    $variation->decrement('stock', $item->qty);
                    Cart::remove($item->rowId);
                }else{
                    $order->delete();
                    return redirect()->back()->with('error','sorry the quantity of '.$product->name .' '.$variation->name.' product not allowed now please try again leter');
                }
            }
        }else{
            return redirect()->back()->with('error','Not Items In Your Cart');
        }
        return redirect('/')->with('success','Order Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Frontend\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function freeDemo(Request $request)
    {
        // dd($request);

        //validation
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time'=>'required',
            'product_id'=>'required',
            'teacher_id'=>'required'
        ]);

        // $product = Product::find($request->product_id);
        $request->merge(['user_id'=>auth()->user()->id]);
        $order =   Order::Create($request->all());
        return redirect('/')->with('success','Request Created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Frontend\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Frontend\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Frontend\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
