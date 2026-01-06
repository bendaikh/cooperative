@extends('layouts.app')

@section('title', $document->title)
@section('page-title', $document->title)

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 max-w-5xl mx-auto">
    <div class="mb-6 flex justify-between items-start">
        <div>
            <a href="{{ route('onca.index') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center mb-2">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour à la liste
            </a>
            <h2 class="text-2xl font-bold text-gray-800">{{ $document->title }}</h2>
            <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                <span class="bg-gray-100 px-2 py-1 rounded font-mono">{{ $document->reference }}</span>
                <span>Version: {{ $document->version }}</span>
                <span>Date: {{ $document->date->format('d/m/Y') }}</span>
                <span>Responsable: {{ $document->responsible }}</span>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('onca.edit', $document) }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Modifier
            </a>
            <a href="{{ route('onca.print', $document) }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Imprimer / Exporter
            </a>
        </div>
    </div>

    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aperçu du contenu</h3>
        
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 overflow-hidden">
             <!-- iframe to show the print view as preview -->
             <iframe src="{{ route('onca.print', $document) }}" class="w-full h-[600px] border bg-white" style="transform: scale(0.95); transform-origin: top center;"></iframe>
        </div>
    </div>

    @if($document->hasDocuments())
    <div class="border-t border-gray-200 pt-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Documents Numérisés</h3>
        
        @php
            $allUrls = $document->getAllDocumentUrls();
        @endphp
        
        @if(!empty($allUrls))
            <div class="grid grid-cols-1 gap-3">
                @foreach($allUrls as $index => $url)
                    <div class="flex items-center justify-between bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="flex items-center gap-3 flex-1">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800">Document {{ $index + 1 }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ $url }}</p>
                            </div>
                        </div>
                        <a href="{{ $url }}" target="_blank" class="ml-2 px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition flex items-center whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Ouvrir
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-sm text-green-800">
                    <strong>Note:</strong> {{ count($allUrls) }} document(s) associé(s) à ce dossier. Vous pouvez les consulter directement via les liens ci-dessus.
                </p>
            </div>
        @endif
    </div>
    @endif
</div>
@endsection
