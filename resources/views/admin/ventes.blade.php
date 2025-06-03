<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">
            🧾 Liste des ventes
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-b from-slate-100 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200">
                <div class="p-6 border-b bg-gradient-to-r from-white to-gray-50">
                    <h3 class="text-xl font-semibold text-gray-700">📦 Historique des ventes</h3>
                    <p class="text-sm text-gray-500">Suivez vos transactions avec élégance</p>
                </div>
                <div class="flex justify-end px-6 pt-6">
                    <a href=""
                    data-bs-toggle="modal" data-bs-target="#addVenteModal"
                    class="inline-flex items-center btn-primary px-4 py-2 bg-green-600 hover:bg-green-700 text-black text-sm font-semibold rounded-lg shadow-md transition duration-150">
                        ➕ Nouvelle Vente
                    </a>
                </div>


                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-800">
                        <thead class="bg-slate-200 text-gray-700 text-sm uppercase tracking-wide">
                            <tr>
                                <th class="px-6 py-3 text-left"># Vente</th>
                                <th class="px-6 py-3 text-left">Produit</th>
                                <th class="px-6 py-3 text-left">Type</th>
                                <th class="px-6 py-3 text-center">Quantité</th>
                                <th class="px-6 py-3 text-center">PU</th>
                                <th class="px-6 py-3 text-center">Total</th>
                                <th class="px-6 py-3 text-center">Facture</th>
                                <th class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
    @foreach ($ventes as $vente)
        <tr class="hover:bg-slate-50 transition duration-200 ease-in-out">
            <td class="px-6 py-4 font-semibold text-blue-600">VNT-{{ $vente->id }}</td>
            <td class="px-6 py-4">{{ $vente->product->name }}</td>
            <td class="px-6 py-4">
                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    {{ $vente->product->type }}
                </span>
            </td>
            <td class="px-6 py-4 text-center">{{ $vente->quantite }}</td>
            <td class="px-6 py-4 text-center">{{ number_format($vente->prix_unitaire, 2) }} DA</td>
            <td class="px-6 py-4 text-center font-bold text-green-600">
                {{ number_format($vente->prix_unitaire, 2)*$vente->quantite }} DA
            </td>
            <td class="px-6 py-4 text-center">
                <a href="#" class="text-blue-500 hover:underline text-sm">🧾 Voir</a>
            </td>
            <td class="px-6 py-4 text-center space-x-2">
                <a href="#" class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-black text-xs font-medium rounded">
                    ✏️ Modifier
                </a>
                <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" class="inline-block"
                    onsubmit="return confirm('Confirmer la suppression ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-black text-xs font-medium rounded">
                        🗑️ Supprimer
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>





    <!--ventes-->


    <div class="modal fade" id="addVenteModal" tabindex="-1" aria-labelledby="addVenteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('ventes.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une vente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Produit</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">-- Choisir un produit --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} ({{ $product->type }}) - {{ number_format($product->prix_unitaire, 2) }} DA
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité</label>
                        <input type="number" name="quantite" class="form-control" id="quantite" required min="1">
                    </div>

                    <div class="mb-3">
                        <label for="client" class="form-label">Client / Destinataire</label>
                        <input type="text" name="client" class="form-control" id="client" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" id="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="taxe" class="form-label">Taxe (en DA)</label>
                        <input type="number" step="0.01" name="taxe" class="form-control" id="taxe" value="0">
                    </div>


                    <div class="mb-3">
                        <label for="date_vente" class="form-label">Date de vente</label>
                        <input type="date" name="date_vente" class="form-control" id="date_vente" value="{{ date('Y-m-d') }}">
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
