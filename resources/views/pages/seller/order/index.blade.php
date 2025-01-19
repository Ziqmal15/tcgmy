<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-50 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12 h-full bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg border border-stone-800 backdrop-blur-sm">
                <!-- Table Header -->
                <div class="p-6 border-b border-stone-800">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-stone-50 tracking-wide">Customer Orders</h3>
                        <div class="text-stone-300">
                            <span class="text-sm">Total Completed Sales:</span>
                            <span class="ml-2 text-lg font-semibold text-green-400">
                                RM {{ number_format($orders->where('status', 'approved')->sum('total'), 2) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-stone-800">
                        <thead class="bg-stone-900/95">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Order ID
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Customer
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Items
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Total Amount
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Receipt
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-stone-900/80 divide-y divide-stone-800">
                            @forelse ($orders as $order)
                                <tr class="hover:bg-stone-800/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-300">
                                        <a href="{{ route('seller.order.show', $order->id) }}" class="hover:text-stone-100">
                                            #{{ $order->id }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-stone-50">
                                                    {{ $order->user->name }}
                                                </div>
                                                <div class="text-sm text-stone-400">
                                                    {{ $order->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-300">
                                        {{ $order->order_items_count }} items
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-300">
                                        RM {{ number_format($order->total, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $status = $order->status;
                                            if($status === 'Reviewing Receipt'){
                                                $statusClass = 'bg-yellow-100 text-yellow-800';
                                            }elseif($status === 'approved'){
                                                $statusClass = 'bg-green-100 text-green-800';
                                            }elseif($status === 'Shipped'){
                                                $statusClass = 'bg-green-100 text-green-800';
                                            }elseif(
                                                $statusClass = 'bg-red-100 text-red-800'
                                            )
                                            
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $payment = $order->checkout->payment ?? null;
                                        @endphp
                                        @if($payment)
                                            <a href="{{ asset('storage/' . $payment->proof_of_payment) }}" 
                                               download
                                               class="text-stone-400 hover:text-stone-200 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </a>
                                        @else
                                            <span class="text-stone-500">No receipt</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            @if($order->status === 'pending')
                                                <form action="{{ route('seller.order.approve', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="text-green-400 hover:text-green-300 transition-colors"
                                                            onclick="return confirm('Are you sure you want to approve this order?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                  d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('seller.order.destroy', $order->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-400 hover:text-red-300 transition-colors"
                                                        onclick="return confirm('Are you sure you want to delete this order?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-stone-400">
                                        No orders found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="px-6 py-4 border-t border-stone-800">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
