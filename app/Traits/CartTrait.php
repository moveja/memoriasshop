<?php

namespace App\Traits;
use Darryldecode\cart\Facades\CartFacade as Cart;
use App\Models\Product;

trait CartTrait {
    public function ScanearCode($barcode, $cant = 1){
        //dd($barcode);
        $product = Product::where('barcode', $barcode)->first();
        if($product == null || empty($empty)){
            $this->emit('scan-notfound', 'El producto no esta registrado*');
        } else {
            if($this->InCart($product->id)){
                $this->IncreaseQuantity($product);
                return;
            }
            if($product->stock < 1 ){
                $this->emit('no-stock', 'Stock insuficiente :/ *');
                return;
            }

            Cart::add($product->id, $product->name, $product->price, $cant, $product->imagen);
            $this->total = Cart::getTotal();

            $this->emit('scan-ok', 'Producto agregado *');
        }
    }

    public function InCart($productId){
        $exist = Cart::get($productId);
        if($exist)
            return true;
        else
            return false;
    }

    public function IncreaseQuantity($product, $cant = 1){
        $title = '';
        //$product = Product::find($productId);
        $exist = Cart::get($product->id);
        if($exist)
            $title = 'Cantidad actualizada*';        
        else
            $title = 'Producto agregado*';
        
        if($exist){
            if($product->stock  < ($cant + $exist->quantity))
            {
                $this->emit('no-stock', 'stock insuficiente *');
                return;
            }
        }

        Cart::add($product->id, $product->name, $product->price, $cant, $product->imagen);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', $title);

    }

    public function updateQuantity($product, $cant = 1){
        $title = '';
        $exist = Cart::get($product->id);
        if($exist)
            $title = 'Cantidad actualizada*';
        else
            $title = 'Producto agregado*';
        //validamos existencias 
        if($exist){
            if($product->stock < $cant){
                $this->emit('no-stock','Stock insuficiente*');
                return;
            }
        }

        $this->removeItem($product->id);

        if($cant > 0){ //valida si en el input tipo number flecha abajo llega a cero el value
            Cart::add($product->id, $product->name, $product->price, $cant, $product->imagen);

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok', $title);

        } else {

        $title = 'La cantidad debe ser mayor a cero';}

    }

    public function removeItem(){
        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Producto eliminado*');
    }

    public function decreaseQuantity($productId){

        $item = Cart::get($productId);
        Cart::remove($productId);

        $img = (count($item->attributes) > 0 ? $item->attributes[0] : Product::find($productId)->imagen);

        $newQty = ($item->quantity) - 1;
        if($newQty > 0)
            Cart::add($item->id, $item->name, $item->price, $newQty, $img);
        
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Cantidad Actualizada *');
        
    }

    public function trashCart(){
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Carrito Vacio*');
    }

}