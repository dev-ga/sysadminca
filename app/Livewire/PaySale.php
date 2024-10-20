<?php

namespace App\Livewire;

use App\Models\Bank;
use App\Models\ItemCar;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\TasaBcv;
use App\Http\Controllers\UtilsController;
use App\Models\ProofPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use LaravelQRCode\Facades\QRCode;
use WireUi\Traits\WireUiActions;
use Filament\Notifications\Notification;


class PaySale extends Component
{
    use WithFileUploads;
    use WireUiActions;

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

    public function tasa_bcv()
    {
        $bcv = TasaBcv::where('date', now()->format('d-m-Y'))->first()->tasa;
        return $bcv;
    }

    public function count_item()
    {
        $shopping_car = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();
        return $shopping_car;
    }

    public function total_to_pay()
    {
        $item = $this->count_item();
        $total = 0;
        foreach ($item as $value) {
            $total += $value->inventory->price * $value->quantity;
        }
        return $total;
    }

    public function banks()
    {
        try {
            $banks = Bank::all();
            return $banks;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function refresh_form()
    {
        $this->reset();
    }

    public function delete_pm_img()
    {
        $this->reset('pm_img');
    }

    public function delete_zelle_img()
    {
        $this->reset('zelle_img');
    }

    public function delete_bp_img()
    {
        $this->reset('bp_img');
    }

    /* Metodo: Pago Movil */
    /**********************/
    public function save_pago_movil()
    {

        /* Reglas de validacion */
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
                'pm_img'   => 'required|image|max:1024'
            ],
            [
                'required' => 'Campo requerido'
            ]
        )->validate();

        try {

            /* Cargamos la imagen del comprobante */
            $image = $this->pm_img->store('PagoMovil', 'public');

            /* Monto del pago movil en bolivares */
            $amount = $this->total_to_pay() * $this->tasa_bcv();

            /* Validamos el pago movil usando el API de validacion */
            $sale_code = UtilsController::validatePagoMovil($this->pm_phone, $this->pm_bank, $this->pm_ref,  $image, $amount);

            if (isset($sale_code)) {

                // QRCode::text($sale_code)
                // ->setOutfile(Storage::disk("public")->path($sale_code.'.png'))
                // ->setSize(10)
                // ->setMargin(1)
                // ->png();


                /* 1.- Cargamos la informacion en la tabla de ventas */
                $sale = new Sale();
                $sale->sale_code        = $sale_code;
                $sale->total_sale       = $this->total_to_pay();
                $sale->pay_bsd          = $amount;
                $sale->payment_method   = $this->payment_method;
                $sale->delivery_method  = $this->delivery_method;
                $sale->tasa_bcv         = $this->tasa_bcv();
                $sale->date             = now()->format('d-m-Y');
                $sale->type_sale        = 'on-line';
                $sale->user_id          = Auth::User()->id;
                $sale->user_name        = Auth::User()->name;
                $sale->status_id        = 2; //facturada
                $sale->qr               = $sale_code.'.png';
                $sale->created_by       = 'sys-on-line';
                // $sale->save();

                /* 2.- Cargamos del datella de la venta */

                /* Busco los item adquiridos por el cliente */
                $sale_items = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();

                /* Genero el QR con la informacion de la venta */
                QRCode::meCard($sale_code, $sale->user_name, Auth::User()->email, Auth::User()->phone)
                    ->setOutfile(Storage::disk("public")->path($sale_code . '.png'))
                    ->setSize(10)
                    ->setMargin(1)
                    ->png();

                /* Guardo el qr y guardo la informacion de la venta  */
                $sale->qr = $sale_code . '.png';
                $sale->save();

                foreach ($sale_items as $item) {
                    $sale_detail = new SaleDetail();
                    $sale_detail->sale_id           = $sale->id;
                    $sale_detail->sale_code         = $sale->sale_code;
                    $sale_detail->sku               = $item->inventory->sku;
                    $sale_detail->size              = $item->inventory->size;
                    $sale_detail->inventory_id      = $item->inventory_id;
                    $sale_detail->inventory_code    = $item->code;
                    $sale_detail->price             = $item->inventory->price;
                    $sale_detail->quantity          = $item->quantity;
                    $sale_detail->total_pay_usd     = $sale_detail->price * $sale_detail->quantity;
                    $sale_detail->user_id           = Auth::User()->id;
                    $sale_detail->date              = now()->format('d-m-Y');
                    $sale_detail->created_by        = 'sys-on-line';
                    $sale_detail->status_id         = 2; //facturada
                    $sale_detail->save();
                }

                /* 3.- Actualizo el status de los item en la tabla item-car */
                foreach ($sale_items as $item_update) {
                    $item_update->update([
                        'status' => 3,
                    ]);
                }

                $this->dispatch('payment-registered');

                Notification::make()
                ->title('COMPRA EXITOSA!')
                ->body('La compra fue registrada de forma correcta. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

                return redirect()->route('status-sale');
            }
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACION-EXCEPCION')
            ->body($th->getMessage())
            ->color('error') 
            ->icon('heroicon-o-document-text')
            ->iconColor('error')
            ->send();
        }
    }

    /* Metodo: Zelle */
    /**********************/
    public function save_zelle()
    {
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
            ]
        )->validate();

