@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Detalhes do País</h5>
                <nav aria-label="breadcrumb" class="mt-1">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('countries.index') }}">Países</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $country->name }}</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-sm btn-outline-primary me-2">
                    <i class="lni lni-pencil me-1"></i> Editar
                </a>
                <a href="{{ route('countries.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="lni lni-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">

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
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <i class="lni lni-world me-2"></i> Informações Geográficas
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Continente:</span>
                            <strong>{{ $country->continent }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Região:</span>
                            <strong>{{ $country->region ?? 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Língua Oficial:</span>
                            <strong>{{ $country->official_language ?? 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">Ano Independência:</span>
                            <strong>{{ $country->independence_year ?? 'N/A' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <i class="lni lni-bar-chart me-2"></i> Indicadores Económicos
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">PIB (US$):</span>
                            <strong>{{ $country->gdp ? '$ ' . number_format($country->gdp, 2) : 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">IDH:</span>
                            <strong>{{ $country->hdi ? number_format($country->hdi, 3) : 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Convenções OIT:</span>
                            <strong>{{ $country->ilo_conventions }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">Legislação SST:</span>
                            <strong>
                                <span class="badge bg-{{ $country->sst_legislation_robustness == 'Forte' ? 'success' : ($country->sst_legislation_robustness == 'Moderada' ? 'warning' : 'danger') }}">
                                    {{ $country->sst_legislation_robustness ?? 'N/A' }}
                                </span>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-info text-white">
                        <i class="lni lni-users me-2"></i> Demografia
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">% Pop. Jovem:</span>
                            <strong>{{ $country->youth_percentage ? number_format($country->youth_percentage, 2) . '%' : 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">% Pop. Criança:</span>
                            <strong>{{ $country->children_percentage ? number_format($country->children_percentage, 2) . '%' : 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted">Nível de Escolaridade:</span>
                            <strong>{{ $country->education_level ?? 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">Ano Aprovação Actividades:</span>
                            <strong>{{ $country->hazardous_activities_approval_year ?? 'N/A' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-warning text-white">
                        <i class="lni lni-stats-up me-2"></i> Sectores que mais contribuem para o PIB
                    </div>
                    <div class="card-body">
                        @if($country->gdp_contributing_sectors)
                            <ul class="list-group list-group-flush">
                                @foreach(explode(',', $country->gdp_contributing_sectors) as $sector)
                                    <li class="list-group-item border-0 py-2 px-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>{{ trim($sector) }}</span>
                                            <span class="badge bg-primary rounded-pill">{{ $loop->iteration }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center text-muted py-3">
                                Nenhuma informação disponível
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-secondary text-white">
                        <i class="lni lni-briefcase me-2"></i> Sectores que mais empregam
                    </div>
                    <div class="card-body">
                        @if($country->employment_sectors)
                            <ul class="list-group list-group-flush">
                                @foreach(explode(',', $country->employment_sectors) as $sector)
                                    <li class="list-group-item border-0 py-2 px-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>{{ trim($sector) }}</span>
                                            <span class="badge bg-primary rounded-pill">{{ $loop->iteration }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center text-muted py-3">
                                Nenhuma informação disponível
                            </div>
                        @endif
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
            <h5 class="mb-0">
                <i class="lni lni-ban text-danger me-2"></i>
                Actividades Proibidas
                <span class="badge bg-primary ms-2">{{ $country->activities->count() }}</span>
            </h5>
            <a href="{{ route('country_activities.create', ['country_id' => $country->id]) }}" class="btn btn-sm btn-primary">
                <i class="lni lni-plus me-1"></i> Adicionar
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Actividade</th>
                        <th>Sector</th>
                        <!-- <th>Riscos</th> -->
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($country->activities as $activity)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $activity->name }}</div>
                                <small class="text-muted">{{ $activity->code ?? 'Sem código' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $activity->sector->name ?? 'N/A' }}</span>
                            </td>
                            <!-- <td>
                                @if($activity->pivot->indicators && is_array(json_decode($activity->pivot->indicators, true)))
                                    @foreach(json_decode($activity->pivot->indicators) as $indicator)
                                    <span class="badge bg-danger me-1 mb-1">{{ $indicator }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td> -->
                            <td class="text-end">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Detalhes">
                                        <i class="lni lni-eye"></i>
                                    </button>
                                    <a href="{{ route('country_activities.edit', $activity->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Editar">
                                        <i class="lni lni-pencil"></i>
                                    </a>
                                    <form action="{{ route('country_activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remover esta actividade proibida?')" data-bs-toggle="tooltip" title="Remover">
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
    </div>
</div>
@else
<div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-body text-center py-5">
        <div class="mb-3">
            <i class="lni lni-ban text-muted" style="font-size: 3rem;"></i>
        </div>
        <h5 class="mb-2">Nenhuma actividade proibida registada</h5>
        <p class="text-muted mb-4">Adicione actividades proibidas para este país</p>
        <a href="{{ route('country_activities.create', ['country_id' => $country->id]) }}" class="btn btn-primary">
            <i class="lni lni-plus me-1"></i> Adicionar Actividade
        </a>
    </div>
</div>
@endif

@push('scripts')
<script>
    // Ativar tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Fechar alerta após 5 segundos
        var successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(function() {
                var alert = bootstrap.Alert.getInstance(successAlert);
                if (alert) {
                    alert.close();
                }
            }, 5000);
        }
    });
</script>
@endpush
@endsection