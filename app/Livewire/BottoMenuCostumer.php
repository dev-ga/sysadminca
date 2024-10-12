<?php

namespace App\Livewire;

use App\Models\ItemCar;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class BottoMenuCostumer extends Component
{
    use WireUiActions;
    
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
        $this->redirectRoute('search-item', navigate: true);
    }

    public function profile(){
        $this->redirectRoute('profile-costumer', navigate: true);
        // return $this->redirect('/search', navigate: false);
    }

    public function car(){
        $this->redirectRoute('shopping-car', navigate: true);
    }

    public function status_sale(){

        $this->redirectRoute('status-sale', navigate: false);
    }
    
    public function render()
    {
        $itemInCard = ItemCar::where('user_id', Auth::user()->id)->where('status', 2)->get();
        $count = count($itemInCard);
        return view('livewire.botto-menu-costumer', compact('count'));
    }
}
