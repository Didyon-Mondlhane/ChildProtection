<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CountryActivity;
use App\Models\ProhibitedActivity;
use Illuminate\Http\Request;

class CountryActivityController extends Controller
{
    public function index()
    {
        $countryActivities = CountryActivity::orderBy('country_id')->paginate(10);
        return view('country_activities.index', compact('countryActivities'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $activities = ProhibitedActivity::with('sector')->orderBy('name')->get();
        return view('country_activities.create', compact('countries', 'activities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'prohibited_activity_id' => 'required|exists:prohibited_activities,id',
            'indicators' => 'nullable|json',
        ]);

        $exists = CountryActivity::where('country_id', $request->country_id)
            ->where('prohibited_activity_id', $request->prohibited_activity_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Esta actividade já está atribuída a este país.');
        }

        CountryActivity::create($validated);
        return redirect()->route('country_activities.index')->with('success', 'Actividade do país atribuída com sucesso.');
    }

    public function show($id)
    {
        $countryActivity = CountryActivity::findOrFail($id);
        return view('country-activities.show', compact('countryActivity'));
    }

    public function edit($id)
    {
        $countryActivity = CountryActivity::findOrFail($id);
        $countries = Country::orderBy('name')->get();
        $activities = ProhibitedActivity::with('sector')->orderBy('name')->get();
        return view('country_activities.edit', compact('countryActivity', 'countries', 'activities'));
    }

    public function update(Request $request, $id)
    {
        $countryActivity = CountryActivity::findOrFail($id);
        
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'prohibited_activity_id' => 'required|exists:prohibited_activities,id',
            'indicators' => 'nullable|json',
        ]);

        $exists = CountryActivity::where('country_id', $request->country_id)
            ->where('prohibited_activity_id', $request->prohibited_activity_id)
            ->where('id', '!=', $countryActivity->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Esta actividade já está atribuída a este país noutro registo.');
        }

        $countryActivity->update($validated);
        return redirect()->route('country_activities.index')->with('success', 'Actividade do país actualizada com sucesso.');
    }

    public function destroy($id)
    {
        $countryActivity = CountryActivity::findOrFail($id);
        $countryActivity->delete();
        return redirect()->route('country_activities.index')->with('success', 'Actividade do país removida com sucesso.');
    }
}