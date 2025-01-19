<link rel="icon" type="image/x-icon" href="/img/logo2.png">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-50 leading-tight">
            {{ __('Edit Card Details') }}
        </h2>
    </x-slot>

    <div class="py-12 h-full bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg p-8 border border-stone-800 backdrop-blur-sm">
                <h2 class="text-2xl font-semibold mb-8 text-stone-50 tracking-wide">Edit Stocks</h2>
                <form action="{{ route('seller.catalogue.update', $card) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center space-y-6 mb-6">
                        <!-- Current Image Preview -->
                        <div class="w-full max-w-md">
                            <label class="block text-sm font-medium text-stone-300 mb-2">Current Image</label>
                            <img src="{{ asset('storage/' . $card->image) }}" 
                                 alt="{{ $card->card_name }}" 
                                 class="w-full h-48 object-contain rounded-lg border border-stone-700 bg-stone-800">
                        </div>

                        <!-- New Image Upload -->
                        <div class="w-full max-w-md">
                            <label class="block text-sm font-medium text-stone-50 mb-3 tracking-wide">Upload New Image</label>
                            <div x-data="fileUpload()"
                                 x-on:dragover.prevent="$refs.dnd.classList.add('border-stone-500'); isDragging = true"
                                 x-on:dragleave.prevent="$refs.dnd.classList.remove('border-stone-500'); isDragging = false"
                                 x-on:drop.prevent="handleDrop($event)"
                                 class="mt-1">
                                <div x-ref="dnd"
                                     class="flex justify-center px-6 pt-5 pb-6 border-2 border-stone-800 border-dashed rounded-lg transition-all duration-300 bg-stone-900/80"
                                     :class="{'border-stone-500 bg-stone-800/80': isDragging}">
                                    <div class="space-y-2 text-center">
                                        <template x-if="!preview">
                                            <svg class="mx-auto h-12 w-12 text-stone-600" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </template>
                                        <template x-if="preview">
                                            <div class="relative w-24 h-24 mx-auto">
                                                <img :src="preview" class="rounded-lg object-cover w-full h-full">
                                                <button @click.prevent="removeFile" class="absolute -top-2 -right-2 bg-stone-800 rounded-full p-1 hover:bg-stone-700 transition-colors">
                                                    <svg class="w-4 h-4 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <div class="flex text-sm text-stone-300 justify-center">
                                            <label class="relative cursor-pointer rounded-md font-medium text-stone-50 hover:text-stone-200 focus-within:outline-none">
                                                <span class="underline">Upload a file</span>
                                                <input type="file" 
                                                       name="image" 
                                                       id="image" 
                                                       class="sr-only"
                                                       accept="image/*"
                                                       @change="handleFileSelect">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <div class="text-xs text-stone-500">
                                            <p>PNG, JPG, GIF up to 2MB</p>
                                            <p x-show="fileError" x-text="fileError" class="text-red-500 mt-2"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="card_name" class="block text-sm font-medium text-stone-300">Card Name</label>
                        <input type="text" name="card_name" id="card_name" value="{{ old('card_name', $card->card_name) }}" 
                               class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-stone-300">Description</label>
                        <textarea name="description" id="description" rows="3" 
                                  class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description', $card->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-stone-300">Price (RM)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $card->price) }}"
                                   class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-medium text-stone-300">Stock</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $card->stock) }}"
                                   class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="rarity" class="block text-sm font-medium text-stone-300">Rarity</label>
                            <select name="rarity" id="rarity" required
                                    class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <option value="common" {{ old('rarity', $card->rarity) == 'common' ? 'selected' : '' }}>Common</option>
                                <option value="uncommon" {{ old('rarity', $card->rarity) == 'uncommon' ? 'selected' : '' }}>Uncommon</option>
                                <option value="rare" {{ old('rarity', $card->rarity) == 'rare' ? 'selected' : '' }}>Rare</option>
                                <option value="super rare" {{ old('rarity', $card->rarity) == 'super rare' ? 'selected' : '' }}>Super Rare</option>
                                <option value="alternate art" {{ old('rarity', $card->rarity) == 'alternate art' ? 'selected' : '' }}>Alternate Art</option>
                                <option value="full art" {{ old('rarity', $card->rarity) == 'full art' ? 'selected' : '' }}>Full Art</option>
                            </select>
                        </div>

                        <div>
                            <label for="set_code" class="block text-sm font-medium text-stone-300">Set Code</label>
                            <select name="set_code" id="set_code" required
                                    class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <optgroup label="One Piece">
                                    <option value="OP01" {{ old('set_code', $card->set_code) == 'OP01' ? 'selected' : '' }}>OP01</option>
                                    <option value="OP02" {{ old('set_code', $card->set_code) == 'OP02' ? 'selected' : '' }}>OP02</option>
                                    <option value="OP03" {{ old('set_code', $card->set_code) == 'OP03' ? 'selected' : '' }}>OP03</option>
                                    <option value="OP04" {{ old('set_code', $card->set_code) == 'OP04' ? 'selected' : '' }}>OP04</option>
                                    <option value="OP05" {{ old('set_code', $card->set_code) == 'OP05' ? 'selected' : '' }}>OP05</option>
                                </optgroup>
                                <optgroup label="Dragon Ball">
                                    <option value="DB01" {{ old('set_code', $card->set_code) == 'DB01' ? 'selected' : '' }}>DB01</option>
                                    <option value="DB02" {{ old('set_code', $card->set_code) == 'DB02' ? 'selected' : '' }}>DB02</option>
                                    <option value="DB03" {{ old('set_code', $card->set_code) == 'DB03' ? 'selected' : '' }}>DB03</option>
                                    <option value="DB04" {{ old('set_code', $card->set_code) == 'DB04' ? 'selected' : '' }}>DB04</option>
                                </optgroup>
                                <optgroup label="Pokemon">
                                    <option value="P01" {{ old('set_code', $card->set_code) == 'P01' ? 'selected' : '' }}>P01</option>
                                    <option value="P02" {{ old('set_code', $card->set_code) == 'P02' ? 'selected' : '' }}>P02</option>
                                    <option value="P03" {{ old('set_code', $card->set_code) == 'P03' ? 'selected' : '' }}>P03</option>
                                    <option value="P04" {{ old('set_code', $card->set_code) == 'P04' ? 'selected' : '' }}>P04</option>
                                </optgroup>
                            </select>
                        </div>

                        <div>
                            <label for="series" class="block text-sm font-medium text-stone-300">Series</label>
                            <select name="series" id="series" required
                                    class="mt-1 block w-full rounded-md border-stone-700 bg-stone-800 text-stone-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <option value="One Piece" {{ old('series', $card->series) == 'One Piece' ? 'selected' : '' }}>One Piece</option>
                                <option value="Dragon Ball" {{ old('series', $card->series) == 'Dragon Ball' ? 'selected' : '' }}>Dragon Ball</option>
                                <option value="Pokemon" {{ old('series', $card->series) == 'Pokemon' ? 'selected' : '' }}>Pokemon</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('seller.catalogue.index', $card->id) }}" 
                           class="bg-stone-700 text-stone-50 px-6 py-2 rounded-lg border border-stone-600 hover:bg-stone-600 transition-all duration-300">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="bg-gradient-to-r from-amber-700 to-amber-900 text-stone-50 px-6 py-2 rounded-lg border border-amber-700 hover:from-amber-600 hover:to-amber-800 transition-all duration-300">
                            Update Stocks
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div>
        <script>
            function fileUpload() {
                return {
                    isDragging: false,
                    preview: null,
                    fileError: null,
                    
                    handleDrop(event) {
                        this.isDragging = false;
                        this.$refs.dnd.classList.remove('border-stone-500');
                        
                        const file = event.dataTransfer.files[0];
                        this.validateAndProcessFile(file);
                    },
                    
                    handleFileSelect(event) {
                        const file = event.target.files[0];
                        this.validateAndProcessFile(file);
                    },
                    
                    validateAndProcessFile(file) {
                        this.fileError = null;
                        
                        // Validate file type
                        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!validTypes.includes(file.type)) {
                            this.fileError = 'Please upload an image file (PNG, JPG, or GIF)';
                            return;
                        }
                        
                        // Validate file size (2MB = 2 * 1024 * 1024 bytes)
                        if (file.size > 2 * 1024 * 1024) {
                            this.fileError = 'File size must be less than 2MB';
                            return;
                        }
                        
                        // Create preview
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.preview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    },
                    
                    removeFile() {
                        this.preview = null;
                        this.fileError = null;
                        document.getElementById('image').value = '';
                    }
                }
            }
        </script>
    </div>
</x-app-layout>