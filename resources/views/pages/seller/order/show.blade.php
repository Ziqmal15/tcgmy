<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-50 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg p-8 border border-stone-800 backdrop-blur-sm">
                <!-- Order Header -->
                <div class="border-b border-stone-800 pb-4 mb-4">
                    <div class="flex justify-between mt-2">
                        <div>
                            <p class="text-stone-300">Order ID: #{{ $order->id }}</p>
                            <p class="text-stone-300">Order Date: {{ $order->created_at->format('F j, Y') }}</p>
                        </div>
                        <div>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($order->status === 'completed') bg-green-900/50 text-green-300 border border-green-700
                                @elseif($order->status === 'pending') bg-yellow-900/50 text-yellow-300 border border-yellow-700
                                @elseif($order->status === 'cancelled') bg-red-900/50 text-red-300 border border-red-700
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold mb-2 text-stone-50 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Shipping Information
                        </h2>
                        <div class="bg-stone-900/95 p-6 rounded-lg border border-stone-800 shadow-md backdrop-blur-sm hover:border-stone-700 transition-all duration-300 min-h-[160px]">
                            <div class="space-y-4">
                                <div class="flex items-center text-stone-300">
                                    <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>{{ $order->user->name }}</span>
                                </div>
                                @php
                                    $profile = $order->user->profile;
                                @endphp
                                <div class="flex items-start text-stone-300">
                                    <svg class="w-5 h-5 mr-3 mt-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    <span>{{ $profile->address ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center text-stone-300">
                                    <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span>{{ $profile->phone ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-data="{ isApproved: {{ $order->status ? 'true' : 'false' }} }">
                        <template x-if="isApproved">
                            <div>
                                <h2 class="text-lg font-semibold mb-2 text-stone-50 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                                    Tracking Information
                                </h2>
                                <div class="bg-stone-900/95 p-6 rounded-lg border border-stone-800 shadow-md backdrop-blur-sm min-h-[160px]">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-stone-300 mb-2 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                </svg>
                                                Tracking Number
                                            </label>
                                            @if($order->tracking_number)
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-stone-300">{{ $order->tracking_number }}</span>
                                                    <span class="px-2 py-1 text-xs rounded-full bg-green-900/50 text-green-300 border border-green-700">Shipped</span>
                                                </div>
                                            @else
                                                <form action="{{ route('seller.order.tracking.update', $order->id) }}" method="POST" class="space-y-4">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex space-x-4">
                                                        <input type="text" 
                                                            name="tracking_number"
                                                            class="flex-1 bg-stone-800 border border-stone-700 text-stone-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200" 
                                                            placeholder="Enter tracking number"
                                                            required>
                                                        <button type="submit" class="px-6 py-2.5 bg-amber-600 text-stone-100 rounded-md hover:bg-amber-500 transition-all duration-200 flex items-center space-x-2 hover:shadow-lg">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                            </svg>
                                                            <span>Submit</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="!isApproved">
                            <div>
                                <h2 class="text-lg font-semibold mb-2 text-stone-50 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                                    Tracking Information
                                </h2>
                                <div class="bg-stone-900/95 p-6 rounded-lg border border-stone-800 shadow-md backdrop-blur-sm min-h-[160px] flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 text-stone-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-stone-500 italic">Receipt approval required to arrange shipment</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4 text-stone-50">Order Items</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-300 uppercase tracking-wider border-b border-stone-800">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-300 uppercase tracking-wider border-b border-stone-800">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-300 uppercase tracking-wider border-b border-stone-800">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-300 uppercase tracking-wider border-b border-stone-800">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-800">
                                @foreach($order->orderItems as $item)
                                @php
                                    $product = $item->cartItem->card;
                                @endphp
                                <tr class="hover:bg-stone-800/50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded" src="{{ asset('storage/'.$product->image) ?? 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-stone-300">{{ $product->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-stone-300">RM{{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4 text-sm text-stone-300">{{ $item->cartItem->quantity }}</td>
                                    <td class="px-6 py-4 text-sm text-stone-300">RM{{ number_format($item->cartItem->price * $item->cartItem->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="border-t border-stone-800 pt-4">
                    <div class="flex justify-end">
                        <div class="w-full md:w-1/3">
                            <div class="flex justify-between font-bold text-lg  pt-2">
                                <span class="text-stone-50">Total</span>
                                <span class="text-stone-50">RM {{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 