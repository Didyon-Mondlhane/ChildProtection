@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Lista de Países</h5>
            <div>
                <a href="{{ route('countries.create') }}" class="btn btn-primary">
                    <i class="lni lni-plus me-2"></i>Adicionar
                </a>
            </div>
        </div>
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

        <!-- Formulário de Filtro -->
        <form method="GET" action="{{ route('countries.index') }}" class="row gy-2 gx-3 align-items-end mb-4">
            <div class="col-md-2">
                <label class="form-label">Continente</label>
                <input type="text" name="continent" value="{{ request('continent') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">PIB mínimo</label>
                <input type="number" name="gdp_min" value="{{ request('gdp_min') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">IDH mínimo</label>
                <input type="number" step="0.001" name="hdi_min" value="{{ request('hdi_min') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Língua oficial</label>
                <input type="text" name="official_language" value="{{ request('official_language') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Ano de Independência</label>
                <input type="number" name="independence_year" value="{{ request('independence_year') }}" class="form-control">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="lni lni-search me-1"></i> Filtrar
                </button>
                <a href="{{ route('countries.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="lni lni-close me-1"></i> Limpar
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Continente</th>
                        <th>IDH</th>
                        <th>Convenções OIT</th>
                        <th>Legislação SST</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($countries as $country)
                    <tr>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->continent }}</td>
                        <td>{{ $country->hdi ? number_format($country->hdi, 3) : 'N/A' }}</td>
                        <td>{{ $country->ilo_conventions }}</td>
                        <td>
                            <span class="badge bg-{{ $country->sst_legislation_robustness == 'Forte' ? 'success' : ($country->sst_legislation_robustness == 'Moderada' ? 'warning' : 'danger') }}">
                                {{ $country->sst_legislation_robustness }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('countries.show', $country->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Ver detalhes">
                                    <i class="lni lni-eye"></i>
                                </a>
                                <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Editar">
                                    <i class="lni lni-pencil"></i>
                                </a>
                                <form action="{{ route('countries.destroy', $country->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este país?')">
                                        <i class="lni lni-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Nenhum país registrado ainda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($countries->hasPages())
        <div class="d-flex justify-content-end mt-3">
            {{ $countries->links('pagination.bootstrap-5-dark') }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>
@endpush
