@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Sector: {{ $sector->name }}</h5>
            <a href="{{ route('sectors.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="lni lni-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('sectors.update', $sector->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome do Sector *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $sector->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $sector->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="lni lni-save me-2"></i>Actualizar Sector
                    </button>
                    <a href="{{ route('sectors.index') }}" class="btn btn-outline-secondary px-4">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection