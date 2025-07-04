@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Detalhes do Sector</h5>
                <nav aria-label="breadcrumb" class="mt-1">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('sectors.index') }}">Sectores Económicos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $sector->name }}</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-sm btn-outline-primary me-2">
                    <i class="lni lni-pencil me-1"></i> Editar
                </a>
                <a href="{{ route('sectors.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="lni lni-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <i class="lni lni-folder me-2"></i> Informações do Sector
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Nome:</span>
                            <strong>{{ $sector->name }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Data Criação:</span>
                            <strong>{{ $sector->created_at->format('d/m/Y H:i') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">Última Actualização:</span>
                            <strong>{{ $sector->updated_at->format('d/m/Y H:i') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <i class="lni lni-text-align-justify me-2"></i> Descrição
                    </div>
                    <div class="card-body">
                        @if($sector->description)
                            <div class="p-3 bg-light rounded">
                                {{ $sector->description }}
                            </div>
                        @else
                            <div class="text-center text-muted py-3">
                                Nenhuma descrição fornecida
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Seção original mantida conforme solicitado -->
<div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Actividades Proibidas neste Sector</h5>
            <a href="{{ route('prohibited_activities.create') }}?sector_id={{ $sector->id }}" class="btn btn-sm btn-primary">
                <i class="lni lni-plus me-1"></i> Adicionar Actividade
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($sector->prohibitedActivities->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Actividade</th>
                        <th>Justificativa</th>
                        <th>Países com Restrição</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sector->prohibitedActivities as $activity)
                    <tr>
                        <td>{{ $activity->name }}</td>
                        <td>{{ Str::limit($activity->justification, 70) }}</td>
                        <td>{{ $activity->countries->count() }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('prohibited_activities.show', $activity->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="lni lni-eye"></i>
                                </a>
                                <a href="{{ route('prohibited_activities.edit', $activity->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="lni lni-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info mb-0">
            Nenhuma actividade proibida registrada para este sector.
        </div>
        @endif
    </div>
</div>
@endsection