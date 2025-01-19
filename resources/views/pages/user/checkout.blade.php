<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-50 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main form wrapping everything -->
            <form id="form-checkout" action="{{ route('user.checkout.store', $order->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @csrf
                
                @if ($errors->any())
                <div class="lg:col-span-2">
                    <div class="bg-red-900/50 border border-red-500 rounded-lg p-4">
                        <div class="flex items-center gap-2 text-red-500 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium">Please correct the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside text-red-400 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if (session('error'))
                <div class="lg:col-span-2">
                    <div class="bg-red-900/50 border border-red-500 rounded-lg p-4">
                        <div class="flex items-center gap-2 text-red-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Left Column - Payment Section -->
                <div class="space-y-8">
                    <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-xl p-8 border border-stone-800 backdrop-blur-sm">
                        <div class="flex items-center gap-3 mb-8">
                            <h3 class="text-2xl font-semibold text-stone-50 tracking-wide">Payment Method</h3>
                        </div>

                        <!-- QR Payment Section -->
                        <div class="space-y-8">
                            <div class="flex justify-center">
                                <div x-data="{ showZoom: false }" class="relative">
                                    <div class="p-4 bg-gradient-to-br from-stone-800 to-stone-900 rounded-xl shadow-md border border-stone-700 transform hover:scale-105 transition-all duration-300 cursor-pointer group"
                                         @click="showZoom = true">
                                        <img src="{{ asset('img/qrpayment.jpg') }}" alt="QR Code" 
                                             class="w-48 h-48 object-cover rounded-lg">
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="bg-stone-900/80 rounded-lg px-3 py-2 backdrop-blur-sm">
                                                <div class="flex items-center gap-2 text-stone-200">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                                    </svg>
                                                    <span class="text-sm font-medium">Click to zoom</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- QR Code Zoom Modal -->
                                    <div x-show="showZoom"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="fixed inset-0 z-[70] overflow-y-auto"
                                         @click.self="showZoom = false"
                                         @keydown.escape.window="showZoom = false">
                                        
                                        <!-- Modal Backdrop -->
                                        <div class="fixed inset-0 bg-stone-950/90 backdrop-blur-sm"></div>

                                        <!-- Modal Content -->
                                        <div class="relative min-h-screen flex items-center justify-center p-4">
                                            <div class="relative bg-gradient-to-b from-stone-900 to-stone-950 p-4 rounded-xl border border-stone-800 shadow-2xl max-w-3xl mx-auto">
                                                <!-- Close Button -->
                                                <button @click="showZoom = false" 
                                                        class="absolute -top-4 -right-4 bg-stone-800 text-stone-200 rounded-full p-2 hover:bg-stone-700 transition-colors border border-stone-700 shadow-lg">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>

                                                <!-- Large QR Code -->
                                                <div class="p-4 bg-gradient-to-br from-stone-800 to-stone-900 rounded-xl border border-stone-700">
                                                    <img src="{{ asset('img/qrpayment.jpg') }}" alt="QR Code" 
                                                         class="w-[500px] h-[500px] object-cover rounded-lg">
                                                </div>

                                                <!-- Helper Text -->
                                                <div class="mt-4 text-center">
                                                    <p class="text-stone-400 text-sm">Press <span class="text-stone-300 font-medium">ESC</span> or click outside to close</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 bg-stone-900/80 rounded-lg border border-stone-800">
                                    <p class="text-stone-300 tracking-wide">1. Screenshot and Scan the QR code with your mobile banking app</p>
                                </div>
                                <div class="flex items-center gap-4 p-4 bg-stone-900/80 rounded-lg border border-stone-800">
                                    <p class="text-stone-300 tracking-wide">2. Amount to pay: <span class="text-stone-50 font-medium">RM {{ $order->total }}</span></p>
                                </div>
                                <div class="flex items-center gap-4 p-4 bg-stone-900/80 rounded-lg border border-stone-800">
                                    <p class="text-stone-300 tracking-wide">3. Upload your payment proof below</p>
                                </div>
                            </div>

                            <!-- File Upload Section -->
                            <div class="pt-6 border-t border-stone-800">
                                <label class="block text-lg font-medium text-stone-50 mb-4 tracking-wide">
                                    Upload Proof of Payment
                                </label>
                                <div x-data="simpleFileUpload()"
                                     class="mt-1">
                                    <div class="space-y-4">
                                        <!-- Preview Area -->
                                        <div x-show="preview" 
                                             class="relative w-full aspect-video bg-stone-900/50 rounded-xl border-2 border-stone-700 overflow-hidden">
                                            <img :src="preview" 
                                                 class="w-full h-full object-contain">
                                            <button @click.prevent="removeFile" 
                                                    class="absolute top-2 right-2 bg-stone-900/90 text-stone-300 rounded-full p-1.5 hover:bg-stone-800 transition-colors border border-stone-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Upload Button -->
                                        <div x-show="!preview" 
                                             class="relative">
                                            <input type="file"
                                                   name="proof_of_payment"
                                                   id="proof_of_payment"
                                                   accept="image/*"
                                                   @change="handleFileSelect"
                                                   class="hidden">
                                            
                                            <label for="proof_of_payment"
                                                   class="flex flex-col items-center justify-center w-full aspect-video rounded-xl border-2 border-dashed border-stone-700 bg-stone-900/50 hover:border-blue-500/50 hover:bg-stone-900/80 transition-all cursor-pointer">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4">
                                                    <svg class="w-12 h-12 text-stone-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6a2 2 0 100-4 2 2 0 000 4z" />
                                                    </svg>
                                                    <p class="text-sm text-stone-400 text-center">
                                                        <span class="font-medium text-blue-400 hover:text-blue-300">Click to upload</span> or drag and drop
                                                    </p>
                                                    <p class="text-xs text-stone-500 mt-1">PNG, JPG, GIF (Max. 10MB)</p>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Error Message -->
                                        <div x-show="fileError" 
                                             x-transition
                                             class="flex items-center gap-2 text-red-400 text-sm mt-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span x-text="fileError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div class="space-y-8">
                    <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-xl p-8 border border-stone-800 backdrop-blur-sm">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-2xl font-semibold text-stone-50 tracking-wide">Order Summary</h3>
                            <div x-data="{ showCancelModal: false }">
                                <button @click="showCancelModal = true"
                                        class="text-stone-500 hover:text-stone-300 transition-colors p-2 rounded-lg hover:bg-stone-800/50">
                                    <span class="sr-only">Cancel Order</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <!-- Cancel Order Confirmation Modal -->
                                <div x-show="showCancelModal"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                     class="fixed inset-0 z-[80] overflow-y-auto"
                                     @click.self="showCancelModal = false"
                                     @keydown.escape.window="showCancelModal = false">
                                    
                                    <!-- Modal Backdrop -->
                                    <div class="fixed inset-0 bg-stone-950/90 backdrop-blur-sm"></div>

                                    <!-- Modal Content -->
                                    <div class="relative min-h-screen flex items-center justify-center p-4">
                                        <div class="relative bg-gradient-to-b from-stone-900 to-stone-950 p-8 rounded-xl border border-stone-800 shadow-2xl max-w-md mx-auto">
                                            <!-- Decorative Elements -->
                                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-600 via-red-500 to-red-600"></div>

                                            <!-- Close Button -->
                                            <button @click="showCancelModal = false" 
                                                    class="absolute -top-4 -right-4 bg-stone-800 text-stone-200 rounded-full p-2 hover:bg-stone-700 transition-colors border border-stone-700 shadow-lg">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>

                                            <div class="text-center">
                                                <!-- Warning Icon -->
                                                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-900/30 border-2 border-red-500 mb-6">
                                                    <svg class="h-10 w-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                </div>

                                                <h3 class="text-2xl font-semibold text-stone-50 mb-4">Cancel Order</h3>
                                                <div class="space-y-4">
                                                    <p class="text-stone-300">Are you sure you want to cancel this order?</p>
                                                    <p class="text-red-400 text-sm">This action cannot be undone.</p>
                                                </div>

                                                <!-- Action Buttons -->
                                                <div class="mt-8 flex gap-4">
                                                    <button type="button"
                                                            @click="showCancelModal = false"
                                                            class="flex-1 px-4 py-3 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 transition-colors duration-200 font-medium border border-stone-700">
                                                        Keep Order
                                                    </button>
                                                    <a href="{{ route('user.order.cancel', $order->id) }}"
                                                       class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-stone-50 rounded-lg hover:from-red-500 hover:to-red-600 transition-all duration-200 font-medium shadow-lg transform hover:scale-[1.02] inline-flex items-center justify-center">
                                                        Cancel Order
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="space-y-4 mb-8">
                            @foreach ($orderItems as $orderItem)
                                <div class="flex justify-between items-start p-4 bg-stone-900/95 rounded-xl border border-stone-800 shadow-md backdrop-blur-sm hover:border-stone-700 transition-all duration-300">
                                    <div class="flex items-start gap-4">
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $orderItem->cartItem->card->image) }}" 
                                                 alt="{{ $orderItem->cartItem->card->card_name }}" 
                                                 class="w-20 h-20 object-cover rounded-lg border border-stone-700 group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-105">
                                            <div class="absolute inset-0 rounded-lg bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-stone-50">{{ $orderItem->cartItem->card->card_name }}</h4>
                                            <p class="text-sm text-stone-400">{{ $orderItem->cartItem->card->series }}</p>
                                            <p class="text-sm text-stone-400">Qty: {{ $orderItem->cartItem->quantity }}</p>
                                        </div>
                                    </div>
                                    <span class="font-medium text-stone-50">RM {{ number_format($orderItem->cartItem->price, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Total Section -->
                        <div class="space-y-4 pt-6 border-t border-stone-800">
                            <div class="flex justify-between items-center text-lg">
                                <span class="text-stone-400">Subtotal</span>
                                <span class="text-stone-50">RM {{ number_format($orderItems->sum('cartItem.price'), 2) }}</span>
                            </div>
                            
                            @if($availableCoupons->isNotEmpty())
                            <div class="py-4 border-y border-stone-800">
                                <h4 class="text-stone-300 mb-3">Available Coupons</h4>
                                <div class="space-y-3">
                                    @foreach($availableCoupons as $coupon)
                                    <div class="flex items-center justify-between p-3 bg-stone-900/50 rounded-lg border border-stone-800 hover:border-blue-500/50 transition-colors">
                                        <div>
                                            <p class="text-stone-200 font-medium">{{ $coupon->name }}</p>
                                            <p class="text-sm text-stone-400">{{ $coupon->description }}</p>
                                            <p class="text-xs text-stone-500 mt-1">Valid until: {{ Carbon\Carbon::parse($coupon->valid_until)->format('d M Y') }}</p>
                                        </div>
                                        <button type="button" 
                                                @click="$dispatch('apply-coupon', { id: {{ $coupon->id }} })"
                                                class="px-3 py-1.5 bg-blue-600/20 text-blue-400 rounded-lg text-sm hover:bg-blue-600/30 transition-colors">
                                            Apply
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="flex justify-between items-center text-lg pb-6 border-b border-stone-800">
                                <span class="text-stone-400">Discount</span>
                                <span class="text-green-500">- RM {{ number_format($order->discount, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xl font-semibold">
                                <span class="text-stone-50">Total</span>
                                <span class="text-stone-50">RM {{ number_format($order->total, 2) }}</span>
                                <input type="hidden" name="total" value="{{ $order->total }}">
                            </div>
                        </div>

                        <!-- Complete Order Button -->
                        <div class="mt-8">
                            <button type="submit" 
                                    x-data="{ isFileUploaded() { return $store.fileUpload.hasFile } }"
                                    :disabled="!isFileUploaded()"
                                    :class="{ 'opacity-50 cursor-not-allowed': !isFileUploaded() }"
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-stone-50 py-4 rounded-xl border border-blue-500 hover:from-blue-500 hover:to-blue-600 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-stone-900 font-semibold tracking-wide shadow-lg transform hover:scale-[1.02]">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Complete Order</span>
                                </div>
                            </button>
                            <p x-show="!isFileUploaded()" class="text-stone-400 text-sm mt-2 text-center">
                                Please upload proof of payment to complete your order
                            </p>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Confirmation Modal -->
            <div x-data="{ show: false }"
                 @open-modal.window="show = true"
                 @close-modal.window="show = false"
                 @keydown.escape.window="show = false">
                
                <!-- Modal Backdrop -->
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-stone-950/75 backdrop-blur-sm z-[90]"
                     @click="show = false">
                </div>

                <!-- Modal Content -->
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="fixed inset-0 z-[90] overflow-y-auto">
                    
                    <div class="flex min-h-full items-center justify-center p-4">
                        <div class="bg-gradient-to-b from-stone-900 to-stone-950 rounded-xl border border-stone-800 shadow-2xl p-8 w-full max-w-md transform transition-all relative overflow-hidden">
                            <!-- Decorative Elements -->
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600"></div>

                            <div class="text-center">
                                <!-- Icon -->
                                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-blue-900/30 border-2 border-blue-500 mb-6">
                                    <svg class="h-10 w-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>

                                <h3 class="text-2xl font-semibold text-stone-50 mb-4">Confirm Payment</h3>
                                <div class="space-y-6">
                                    <!-- Order Summary -->
                                    <div class="bg-stone-900/50 rounded-lg border border-stone-800/50 p-4">
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="text-stone-400">Subtotal</span>
                                                <span class="text-stone-200">RM {{ number_format($orderItems->sum('cartItem.price'), 2) }}</span>
                                            </div>
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="text-stone-400">Discount</span>
                                                <span class="text-green-500">- RM {{ number_format($order->discount, 2) }}</span>
                                            </div>
                                            <div class="pt-2 border-t border-stone-800">
                                                <div class="flex justify-between items-center font-medium">
                                                    <span class="text-stone-200">Total Amount</span>
                                                    <span class="text-stone-50 text-lg">RM {{ number_format($order->total, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Warning Message -->
                                    <div class="text-stone-400 text-sm">
                                        <p>Please confirm that you have made the payment.</p>
                                        <p class="text-stone-500 mt-1">This action cannot be undone.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-8 flex gap-4">
                                <button type="button"
                                        @click="show = false"
                                        class="flex-1 px-4 py-3 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 transition-colors duration-200 font-medium border border-stone-700">
                                    Cancel
                                </button>
                                <button type="button"
                                        @click="show = false; $dispatch('show-success'); setTimeout(() => { document.querySelector('#form-checkout').submit() }, 500);"
                                        class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-stone-50 rounded-lg hover:from-blue-500 hover:to-blue-600 transition-all duration-200 font-medium shadow-lg transform hover:scale-[1.02]">
                                    Confirm Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Modal -->
            <div x-data="{ showSuccess: false }"
                 @show-success.window="showSuccess = true; setTimeout(() => { window.location.href = '{{ route('user.order.index') }}' }, 3500)">
                
                <!-- Success Modal Backdrop -->
                <div x-show="showSuccess"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-stone-950/75 backdrop-blur-sm z-[100]">
                </div>

                <!-- Success Modal Content -->
                <div x-show="showSuccess"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="fixed inset-0 z-[100] overflow-y-auto">
                    
                    <div class="flex min-h-full items-center justify-center p-4">
                        <div class="bg-gradient-to-b from-stone-900 to-stone-950 rounded-xl border border-stone-800 shadow-2xl p-8 w-full max-w-sm transform transition-all relative overflow-hidden">
                            <!-- Decorative Elements -->
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-600 via-green-500 to-green-600"></div>

                            <div class="text-center">
                                <!-- Success Icon with Animation -->
                                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-900/30 border-2 border-green-500 mb-6 relative">
                                    <svg class="h-12 w-12 text-green-500 transform transition-all duration-500 ease-out" 
                                         fill="none" 
                                         stroke="currentColor" 
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" 
                                              stroke-linejoin="round" 
                                              stroke-width="2" 
                                              d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                </div>

                                <h3 class="text-2xl font-semibold text-stone-50 mb-4">Payment Completed!</h3>
                                <div class="space-y-3">
                                    <p class="text-stone-300">Your order has been successfully processed.</p>
                                    <p class="text-stone-400 text-sm">Redirecting to your orders page...</p>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mt-8 h-1 bg-stone-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-600 to-green-400 transition-all duration-[3000ms] ease-linear w-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('fileUpload', {
            hasFile: false
        });
    });

    function simpleFileUpload() {
        return {
            preview: null,
            fileError: null,
            
            handleFileSelect(event) {
                const file = event.target.files[0];
                this.validateAndProcessFile(file);
            },
            
            validateAndProcessFile(file) {
                this.fileError = null;
                Alpine.store('fileUpload').hasFile = false;
                
                if (!file) {
                    this.fileError = 'Please select a file';
                    return;
                }
                
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    this.fileError = 'Please upload an image file (PNG, JPG, or GIF)';
                    return;
                }
                
                // Validate file size (10MB = 10 * 1024 * 1024 bytes)
                if (file.size > 10 * 1024 * 1024) {
                    this.fileError = 'File size must be less than 10MB';
                    return;
                }
                
                // Create preview
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.preview = e.target.result;
                    Alpine.store('fileUpload').hasFile = true;
                };
                reader.readAsDataURL(file);
            },
            
            removeFile() {
                this.preview = null;
                this.fileError = null;
                document.getElementById('proof_of_payment').value = '';
                Alpine.store('fileUpload').hasFile = false;
            }
        }
    }

    // Add coupon handling
    document.addEventListener('alpine:init', () => {
        Alpine.data('checkoutData', () => ({
            isApplyingCoupon: false,

            init() {
                this.$watch('isApplyingCoupon', (value) => {
                    if (value) {
                        document.body.style.cursor = 'wait';
                    } else {
                        document.body.style.cursor = 'default';
                    }
                });

                this.$el.addEventListener('apply-coupon', async (event) => {
                    if (this.isApplyingCoupon) return;
                    
                    const couponId = event.detail.id;
                    this.isApplyingCoupon = true;

                    try {
                        const response = await fetch(`/user/order/${orderId}/apply-coupon/${couponId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            window.location.reload();
                        } else {
                            throw new Error(result.message || 'Failed to apply coupon');
                        }
                    } catch (error) {
                        console.error('Error applying coupon:', error);
                        alert(error.message || 'Failed to apply coupon. Please try again.');
                    } finally {
                        this.isApplyingCoupon = false;
                    }
                });
            }
        }));
    });
</script>