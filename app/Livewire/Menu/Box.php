<?php

namespace App\Livewire\Menu;

use App\Http\Controllers\UtilsController;
use App\Models\PaymentMethod;
use App\Models\PreBilling;
use App\Models\TasaBcv;
use App\Models\User;
use Exception;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Box extends Component
{
    use WireUiActions;
    
    public $amount_bsd;
    public $amount_usd;

    #[Validate('required', message: 'Empleado requerido')]
    public $employee;
    
    public $payment_method_usd;
    public $payment_method_bsd;

    public $hidden_table_inventory = '';

    public function hidden()
    {
        $this->hidden_table_inventory = 'hidden';
    }

    public function show()
    {
        $this->hidden_table_inventory = '';  
    }

    public function errorDialog(): void
    {

        $this->dialog()->show([
            'icon' => 'error',
            'title' => 'NOTIFICACION!',
            'description' => 'Debe seleccionar al menos un metodo de pago para poder ejecutar el calculo.',
        ]);

    }

    public function errorDialogBill(): void
    {

        $this->dialog()->show([
            'icon' => 'error',
            'title' => 'NOTIFICACION!',
            'description' => 'El monto no puede ser igual a cero. Por favor valide y vuelva a intentarlo',
        ]);

    }

    public function calculo(Request $request)
    {
        $this->validate();

        try {

            $tasaBcv = TasaBcv::first()->tasa;

            $total_amount = PreBilling::sum('total_usd');

            if ($this->payment_method_usd == 'zelle' || $this->payment_method_usd == 'efectivo-dolares' || $this->payment_method_usd == 'banesco-panama' || $this->payment_method_usd == '' && $this->payment_method_bsd == '' || $this->payment_method_bsd == 'pago-movil' || $this->payment_method_bsd == 'transferencia' || $this->payment_method_bsd == 'efectivo-bolivares') {
                if ($this->payment_method_usd == '' && $this->payment_method_bsd == '') {
                    $this->errorDialog();
                    $this->reset(['amount_bsd']);
                } else {
                    $this->amount_bsd = number_format((($total_amount - $this->amount_usd) * $tasaBcv), 2, ",", ".");
                }
                
            }

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

    public function bill()
    {

        if($this->payment_method_usd != '' && $this->payment_method_bsd == '')
        {
            $total_amount = PreBilling::sum('total_usd');
            $res = UtilsController::billing_payment_method_usd($total_amount, $this->amount_usd, $this->payment_method_usd, $this->employee);

            if($res){

                PreBilling::query()->truncate();

                Notification::make()
                ->title('FACTURACION EXITOSA!')
                ->body('La facturacion fue registrada de forma correcta. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

                $this->reset();

                return redirect()->route('box');
            }else{
                $this->errorDialogBill();
                $this->reset();
            }

        }

        if($this->payment_method_usd == '' && $this->payment_method_bsd != '')
        {
            $total_amount = PreBilling::sum('total_bsd');
            $res = UtilsController::billing_payment_method_bsd($total_amount, $total_amount, $this->payment_method_bsd, $this->employee);

            if($res){

                PreBilling::query()->truncate();

                Notification::make()
                ->title('FACTURACION EXITOSA!')
                ->body('La facturacion fue registrada de forma correcta. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

                $this->reset();

                return redirect()->route('box');
            }else{
                $this->errorDialogBill();
                $this->reset();
            }
        }

        if($this->payment_method_bsd != '' && $this->payment_method_usd != '')
        {
            $total_amount_usd = PreBilling::sum('total_usd');
            $total_amount_bsd = PreBilling::sum('total_bsd');
            $res = UtilsController::billing_multiple($total_amount_usd, $total_amount_bsd, (integer)$this->amount_usd, (float)$this->amount_bsd, 'multi-moneda', $this->employee, $this->payment_method_usd, $this->payment_method_bsd);

            if($res){

                PreBilling::query()->truncate();

                Notification::make()
                ->title('FACTURACION EXITOSA!')
                ->body('La facturacion fue registrada de forma correcta. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

                $this->reset();

                return redirect()->route('box');
            }else{
                $this->errorDialogBill();
                $this->reset();
            }
        }
    
    }


    public function render()
    {
        
        $employees = User::where('role', 'employee')->get();
        $method_pay_usd = PaymentMethod::where('currency', 'USD')->get();
        $method_pay_bsd = PaymentMethod::where('currency', 'BS')->get();
        return view('livewire.menu.box', compact('employees', 'method_pay_usd', 'method_pay_bsd'));
    }
}