        try {

            /* Cargamos la imagen del comprobante */
            $image = $this->zelle_img->store('Zelle', 'public');

            /* Monto del pago en Zelle */
            $amount = $this->total_to_pay();

            /* Almacenamos el pago para optener el codigo de venta */
            $sale_code = UtilsController::zelle($this->zelle_name, $this->zelle_email, $image, $amount);

            if (isset($sale_code)) {

                /* 1.- Cargamos la informacion en la tabla de ventas */
                $sale = new Sale();
                $sale->sale_code        = $sale_code;
                $sale->total_sale       = $this->total_to_pay();
                $sale->pay_usd          = $amount;
                $sale->payment_method   = $this->payment_method;
                $sale->delivery_method  = $this->delivery_method;
                $sale->tasa_bcv         = $this->tasa_bcv();
                $sale->date             = now()->format('d-m-Y');
                $sale->type_sale        = 'on-line';
                $sale->user_id          = Auth::User()->id;
                $sale->user_name        = Auth::User()->name;
                $sale->status_id        = 2; //facturada
                $sale->created_by       = 'sys-on-line';

                /* 2.- Cargamos del datella de la venta */

                /* Busco los item adquiridos por el cliente */
                $sale_items = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();

                /* Genero el QR con la informacion de la venta */
                QRCode::meCard('http://127.0.0.1/list/items/'.$sale_code, $sale->user_name, Auth::User()->email, Auth::User()->phone)
                    ->setOutfile(Storage::disk("public")->path($sale_code . '.png'))
                    ->setSize(10)
                    ->setMargin(1)
                    ->png();

                /* Guardo el qr y guardo la informacion de la venta  */
                $sale->qr = $sale_code . '.png';
                $sale->save();

                foreach ($sale_items as $item) {
                    $sale_detail = new SaleDetail();
                    $sale_detail->sale_id           = $sale->id;
                    $sale_detail->sale_code         = $sale->sale_code;
                    $sale_detail->sku               = $item->inventory->sku;
                    $sale_detail->size              = $item->inventory->size;
                    $sale_detail->inventory_id      = $item->inventory_id;
                    $sale_detail->inventory_code    = $item->code;
                    $sale_detail->price             = $item->inventory->price;
                    $sale_detail->quantity          = $item->quantity;
                    $sale_detail->total_pay_usd     = $sale_detail->price * $sale_detail->quantity;
                    $sale_detail->user_id           = Auth::User()->id;
                    $sale_detail->date              = now()->format('d-m-Y');
                    $sale_detail->created_by        = 'sys-on-line';
                    $sale_detail->status_id         = 2; //facturada
                    $sale_detail->save();
                }

                /* 3.- Actualizo el status de los item en la tabla item-car */
                foreach ($sale_items as $item_update) {
                    $item_update->update([
                        'status' => 3,
                    ]);
                }

                $this->dispatch('payment-registered');

                Notification::make()
                ->title('COMPRA EXITOSA!')
                ->body('La compra fue registrada de forma correcta. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

                return redirect()->route('status-sale');

            } else {
            }
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACION-EXCEPCION')
            ->body($th->getMessage())
            ->color('error') 
            ->icon('heroicon-o-document-text')
            ->iconColor('error')
            ->send();
        }
    }

