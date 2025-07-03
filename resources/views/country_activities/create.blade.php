@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Vincular Actividade Proibida a País</h5>
            <a href="{{ route('country_activities.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="lni lni-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('country_activities.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="country_id" class="form-label">País *</label>
                    <select class="form-select @error('country_id') is-invalid @enderror" id="country_id" name="country_id" required>
                        <option value="" selected disabled>Selecione...</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>
                            {{ $country->name }} ({{ $country->continent }})
                        </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="prohibited_activity_id" class="form-label">Actividade Proibida *</label>
                    <select class="form-select @error('prohibited_activity_id') is-invalid @enderror" id="prohibited_activity_id" name="prohibited_activity_id" required>
                        <option value="" selected disabled>Selecione...</option>
                        @foreach($activities as $activity)
                        <option value="{{ $activity->id }}" @selected(old('prohibited_activity_id') == $activity->id || (isset($_GET['activity_id']) && $_GET['activity_id'] == $activity->id))>
                            {{ $activity->name }} ({{ $activity->sector->name }})
                        </option>
                        @endforeach
                    </select>
                    @error('prohibited_activity_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="indicators" class="form-label">Indicadores/Categorias</label>
                    <select class="form-select select2-multiple @error('indicators') is-invalid @enderror" id="indicators" name="indicators[]" multiple>
                        <option value="Risco Físico">Risco Físico</option>
                        <option value="Risco Químico">Risco Químico</option>
                        <option value="Risco Biológico">Risco Biológico</option>
                        <option value="Risco Ergonômico">Risco Ergonômico</option>
                        <option value="Risco de Acidentes">Risco de Acidentes</option>
                        <option value="Exploração Infantil">Exploração Infantil</option>
                        <option value="Trabalho Noturno">Trabalho Noturno</option>
                        <option value="Trabalho em Altura">Trabalho em Altura</option>
                    </select>
                    @error('indicators')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="lni lni-save me-2"></i>Gravar Relação
                    </button>
                    <a href="{{ route('country_activities.index') }}" class="btn btn-outline-secondary px-4">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: "Selecione os indicadores",
            width: '100%'
        });
    });
</script>
@endpush