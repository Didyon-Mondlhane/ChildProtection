@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">Comparações</h5>
            <a href="{{ route('comparisons.index') }}" class="btn btn-primary">
                <i class="lni lni-plus me-2"></i> Nova Comparação
            </a>
        </div>
        
        <div class="card-body">

            <!-- Mensagens de Feedback -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" id="successAlert">
                <div class="d-flex align-items-center">
                    <i class="lni lni-checkmark-circle me-2"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" id="errorAlert">
                <div class="d-flex align-items-center">
                    <i class="lni lni-warning me-2"></i>
                    <span>{{ session('error') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Comparações Recentes</h6>
                        </div>
                        <div class="card-body">
                            @forelse($comparisons as $comparison)
                            <div class="list-group-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">
                                            <a href="{{ route('comparisons.show', $comparison->id) }}">
                                                {{ $comparison->name }}
                                            </a>
                                        </h6>
                                        <!-- <small class="text-muted">
                                            {{ $comparison->country1->name }} vs {{ $comparison->country2->name }}
                                        </small> -->
                                    </div>
                                    <div>
                                        <small>{{ $comparison->created_at->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="alert alert-info mb-0">
                                Nenhuma comparação encontrada.
                            </div>
                            @endforelse
                            
                            {{ $comparisons->links() }}
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Comparação Rápida</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('comparisons.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nome da Comparação</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">País 1</label>
                                        <select name="country1_id" class="form-select" required>
                                            <option value="">Seleccione</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">País 2</label>
                                        <select name="country2_id" class="form-select" required>
                                            <option value="">Seleccione</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="lni lni-search-alt me-2"></i> Comparar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection