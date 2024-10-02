<?php

namespace App\Livewire;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\TasaBcv;
use Illuminate\Support\Facades\Auth;
use LaravelQRCode\Facades\QRCode;
use Livewire\Attributes\On;
use Livewire\Component;

class StatusSale extends Component
{
    
    public function tasa_bcv(){
        $bcv = TasaBcv::where('date', now()->format('d-m-Y'))->first()->tasa;
        return $bcv;
        
    }

    public function sale(){
        $detail_sale = Sale::where('user_id', Auth::User()->id)->get();
        return $detail_sale;
        
    }

    public function detail_sale(){
        $detail_sale = SaleDetail::where('user_id', Auth::User()->id)->get();
        return $detail_sale;
        
    }
    
    public function render()
    {
        $sale = $this->sale();
        $detail_sale = $this->detail_sale();
        return view('livewire.status-sale', compact('sale', 'detail_sale'));
    }
}
