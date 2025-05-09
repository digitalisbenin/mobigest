@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Importer un fichier Excel</h2>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des formulaires d'import -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @php
                $imports = [
                    ['route' => 'import.articles', 'label' => 'Importer Articles'],
                    ['route' => 'import.depenses', 'label' => 'Importer Dépenses'],
                    ['route' => 'import.entrearticles', 'label' => 'Importer Entrée Articles'],
                    ['route' => 'import.familles', 'label' => 'Importer Familles'],
                    ['route' => 'import.retourarticle', 'label' => 'Importer Retours Articles'],
                    ['route' => 'import.reglements', 'label' => 'Importer Règlements Ventes'],
                    ['route' => 'import.ventearticles', 'label' => 'Importer Ventes Articles'],
                ];
            @endphp

            @foreach ($imports as $import)
            <form action="{{ route($import['route']) }}" method="post" enctype="multipart/form-data" class="bg-gray-50 p-4 rounded-lg">
                @csrf
                <div class="row g-3 align-items-center">
                    <!-- Input file à gauche -->
                    <div class="col">
                        <input type="file" name="file" required class="form-control">
                    </div>
                    
                    <!-- Bouton à droite -->
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary text-white fw-semibold rounded-lg" style="width: 400px;">
                            {{ $import['label'] }}
                        </button>
                    </div>
                </div>
            </form>
            
            
            @endforeach
        </div>
    </div>

</div>
@endsection
