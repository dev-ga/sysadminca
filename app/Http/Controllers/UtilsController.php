<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Commission;
use App\Models\Inventory;
use App\Models\PreBilling;
use App\Models\ProofPayment;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\TasaBcv;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilsController extends Controller
{
    static function validatePagoMovil($phone, $codeBank, $references, $image, $amount)
    {
        try {
            sleep(2);

            /**
             * API de la validacion del pago movil
             *  @param string $phone
             *  @param string $references
             *  @param string $codeBank
             * 
             * 
             */
            // $url = 'https://api.pago-movil.com/v1/validate';
            // $data = [
            //     'phone' => $phone,
            //     'references' => $references,
            //     'codeBank' => $codeBank,
            //     'amount' => $amount,
            //     'image' => $image
            //     ];
            //     $response = json_decode(file_get_contents($url, false, stream_context_create([
            //         'http'=> [
            //             'method' => 'POST', 
            //             'header' => 'Content-Type: application/json',
            //             'content' => json_encode($data)
            //             ]
            //         ])
            //     ), true);

            if(true){

                /**Cargamos la informacion del pago en la tabla para respaldar el movimiento */
                $payment = new ProofPayment();
                $payment->sale_code     = 'CA-S-'.random_int(11111111, 99999999);
                $payment->user_id       = Auth::User()->id;
                $payment->bank_code     = $codeBank;
                $payment->bank_name     = Bank::where('code', $codeBank)->first()->name;
                $payment->phone         = $phone;
                $payment->reference     = $references;
                $payment->amount        = $amount;
                $payment->image         = $image;
                $payment->save();
                
                return $payment->sale_code;

            }else{
                return false;
            }

            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    static function zelle($name, $email, $image, $amount)
    {
        try {
            
            /**Cargamos la informacion del pago en la tabla para respaldar el movimiento */
            $payment = new ProofPayment();
            $payment->sale_code = 'CA-S-'.random_int(11111111, 99999999);
            $payment->user_id = Auth::User()->id;
            $payment->zelle_email = $email;
            $payment->zelle_name = $name;
            $payment->amount = $amount;
            $payment->image = $image;
            $payment->save();
            
            return $payment->sale_code;

            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    static function banesco_panama($name, $ref, $image, $amount)
    {
        try {
            
            /**Cargamos la informacion del pago en la tabla para respaldar el movimiento */
            $payment = new ProofPayment();
            $payment->sale_code = 'CA-S-'.random_int(11111111, 99999999);
            $payment->user_id = Auth::User()->id;
            $payment->bp_reference = $ref;
            $payment->bp_name = $name;
            $payment->amount = $amount;
            $payment->image = $image;
            $payment->save();
            
            return $payment->sale_code;

            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    static function billing_payment_method_usd($amount_sale, $amount_usd, $payment_method_usd, $employee)
    {
        try {

            if($amount_usd == 0){
                return false;

            }else{

                $user = Auth::User()->name;
                $tasaBcv = TasaBcv::first()->tasa;
                $commission_usd = Commission::where('type_user', 'employee')->where('aplication', 'piso-de-venta')->where('status', 'activo')->first()->porcent;
                $commission_usd = $amount_usd * $commission_usd / 100;
                
                $sale = new Sale();
                $sale->sale_code        = 'CA-S-' . random_int(11111111, 99999999);
                $sale->total_sale       = $amount_sale;
                $sale->payment_method   = $payment_method_usd;
                $sale->tasa_bcv         = $tasaBcv;
                $sale->pay_usd          = $amount_usd;
                $sale->commission_usd   = $commission_usd;
                $sale->date             = now()->format('d-m-Y');
                $sale->type_sale        = 'tienda-fisica';
                $sale->sold_by          = $employee;
                $sale->status_id        = 2;
                $sale->created_by       = $user;
                $sale->save();

                //Actualizamos la tabla de detalle de venta
                $general_sale = PreBilling::all();

                foreach($general_sale as $item){
                    $inventory = Inventory::where('code', $item->code)->first();
                    $sale_details = new SaleDetail();
                    $sale_details->sale_id = $sale->id;
                    $sale_details->sale_code = $sale->sale_code;
                    $sale_details->sku = $inventory->sku;
                    $sale_details->inventory_id = $inventory->id;
                    $sale_details->inventory_code = $inventory->code;
                    $sale_details->size = $inventory->size;
                    $sale_details->price = $inventory->price;
                    $sale_details->quantity = $item->quantity;
                    $sale_details->total_pay_usd = $item->total_usd;
                    $sale_details->user_id = $employee;
                    $sale_details->date = now()->format('d-m-Y');
                    $sale_details->status_id = 2;
                    $sale_details->created_by = $user;
                    $sale_details->save();
                }

                return true;

            }
            
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACIÓN!')
            ->icon('heroicon-o-document-text')
            ->iconColor('danger')
            ->color('danger')
            ->body($th->getMessage())
            ->send();
        }
        
    }

    static function billing_payment_method_bsd($amount_sale, $amount_bsd, $payment_method_bsd, $employee)
    {

        try {

            if($amount_bsd == 0){
                return false;

            }else{

                $user = Auth::User()->name;
                $tasaBcv = TasaBcv::first()->tasa;
                $commission_bsd = Commission::where('type_user', 'employee')->where('aplication', 'piso-de-venta')->where('status', 'activo')->first()->porcent;
                $commission_bsd = $amount_bsd * $commission_bsd / 100;
                
                $sale = new Sale();
                $sale->sale_code        = 'CA-S-' . random_int(11111111, 99999999);
                $sale->total_sale       = $amount_sale;
                $sale->payment_method   = $payment_method_bsd;
                $sale->tasa_bcv         = $tasaBcv;
                $sale->pay_bsd          = $amount_bsd;
                $sale->commission_bsd   = $commission_bsd;
                $sale->date             = now()->format('d-m-Y');
                $sale->type_sale        = 'tienda-fisica';
                $sale->sold_by          = $employee;
                $sale->status_id        = 2;
                $sale->created_by       = $user;
                $sale->save();

                //Actualizamos la tabla de detalle de venta
                $general_sale = PreBilling::all();

                foreach($general_sale as $item){
                    $inventory = Inventory::where('code', $item->code)->first();
                    $sale_details = new SaleDetail();
                    $sale_details->sale_id = $sale->id;
                    $sale_details->sale_code = $sale->sale_code;
                    $sale_details->sku = $inventory->sku;
                    $sale_details->inventory_id = $inventory->id;
                    $sale_details->inventory_code = $inventory->code;
                    $sale_details->size = $inventory->size;
                    $sale_details->price = $inventory->price;
                    $sale_details->quantity = $item->quantity;
                    $sale_details->total_pay_usd = $inventory->price * $item->quantity;
                    $sale_details->user_id = $employee;
                    $sale_details->date = now()->format('d-m-Y');
                    $sale_details->status_id = 2;
                    $sale_details->created_by = $user;
                    $sale_details->save();
                }

                return true;

            }
            
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACIÓN!')
            ->icon('heroicon-o-document-text')
            ->iconColor('danger')
            ->color('danger')
            ->body($th->getMessage())
            ->send();
        }
        
    }

    static function billing_multiple($amount_sale_usd, $amount_sale_bsd, $amount_usd, $amount_bsd, $payment_method, $employee, $payment_method_usd, $payment_method_bsd)
    {
        try {

            if($amount_bsd == 0){
                return false;

            }else{
                
                /**Calculo de comisiones iniciales */
                $commission = Commission::where('type_user', 'employee')->where('aplication', 'piso-de-venta')->where('status', 'activo')->first()->porcent;
                $comision_usd = ($amount_sale_usd * $commission) / 100;
                $comision_bsd = ($amount_sale_bsd * $commission) / 100;

                /**Calculo de porcentaje iniciales */
                $percent_usd = ($amount_usd * 100) / $amount_sale_usd;
                $percent_bsd = ($amount_bsd * 100) / $amount_sale_bsd;

                /**Calculo de las comisiones para el empleado de acuerdo a los porcentajes de representacion */
                $comision_employee_usd = ($comision_usd * $percent_usd) / 100;
                $comision_employee_bsd = ($comision_bsd * $percent_bsd) / 100;


                $user = Auth::User()->name;
                $tasaBcv = TasaBcv::first()->tasa;
                
                $sale = new Sale();
                $sale->sale_code        = 'CA-S-' . random_int(11111111, 99999999);
                $sale->total_sale       = $amount_sale_usd;
                $sale->payment_method   = $payment_method;

                //Metodos multi-moneda
                $sale->multiMoneda_method_usd   = $payment_method_usd;
                $sale->multiMoneda_method_bsd   = $payment_method_bsd;

                $sale->tasa_bcv         = $tasaBcv;
                $sale->pay_usd          = $amount_usd;
                $sale->pay_bsd          = $amount_bsd;
                $sale->commission_usd   = $comision_employee_usd;
                $sale->commission_bsd   = $comision_employee_bsd;
                $sale->date             = now()->format('d-m-Y');
                $sale->type_sale        = 'tienda-fisica';
                $sale->sold_by          = $employee;
                $sale->status_id        = 2;
                $sale->created_by       = $user;
                $sale->save();

                //Actualizamos la tabla de detalle de venta
                $general_sale = PreBilling::all();

                foreach($general_sale as $item){
                    $inventory = Inventory::where('code', $item->code)->first();
                    $sale_details = new SaleDetail();
                    $sale_details->sale_id = $sale->id;
                    $sale_details->sale_code = $sale->sale_code;
                    $sale_details->sku = $inventory->sku;
                    $sale_details->inventory_id = $inventory->id;
                    $sale_details->inventory_code = $inventory->code;
                    $sale_details->size = $inventory->size;
                    $sale_details->price = $inventory->price;
                    $sale_details->quantity = $item->quantity;
                    $sale_details->total_pay_usd = $inventory->price * $item->quantity;
                    $sale_details->user_id = $employee;
                    $sale_details->date = now()->format('d-m-Y');
                    $sale_details->status_id = 2;
                    $sale_details->created_by = $user;
                    $sale_details->save();
                }

                return true;

            }
            
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACIÓN!')
            ->icon('heroicon-o-document-text')
            ->iconColor('danger')
            ->color('danger')
            ->body($th->getMessage())
            ->send();
        }
        
    }
}
