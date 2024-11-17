<x-layout>
    <div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Create Bill</h1>

        <!-- Flash Message -->
        @if (session('status'))
            <div class="text-green-700 font-semibold mb-6 bg-green-100 border-l-4 border-green-500 rounded-md p-4">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
        @endif

        <form id="billForm" action="{{ route('sales.store') }}" method="POST" class="space-y-6">
            @csrf
            <div id="itemsList" class="space-y-4">
                <!-- Single Item Row -->
                <div class="item-row flex items-center space-x-4">
                    <div class="flex-1">
                        <!-- Add label only for the first selector -->
                        <label for="item-0" class="block text-sm font-medium text-gray-700">Select Item</label>
                        <select name="items[0][item_id]" id="item-0" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Select an item</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                    {{ $item->name }} - ₹{{ $item->price }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-24">
                        <label for="quantity-0" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="items[0][quantity]" id="quantity-0" min="1" value="1" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="button" id="addItem" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-600 transition duration-300">
                    Add Another Item
                </button>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-sm hover:bg-blue-600 transition duration-300">
                    Complete Bill
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('addItem').addEventListener('click', function () {
            const itemsList = document.getElementById('itemsList');
            const index = itemsList.children.length;

            const itemRow = document.createElement('div');
            itemRow.className = 'item-row flex items-center space-x-4';
            itemRow.innerHTML = `
                <div class="flex-1">
                    <select name="items[${index}][item_id]" id="item-${index}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Select an item</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                {{ $item->name }} - ₹{{ $item->price }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-24">
                    <label for="quantity-${index}" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="items[${index}][quantity]" id="quantity-${index}" min="1" value="1" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            `;
            itemsList.appendChild(itemRow);
        });
    </script>
</x-layout>
