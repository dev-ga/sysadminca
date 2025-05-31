<?php

namespace App\Livewire\Menu;

use App\Models\DailyClosing as ModelsDailyClosing;
use App\Models\Sale;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DailyClosing extends Component
{
    public $ref_debito;
    public $ref_credito;
    public $ref_visaMaster;
    public $amount_debito;
    public $amount_credito;
    public $amount_visaMaster;
    public $store;


    public function daily_closing()
    {
        // TODO: Implement daily_closing() method.
        try {

            $dailyClosing = new ModelsDailyClosing();
            $dailyClosing->code            = 'CA-CD-' . random_int(1111, 9999);
            $dailyClosing->ref_debito           = $this->ref_debito;
            $dailyClosing->ref_credito          = $this->ref_credito;
            $dailyClosing->ref_visaMaster       = $this->ref_visaMaster;
            $dailyClosing->amount_debito        = $this->amount_debito;
            $dailyClosing->amount_credito       = $this->amount_credito;
            $dailyClosing->amount_visaMaster    = $this->amount_visaMaster;

            /** Efectivo USD */
            $efectivoUSD = Sale::where('status_id', 2)
            ->where('payment_method', 'efectivo-dolares')
            ->where('type_sale', $this->store)
            ->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])
            ->sum('pay_usd');

            $efectivoUSD_multiMoneda = Sale::where('status_id', 2)
            ->where('multiMoneda_method_usd', 'efectivo-dolares')
            ->where('type_sale', $this->store)
            ->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])
            ->sum('pay_usd');
            /********************************************************************************************************************/

            /** Zelle */
            $zelle = Sale::where('status_id', 2)
            ->where('payment_method', 'zelle')
            ->where('type_sale', $this->store)
            ->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])
            ->sum('pay_usd');

            $zelle_multiMoneda = Sale::where('status_id', 2)
            ->where('multiMoneda_method_usd', 'zelle')
            ->where('type_sale', $this->store)
            ->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])
            ->sum('pay_usd');
            /********************************************************************************************************************/

            /** Banesco Panama */
            $banecoPanama = Sale::where('status_id', 2)
            ->where('payment_method', 'banesco-panama')
            ->where('type_sale', $this->store)
            ->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])
            ->sum('pay_usd');

            $banecoPanama_multiMoneda = Sale::where('status_id', 2)
            ->where('multiMoneda_method_usd', 'banesco-panama')
            ->where('type_sale', $this->store)
            ->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])
            ->sum('pay_usd');
            /********************************************************************************************************************/

            /** Pago MOvil */
            $pagoMovil = Sale::where('status_id', 2)
            ->where('payment_method', 'pago-movil')
            ->where('type_sale', $this->store)
            ->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])
            ->sum('pay_usd');

            $pagoMovil_multiMoneda = Sale::where('status_id', 2)
            ->where('multiMoneda_method_usd', 'pago-movil')
            ->where('type_sale', $this->store)
            ->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])
            ->sum('pay_usd');
            /********************************************************************************************************************/
            
            
            $dailyClosing->total_efectivo_usd   = $efectivoUSD + $efectivoUSD_multiMoneda;
            $dailyClosing->total_zelle          = $zelle + $zelle_multiMoneda;
            $dailyClosing->total_banesco_panama = $banecoPanama + $banecoPanama_multiMoneda;
            $dailyClosing->total_pago_movil     = $pagoMovil + $pagoMovil_multiMoneda;
            $dailyClosing->store                = $this->store;
            $dailyClosing->created_by           = Auth::user()->name;

            $dailyClosing->save();

            $this->dispatch('daily-closing-updated');

            Notification::make()
                ->title('FACTURACION EXITOSA!')
                ->body('La facturacion fue registrada de forma correcta. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

            $this->reset();


        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACIÓN')
            ->icon('heroicon-o-document-text')
            ->iconColor('danger')
            ->color('danger')
            ->body($th->getMessage())
            ->send();
        }

    }


    public function render()
    {
        return view('livewire.menu.daily-closing');
    }
}
