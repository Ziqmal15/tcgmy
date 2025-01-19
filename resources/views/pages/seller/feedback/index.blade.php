<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-b from-stone-900 to-stone-950 overflow-hidden shadow-xl rounded-xl border border-stone-800">
                <!-- Header -->
                <div class="p-6 border-b border-stone-800">
                    <h2 class="text-2xl font-semibold text-stone-50">Customer Feedback</h2>
                    <p class="mt-1 text-stone-400">View and analyze customer feedback to improve your service</p>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 border-b border-stone-800">
                    <div class="bg-stone-800/50 rounded-lg p-4">
                        <div class="text-stone-400 text-sm">Average Rating</div>
                        <div class="mt-2 flex items-center">
                            <span class="text-2xl font-bold text-amber-500">{{ number_format($averageRating, 1) }}</span>
                            <span class="ml-2 text-amber-500">★</span>
                        </div>
                    </div>
                    <div class="bg-stone-800/50 rounded-lg p-4">
                        <div class="text-stone-400 text-sm">Total Feedbacks</div>
                        <div class="mt-2 text-2xl font-bold text-stone-50">{{ $totalFeedbacks }}</div>
                    </div>
                    <div class="bg-stone-800/50 rounded-lg p-4">
                        <div class="text-stone-400 text-sm">5★ Ratings</div>
                        <div class="mt-2 text-2xl font-bold text-stone-50">{{ $fiveStarCount }}</div>
                    </div>
                </div>

                <!-- Feedback List -->
                <div class="p-6">
                    <div class="space-y-6">
                        @forelse($feedbacks as $feedback)
                            <div class="bg-stone-800/30 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-stone-700 flex items-center justify-center">
                                                <span class="text-stone-300">{{ strtoupper(substr($feedback->user->name, 0, 1)) }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-stone-200 font-medium">{{ $feedback->user->name }}</div>
                                            <div class="text-stone-400 text-sm">{{ $feedback->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="text-{{ $i <= $feedback->rating ? 'amber' : 'stone' }}-500">★</span>
                                        @endfor
                                    </div>
                                </div>
                                @if($feedback->comment)
                                    <div class="mt-4 text-stone-300">
                                        {{ $feedback->comment }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="text-stone-400">No feedback received yet</div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $feedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 