@extends('layout.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar País: {{ $country->name }}</h5>
            <a href="{{ route('countries.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="lni lni-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('countries.update', $country->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome do País *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $country->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="continent" class="form-label">Continente *</label>
                    <select class="form-select @error('continent') is-invalid @enderror" id="continent" name="continent" required>
                        <option value="África" @selected(old('continent', $country->continent) == 'África')>África</option>
                        <option value="América" @selected(old('continent', $country->continent) == 'América')>América</option>
                        <option value="Ásia" @selected(old('continent', $country->continent) == 'Ásia')>Ásia</option>
                        <option value="Europa" @selected(old('continent', $country->continent) == 'Europa')>Europa</option>
                        <option value="Oceania" @selected(old('continent', $country->continent) == 'Oceania')>Oceania</option>
                    </select>
                    @error('continent')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="region" class="form-label">Região</label>
                    <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" name="region" value="{{ old('region', $country->region) }}">
                    @error('region')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="official_language" class="form-label">Língua Oficial</label>
                    <input type="text" class="form-control @error('official_language') is-invalid @enderror" id="official_language" name="official_language" value="{{ old('official_language', $country->official_language) }}">
                    @error('official_language')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="independence_year" class="form-label">Ano de Independência</label>
                    <input type="number" class="form-control @error('independence_year') is-invalid @enderror" id="independence_year" name="independence_year" value="{{ old('independence_year', $country->independence_year) }}" min="1000" max="{{ date('Y') }}">
                    @error('independence_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="gdp" class="form-label">PIB (US$)</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" class="form-control @error('gdp') is-invalid @enderror" id="gdp" name="gdp" value="{{ old('gdp', $country->gdp) }}" min="0">
                        <span class="input-group-text">.00</span>
                    </div>
                    @error('gdp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="hdi" class="form-label">IDH</label>
                    <input type="number" step="0.001" class="form-control @error('hdi') is-invalid @enderror" id="hdi" name="hdi" value="{{ old('hdi', $country->hdi) }}" min="0" max="1">
                    @error('hdi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="ilo_conventions" class="form-label">Convenções OIT *</label>
                    <input type="number" class="form-control @error('ilo_conventions') is-invalid @enderror" id="ilo_conventions" name="ilo_conventions" value="{{ old('ilo_conventions', $country->ilo_conventions) }}" min="0" required>
                    @error('ilo_conventions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="hazardous_activities_approval_year" class="form-label">Ano Aprovação Actividades</label>
                    <input type="number" class="form-control @error('hazardous_activities_approval_year') is-invalid @enderror" id="hazardous_activities_approval_year" name="hazardous_activities_approval_year" value="{{ old('hazardous_activities_approval_year', $country->hazardous_activities_approval_year) }}" min="1000" max="{{ date('Y') }}">
                    @error('hazardous_activities_approval_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="sst_legislation_robustness" class="form-label">Robustez Legislação SST</label>
                    <select class="form-select @error('sst_legislation_robustness') is-invalid @enderror" id="sst_legislation_robustness" name="sst_legislation_robustness">
                        <option value="Fraca" @selected(old('sst_legislation_robustness', $country->sst_legislation_robustness) == 'Fraca')>Fraca</option>
                        <option value="Moderada" @selected(old('sst_legislation_robustness', $country->sst_legislation_robustness) == 'Moderada')>Moderada</option>
                        <option value="Forte" @selected(old('sst_legislation_robustness', $country->sst_legislation_robustness) == 'Forte')>Forte</option>
                    </select>
                    @error('sst_legislation_robustness')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="education_level" class="form-label">Nível de Escolaridade</label>
                    <select class="form-select @error('education_level') is-invalid @enderror" id="education_level" name="education_level">
                        <option value="Baixo" @selected(old('education_level', $country->education_level) == 'Baixo')>Baixo</option>
                        <option value="Médio" @selected(old('education_level', $country->education_level) == 'Médio')>Médio</option>
                        <option value="Alto" @selected(old('education_level', $country->education_level) == 'Alto')>Alto</option>
                    </select>
                    @error('education_level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="youth_percentage" class="form-label">% População Jovem</label>
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control @error('youth_percentage') is-invalid @enderror" id="youth_percentage" name="youth_percentage" value="{{ old('youth_percentage', $country->youth_percentage) }}" min="0" max="100">
                        <span class="input-group-text">%</span>
                    </div>
                    @error('youth_percentage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="children_percentage" class="form-label">% População Criança</label>
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control @error('children_percentage') is-invalid @enderror" id="children_percentage" name="children_percentage" value="{{ old('children_percentage', $country->children_percentage) }}" min="0" max="100">
                        <span class="input-group-text">%</span>
                    </div>
                    @error('children_percentage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="gdp_contributing_sectors" class="form-label">Sectores que mais contribuem para o PIB</label>
                    <textarea class="form-control @error('gdp_contributing_sectors') is-invalid @enderror" id="gdp_contributing_sectors" name="gdp_contributing_sectors" rows="2">{{ old('gdp_contributing_sectors', $country->gdp_contributing_sectors) }}</textarea>
                    @error('gdp_contributing_sectors')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="employment_sectors" class="form-label">Sectores que mais empregam</label>
                    <textarea class="form-control @error('employment_sectors') is-invalid @enderror" id="employment_sectors" name="employment_sectors" rows="2">{{ old('employment_sectors', $country->employment_sectors) }}</textarea>
                    @error('employment_sectors')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="lni lni-save me-2"></i>Actualizar País
                </button>
                <a href="{{ route('countries.index') }}" class="btn btn-outline-secondary px-4">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection