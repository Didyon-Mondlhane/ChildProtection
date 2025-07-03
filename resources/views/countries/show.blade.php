@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detalhes do País: {{ $country->name }}</h5>
            <div>
                <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-sm btn-outline-secondary me-2">
                    <i class="lni lni-pencil me-1"></i> Editar
                </a>
                <a href="{{ route('countries.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="lni lni-arrow-left me-1"></i> Voltar
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

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Informações Básicas</h6>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Continente:</span>
                        <strong>{{ $country->continent }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Região:</span>
                        <strong>{{ $country->region ?? 'N/A' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Língua Oficial:</span>
                        <strong>{{ $country->official_language ?? 'N/A' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Ano de Independência:</span>
                        <strong>{{ $country->independence_year ?? 'N/A' }}</strong>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Indicadores Económicos</h6>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>PIB (US$):</span>
                        <strong>{{ $country->gdp ? '$ ' . number_format($country->gdp, 2) : 'N/A' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>IDH:</span>
                        <strong>{{ $country->hdi ? number_format($country->hdi, 3) : 'N/A' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Convenções OIT:</span>
                        <strong>{{ $country->ilo_conventions }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Legislação SST:</span>
                        <strong>
                            <span class="badge bg-{{ $country->sst_legislation_robustness == 'Forte' ? 'success' : ($country->sst_legislation_robustness == 'Moderada' ? 'warning' : 'danger') }}">
                                {{ $country->sst_legislation_robustness ?? 'N/A' }}
                            </span>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Demografia</h6>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>% População Jovem:</span>
                        <strong>{{ $country->youth_percentage ? number_format($country->youth_percentage, 2) . '%' : 'N/A' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>% População Criança:</span>
                        <strong>{{ $country->children_percentage ? number_format($country->children_percentage, 2) . '%' : 'N/A' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Nível de Escolaridade:</span>
                        <strong>{{ $country->education_level ?? 'N/A' }}</strong>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Sectores Económicos</h6>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Ano Aprovação Actividades:</span>
                        <strong>{{ $country->hazardous_activities_approval_year ?? 'N/A' }}</strong>
                    </div>
                </div>
                
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Sectores que mais contribuem para o PIB</h6>
                    <div class="p-2 bg-light rounded">
                        {{ $country->gdp_contributing_sectors ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Sectores que mais empregam</h6>
                    <div class="p-2 bg-light rounded">
                        {{ $country->employment_sectors ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($country->activities->count() > 0)
<div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Actividades Proibidas neste País</h5>
            <a href="{{ route('country_activities.create', ['country_id' => $country->id]) }}" class="btn btn-sm btn-primary">
                <i class="lni lni-plus me-1"></i> Adicionar Actividade
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Actividade</th>
                        <th>Sector</th>
                        <th>Indicadores</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($country->activities as $activity)
                        <tr>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->sector->name ?? 'N/A' }}</td>
                            <td>
                                @if($activity->pivot->indicators && is_array(json_decode($activity->pivot->indicators, true)))
                                    @foreach(json_decode($activity->pivot->indicators) as $indicator)
                                    <span class="badge bg-secondary me-1">{{ $indicator }}</span>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-end">
                                <form action="{{ route('country_activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remover esta actividade proibida?')">
                                        <i class="lni lni-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-body text-center py-5">
        <div class="mb-3">
            <i class="lni lni-ban text-muted" style="font-size: 2.5rem;"></i>
        </div>
        <h5 class="mb-2">Nenhuma actividade proibida registrada</h5>
        <p class="text-muted mb-4">Adicione actividades proibidas para este país</p>
        <a href="{{ route('country_activities.create', ['country_id' => $country->id]) }}" class="btn btn-primary">
            <i class="lni lni-plus me-1"></i> Adicionar Actividade
        </a>
    </div>
</div>
@endif
@endsection