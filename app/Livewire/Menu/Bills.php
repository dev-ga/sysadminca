<?php

namespace App\Livewire\Menu;

use App\Models\Bill;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Bills extends Component
{
    #[Validate('required', message: 'Campo requerido')]
    public $description;

    #[Validate('required', message: 'Campo requerido')]
    #[Validate('numeric', message: 'Requiere solo numeros')]
    public $amount;

    #[Validate('required', message: 'Campo requerido')]
    public $payment_method;

    public $reference;

    public function upload_bill() {

        $this->validate();

        try {

            $bill = new Bill();
            $bill->code             = 'CA-G-' . random_int(1111, 9999);
            $bill->description      = $this->description;
            $bill->payment_method   = $this->payment_method;
            if($bill->payment_method == 'usd'){
                $bill->amount_usd  = $this->amount;
            }else{
                $bill->amount_bsd  = $this->amount;
            }
            $bill->reference        = $this->reference;
            $bill->created_by       = Auth::user()->name;
            $bill->save();

            $this->dispatch('bill-updated');

            Notification::make()
                ->title('CARGA EXITOSA!')
                ->body('El gasto fue cargado de forma correcta. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

            $this->reset();

            //code...
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
        return view('livewire.menu.bills');
    }
}
