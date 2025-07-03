@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detalhes da Actividade: {{ $prohibitedActivity->name }}</h5>
            <div>
                <a href="{{ route('prohibited_activities.edit', $prohibitedActivity->id) }}" class="btn btn-sm btn-outline-secondary me-2">
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
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Informações Básicas</h6>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Sector Económico:</span>
                        <strong>{{ $prohibitedActivity->sector->name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Data de Criação:</span>
                        <strong>{{ $prohibitedActivity->created_at->format('d/m/Y H:i') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Última Actualização:</span>
                        <strong>{{ $prohibitedActivity->updated_at->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Descrição</h6>
                    <div class="p-3 bg-light rounded">
                        {{ $prohibitedActivity->description }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Justificativa</h6>
                    <div class="p-3 bg-light rounded">
                        {{ $prohibitedActivity->justification }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <th>Nível de Risco</th>
                        <th>Conformidade</th>
                        <th>Notas</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prohibitedActivity->countries as $country)
                    <tr>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->continent }}</td>
                        <td>
                            @if($country->pivot->risk_level)
                                <span class="badge bg-{{ $country->pivot->risk_level == 'Baixo' ? 'success' : ($country->pivot->risk_level == 'Médio' ? 'warning' : 'danger') }}">
                                    {{ $country->pivot->risk_level }}
                                </span>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($country->pivot->compliance)
                                <span class="badge bg-success">Sim</span>
                            @else
                                <span class="badge bg-danger">Não</span>
                            @endif
                        </td>
                        <td>{{ $country->pivot->additional_notes ?? 'N/A' }}</td>
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