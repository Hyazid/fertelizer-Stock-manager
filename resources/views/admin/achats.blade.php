<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-black bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 rounded shadow">
                <i class="fas fa-shopping-cart mr-2"></i> Gestion des Achats
            </h2>
            <!-- CSS-only toggle button -->
            <label for="toggle-form" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-black font-semibold px-4 py-2 rounded-lg shadow-lg transition transform hover:scale-105 cursor-pointer">
                <i class="fas fa-plus mr-1"></i> Ajouter un achat
            </label>
        </div>
    </x-slot>

    <style>
        /* CSS-only toggle functionality */
        #toggle-form {
            display: none;
        }
        
        #add-form-container {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        #toggle-form:checked + #add-form-container {
            max-height: 1000px;
            transition: max-height 0.3s ease-in;
        }
        
        .form-toggle-label {
            display: inline-block;
            transition: transform 0.3s ease;
        }
        
        #toggle-form:checked + #add-form-container .form-toggle-label {
            transform: rotate(45deg);
        }
    </style>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Hidden checkbox for CSS toggle -->
            <input type="checkbox" id="toggle-form" class="sr-only">
            
            <!-- Add Purchase Form (toggleable) -->
            <div id="add-form-container">
                <div class="bg-white shadow-xl rounded-lg p-6 border-l-4 border-green-500">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2"></i>
                            Ajouter un nouvel achat
                        </h3>
                        <label for="toggle-form" class="form-toggle-label text-gray-500 hover:text-gray-700 cursor-pointer text-2xl">
                            <i class="fas fa-times"></i>
                        </label>
                    </div>
                    
                    <form method="POST" action="{{ route('achats.store') }}" class="space-y-4">
                        @csrf
                        
                        <!-- Product Selection -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-box mr-1"></i> Produit
                            </label>
                            <select name="product_id" id="product_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">-- Choisir un produit --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->nom }} ({{ $product->type }}) - {{ number_format($product->prix_unitaire, 2) }} DA
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Product Details Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="type_produit" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-1"></i> Type de produit
                                </label>
                                <input type="text" name="type" id="type_produit" value="{{ old('type') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                @error('type')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="quantite" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-sort-numeric-up mr-1"></i> Quantité
                                </label>
                                <input type="number" name="quantite" id="quantite" value="{{ old('quantite') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required min="0">
                                @error('quantite')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Price Details Row -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="prix_achat" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-money-bill-wave mr-1"></i> Prix d'achat (DA)
                                </label>
                                <input type="number" step="0.01" name="prix_achat" id="prix_achat" value="{{ old('prix_achat') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                @error('prix_achat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="prix_unitaire" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-coins mr-1"></i> Prix unitaire (DA)
                                </label>
                                <input type="number" step="0.01" name="prix_unitaire" id="prix_unitaire" value="{{ old('prix_unitaire') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                @error('prix_unitaire')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="taxe" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-percent mr-1"></i> Taxe (%)
                                </label>
                                <input type="number" step="0.01" name="taxe" id="taxe" value="{{ old('taxe') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                @error('taxe')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Supplier and Date Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="fournisseur" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-truck mr-1"></i> Fournisseur
                                </label>
                                <input type="text" name="fournisseur" id="fournisseur" value="{{ old('fournisseur') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('fournisseur')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date_achat" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-1"></i> Date d'achat
                                </label>
                                <input type="date" name="date_achat" id="date_achat" value="{{ old('date_achat', date('Y-m-d')) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('date_achat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                            <label for="toggle-form" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 cursor-pointer transition-colors">
                                <i class="fas fa-times mr-1"></i> Annuler
                            </label>
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-md shadow-sm transition-all transform hover:scale-105">
                                <i class="fas fa-save mr-1"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Purchases Table -->
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-4">
                    <h3 class="text-xl font-semibold">
                        <i class="fas fa-list mr-2"></i> Liste des Achats
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 font-semibold">
                                    <i class="fas fa-box mr-1"></i> Produit
                                </th>
                                <th class="px-6 py-4 font-semibold">
                                    <i class="fas fa-tag mr-1"></i> Type
                                </th>
                                <th class="px-6 py-4 font-semibold">
                                    <i class="fas fa-sort-numeric-up mr-1"></i> Quantité
                                </th>
                                <th class="px-6 py-4 font-semibold">
                                    <i class="fas fa-money-bill-wave mr-1"></i> Prix Achat (DA)
                                </th>
                                <th class="px-6 py-4 font-semibold">
                                    <i class="fas fa-percent mr-1"></i> Taxe (%)
                                </th>
                                <th class="px-6 py-4 font-semibold">
                                    <i class="fas fa-truck mr-1"></i> Fournisseur
                                </th>
                                <th class="px-6 py-4 font-semibold">
                                    <i class="fas fa-calendar-alt mr-1"></i> Date
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($achats as $achat)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $achat->product->nom ?? $achat->produit }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $achat->type_produit }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        <span class="font-semibold">{{ $achat->quantite }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        <span class="font-semibold text-green-600">{{ number_format($achat->prix_achat, 2) }} DA</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ number_format($achat->taxe, 2) }}%
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $achat->fournisseur ?? '---' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        <span class="text-sm">{{ \Carbon\Carbon::parse($achat->date_achat)->format('d/m/Y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                                            <p class="text-lg">Aucun achat enregistré</p>
                                            <p class="text-sm">Commencez par ajouter votre premier achat</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
               
            </div>
        </div>
    </div>
</x-app-layout>