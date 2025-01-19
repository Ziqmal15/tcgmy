<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-stone-50 leading-tight tracking-wide">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen bg-gradient-to-br from-stone-950 to-stone-900" x-data="{ tab: 'profile' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Side Navigation -->
                <div class="w-full md:w-72 shrink-0">
                    <div class="bg-stone-900/80 backdrop-blur-lg rounded-2xl border border-stone-800/50 shadow-lg overflow-hidden">
                        <nav class="flex flex-col p-2">
                            <button @click="tab = 'profile'" 
                                    :class="{ 'bg-stone-800/80 text-stone-50 border-stone-400 shadow-md scale-[0.98]': tab === 'profile', 'border-transparent hover:bg-stone-800/30': tab !== 'profile' }"
                                    class="w-full flex items-center px-4 py-3 text-stone-300 border-l-4 rounded-xl transition-all duration-300 transform">
                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="font-medium">Profile</span>
                            </button>

                            <button @click="tab = 'orders'" 
                                    :class="{ 'bg-stone-800/80 text-stone-50 border-stone-400 shadow-md scale-[0.98]': tab === 'orders', 'border-transparent hover:bg-stone-800/30': tab !== 'orders' }"
                                    class="w-full flex items-center px-4 py-3 text-stone-300 border-l-4 rounded-xl mt-2 transition-all duration-300 transform">
                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span class="font-medium">Orders</span>
                            </button>

                            <button @click="tab = 'Profile Settings'" 
                                    :class="{ 'bg-stone-800/80 text-stone-50 border-stone-400 shadow-md scale-[0.98]': tab === 'Profile Settings', 'border-transparent hover:bg-stone-800/30': tab !== 'Profile Settings' }"
                                    class="w-full flex items-center px-4 py-3 text-stone-300 border-l-4 rounded-xl mt-2 transition-all duration-300 transform">
                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="font-medium">Profile Settings</span>
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="flex-1">
                    <!-- Profile Section -->
                    <div x-show="tab === 'profile'" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                        <section class="bg-stone-900/80 backdrop-blur-lg rounded-2xl border border-stone-800/50 shadow-lg p-8">
                            <header class="flex items-center justify-between mb-8">
                                <h2 class="text-2xl font-semibold text-stone-50 tracking-wide flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ __('Profile Information') }}
                                </h2>
                            </header>
                        
                            <div class="grid gap-6">
                                <!-- Profile Fields -->
                                <div class="flex items-center gap-6 p-6 bg-stone-950/50 rounded-xl border border-stone-800/50 shadow-inner backdrop-blur-sm hover:border-stone-700/50 transition-all duration-300">
                                    <div class="w-1/3">
                                        <x-input-label for="name" :value="__('Name')" class="text-stone-400 text-sm uppercase tracking-wider" />
                                    </div>
                                    <div class="w-2/3">
                                        <p class="text-stone-50 font-medium">{{ $user->name }}</p>
                                    </div>
                                </div>
                        
                                <div class="flex items-center gap-6 p-6 bg-stone-950/50 rounded-xl border border-stone-800/50 shadow-inner backdrop-blur-sm hover:border-stone-700/50 transition-all duration-300">
                                    <div class="w-1/3">
                                        <x-input-label for="email" :value="__('Email')" class="text-stone-400 text-sm uppercase tracking-wider" />
                                    </div>
                                    <div class="w-2/3">
                                        <p class="text-stone-50 font-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                        
                                <div class="flex items-center gap-6 p-6 bg-stone-950/50 rounded-xl border border-stone-800/50 shadow-inner backdrop-blur-sm hover:border-stone-700/50 transition-all duration-300">
                                    <div class="w-1/3">
                                        <x-input-label for="address" :value="__('Address')" class="text-stone-400 text-sm uppercase tracking-wider" />
                                    </div>
                                    <div class="w-2/3">
                                        <p class="text-stone-50 font-medium">{{ $profile->address ?? 'Not set' }}</p>
                                    </div>
                                </div>
                        
                                <div class="flex items-center gap-6 p-6 bg-stone-950/50 rounded-xl border border-stone-800/50 shadow-inner backdrop-blur-sm hover:border-stone-700/50 transition-all duration-300">
                                    <div class="w-1/3">
                                        <x-input-label for="phone" :value="__('Phone Number')" class="text-stone-400 text-sm uppercase tracking-wider" />
                                    </div>
                                    <div class="w-2/3">
                                        <p class="text-stone-50 font-medium">{{ $profile->phone ?? 'Not set' }}</p>
                                    </div>
                                </div>
                        
                                <div class="flex items-center gap-6 p-6 bg-stone-950/50 rounded-xl border border-stone-800/50 shadow-inner backdrop-blur-sm hover:border-stone-700/50 transition-all duration-300">
                                    <div class="w-1/3">
                                        <x-input-label for="birthday" :value="__('Birth Date')" class="text-stone-400 text-sm uppercase tracking-wider" />
                                    </div>
                                    <div class="w-2/3">
                                        <p class="text-stone-50 font-medium">{{ $profile->birthday ?? 'Not set' }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Orders Section -->
                    <div x-show="tab === 'orders'" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                        <section class="bg-stone-900/80 backdrop-blur-lg rounded-2xl border border-stone-800/50 shadow-lg p-8">
                            <header class="flex items-center justify-between mb-8">
                                <h2 class="text-2xl font-semibold text-stone-50 tracking-wide flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    {{ __('My Orders') }}
                                </h2>
                            </header>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider border-b border-stone-800">
                                                Order ID
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider border-b border-stone-800">
                                                Date
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider border-b border-stone-800">
                                                Total
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider border-b border-stone-800">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-stone-800">
                                        @forelse ($orders as $order)
                                            <tr class="hover:bg-stone-800/30 transition-colors duration-200 cursor-pointer group" onclick="window.location.href='{{ route('user.order.show', $order) }}'">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-stone-300 group-hover:text-stone-50">#{{ $order->id }}</div>
                                                </td>
                                                
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-stone-300 group-hover:text-stone-50">{{ $order->created_at->format('d M Y') }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-stone-300 group-hover:text-stone-50">
                                                        RM {{ number_format($order->total, 2) }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($order->status === 'completed') 
                                                            bg-green-900/30 text-green-300 border border-green-700/50
                                                        @elseif($order->status === 'pending')
                                                            bg-yellow-900/30 text-yellow-300 border border-yellow-700/50
                                                        @elseif($order->status === 'cancelled')
                                                            bg-red-900/30 text-red-300 border border-red-700/50
                                                        @else
                                                            bg-stone-800/30 text-stone-300 border border-stone-700/50
                                                        @endif">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-8 whitespace-nowrap text-center">
                                                    <div class="flex flex-col items-center justify-center text-stone-400">
                                                        <svg class="w-12 h-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                        </svg>
                                                        <span class="text-sm">No orders found</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>

                    <!-- Settings Section -->
                    <div x-show="tab === 'Profile Settings'" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                        <section class="bg-stone-900/80 backdrop-blur-lg rounded-2xl border border-stone-800/50 shadow-lg p-8">
                            <header class="flex items-center justify-between mb-8">
                                <h2 class="text-2xl font-semibold text-stone-50 tracking-wide flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ __('Profile Settings') }}
                                </h2>
                            </header>

                            <!-- settings content -->
                            <div class="max-w-7xl mx-auto space-y-6" x-data="{ activeSettings: null }">
                                <div class="p-6 bg-stone-950/50 rounded-xl border border-stone-800/50 shadow-inner backdrop-blur-sm">
                                    <div class="max-w-xl">
                                        <div @click="activeSettings = (activeSettings === 'profile') ? null : 'profile'" 
                                             class="w-full flex items-center justify-between p-4 text-stone-300 hover:bg-stone-800/30 transition-all duration-200 rounded-lg cursor-pointer">
                                            <span class="flex items-center">
                                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="font-medium">Profile Information</span>
                                            </span>
                                            <svg class="w-5 h-5 transform transition-transform duration-200" :class="{ 'rotate-180': activeSettings === 'profile' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                        <div x-show="activeSettings === 'profile'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-4 p-4 bg-stone-900/50 rounded-lg">
                                            @include('profile.partials.update-profile-information-form')
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 bg-stone-950/50 rounded-xl border border-stone-800/50 shadow-inner backdrop-blur-sm">
                                    <div class="max-w-xl">
                                        <div @click="activeSettings = (activeSettings === 'password') ? null : 'password'" 
                                             class="w-full flex items-center justify-between p-4 text-stone-300 hover:bg-stone-800/30 transition-all duration-200 rounded-lg cursor-pointer">
                                            <span class="flex items-center">
                                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                <span class="font-medium">Update Password</span>
                                            </span>
                                            <svg class="w-5 h-5 transform transition-transform duration-200" :class="{ 'rotate-180': activeSettings === 'password' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                        <div x-show="activeSettings === 'password'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-4 p-4 bg-stone-900/50 rounded-lg">
                                            @include('profile.partials.update-password-form')
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="p-6 bg-stone-950/50 rounded-xl border border-stone-800/50 shadow-inner backdrop-blur-sm">
                                    <div class="max-w-xl">
                                        <div @click="activeSettings = (activeSettings === 'delete') ? null : 'delete'" 
                                             class="w-full flex items-center justify-between p-4 text-stone-300 hover:bg-stone-800/30 transition-all duration-200 rounded-lg cursor-pointer">
                                            <span class="flex items-center">
                                                <svg class="mr-3 h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span class="font-medium text-red-400">Delete Account</span>
                                            </span>
                                            <svg class="w-5 h-5 transform transition-transform duration-200" :class="{ 'rotate-180': activeSettings === 'delete' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                        <div x-show="activeSettings === 'delete'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-4 p-4 bg-stone-900/50 rounded-lg">
                                            @include('profile.partials.delete-user-form')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</x-app-layout>
