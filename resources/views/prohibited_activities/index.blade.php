@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Actividades Proibidas</h5>
            <a href="{{ route('prohibited_activities.create') }}" class="btn btn-primary">
                <i class="lni lni-plus me-2"></i>Adicionar
            </a>
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

        <!-- Filtros -->
        <form method="GET" class="row gy-2 gx-3 align-items-end mb-4">
            <div class="col-md-4">
                <label class="form-label">Sector</label>
                <select name="sector" class="form-select">
                    <option value="">Seleccione um sector</option>
                    @foreach($sectors as $sector)
                        <option value="{{ $sector->id }}" {{ request('sector') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Palavra-chave</label>
                <input type="text" name="search" class="form-control" placeholder="Nome ou descrição..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Mínimo de países</label>
                <input type="number" name="min_countries" class="form-control" min="0" value="{{ request('min_countries') }}">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="lni lni-search me-1"></i> Filtrar
                </button>
                <a href="{{ route('prohibited_activities.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="lni lni-close me-1"></i> Limpar
                </a>
            </div>
        </form>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Actividade</th>
                        <th>Sector</th>
                        <th>Descrição</th>
                        <th>Países</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                    <tr>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->sector->name }}</td>
                        <td>{{ Str::limit($activity->description, 50) }}</td>
                        <td>{{ $activity->countries->count() }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('prohibited_activities.show', $activity->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Ver detalhes">
                                    <i class="lni lni-eye"></i>
                                </a>
                                <a href="{{ route('prohibited_activities.edit', $activity->id) }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Editar">
                                    <i class="lni lni-pencil"></i>
                                </a>
                                <form action="{{ route('prohibited_activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta actividade?')">
                                        <i class="lni lni-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Nenhuma actividade proibida registrada ainda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($activities->hasPages())
        <div class="d-flex justify-content-end mt-3">
            {{ $activities->appends(request()->query())->links('pagination.bootstrap-5-dark') }}
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
