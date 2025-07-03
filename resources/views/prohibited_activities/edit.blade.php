@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Actividade Proibida: {{ $prohibitedActivity->name }}</h5>
            <a href="{{ route('prohibited_activities.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="lni lni-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('prohibited_activities.update', $prohibitedActivity->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="sector_id" class="form-label">Sector Económico *</label>
                    <select class="form-select @error('sector_id') is-invalid @enderror" id="sector_id" name="sector_id" required>
                        @foreach($sectors as $sector)
                        <option value="{{ $sector->id }}" @selected(old('sector_id', $prohibitedActivity->sector_id) == $sector->id)>
                            {{ $sector->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome da Actividade *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $prohibitedActivity->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="description" class="form-label">Descrição *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $prohibitedActivity->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="justification" class="form-label">Justificativa *</label>
                    <textarea class="form-control @error('justification') is-invalid @enderror" id="justification" name="justification" rows="3" required>{{ old('justification', $prohibitedActivity->justification) }}</textarea>
                    @error('justification')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="lni lni-save me-2"></i>Actualizar Actividade
                    </button>
                    <a href="{{ route('prohibited_activities.index') }}" class="btn btn-outline-secondary px-4">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection