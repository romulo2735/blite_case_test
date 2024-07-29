<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="mb-4 flex items-center gap-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search Products..."
               class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">

        <div class="relative w-48">
            <label for="brands">Brands:</label>
            <select wire:model.live.debounce.300ms="selectedBrands" id="brands" multiple
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="categories">Categories:</label>
            <select wire:model.live.debounce.300ms="selectedCategories" id="categories" multiple
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button wire:click="clearFilters" class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">Clear
            Filters
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white border rounded-lg shadow overflow-hidden">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600">{{ $product->brand->name }}</p>
                    <p class="text-gray-600">{{ $product->category->name }}</p>
                    <p class="text-xl font-bold">${{ $product->price }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
