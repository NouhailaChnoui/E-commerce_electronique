@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">
            <i class="bi bi-box-seam"></i> Gestion des Produits
            <span class="badge bg-primary">{{ $products->total() }}</span>
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Nouveau Produit
            </a>
        </div>
    </div>

    @include('partials.alerts')

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="query" class="form-control"
                           placeholder="Rechercher par nom..." value="{{ request('query') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Statut</th>
                            <th>Catégorie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="{{ $product->image_url }}" alt="{{ $product->nom }}" class="img-thumbnail product-img">
                                </td>
                                <td>
                                    <strong>{{ $product->nom }}</strong>
                                    @if($product->description)
                                        <p class="text-muted small mb-0">{{ Str::limit($product->description, 50) }}</p>
                                    @endif
                                </td>
                                <td>{{ number_format($product->prix, 2) }} MAD</td>
                                <td>
                                    <span class="badge bg-{{ $product->quantite > 0 ? 'success' : 'danger' }}">
                                        {{ $product->quantite }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $product->actif ? 'success' : 'danger' }}">
                                        {{ $product->actif ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>{{ $product->category->nom ?? 'Non catégorisé' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-primary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                    title="Supprimer" onclick="return confirm('Confirmer la suppression ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-outline-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="bi bi-box text-muted" style="font-size: 2rem;"></i>
                                    <h5 class="mt-2">Aucun produit trouvé</h5>
                                    @if(request('query'))
                                        <p class="text-muted">Essayez avec d'autres termes de recherche</p>
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">
                                            Afficher tous les produits
                                        </a>
                                    @else
                                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-plus"></i> Ajouter un produit
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="mt-3">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
