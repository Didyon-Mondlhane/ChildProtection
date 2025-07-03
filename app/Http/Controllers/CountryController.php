<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\ProhibitedActivity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{

    public function index(Request $request)
    {
        $query = Country::withCount('activities')->orderBy('name');

        if ($request->filled('continent')) {
            $query->where('continent', 'like', '%' . $request->continent . '%');
        }

        if ($request->filled('gdp_min')) {
            $query->where('gdp', '>=', $request->gdp_min);
        }

        if ($request->filled('hdi_min')) {
            $query->where('hdi', '>=', $request->hdi_min);
        }

        if ($request->filled('official_language')) {
            $query->where('official_language', 'like', '%' . $request->official_language . '%');
        }

        if ($request->filled('independence_year')) {
            $query->where('independence_year', $request->independence_year);
        }

        $countries = $query->paginate(10)->appends($request->query());

        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:countries',
            'continent' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'gdp' => 'nullable|numeric',
            'hdi' => 'nullable|numeric|between:0,1',
            'official_language' => 'nullable|string|max:50',
            'independence_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'ilo_conventions' => 'required|integer|min:0',
            'hazardous_activities_approval_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'sst_legislation_robustness' => 'nullable|string|max:20|in:Forte,Moderada,Fraca',
            'youth_percentage' => 'nullable|numeric|between:0,100',
            'children_percentage' => 'nullable|numeric|between:0,100',
            'gdp_contributing_sectors' => 'nullable|string',
            'employment_sectors' => 'nullable|string',
            'education_level' => 'nullable|string|max:50',
        ]);

        Country::create($validated);
        return redirect()->route('countries.index')->with('success', 'País criado com sucesso.');
    }

    public function show($id)
    {
        $country = Country::with(['activities' => function($query) {
            $query->with('sector');
        }])->findOrFail($id);

        return view('countries.show', compact('country'));
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'continent' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'gdp' => 'nullable|numeric',
            'hdi' => 'nullable|numeric|between:0,1',
            'official_language' => 'nullable|string|max:50',
            'independence_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'ilo_conventions' => 'required|integer|min:0',
            'hazardous_activities_approval_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'sst_legislation_robustness' => 'nullable|string|max:20|in:Forte,Moderada,Fraca',
            'youth_percentage' => 'nullable|numeric|between:0,100',
            'children_percentage' => 'nullable|numeric|between:0,100',
            'gdp_contributing_sectors' => 'nullable|string',
            'employment_sectors' => 'nullable|string',
            'education_level' => 'nullable|string|max:50',
        ]);

        $country->update($validated);
        return redirect()->route('countries.show', $country->id)->with('success', 'País actualizado com sucesso.');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        
        if ($country->activities()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível apagar este país porque existem actividades associadas a ele.');
        }

        if ($country->classifications()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível apagar este país porque existem classificações associadas a ele.');
        }
        
        $country->delete();
        return redirect()->route('countries.index')->with('success', 'País eliminado com sucesso.');
    }
}