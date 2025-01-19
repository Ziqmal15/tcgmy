<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-50 leading-tight tracking-wide">
            {{ __('Vouchers / Discounts') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg p-8 border border-stone-800 backdrop-blur-sm">
                <div class="w-full flex flex-row justify-between items-center mb-8">
                    <h3 class="text-2xl font-semibold text-stone-50 tracking-wide">Manage Coupons</h3>
                    <button type="button" 
                            class="bg-gradient-to-r from-stone-800 to-stone-900 text-stone-50 px-6 py-3 rounded-lg border border-stone-700 hover:from-stone-700 hover:to-stone-800 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-stone-600 focus:ring-offset-2 focus:ring-offset-stone-900 font-semibold tracking-wide shadow-md"
                            onclick="location.href='{{ route('seller.coupons.create') }}'">
                        <i class="fas fa-plus-circle me-2"></i>{{ __('Create New Coupon') }}
                    </button>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-stone-300">
                        <thead class="text-xs uppercase bg-stone-800 text-stone-300 border-b border-stone-700">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-center">Code</th>
                                <th scope="col" class="px-6 py-4 text-center">Type</th>
                                <th scope="col" class="px-6 py-4 text-center">Discount</th>
                                <th scope="col" class="px-6 py-4 text-center">Min. Spend</th>
                                <th scope="col" class="px-6 py-4 text-center">Valid From</th>
                                <th scope="col" class="px-6 py-4 text-center">Valid Until</th>
                                <th scope="col" class="px-6 py-4 text-center">Status</th>
                                <th scope="col" class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                            <tr class="border-b border-stone-800 bg-stone-900/50 hover:bg-stone-800/50 transition-colors">
                                <td class="px-6 py-4 text-center font-medium">{{ $coupon->code }}</td>
                                <td class="px-6 py-4 text-center">{{ ucfirst($coupon->type) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $coupon->discount_type === 'percentage' ? 'bg-amber-900/50 text-amber-200 border border-amber-700' : 'bg-emerald-900/50 text-emerald-200 border border-emerald-700' }}">
                                        @if($coupon->discount_type === 'percentage')
                                            {{ $coupon->discount_amount }}%
                                        @else
                                            RM{{ number_format($coupon->discount_amount, 2) }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">RM{{ number_format($coupon->min_spend, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ $coupon->valid_from->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-center">{{ $coupon->valid_until ? $coupon->valid_until->format('d M Y') : 'No Expiry' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($coupon->is_active)
                                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-emerald-900/50 text-emerald-200 border border-emerald-700">Active</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-red-900/50 text-red-200 border border-red-700">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        {{-- TODO: Add assign coupon feature --}}
                                        {{-- <a href="{{ route('seller.coupons.assign.form', $coupon->id) }}" 
                                           class="px-3 py-1.5 bg-amber-900/80 text-amber-100 rounded hover:bg-amber-800 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-amber-700 focus:ring-offset-2 focus:ring-offset-stone-900">
                                            <i class="fas fa-user-plus">Assign</i>
                                        </a> --}}
                                        <a href="{{ route('seller.coupons.edit', $coupon->id) }}" 
                                           class="px-3 py-1.5 bg-stone-800 text-stone-300 rounded hover:bg-stone-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-stone-600 focus:ring-offset-2 focus:ring-offset-stone-900">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                        <form action="{{ route('seller.coupons.destroy', $coupon->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-1.5 bg-red-900/80 text-red-100 rounded hover:bg-red-800 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2 focus:ring-offset-stone-900"
                                                    onclick="return confirm('Warning: This action cannot be undone. Are you sure you want to delete this coupon?')">
                                                <i class="fas fa-trash">Remove</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#couponsTable').DataTable({
                order: [[4, 'desc']],
                pageLength: 10,
                language: {
                    search: "",
                    searchPlaceholder: "Search coupons..."
                },
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                initComplete: function() {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
