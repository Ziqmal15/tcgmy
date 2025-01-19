<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-stone-50 leading-tight">
                {{ isset($coupon) ? __('Edit Coupon') : __('Create New Coupon') }}
            </h2>
            <a href="{{ route('seller.coupons.index') }}" class="bg-stone-700 text-stone-50 px-4 py-2 rounded-lg border border-stone-600 hover:bg-stone-600 transition-all duration-300">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12 h-full bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg p-8 border border-stone-800 backdrop-blur-sm">
                <h2 class="text-2xl font-semibold mb-8 text-stone-50 tracking-wide">{{ isset($coupon) ? 'Edit Coupon' : 'Create New Coupon' }}</h2>
                <form action="{{ isset($coupon) ? route('seller.coupons.update', $coupon->id) : route('seller.coupons.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if(isset($coupon))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="code" class="block text-sm font-medium text-stone-300">Coupon Code</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('code') is-invalid @enderror" 
                                id="code" name="code" value="{{ old('code', $coupon->code ?? '') }}" required>
                            @error('code')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-stone-300">Type</label>
                            <select class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('type') is-invalid @enderror" 
                                id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="product" {{ (old('type', $coupon->type ?? '') == 'product') ? 'selected' : '' }}>Product</option>
                                <option value="shipping" {{ (old('type', $coupon->type ?? '') == 'shipping') ? 'selected' : '' }}>Shipping</option>
                            </select>
                            @error('type')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="discount_type" class="block text-sm font-medium text-stone-300">Discount Type</label>
                            <select class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('discount_type') is-invalid @enderror" 
                                id="discount_type" name="discount_type" required>
                                <option value="fixed" {{ (old('discount_type', $coupon->discount_type ?? '') == 'fixed') ? 'selected' : '' }}>Fixed Amount (RM)</option>
                                <option value="percentage" {{ (old('discount_type', $coupon->discount_type ?? '') == 'percentage') ? 'selected' : '' }}>Percentage (%)</option>
                            </select>
                            @error('discount_type')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="discount_amount" class="block text-sm font-medium text-stone-300">Discount Amount</label>
                            <input type="number" step="0.01" class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('discount_amount') is-invalid @enderror" 
                                id="discount_amount" name="discount_amount" value="{{ old('discount_amount', $coupon->discount_amount ?? '') }}" required>
                            @error('discount_amount')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="min_spend" class="block text-sm font-medium text-stone-300">Minimum Spend (RM)</label>
                            <input type="number" step="0.01" class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('min_spend') is-invalid @enderror" 
                                id="min_spend" name="min_spend" value="{{ old('min_spend', $coupon->min_spend ?? '') }}" required>
                            @error('min_spend')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="auto_assign_threshold" class="block text-sm font-medium text-stone-300">Auto-Assign Threshold (RM)</label>
                            <input type="number" step="0.01" class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('auto_assign_threshold') is-invalid @enderror" 
                                id="auto_assign_threshold" name="auto_assign_threshold" value="{{ old('auto_assign_threshold', $coupon->auto_assign_threshold ?? '') }}">
                            <small class="text-stone-500">Leave empty to disable auto-assignment. When set, coupon will be automatically assigned to users who complete orders above this amount.</small>
                            @error('auto_assign_threshold')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="valid_from" class="block text-sm font-medium text-stone-300">Valid From</label>
                            <input type="datetime-local" class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('valid_from') is-invalid @enderror" 
                                id="valid_from" name="valid_from" 
                                value="{{ old('valid_from', isset($coupon) ? $coupon->valid_from->format('Y-m-d\TH:i') : '') }}" required>
                            @error('valid_from')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="valid_until" class="block text-sm font-medium text-stone-300">Valid Until</label>
                            <input type="datetime-local" class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('valid_until') is-invalid @enderror" 
                                id="valid_until" name="valid_until" 
                                value="{{ old('valid_until', isset($coupon) ? ($coupon->valid_until ? $coupon->valid_until->format('d M Y') : '') : '') }}">
                            <small class="text-stone-500">Leave empty for no expiry</small>
                            @error('valid_until')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="description" class="block text-sm font-medium text-stone-300">Description</label>
                            <textarea class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="3">{{ old('description', $coupon->description ?? '') }}</textarea>
                            @error('description')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded border-stone-700 bg-stone-800 text-amber-600 shadow-sm focus:border-amber-500 focus:ring-amber-500" 
                                    id="is_active" name="is_active" value="1" {{ old('is_active', $coupon->is_active ?? true) ? 'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-stone-300" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-900/50 border border-red-700 text-red-200 px-4 py-3 rounded-lg" role="alert">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('seller.coupons.index') }}" 
                           class="bg-stone-700 text-stone-50 px-6 py-2 rounded-lg border border-stone-600 hover:bg-stone-600 transition-all duration-300">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="bg-gradient-to-r from-amber-700 to-amber-900 text-stone-50 px-6 py-2 rounded-lg border border-amber-700 hover:from-amber-600 hover:to-amber-800 transition-all duration-300">
                            {{ isset($coupon) ? 'Update Coupon' : 'Create Coupon' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Update discount amount label based on discount type
            $('#discount_type').change(function() {
                const label = $(this).val() === 'percentage' ? 'Discount Percentage (%)' : 'Discount Amount (RM)';
                $('label[for="discount_amount"]').text(label);
            });
        });
    </script>
    @endpush
</x-app-layout>
