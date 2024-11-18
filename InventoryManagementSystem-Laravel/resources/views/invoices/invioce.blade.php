<x-layout>
    <div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Invoice</h1>
        
        <div class="mb-4">
            <h2 class="text-lg font-semibold">Bill ID: {{ $bill->id }}</h2>
            <h2 class="text-lg font-semibold">Total Amount: ₹{{ $bill->total_amount }}</h2>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b">Item Name</th>
                    <th class="py-2 px-4 border-b">Quantity</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($billItems as $item)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $item->item->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->quantity }}</td>
                        <td class="py-2 px-4 border-b">₹{{ $item->item->price }}</td>
                        <td class="py-2 px-4 border-b">₹{{ $item->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            <a href="{{ route('sales.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
                Create Another Bill
            </a>
        </div>
    </div>
</x-layout>
