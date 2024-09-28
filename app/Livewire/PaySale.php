<?php

namespace App\Livewire;

use App\Models\Bank;
use App\Models\ItemCar;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\TasaBcv;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaySale extends Component
{
    use WithFileUploads;
    
    public $check;

    #[Validate('required', as: 'Metodo de Entrega')]
    public $delivery_method;

    public $payment_method;

    /**Pago con Zelle */
    public $zelle_name;
    public $zelle_email;
    public $zelle_img;

    /**Pago con Banesco panama */
    public $bp_name;
    public $bp_ref;
    public $bp_img;

    /**Pago Movil */
    public $pm_bank;
    public $pm_phone;
    public $pm_ref;
    public $pm_img;

    public function tasa_bcv(){
        $bcv = TasaBcv::where('date', now()->format('d-m-Y'))->first()->tasa;
        return $bcv;
        
    }
    
    public function count_item(){
        $shopping_car = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();
        return $shopping_car;
        
    }

    public function total_to_pay(){
        $item = $this->count_item();
        $total = 0;
        foreach ($item as $value){
            $total += $value->inventory->price * $value->quantity;
        }
        return $total;
        
    }

    public function banks(){
        try {
            $banks = Bank::all();
            return $banks;

        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function refresh_form(){
        $this->reset();
    }

    public function delete_pm_img(){
        $this->reset('pm_img');
    }

    public function delete_zelle_img(){
        $this->reset('zelle_img');
    }

    public function delete_bp_img(){
        $this->reset('bp_img');
    }

    /**
     * Metodo: Pago Movil
     * Funcion para cargar los datos
     */
    public function save_pago_movil(){
        $validated = Validator::make(
            [
                'pm_bank'  => $this->pm_bank,
                'pm_phone' => $this->pm_phone,
                'pm_ref'   => $this->pm_ref,
                'pm_img'   => $this->pm_img,
            ],
            [
                'pm_bank'  => 'required',
                'pm_phone' => 'required',
                'pm_ref'   => 'required',
                'pm_img'   => 'required',
            ],
            [
                'required' => 'Campo requerido'
            ])->validate();

        
    }

    /**
     * Metodo: Zelle
     * Funcion para cargar los datos
     */
    public function save_zelle(){
        $validated = Validator::make(
            [
                'zelle_name'  => $this->zelle_name,
                'zelle_email' => $this->zelle_email,
                'zelle_img'   => $this->zelle_img,
            ],
            [
                'zelle_name'  => 'required',
                'zelle_email' => 'required',
                'zelle_img'   => 'required',
            ],
            [
                'required' => 'Campo requerido'
            ])->validate();

        
    }

    /**
     * Metodo: Banesco Panama
     * Funcion para cargar los datos
     */
    public function save_baneco_panama(){
        $validated = Validator::make(
            [
                'bp_name' => $this->bp_name,
                'bp_ref'  => $this->bp_ref,
                'bp_img'  => $this->bp_img,
            ],
            [
                'bp_name' => 'required',
                'bp_ref'  => 'required',
                'bp_img'  => 'required',
            ],
            [
                'required' => 'Campo requerido'
            ])->validate();

        
    }

    /**
     * Metodo: Retiro en tienda o Pickup
     */
    public function save(){

        $this->validate();

        try {

            /** 1.- Cargamos la informacion en la tabla de ventas */
            $sale = new Sale();
            $sale->sale_code        = 'CA-S-'.random_int(11111111, 99999999);
            $sale->total_sale       = $this->total_to_pay();
            $sale->payment_method   = 'pago-en-tienda';
            $sale->delivery_method  = $this->delivery_method;
            $sale->tasa_bcv         = $this->tasa_bcv();
            $sale->date             = now()->format('d-m-Y');
            $sale->type_sale        = 'on-line';
            $sale->user_id          = Auth::User()->id;
            $sale->user_name        = Auth::User()->name;
            $sale->created_by       = 'sys-on-line';
            $sale->save();

            /** 2.- Cargamos del datella de la venta */

            /** Busco los item adquiridos por el cliente */
            $sale_items = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();

            foreach ($sale_items as $item) {
                $sale_detail = new SaleDetail();
                $sale_detail->sale_id = $sale->id;
                $sale_detail->sale_code = $sale->sale_code;
                $sale_detail->sku = $item->inventory->sku;
                $sale_detail->size = $item->inventory->size;
                $sale_detail->inventory_id = $item->inventory_id;
                $sale_detail->inventory_code = $item->code;
                $sale_detail->price = $item->inventory->price;
                $sale_detail->quantity = $item->quantity;
                $sale_detail->total_pay_usd = $sale_detail->price * $sale_detail->quantity;
                $sale_detail->user_id = Auth::User()->id;
                $sale_detail->date = now()->format('d-m-Y');
                $sale_detail->created_by = 'sys-on-line';
                $sale_detail->save();
            }

            /**Actualizo el status de los item en la tabla item-car */
            foreach ($sale_items as $item_update) {
                $item_update->update([
                    'status' => 3,
                ]);
            }

            $this->dispatch('payment-registered');

            dd('listo');
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Metodo: Retiro en tienda o Pickup
     */
    public function save_efectivo_dolares(){

        try {

            /** 1.- Cargamos la informacion en la tabla de ventas */
            $sale = new Sale();
            $sale->sale_code        = 'CA-S-'.random_int(11111111, 99999999);
            $sale->total_sale       = $this->total_to_pay();
            $sale->payment_method   = $this->payment_method;
            $sale->delivery_method  = $this->delivery_method;
            $sale->tasa_bcv         = $this->tasa_bcv();
            $sale->date             = now()->format('d-m-Y');
            $sale->type_sale        = 'on-line';
            $sale->user_id          = Auth::User()->id;
            $sale->user_name        = Auth::User()->name;
            $sale->created_by       = 'sys-on-line';
            $sale->save();

            /** 2.- Cargamos del datella de la venta */

            /** Busco los item adquiridos por el cliente */
            $sale_items = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();

            foreach ($sale_items as $item) {
                $sale_detail = new SaleDetail();
                $sale_detail->sale_id = $sale->id;
                $sale_detail->sale_code = $sale->sale_code;
                $sale_detail->sku = $item->inventory->sku;
                $sale_detail->size = $item->inventory->size;
                $sale_detail->inventory_id = $item->inventory_id;
                $sale_detail->inventory_code = $item->code;
                $sale_detail->price = $item->inventory->price;
                $sale_detail->quantity = $item->quantity;
                $sale_detail->total_pay_usd = $sale_detail->price * $sale_detail->quantity;
                $sale_detail->user_id = Auth::User()->id;
                $sale_detail->date = now()->format('d-m-Y');
                $sale_detail->created_by = 'sys-on-line';
                $sale_detail->save();
            }

            /**Actualizo el status de los item en la tabla item-car */
            foreach ($sale_items as $item_update) {
                $item_update->update([
                    'status' => 3,
                ]);
            }

            $this->dispatch('payment-registered');

            dd('listo');
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
    }


    public function render()
    {
        $bank           = $this->banks();
        $total_pay      = $this->total_to_pay();
        $bcv            = $this->tasa_bcv();
        $total_pay_bsd  = $total_pay * $bcv;

        
        return view('livewire.pay-sale', compact('total_pay_bsd', 'bank'));
    }
}
