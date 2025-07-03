@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Actividades Proibidas por País</h5>
            <a href="{{ route('country_activities.create') }}" class="btn btn-primary">
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

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>País</th>
                        <th>Actividade</th>
                        <th>Sector</th>
                        <th>Nível Risco</th>
                        <th>Conformidade</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($countryActivities as $ca)
                    <tr>
                        <td>{{ $ca->country->name }}</td>
                        <td>{{ $ca->prohibitedActivity->name }}</td>
                        <td>{{ $ca->prohibitedActivity->sector->name }}</td>
                        <td>
                            @if($ca->risk_level)
                                <span class="badge bg-{{ $ca->risk_level == 'Baixo' ? 'success' : ($ca->risk_level == 'Médio' ? 'warning' : 'danger') }}">
                                    {{ $ca->risk_level }}
                                </span>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($ca->compliance)
                                <span class="badge bg-success">Sim</span>
                            @else
                                <span class="badge bg-danger">Não</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <form action="{{ route('country_activities.destroy', $ca->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta relação?')">
                                        <i class="lni lni-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Nenhuma relação país/actividade registrada ainda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($countryActivities->hasPages())
        <div class="d-flex justify-content-end mt-3">
            {{ $countryActivities->links('pagination.bootstrap-5-dark') }}
        </div>
        @endif
        
    </div>
</div>
@endsection