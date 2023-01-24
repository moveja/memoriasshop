<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\CartTrait;
use Illuminate\Support\Str;

class SearchController extends Component
{
    use CartTrait;
     public $search;
     public $currentPath;

    public function mount()
    {
        //http://ventaslitev2.test/pos
        $this->currentPath = url()->current();
    }

    protected $listeners = ['scan-code' => 'ScanCode'];

    public function ScanCode($barcode)
    {
        $routeName = Str::afterLast($this->currentPath);//pos
        if($routeName != 'pos'){
            $this->ScanearCode($barcode);
            redirect()->to('/pos');
        }
    }
    
    public function render()
    {
        return view('livewire.search');
    }
}
