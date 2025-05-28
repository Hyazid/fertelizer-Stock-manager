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
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-black text-sm font-semibold rounded-lg shadow-md transition duration-150">
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
                            {{-- Example row, replace with dynamic loop --}}
                            foreach ($ventes as $vente)
                            <tr class="hover:bg-slate-50 transition duration-200 ease-in-out">
                                <td class="px-6 py-4 font-semibold text-blue-600">VNT-$vente->id </td>
                                <td class="px-6 py-4"> $vente->produit </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        $vente->type 
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">$vente->quantite </td>
                                <td class="px-6 py-4 text-center"> number_format($vente->prix_unitaire, 2) DA</td>
                                <td class="px-6 py-4 text-center font-bold text-green-600">
                                     number_format($vente->quantite * $vente->prix_unitaire, 2)  DA
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="" class="text-blue-500 hover:underline text-sm">
                                        🧾 Voir
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href=""
                                       class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-medium rounded">
                                        ✏️ Modifier
                                    </a>
                                    <form action="" method="POST" class="inline-block"
                                          onsubmit="return confirm('Confirmer la suppression ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            endforeach
                            {{-- End loop --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
