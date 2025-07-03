<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::orderBy('name')->paginate(10);
        return view('sectors.index', compact('sectors'));
    }

    public function create()
    {
        return view('sectors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:sectors',
            'description' => 'nullable|string',
        ]);

        Sector::create($validated);
        return redirect()->route('sectors.index')->with('success', 'Sector criado com sucesso.');
    }

    public function show($id)
    {
        $sector = Sector::findOrFail($id);
        return view('sectors.show', compact('sector'));
    }

    public function edit($id)
    {
        $sector = Sector::findOrFail($id);
        return view('sectors.edit', compact('sector'));
    }

    public function update(Request $request, $id)
    {
        $sector = Sector::findOrFail($id);
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('sectors')->ignore($sector->id)],
            'description' => 'nullable|string',
        ]);

        $sector->update($validated);
        return redirect()->route('sectors.index')->with('success', 'Sector actualizado com sucesso.');
    }

    public function destroy($id)
    {
        $sector = Sector::findOrFail($id);
        if ($sector->prohibitedActivities()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível apagar este sector porque existem actividades associadas a ele.');
        }
        $sector->delete();
        return redirect()->route('sectors.index')->with('success', 'Sector eliminado com sucesso.');
    }
}