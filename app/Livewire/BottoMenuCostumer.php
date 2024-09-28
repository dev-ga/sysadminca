<?php

namespace App\Livewire;

use App\Models\ItemCar;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class BottoMenuCostumer extends Component
{
    
    #[On('add-to-card')] 
    public function updateCardList()
    {
        $this->reset();
    }

    #[On('delete-item-to-card')] 
    public function deleteCardList()
    {
        $this->reset();
    }

    #[On('payment-registered')] 
    public function paymentRegistered()
    {
        $this->reset();
    }

    public function home(){
        // $this->redirectRoute('search-item');
        return $this->redirect('/search', navigate: true);
    }

    public function car(){
        return $this->redirect('/costumer/c/c', navigate: true);
    }

    public function status_sale(){
        return $this->redirect('/costumer/s/s', navigate: true);
    }

    public function profile(){
        return $this->redirect('/costumer/p', navigate: true);
    }
    
    public function render()
    {
        $itemInCard = ItemCar::where('user_id', Auth::user()->id)->where('status', 2)->get();
        $count = count($itemInCard);
        return view('livewire.botto-menu-costumer', compact('count'));
    }
}
