<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-stone-50 leading-tight tracking-wide">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-stone-950 to-stone-900 bg-opacity-95 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-stone-900/95 to-stone-900/80 overflow-hidden shadow-[0_0_20px_rgba(214,211,209,0.1)] rounded-xl p-8 border border-stone-800/50 backdrop-blur-sm">
                <!-- Order Header -->
                <div class="border-b border-stone-800/50 pb-6 mb-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="space-y-2">
                            <p class="text-stone-300 text-lg">#<span class="font-mono">{{ $order->id }}</span></p>
                            <p class="text-stone-400 text-sm">Ordered on {{ $order->created_at->format('F j, Y') }}</p>
                        </div>
                        <div>
                            <span class="px-4 py-1.5 inline-flex text-sm leading-5 font-medium rounded-full shadow-lg 
                                @if($order->status === 'completed') bg-green-900/30 text-green-300 border border-green-700/50
                                @elseif($order->status === 'pending') bg-yellow-900/30 text-yellow-300 border border-yellow-700/50
                                @elseif($order->status === 'cancelled') bg-red-900/30 text-red-300 border border-red-700/50
                                @endif backdrop-blur-sm">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-stone-50 flex items-center gap-2">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Shipping Information
                        </h2>
                        <div class="bg-stone-900/60 p-6 rounded-xl border border-stone-800/50 shadow-lg backdrop-blur-sm hover:border-stone-700/50 transition-all duration-300 h-auto">
                            <div class="space-y-3">
                                <p class="text-stone-300"><span class="text-stone-400">Name:</span> {{ $order->user->name }}</p>
                                @php
                                    $profile = $order->user->profile;
                                @endphp
                                <p class="text-stone-300"><span class="text-stone-400">Address:</span> {{ $profile->address ?? 'N/A' }}</p>
                                <p class="text-stone-300"><span class="text-stone-400">Phone:</span> {{ $profile->phone ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-stone-50 flex items-center gap-2">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                            </svg>
                            Tracking Information
                        </h2>
                        <div class="bg-stone-900/60 p-6 rounded-xl border border-stone-800/50 shadow-lg backdrop-blur-sm hover:border-stone-700/50 transition-all duration-300 h-auto">
                            <div class="flex items-start space-x-3">
                                <div class="w-2.5 h-2.5 rounded-full mt-1.5
                                    @if($order->status === 'completed') bg-green-400 shadow-green-400/50
                                    @elseif($order->status === 'cancelled') bg-red-400 shadow-red-400/50
                                    @elseif($order->status === 'shipped') bg-blue-400 shadow-blue-400/50
                                    @elseif($order->status === 'approved') bg-yellow-400 shadow-yellow-400/50
                                    @else bg-stone-400 
                                    @endif shadow-lg">
                                </div>
                                <div class="flex-1">
                                    @if($order->status === 'pending')
                                        <div>
                                            <p class="text-stone-50 font-medium">Payment Under Review</p>
                                            <span class="text-stone-400 text-sm block mt-2">
                                                Please Wait for Approval
                                            </span>
                                        </div>
                                    @elseif($order->status === 'approved')
                                        <div>
                                            <p class="text-stone-50 font-medium">Preparing to Ship</p>
                                            <span class="text-stone-400 text-sm block mt-2">
                                                Seller is preparing your order.
                                            </span>
                                        </div>
                                    @elseif($order->status === 'shipped')
                                        <p class="text-stone-50 font-medium">Tracking Number Available</p>
                                    @elseif($order->status === 'cancelled')
                                        <div>
                                            <p class="text-stone-50 font-medium">Order has been rejected</p>
                                            <span class="text-stone-400 text-sm block mt-2">
                                                Due to invalid payment
                                            </span>
                                        </div>
                                    @elseif($order->status === 'completed')
                                        <p class="text-stone-50 font-medium">Your order has been completed</p>
                                    @endif
                                </div>
                            </div>
                            @if($order->status === 'shipped' && $order->tracking_number)
                                <div class="text-stone-300 mt-4 pl-5">
                                    <p class="font-medium text-stone-400 mb-2">Tracking Number:</p>
                                    <div class="flex items-center space-x-3">
                                        <p id="tracking-number" class="font-mono bg-stone-800/80 px-4 py-2 rounded-lg text-stone-300">{{ $order->tracking_number }}</p>
                                        <button onclick="copyTrackingNumber()" class="px-3 py-2 text-sm bg-stone-700/80 hover:bg-stone-600/80 text-stone-200 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                            </svg>
                                            <span id="copy-text">Copy</span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            @if($order->status === 'completed')
                                <div class="text-stone-300 mt-4 pl-5">
                                    <p class="text-stone-400">Please rate and review our product now</p>
                                    <a href="{{ route('user.review.index', ['order_id' => $order->id]) }}" 
                                       class="inline-flex items-center mt-3 px-4 py-2 bg-stone-700/80 hover:bg-stone-600/80 text-stone-200 rounded-lg transition-all duration-200 text-sm gap-2 hover:translate-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                        </svg>
                                        Rate & Review
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4 text-stone-50 flex items-center gap-2">
                        <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Order Items
                    </h2>
                    <div class="overflow-x-auto rounded-xl border border-stone-800/50">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-stone-900/60">
                                    <th class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-800/50 bg-stone-900/30">
                                @foreach($order->orderItems as $item)
                                @php
                                    $product = $item->cartItem->card;
                                @endphp
                                <tr class="hover:bg-stone-800/30 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-12 w-12 flex-shrink-0">
                                                <img class="h-12 w-12 rounded-lg object-cover shadow-lg" src="{{ asset('storage/'.$product->image) ?? 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-stone-200">{{ $product->name }}</div>
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
                <div class="border-t border-stone-800/50 pt-6">
                    <div class="flex justify-end">
                        <div class="w-full md:w-1/3 bg-stone-900/60 p-6 rounded-xl border border-stone-800/50 shadow-lg">
                            <div class="space-y-4">
                                <div class="flex justify-between text-lg">
                                    <span class="text-stone-400">Subtotal</span>
                                    <span class="text-stone-300">RM {{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                @if($order->discount > 0)
                                <div class="flex justify-between text-lg text-green-400">
                                    <span>Discount</span>
                                    <span>-RM {{ number_format($order->discount, 2) }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between text-lg pt-4 border-t border-stone-800/50">
                                    <span class="text-stone-50 font-medium">Total After Discount</span>
                                    <span class="text-stone-50 font-medium">RM {{ number_format($order->total, 2) }}</span>
                                </div>
                            </div>

                            @if($order->status === 'shipped')
                                <div class="mt-6">
                                    <form action="{{ route('user.orders.received', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full bg-gradient-to-r from-stone-800 to-stone-700 hover:from-stone-700 hover:to-stone-600 text-stone-200 font-medium py-3 px-6 rounded-lg shadow-lg backdrop-blur-sm transition-all duration-300 hover:shadow-[0_0_15px_rgba(214,211,209,0.1)] hover:scale-[1.02] transform flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Order Received
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout> 