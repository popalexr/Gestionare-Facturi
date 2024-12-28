<x-print-layout>
    <div class="max-w-4xl mx-auto my-10 no-print">
        <div class="flex justify-end gap-2 max-w-full max-h-full">
            <button type="button" id="save-pdf" data-name="invoice-{{ $invoice->id }}-{{ $client->name }}-{{ now()->format('d-M-Y-H-i') }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">Save PDF</button>
            <a href="{{ route('invoices.details', ['id' => $invoice->id]) }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg" id="invoice-container">
        <!-- Invoice Header -->
        <div class="flex items-center justify-between border-b pb-4 mb-6">
            <h1 class="text-2xl font-bold">Invoice #{{ $invoice->id }}</h1>
            <p class="text-gray-600">Created at {{ $invoice->created_at->format('d M y, H:i') }}</p>
        </div>

        <!-- Invoice Details -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-8">
            <div>
                <h2 class="text-lg font-semibold">Billed To:</h2>
                <p class="text-gray-700">{{ $client->name }}</p>
                <p class="text-gray-700">{{ $client->cui }}</p>
                <p class="text-gray-700">{{ $client->address ?? '-' }}</p>
                <p class="text-gray-700">
                    {{ $client->country ?? '-' }},
                    {{ $client->county ?? '-' }},
                    {{ $client->city ?? '-' }}
                </p>
            </div>
            <div class="md:text-right">
                <h2 class="text-lg font-semibold">Provider:</h2>
                <p class="text-gray-700">{{ $provider->name }}</p>
                <p class="text-gray-700">{{ $provider->cui }}</p>
                <p class="text-gray-700">{{ $provider->address ?? '-' }}</p>
                <p class="text-gray-700">
                    {{ $provider->country ?? '-' }},
                    {{ $provider->county ?? '-' }},
                    {{ $provider->city ?? '-' }}
                </p>
            </div>
        </div>

        <!-- Invoice Table -->
        <div class="overflow-x-auto mt-6">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                    <th scope="col" class="px-6 py-3">Item</th>
                    <th scope="col" class="px-6 py-3">Quantity</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">VAT</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $product->product_name }}</td>
                            <td class="px-6 py-4">{{ $product->quantity }}</td>
                            <td class="px-6 py-4">{{ currency_symbol($invoice->currency) }} {{ $product->price }}</td>
                            <td class="px-6 py-4">{{ $product->vat }}%</td>
                            <td class="px-6 py-4">{{ currency_symbol($invoice->currency )}} {{ $product->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Invoice Summary -->
        <div class="flex justify-end mt-6">
            <div class="w-full md:w-1/2 lg:w-1/3 text-gray-700">
                <div class="pt-2 flex justify-between font-semibold text-lg">
                    <span>Total:</span>
                    <span>{{ currency_symbol($invoice->currency) }} {{ $invoice->value }}</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // window.print();
    </script>
</x-print-layout>