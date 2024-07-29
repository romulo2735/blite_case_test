<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedBrands = [];
    public $selectedCategories = [];
    public $brands = [];
    public $categories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedBrands' => ['except' => []],
        'selectedCategories' => ['except' => []],
    ];

    public function mount(): void
    {
        $this->brands = Brand::orderBy('name')->get();
        $this->categories = Category::orderBy('name')->get();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSelectedBrands(): void
    {
        $this->resetPage();
    }

    public function updatingSelectedCategories(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'selectedBrands', 'selectedCategories']);
    }

    public function render()
    {
        $products = Product::with(['brand', 'category'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedBrands, function ($query) {
                $query->whereIn('brand_id', $this->selectedBrands);
            })
            ->when($this->selectedCategories, function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })
            ->paginate(12);

        return view('livewire.product-list', [
            'products' => $products,
        ]);
    }
}
