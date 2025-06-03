<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des Produits
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
        <div class="mb-4 flex justify-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-lg"></i> Ajouter un produit
            </button>
          </div>
          <div class="mb-4 flex justify-end">
            
                <a href="{{ route('stock.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i> Exporter Excel
                </a>
             
            </div>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix Unitaire</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $product->id }}</td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->type }}</td>
                                <td class="px-4 py-2">{{ $product->description }}</td>
                                <td class="px-4 py-2">{{ $product->quantite }}</td>
                                <td class="px-4 py-2">{{ number_format($product->prix_unitaire, 2) }} DA</td>
                                <td class="px-4 py-2">{{ number_format($product->quantite * $product->prix_unitaire, 2) }} DA</td>
                                <td class="px-4 py-2 space-x-2">
                                    <button class="btn btn-primary"><a  class="text-blue-600 hover:underline">Voir</a></button></br>
                                    <button class="btn btn-warning btn-sm edit-btn" 
    data-id="{{ $product->id }}"
    data-name="{{ $product->name }}"
    data-type="{{ $product->type }}"
    data-quantity="{{ $product->quantite }}"
    data-unit_price="{{ $product->prix_unitaire }}"
    data-description="{{ $product->description }}"
    data-bs-toggle="modal"
    data-bs-target="#editProductModal">
    <i class="bi bi-pencil-square"></i> Modifier
</button>


                                    <form  method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Supprimer ce produit ?')" class="text-red-600 hover:underline">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($products->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center py-4 text-gray-500">Aucun produit trouvé.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>












    <!-- Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="" id="editProductForm">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier le produit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">
          <div class="mb-3">
            <label for="edit-name" class="form-label">Nom</label>
            <input type="text" name="name" id="edit-name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="edit-type" class="form-label">Type</label>
            <select name="type" id="edit-type" class="form-select" required>
              <option value="sacherie">Sacherie</option>
              <option value="Produit fongique">Produit fongique</option>
              <option value="piece de rechange">Pièce de rechange</option>
              <option value="insectiside">Insecticide</option>
              <option value="engrais">Engrais</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="edit-quantity" class="form-label">Quantité</label>
            <input type="number" name="quantite" id="edit-quantity" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="edit-unit_price" class="form-label">Prix unitaire</label>
            <input type="number" name="prix_unitaire" id="edit-unit_price" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="edit-description" class="form-label">Description</label>
            <textarea name="description" id="edit-description" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Mettre à jour</button>
        </div>
      </div>
    </form>
  </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');
    const form = document.getElementById('editProductForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const type = this.dataset.type;
            const quantity = this.dataset.quantity;
            const unitPrice = this.dataset.unit_price;
            const description = this.dataset.description;

            // Remplir les champs
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-type').value = type;
            document.getElementById('edit-quantity').value = quantity;
            document.getElementById('edit-unit_price').value = unitPrice;
            document.getElementById('edit-description').value = description;

            // Changer l'action du formulaire dynamiquement
            form.action = `/stock/${id}`;
        });
    });
});
</script>







    <!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('stock.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Ajouter un produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du produit</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type de produit</label>
                    <select name="type" class="form-select" id="type" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="sacherie">Sacherie</option>
                        <option value="Produit fongique">Produit fongique</option>
                        <option value="piece de rechange">Pièce de rechange</option>
                        <option value="insectiside">Insecticide</option>
                        <option value="engrais">Engrais</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantité</label>
                    <input type="number" name="quantite" class="form-control" id="quantity" required min="0">
                </div>
                <div class="mb-3">
                    <label for="unit_price" class="form-label">Prix unitaire (DA)</label>
                    <input type="number" name="prix_unitaire" class="form-control" id="unit_price" required min="0">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>
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
<!-- Modal -->
<!-- Modal -->
