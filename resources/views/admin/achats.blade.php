<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-black bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 rounded shadow">
                <i class="fas fa-shopping-cart mr-2"></i> Gestion des Achats
            </h2>
            <!-- FIXED: use Bootstrap modal trigger -->
            <button data-bs-toggle="modal" data-bs-target="#addAchatModal"
                class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-black font-semibold px-4 py-2 rounded-lg shadow-lg transition transform hover:scale-105">
                <i class="fas fa-plus mr-1"></i> Ajouter un achat
            </button>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">📦 Liste des Achats</h3>
                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Produit</th>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Quantité</th>
                                <th class="px-4 py-3">Prix Achat (DA)</th>
                                <th class="px-4 py-3">Taxe (%)</th>
                                <th class="px-4 py-3">Fournisseur</th>
                                <th class="px-4 py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($achats as $achat)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-2 font-medium">{{ $achat->product->nom ?? $achat->produit }}</td>
                                    <td class="px-4 py-2">{{ $achat->type_produit }}</td>
                                    <td class="px-4 py-2">{{ $achat->quantite }}</td>
                                    <td class="px-4 py-2">{{ number_format($achat->prix_achat, 2) }}</td>
                                    <td class="px-4 py-2">{{ number_format($achat->taxe, 2) }}</td>
                                    <td class="px-4 py-2">{{ $achat->fournisseur ?? '---' }}</td>
                                    <td class="px-4 py-2">{{ $achat->date_achat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAchatModal" tabindex="-1" aria-labelledby="addAchatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('achats.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addAchatModalLabel">Ajouter un achat</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Produit</label>
                            <select name="product_id" id="product_id" class="form-select" required>
                                <option value="">-- Choisir un produit --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->nom }} ({{ $product->type }}) - {{ number_format($product->prix_unitaire, 2) }} DA
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="type_produit" class="form-label">Type de produit</label>
                                <input type="text" name="type_produit" id="type_produit" class="form-control" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="quantite" class="form-label">Quantité</label>
                                <input type="number" name="quantite" id="quantite" class="form-control" required min="0">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="prix_achat" class="form-label">Prix d'achat (DA)</label>
                                <input type="number" step="0.01" name="prix_achat" id="prix_achat" class="form-control" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="taxe" class="form-label">Taxe (%)</label>
                                <input type="number" step="0.01" name="taxe" id="taxe" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fournisseur" class="form-label">Fournisseur</label>
                            <input type="text" name="fournisseur" id="fournisseur" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="date_achat" class="form-label">Date d'achat</label>
                            <input type="date" name="date_achat" id="date_achat" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
