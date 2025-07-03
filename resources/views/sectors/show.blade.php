@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detalhes do Sector: {{ $sector->name }}</h5>
            <div>
                <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-sm btn-outline-secondary me-2">
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
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Informações do Sector</h6>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Nome:</span>
                        <strong>{{ $sector->name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Data de Criação:</span>
                        <strong>{{ $sector->created_at->format('d/m/Y H:i') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Última Actualização:</span>
                        <strong>{{ $sector->updated_at->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Descrição</h6>
                    <div class="p-3 bg-light rounded">
                        {{ $sector->description ?? 'Nenhuma descrição fornecida.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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