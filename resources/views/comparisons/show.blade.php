@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">{{ $comparison->name }}</h5>
        <div>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="lni lni-download me-1"></i> Exportar
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('comparisons.export', ['id' => $comparison->id, 'format' => 'pdf']) }}">PDF</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('comparisons.export', ['id' => $comparison->id, 'format' => 'excel']) }}">Excel</a></li>
            </ul>
        </div>
            <a href="{{ route('comparisons.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="lni lni-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
        
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="lni lni-checkmark-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card h-100 border-primary">
                        <div class="card-header bg-primary text-white">
                            {{ $comparison->country1->name }}
                        </div>
                        <div class="card-body">
                            <p><strong>PIB:</strong> ${{ number_format($comparison->country1->gdp, 2) }}</p>
                            <p><strong>IDH:</strong> {{ $comparison->country1->hdi }}</p>
                            <p><strong>Actividades Proibidas:</strong> {{ $comparison->country1->activities->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-success">
                        <div class="card-header bg-success text-white">
                            {{ $comparison->country2->name }}
                        </div>
                        <div class="card-body">
                            <p><strong>PIB:</strong> ${{ number_format($comparison->country2->gdp, 2) }}</p>
                            <p><strong>IDH:</strong> {{ $comparison->country2->hdi }}</p>
                            <p><strong>Actividades Proibidas:</strong> {{ $comparison->country2->activities->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs mb-4" id="comparisonTabs">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#differences">Diferenças</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#similarities">Similaridades</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#all">Todas Actividades</button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="differences">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    Actividades exclusivas de {{ $comparison->country1->name }}
                                </div>
                                <div class="card-body">
                                    @if($differences['country1']->count() > 0)
                                    <ul class="list-group">
                                        @foreach($differences['country1'] as $activity)
                                        <li class="list-group-item">
                                            <strong>{{ $activity->name }}</strong><br>
                                            <small class="text-muted">{{ $activity->sector->name }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <div class="alert alert-info mb-0">
                                        Nenhuma diferença encontrada.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Actividades exclusivas de {{ $comparison->country2->name }}
                                </div>
                                <div class="card-body">
                                    @if($differences['country2']->count() > 0)
                                    <ul class="list-group">
                                        @foreach($differences['country2'] as $activity)
                                        <li class="list-group-item">
                                            <strong>{{ $activity->name }}</strong><br>
                                            <small class="text-muted">{{ $activity->sector->name }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <div class="alert alert-info mb-0">
                                        Nenhuma diferença encontrada.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="similarities">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            Actividades comuns a ambos países
                        </div>
                        <div class="card-body">
                            @if($similarities->count() > 0)
                            <ul class="list-group">
                                @foreach($similarities as $activity)
                                <li class="list-group-item">
                                    <strong>{{ $activity->name }}</strong><br>
                                    <small class="text-muted">{{ $activity->sector->name }}</small>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="alert alert-info mb-0">
                                Nenhuma similaridade encontrada.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="all">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Actividade</th>
                                    <th>Sector</th>
                                    <th>{{ $comparison->country1->name }}</th>
                                    <th>{{ $comparison->country2->name }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->name }}</td>
                                    <td>{{ $activity->sector->name }}</td>
                                    <td>
                                        @if($comparison->country1->activities->contains($activity))
                                        <span class="badge bg-primary">Presente</span>
                                        @else
                                        <span class="badge bg-secondary">Ausente</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($comparison->country2->activities->contains($activity))
                                        <span class="badge bg-primary">Presente</span>
                                        @else
                                        <span class="badge bg-secondary">Ausente</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top">
                <form action="{{ route('comparisons.update', $comparison->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Comentários</label>
                        <textarea name="comments" class="form-control" rows="3">{{ $comparison->comments }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="lni lni-save me-1"></i> Salvar
                        </button>
                        <button type="button" class="btn btn-outline-danger" onclick="if(confirm('Tem certeza?')) { document.getElementById('delete-form').submit(); }">
                            <i class="lni lni-trash-can me-1"></i> Excluir
                        </button>
                    </div>
                </form>
                
                <form id="delete-form" action="{{ route('comparisons.destroy', $comparison->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tabElms = [].slice.call(document.querySelectorAll('[data-bs-toggle="tab"]'))
        tabElms.map(function(tabEl) {
            return new bootstrap.Tab(tabEl)
        });
    });
</script>
@endpush