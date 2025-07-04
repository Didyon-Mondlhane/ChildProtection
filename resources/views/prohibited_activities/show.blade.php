@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Detalhes da Actividade</h5>
                <nav aria-label="breadcrumb" class="mt-1">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('prohibited_activities.index') }}">Actividades Proibidas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $prohibitedActivity->name }}</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('prohibited_activities.edit', $prohibitedActivity->id) }}" class="btn btn-sm btn-outline-primary me-2">
                    <i class="lni lni-pencil me-1"></i> Editar
                </a>
                <a href="{{ route('prohibited_activities.index') }}" class="btn btn-sm btn-outline-secondary">
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
                        <i class="lni lni-list me-2"></i> Informações Básicas
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Sector Económico:</span>
                            <strong>{{ $prohibitedActivity->sector->name }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Data Criação:</span>
                            <strong>{{ $prohibitedActivity->created_at->format('d/m/Y H:i') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">Última Actualização:</span>
                            <strong>{{ $prohibitedActivity->updated_at->format('d/m/Y H:i') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <i class="lni lni-danger me-2"></i> Indicadores de Risco
                    </div>
                    <div class="card-body">
                        @if($prohibitedActivity->risk_indicators && is_array(json_decode($prohibitedActivity->risk_indicators, true)))
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(json_decode($prohibitedActivity->risk_indicators) as $indicator)
                                    <span class="badge bg-danger">{{ $indicator }}</span>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center text-muted py-3">
                                Nenhum indicador de risco definido
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-info text-white">
                        <i class="lni lni-text-align-justify me-2"></i> Descrição
                    </div>
                    <div class="card-body">
                        @if($prohibitedActivity->description)
                            <div class="p-3 bg-light rounded">
                                {{ $prohibitedActivity->description }}
                            </div>
                        @else
                            <div class="text-center text-muted py-3">
                                Nenhuma descrição fornecida
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-warning text-white">
                        <i class="lni lni-warning me-2"></i> Justificativa
                    </div>
                    <div class="card-body">
                        @if($prohibitedActivity->justification)
                            <div class="p-3 bg-light rounded">
                                {{ $prohibitedActivity->justification }}
                            </div>
                        @else
                            <div class="text-center text-muted py-3">
                                Nenhuma justificativa fornecida
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
            <h5 class="mb-0">Países que Proíbem esta Actividade</h5>
            <a href="{{ route('country_activities.create') }}?activity_id={{ $prohibitedActivity->id }}" class="btn btn-sm btn-primary">
                <i class="lni lni-plus me-1"></i> Adicionar País
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($prohibitedActivity->countries->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>País</th>
                        <th>Continente</th>
                        <th>Conformidade</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prohibitedActivity->countries as $country)
                    <tr>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->continent }}</td>
                        <!-- <td>
                            @if($country->pivot->risk_level)
                                <span class="badge bg-{{ $country->pivot->risk_level == 'Baixo' ? 'success' : ($country->pivot->risk_level == 'Médio' ? 'warning' : 'danger') }}">
                                    {{ $country->pivot->risk_level }}
                                </span>
                            @else
                                N/A
                            @endif
                        </td> -->
                        <td>
                            @if($country->pivot->compliance)
                                <span class="badge bg-success">Sim</span>
                            @else
                                <span class="badge bg-danger">Não</span>
                            @endif
                        </td>
                        <!-- <td>{{ $country->pivot->additional_notes ?? 'N/A' }}</td> -->
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <form action="{{ route('country_activities.destroy', $country->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remover esta restrição do país?')">
                                        <i class="lni lni-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info mb-0">
            Nenhum país registrado com restrição para esta actividade.
        </div>
        @endif
    </div>
</div>
@endsection