@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Sectores Económicos</h5>
            <a href="{{ route('sectors.create') }}" class="btn btn-primary">
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
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Actividades Proibidas</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sectors as $sector)
                    <tr>
                        <td>{{ $sector->name }}</td>
                        <td>{{ Str::limit($sector->description, 50) }}</td>
                        <td>{{ $sector->prohibitedActivities->count() }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('sectors.show', $sector->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Ver detalhes">
                                    <i class="lni lni-eye"></i>
                                </a>
                                <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Editar">
                                    <i class="lni lni-pencil"></i>
                                </a>
                                <form action="{{ route('sectors.destroy', $sector->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este sector?')">
                                        <i class="lni lni-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Nenhum sector registrado ainda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($sectors->hasPages())
        <div class="d-flex justify-content-end mt-3">
            {{ $sectors->links('pagination.bootstrap-5-dark') }}
        </div>
        @endif
    </div>
</div>
@endsection
