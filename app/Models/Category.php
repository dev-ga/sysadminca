<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'status'
    ];

    /**
     * Get all of the subCategories for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategory(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }

        /**
     * Get the category associated with the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventoryCategory(): HasOne
    {
        return $this->hasOne(Category::class);
    }


}
