<?php

namespace App\Livewire;

use App\Models\TasaBcv;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Livewire\Actions\Logout;
use Livewire\Component;

class MenuEmployee extends Component
{
    #[Validate('required', message: 'Please provide a post title')] 
    public $value;

    #[On('valueBcvModified')] 
    public function valueBcvModified()
    {
        $this->reset();
    }

    public $hidden_menu = 'hidden';

    public function view_menu(){
        if ($this->hidden_menu == 'hidden') {
            $this->hidden_menu = '';
        } else {
            $this->hidden_menu = 'hidden';
        }
        
    }

    public function update_bcv(){
        
        $this->validate();

        try {

            $update_bcv = TasaBcv::first();
            $update_bcv->update([
                'tasa' => $this->value,
                'date' => now()->format('d-m-Y'),
                ]);

            $this->reset();

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
    
    public function render()
    {
        $tasa = TasaBcv::first()->tasa;
        return view('livewire.menu-employee', compact('tasa'));
    }
}
