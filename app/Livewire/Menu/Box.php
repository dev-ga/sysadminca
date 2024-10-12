<?php

namespace App\Livewire\Menu;

use App\Models\PaymentMethod;
use App\Models\User;
use Livewire\Component;

class Box extends Component
{
    public $amount_bsd;
    public $amount_usd;
    public $employee;
    public $payment_method_usd;
    public $payment_method_bsd;

    public $hidden_table_inventory = 'hidden';

    public function hidden()
    {
        $this->hidden_table_inventory = 'hidden';
    }

    public function show()
    {
        $this->hidden_table_inventory = '';  
    }


    public function render()
    {
        $employees = User::where('role', 'employee')->get();
        $method_pay_usd = PaymentMethod::where('currency', 'USD')->get();
        $method_pay_bsd = PaymentMethod::where('currency', 'BS')->get();
        return view('livewire.menu.box', compact('employees', 'method_pay_usd', 'method_pay_bsd'));
    }
}
