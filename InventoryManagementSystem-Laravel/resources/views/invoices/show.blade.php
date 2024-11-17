<x-layout>
    <div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-md mt-16">
        <h1 class="text-3xl font-semibold mb-4 text-gray-800">Invoice</h1>
        
        <!-- Greeting for Customer -->
        <p class="text-lg text-gray-600 mb-4">
            Thank you for shopping with us at <strong>Ratna Medico</strong>. We value your health and well-being!
        </p>

        <!-- Invoice Details -->
        <p><strong>Bill ID:</strong> {{ $bill->id }}</p>
        <p><strong>Total Amount:</strong> ₹{{ $bill->total_amount }}</p>

        <!-- Items Table -->
        <table class="min-w-full bg-white shadow-md rounded-lg mt-6">
            <thead class="bg-gray-200">
                <tr>
                    <th class="text-left py-2 px-4 font-semibold text-gray-600">Item</th>
                    <th class="text-left py-2 px-4 font-semibold text-gray-600">Quantity</th>
                    <th class="text-left py-2 px-4 font-semibold text-gray-600">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bill->billItems as $item)
                    <tr class="border-t">
                        <td class="py-2 px-4 text-gray-700">{{ $item->item->name }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $item->quantity }}</td>
                        <td class="py-2 px-4 text-gray-700">₹{{ $item->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Thank You Note -->
        <p class="mt-8 text-center text-gray-700">
            We look forward to serving you again. Stay healthy and take care!
        </p>
    </div>
</x-layout>
