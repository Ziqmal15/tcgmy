<link rel="icon" type="image/x-icon" href="/img/logo2.png">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <!-- Stats Overview Section -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Total Sales Card -->
                <div class="bg-black border border-gray-800 rounded-lg shadow-lg p-6 hover:border-gray-700 transition duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-900">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-400">Total Sales</p>
                            <p class="text-2xl font-light text-white">RM {{ number_format($totalSales, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="bg-black border border-gray-800 rounded-lg shadow-lg p-6 hover:border-gray-700 transition duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-900">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-400">Total Orders</p>
                            <p class="text-2xl font-light text-white">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>

                <!-- Products Card -->
                <div class="bg-black border border-gray-800 rounded-lg shadow-lg p-6 hover:border-gray-700 transition duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-900">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-400">Total Products</p>
                            <p class="text-2xl font-light text-white">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customers Card -->
                <div class="bg-black border border-gray-800 rounded-lg shadow-lg p-6 hover:border-gray-700 transition duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-900">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-400">Customers</p>
                            <p class="text-2xl font-light text-white">{{ $totalCustomers }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart Section -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black border border-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-light text-white mb-6">{{ __("Monthly Sales Report") }}</h3>
                    <div class="bg-gray-900/50 p-6 rounded-lg border border-gray-800">
                        <canvas id="salesChart" class="w-full h-16"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Best Selling Products Section -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black border border-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-light text-white">{{ __("Best Selling Products") }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($bestSellingProducts as $product)
                            <div class="bg-gray-900/30 border border-gray-800 rounded-lg p-4 hover:border-gray-700 transition duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-light text-white">{{ $product->card_name }}</h4>
                                        <p class="text-sm text-gray-400">RM {{ number_format($product->price, 2) }}</p>
                                        <p class="text-xs text-gray-500 mt-2">{{ __('Total Sales: ') . $product->total_sales }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="border border-gray-700 text-white text-xs px-2 py-1 rounded-full">
                                            {{ $product->stock > 0 ? __('In Stock') : __('Out of Stock') }}
                                        </span>
                                        <p class="text-sm text-gray-400 mt-2">{{ $product->stock }} {{ __('units') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Print Report Section -->
    <div class="py-6" x-data="{ showPreview: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black border border-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-light text-white">{{ __("Generate Report") }}</h3>
                        <div class="flex space-x-4">
                            <button @click="showPreview = !showPreview" class="px-4 py-2 bg-gray-900 text-white rounded-lg border border-gray-700 hover:bg-gray-800 transition duration-300">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span x-text="showPreview ? '{{ __("Hide Preview") }}' : '{{ __("Preview Report") }}'"></span>
                                </div>
                            </button>
                            <button id="print-button" @click="printReport()" class="px-4 py-2 bg-gray-900 text-white rounded-lg border border-gray-700 hover:bg-gray-800 transition duration-300">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                    </svg>
                                    {{ __("Print Report") }}
                                </div>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Preview Panel -->
                    <div x-show="showPreview" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="mt-6 bg-gray-900/30 p-6 rounded-lg border border-gray-700">
                        <div class="print-preview">
                            <div class="mb-6 border-b border-gray-700 pb-4">
                                <h1 class="text-2xl font-bold text-white mb-4">System Sales Report</h1>
                                <p class="text-gray-400">Generated on: <span x-text="new Date().toLocaleString()"></span></p>
                            </div>
                            <div class="mb-6 border-b border-gray-700 pb-4">
                                <h2 class="text-xl font-semibold text-white mb-3">Overview</h2>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-gray-400">Total Sales: <span class="text-white">RM {{ number_format($totalSales, 2) }}</span></p>
                                        <p class="text-gray-400">Total Orders: <span class="text-white">{{ $totalOrders }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-400">Total Products: <span class="text-white">{{ $totalProducts }}</span></p>
                                        <p class="text-gray-400">Total Customers: <span class="text-white">{{ $totalCustomers }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-white mb-3">Best Selling Products</h2>
                                <div class="overflow-x-auto">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="bg-gray-800">
                                                <th class="px-4 py-2 text-left text-gray-400">Product Name</th>
                                                <th class="px-4 py-2 text-left text-gray-400">Price</th>
                                                <th class="px-4 py-2 text-left text-gray-400">Total Sales</th>
                                                <th class="px-4 py-2 text-left text-gray-400">Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bestSellingProducts as $product)
                                            <tr class="border-t border-gray-700">
                                                <td class="px-4 py-2 text-white">{{ $product->card_name }}</td>
                                                <td class="px-4 py-2 text-white">RM {{ number_format($product->price, 2) }}</td>
                                                <td class="px-4 py-2 text-white">{{ $product->total_sales }}</td>
                                                <td class="px-4 py-2 text-white">{{ $product->stock }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print-only content -->
    <div id="printable-content" class="hidden">
        <div class="print-header">
            <h1 class="text-2xl font-bold mb-4">Seller Dashboard Report</h1>
            <p class="mb-2">Generated on: <span id="report-date"></span></p>
        </div>
        <div class="print-stats">
            <h2 class="text-xl font-semibold mb-3">Overview</h2>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p>Total Sales: RM {{ number_format($totalSales, 2) }}</p>
                    <p>Total Orders: {{ $totalOrders }}</p>
                </div>
                <div>
                    <p>Total Products: {{ $totalProducts }}</p>
                    <p>Total Customers: {{ $totalCustomers }}</p>
                </div>
            </div>
        </div>
        <div class="print-products">
            <h2 class="text-xl font-semibold mb-3">Best Selling Products</h2>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left">Product Name</th>
                        <th class="text-left">Price</th>
                        <th class="text-left">Total Sales</th>
                        <th class="text-left">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bestSellingProducts as $product)
                    <tr>
                        <td>{{ $product->card_name }}</td>
                        <td>RM {{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->total_sales }}</td>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Customer System Feedback Section -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black border border-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-light text-white">{{ __("Customer System Feedback") }}</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-800">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-900/50 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __("Customer Name") }}</th>
                                    <th class="px-6 py-3 bg-gray-900/50 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __("Rating") }}</th>
                                    <th class="px-6 py-3 bg-gray-900/50 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __("Comment") }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-black divide-y divide-gray-800">
                                @forelse($feedbacks as $feedback)
                                    <tr class="hover:bg-gray-900/30 transition duration-300">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $feedback->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $feedback->rating }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-400">{{ $feedback->comment }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-400">{{ __("No feedback available") }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function printReport() {
        // Update the report date
        const now = new Date();
        document.getElementById('report-date').textContent = now.toLocaleString();
        
        // Get the printable content
        const printContent = document.getElementById('printable-content');
        
        // Make it visible temporarily
        printContent.classList.remove('hidden');
        
        // Print
        window.print();
        
        // Hide it again after printing
        setTimeout(() => {
            printContent.classList.add('hidden');
        }, 100);
    }
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthLabels) !!},
            datasets: [{
                label: 'Monthly Sales (RM)',
                data: {!! json_encode($monthlySales) !!},
                borderColor: 'rgb(255, 255, 255)',
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.5)'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.5)'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-content,
        #printable-content * {
            visibility: visible;
        }
        #printable-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
        }
        .print-header {
            margin-bottom: 30px;
        }
        .print-stats {
            margin-bottom: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .print-preview {
            display: none;
        }
    }
</style>

<script>
    function printReport() {
        // Update the report date
        const now = new Date();
        document.getElementById('report-date').textContent = now.toLocaleString();
        
        // Get the printable content
        const printContent = document.getElementById('printable-content');
        
        // Make it visible temporarily
        printContent.classList.remove('hidden');
        
        // Print
        window.print();
        
        // Hide it again after printing
        setTimeout(() => {
            printContent.classList.add('hidden');
        }, 100);
    }
</script>
