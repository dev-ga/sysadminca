<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\ProofPayment;
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
}
