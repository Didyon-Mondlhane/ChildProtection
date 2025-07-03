<?php

namespace App\Http\Controllers;

use App\Models\ProhibitedActivity;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProhibitedActivityController extends Controller
{

    public function index(Request $request)
    {
        $query = ProhibitedActivity::with(['sector', 'countries'])->withCount('countries');

        // Filtros
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('justification', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('sector')) {
            $query->where('sector_id', $request->sector);
        }

        if ($request->filled('min_countries')) {
            $query->having('countries_count', '>=', $request->min_countries);
        }

        // Ordenação (opcional, com campos permitidos)
        $allowedSortFields = ['name', 'countries_count'];
        $sortField = in_array($request->get('sort'), $allowedSortFields) ? $request->get('sort') : 'name';
        $sortDirection = $request->get('direction') === 'desc' ? 'desc' : 'asc';

        $query->orderBy($sortField, $sortDirection);

        $activities = $query->paginate(10)->appends($request->query());
        $sectors = \App\Models\Sector::orderBy('name')->get();

        return view('prohibited_activities.index', compact('activities', 'sectors'));
    }


    public function create()
    {
        $sectors = Sector::orderBy('name')->get();
        return view('prohibited_activities.create', compact('sectors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sector_id' => 'required|exists:sectors,id',
            'name' => 'required|string|max:200|unique:prohibited_activities',
            'description' => 'required|string',
            'justification' => 'required|string',
        ]);

        ProhibitedActivity::create($validated);
        return redirect()->route('prohibited_activities.index')->with('success', 'Actividade proibida criada com sucesso.');
    }

    public function show($id)
    {
        $prohibitedActivity = ProhibitedActivity::with(['countries' => function($query) {
            $query->orderBy('name');
        }])->findOrFail($id);

        return view('prohibited_activities.show', compact('prohibitedActivity'));
    }

    public function edit($id)
    {
        $prohibitedActivity = ProhibitedActivity::findOrFail($id);
        $sectors = Sector::orderBy('name')->get();
        return view('prohibited_activities.edit', compact('prohibitedActivity', 'sectors'));
    }

    public function update(Request $request, $id)
    {
        $prohibitedActivity = ProhibitedActivity::findOrFail($id);
        
        $validated = $request->validate([
            'sector_id' => 'required|exists:sectors,id',
            'name' => ['required', 'string', 'max:200'],
            'description' => 'required|string',
            'justification' => 'required|string',
        ]);

        $prohibitedActivity->update($validated);
        return redirect()->route('prohibited_activities.index')->with('success', 'Actividade proibida actualizada com sucesso.');
    }

    public function destroy($id)
    {
        $prohibitedActivity = ProhibitedActivity::findOrFail($id);
        
        if ($prohibitedActivity->countries()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível apagar esta actividade porque está associada a países.');
        }
        
        $prohibitedActivity->delete();
        return redirect()->route('prohibited_activities.index')->with('success', 'Actividade proibida eliminada com sucesso.');
    }
}