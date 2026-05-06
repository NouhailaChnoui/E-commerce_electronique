@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Détails du Produit</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Nom :</strong>
                        <p>{{ $product->nom }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Description :</strong>
                        <p>{{ $product->description ?? 'Aucune description' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Prix :</strong>
                        <p>{{ number_format($product->prix, 2) }} MAD</p>
                    </div>
                    <div class="mb-3">
                        <strong>Quantité en stock :</strong>
                        <span class="badge bg-{{ $product->quantite > 0 ? 'success' : 'danger' }}">
                            {{ $product->quantite }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>Catégorie :</strong>
                        <p>{{ $product->category->nom ?? 'Non catégorisé' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Statut :</strong>
                        <span class="badge bg-{{ $product->actif ? 'success' : 'danger' }}">
                            {{ $product->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <strong>Image du produit :</strong>
                    <div class="mt-2">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="Image du produit" class="img-fluid rounded" style="max-height: 300px;">
                        @else
                            <img src="{{ asset('images/default-product.png') }}" alt="Image par défaut" class="img-fluid rounded" style="max-height: 300px;">
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
