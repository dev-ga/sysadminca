<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class SelectDependent extends Component
{
    public $categories;
    public $subCategories = [];

    public $categoryId;
    public $subCategoryId;


    public function mount(){
        $this->categories = Category::all();
        $this->subCategories = collect();
    }

    public function updatedCategoryId($value){
        $this->subCategories = SubCategory::where('category_id', $value)->get();
    }

    public function render()
    {
        return view('livewire.select-dependent');
    }
}