    /* Metodo: BANESCO PANAMA */
    /*************************/
    public function save_baneco_panama()
    {
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
            ]
        )->validate();

        try {

            /* Cargamos la imagen del comprobante */
            $image = $this->bp_img->store('BanescoPanama', 'public');

            /* Monto del pago en Zelle */
            $amount = $this->total_to_pay();

            /* Almacenamos el pago para optener el codigo de venta */
            $sale_code = UtilsController::banesco_panama($this->bp_name, $this->bp_ref, $image, $amount);

            if (isset($sale_code)) {

                /* 1.- Cargamos la informacion en la tabla de ventas */
                $sale = new Sale();
                $sale->sale_code        = $sale_code;
                $sale->total_sale       = $this->total_to_pay();
                $sale->pay_usd          = $amount;
                $sale->payment_method   = $this->payment_method;
                $sale->delivery_method  = $this->delivery_method;
                $sale->tasa_bcv         = $this->tasa_bcv();
                $sale->date             = now()->format('d-m-Y');
                $sale->type_sale        = 'on-line';
                $sale->user_id          = Auth::User()->id;
                $sale->user_name        = Auth::User()->name;
                $sale->status_id        = 5; //Validando el pago
                $sale->created_by       = 'sys-on-line';

                /* 2.- Cargamos del datella de la venta */

                /* Busco los item adquiridos por el cliente */
                $sale_items = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();

                /* Genero el QR con la informacion de la venta */
                QRCode::meCard($sale_code, $sale->user_name, Auth::User()->email, Auth::User()->phone)
                    ->setOutfile(Storage::disk("public")->path($sale_code . '.png'))
                    ->setSize(10)
                    ->setMargin(1)
                    ->png();

                /* Guardo el qr y guardo la informacion de la venta  */
                $sale->qr = $sale_code . '.png';
                $sale->save();

                foreach ($sale_items as $item) {
                    $sale_detail = new SaleDetail();
                    $sale_detail->sale_id           = $sale->id;
                    $sale_detail->sale_code         = $sale->sale_code;
                    $sale_detail->sku               = $item->inventory->sku;
                    $sale_detail->size              = $item->inventory->size;
                    $sale_detail->inventory_id      = $item->inventory_id;
                    $sale_detail->inventory_code    = $item->code;
                    $sale_detail->price             = $item->inventory->price;
                    $sale_detail->quantity          = $item->quantity;
                    $sale_detail->total_pay_usd     = $sale_detail->price * $sale_detail->quantity;
                    $sale_detail->user_id           = Auth::User()->id;
                    $sale_detail->date              = now()->format('d-m-Y');
                    $sale_detail->created_by        = 'sys-on-line';
                    $sale_detail->status_id         = 5; //Validando el pago
                    $sale_detail->save();
                }

                /* 3.- Actualizo el status de los item en la tabla item-car */
                foreach ($sale_items as $item_update) {
                    $item_update->update([
                        'status' => 3,
                    ]);
                }

                $this->dispatch('payment-registered');

                Notification::make()
                ->title('COMPRA EXITOSA!')
                ->body('La compra fue registrada de forma correcta. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

                return redirect()->route('status-sale');

            } else {
            }
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACION-EXCEPCION')
            ->body($th->getMessage())
            ->color('error') 
            ->icon('heroicon-o-document-text')
            ->iconColor('error')
            ->send();
        }
    }

    /* Metodo: RETIRO EN TIENDA O PICKUP */
    /************************************/
    public function save()
    {

        $this->validate();

        try {

            /** 1.- Cargamos la informacion en la tabla de ventas */
            $sale = new Sale();
            $sale->sale_code        = 'CA-S-' . random_int(11111111, 99999999);
            $sale->total_sale       = $this->total_to_pay();
            $sale->payment_method   = 'pago-en-tienda';
            $sale->delivery_method  = $this->delivery_method;
            $sale->tasa_bcv         = $this->tasa_bcv();
            $sale->date             = now()->format('d-m-Y');
            $sale->type_sale        = 'on-line';
            $sale->user_id          = Auth::User()->id;
            $sale->user_name        = Auth::User()->name;
            $sale->qr               = $sale->sale_code.'.png';
            $sale->created_by       = 'sys-on-line';
            $sale->save();

            /** 2.- Cargamos del datella de la venta */

            /** Busco los item adquiridos por el cliente */
            $sale_items = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();

            /* Genero el QR con la informacion de la venta */
            QRCode::meCard($sale->sale_code, $sale->user_name, Auth::User()->email, Auth::User()->phone)
            ->setOutfile(Storage::disk("public")->path($sale->sale_code . '.png'))
            ->setSize(10)
            ->setMargin(1)
            ->png();

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

            Notification::make()
            ->title('COMPRA EXITOSA!')
            ->body('La compra fue registrada de forma correcta. Gracias!')
            ->color('success') 
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->send();

            return redirect()->route('status-sale');

            //code...
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACION-EXCEPCION')
            ->body($th->getMessage())
            ->color('error') 
            ->icon('heroicon-o-document-text')
            ->iconColor('error')
            ->send();
        }
    }

    /* Metodo: RETIRO EN TIENDA O PICKUP - PAGO EN EFECTIVO */
    /*******************************************************/
    public function save_efectivo_dolares()
    {

        try {

            /** 1.- Cargamos la informacion en la tabla de ventas */
            $sale = new Sale();
            $sale->sale_code        = 'CA-S-' . random_int(11111111, 99999999);
            $sale->total_sale       = $this->total_to_pay();
            $sale->payment_method   = $this->payment_method;
            $sale->delivery_method  = $this->delivery_method;
            $sale->tasa_bcv         = $this->tasa_bcv();
            $sale->date             = now()->format('d-m-Y');
            $sale->type_sale        = 'on-line';
            $sale->user_id          = Auth::User()->id;
            $sale->user_name        = Auth::User()->name;
            $sale->qr               = $sale->sale_code.'.png';
            $sale->created_by       = 'sys-on-line';
            $sale->save();

            /** 2.- Cargamos del datella de la venta */

            /** Busco los item adquiridos por el cliente */
            $sale_items = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();

            /* Genero el QR con la informacion de la venta */
            QRCode::meCard($sale->sale_code, $sale->user_name, Auth::User()->email, Auth::User()->phone)
            ->setOutfile(Storage::disk("public")->path($sale->sale_code . '.png'))
            ->setSize(10)
            ->setMargin(1)
            ->png();

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

            Notification::make()
            ->title('COMPRA EXITOSA!')
            ->body('La compra fue registrada de forma correcta. Gracias!')
            ->color('success') 
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->send();

            return redirect()->route('status-sale');

            //code...
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACION-EXCEPCION')
            ->body($th->getMessage())
            ->color('error') 
            ->icon('heroicon-o-document-text')
            ->iconColor('error')
            ->send();
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
