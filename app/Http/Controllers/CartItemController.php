<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCartItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::table('carts')->get()->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateCartItem $request)
    {
        $form = $request->validated();
        $product = Product::find($form['product_id']);
        if (!$product->checkQuantity($form['quantity'])) {
            return response($product->title . '數量不足', 400);
        }
        $cart = Cart::find($form['cart_id']);
        $result = $cart->cartItems()->create([
            'product_id' => $product->id,
            'quantity' => $form['quantity']
        ]);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartItem $request, $id)
    {
        $form = $request->validated();
        $item = CartItem::find($id);
        $item->update(['quantity' => $form['quantity']]);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartItem::find($id)->delete();
    }
}
