<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Commerce;
use Cart;
use Session;

class CartController extends Controller
{ 
    public function index(){
        return view('public.cart.index');
    }

    public function addToCart(Request $request){
        $id = $request->id;
        $product = Product::find($id);
        $cart = Cart::name('shopping');
    
        $commerceId = Session::get('commerceId');
        if(isset($commerceId)){
            if ($commerceId != $product->commerce_id) {
                $cart->destroy();
            }
        }

        $commerce = Commerce::find($product->commerce_id);
        Session::put('commerceId', $product->commerce_id);
        Session::put('whatsapp', $commerce->whatsapp);

        $commerceId = Session::get('commerceId');
        $whatsapp = Session::get('whatsapp');
    
        $cart = Cart::name('shopping');
        $item = $cart->addItem([
            'id' => $id,
            'quantity' => $request->qty,
            'title' => $product->name,
            'price' => $product->price,
            'options' => ['img' => $product->image]
        ]);
    
        $items = [];
    
        foreach (array_slice($cart->getItems(), -3, 3) as $item) {
            array_push($items, $item->getDetails());
        }
    
        return response()->json([
            'success' => 'Has añadido este producto al carrito',
            'count' => $cart->countItems(),
            'cart_subtotal' => $cart->getSubtotal(),
            'items' => $items,
            'commerceId' => $commerceId,
            'whatsapp' => $whatsapp,
        ]);
    }

    public function updateCartItem(Request $request){
        $hash = $request->hash;        
        $cart = Cart::name('shopping');

        $cartItem = $cart->getItem($hash);
        if($cartItem){
            $quantity = $cartItem->getDetails()->quantity + $request->quantity;
            $product = Product::find($cartItem->getDetails()->id);
        }

        $updatedItem = $cart->updateItem($hash, ['quantity' => $request->quantity]);
        $items = [];

        foreach(array_slice($cart->getItems(), -3, 3) as $item){
            array_push($items, $item->getDetails());
        }

        return response()->json([
            'success' => 'Producto eliminado con éxito', 
            'count' => $cart->countItems(),
            'cart_subtotal' => $cart->getSubtotal(),
            'cart_total' => $cart->getTotal(),
            'items' => $items,
            'updatedItem' => $updatedItem,
            'updatedItemPrice' => $updatedItem->getDetails()->subtotal,
            'updatedItemQuantity' => $updatedItem->getDetails()->quantity,
        ]);
    }

    public function deleteCartItem(Request $request){
        $hash = $request->hash;        
        $cart = Cart::name('shopping');

        $cart->removeItem($hash);

        $items = [];

        foreach(array_slice($cart->getItems(), -3, 3) as $item){
            array_push($items, $item->getDetails());
        }

        if($cart->countItems() < 1){
            Session::forget('commerceId');
            Session::forget('whatsapp');
        }

        return response()->json([
            'success' => 'Producto eliminado con éxito', 
            'count' => $cart->countItems(),
            'cart_subtotal' => $cart->getSubtotal(),
            'cart_total' => $cart->getTotal(),
            'items' => $items
        ]);
    }

    public function checkout(){
        return view('public.cart.checkout');
    }
}
