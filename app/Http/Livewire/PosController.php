<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Darryldecode\cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Denomination;
use App\Models\SaleDetail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use DB;
use App\Traits\CartTrait;
//use App\Traits\Utils;

class PosController extends Component
{
    use CartTrait;
   // use Utils;

    public $total, $itemsQuantity, $efectivo, $change;
    private $pagination = 5;

    public function mount(){
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function render()
    {
        
        return view('livewire.pos.component', [
        'denominations' => Denomination::orderBy('value', 'desc')->get(), 
        'cart' => Cart::getContent()->sortBy('name')
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function ACash(){
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }

    protected $listeners = [
        'ScanCode' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
        'refresh' => '$refresh',
        'print-last' => 'printLast',
        'scan-code-byid' => 'ScanCodeById',
    ];

    public function ScanCodeById(Product $product)
    {
        $this->increaseQuantity($product);
    }

    public function ScanCode($barcode, $cant = 1){
        
        $this->ScanearCode($barcode, $cant);
    }

    

    public function increaseQty(Product $product, $cant = 1){
        $this->IncreaseQuantity($product, $cant);
    }

    public function updateQty(Product $product, $cant = 1){
        if($cant <= 0 )
            $this->removeItem($product->id);
        else
            $this->updateQuantity($product, $cant);
    }

    public function decreaseQty($productId){
        $this->decreaseQuantity($productId);
    }

    public function AddCash($value)
    {
        if($value > 0)
            $this->efectivo += $value;
        else
            $this->efectivo = $this->total;
    }

    public function updatedEfectivo($value){
        if(is_numeric($value))
            $this->change = $this->efectivo - $this->total;
        else
            $his->change = 0 - $this->total;

    }

    

    public function clearCart(){
        $this->trashCart(); 
    }

    public function saveSale(){
        if($this->total <= 0){
            $this->emit('sale-error', 'AGREGA PRODUCTOS A LA VENTA');
            return;
        }
        if($this->efectivo <= 0){
            $this->emit('sale-error', 'INGRESA EL EFECTIVO');
            return;
        }
        if($this->total > $this->efectivo){
            $this->emit('sale-error', 'EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
            return;
        }

        DB::beginTransaction();

        try{
            $sale = Sale::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id
            ]);

            if($sale)
            {
                $items = Cart::getContent();
                foreach ($items as $item){
                    SaleDetail::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'sale_' => $sale->id,
                    ]);
                    //update stock
                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;
                    $product->save();
                }
            }
            DB::commit();
            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok', 'Venta registrada con exito');
            $this->emit('print-ticket', $sale->id);
        
        } catch (Exception $e) {
            DB::rollback();
            $this->emit('sale-error', $e->getMessage());

        }
    }

    public function printTicket($sale)
    {
        return Redirect::to("print://$sale->id");
    }
}

