<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Comparison;
use App\Models\ProhibitedActivity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\ComparisonExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sector;

class ComparisonController extends Controller
{
    public function index()
    {
        $comparisons = Comparison::with(['country1', 'country2'])
            ->latest()
            ->paginate(10);
            
        $countries = Country::orderBy('name')->get();
        
        return view('comparisons.index', compact('comparisons', 'countries'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();
        return view('comparisons.create', compact('countries'));
    }

    public function store(Request $request)
    {

        if ($request['country1_id'] == $request['country2_id']) {
            $message = 'Não é possível comparar um país com ele mesmo.';
    
            return redirect()
                ->back()
                ->with('error', $message);
        }    

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'country1_id' => [
                'required',
                'exists:countries,id',
                Rule::notIn([$request->country2_id])
            ],
            'country2_id' => [
                'required',
                'exists:countries,id',
                Rule::notIn([$request->country1_id])
            ],
            'comments' => 'nullable|string',
        ]);

        $comparisonData = $this->prepareComparisonData(
            $validated['country1_id'],
            $validated['country2_id']
        );

        $existingComparison = Comparison::where(function($query) use ($validated) {
            $query->where('country1_id', $validated['country1_id'])
                ->where('country2_id', $validated['country2_id']);
        })->orWhere(function($query) use ($validated) {
            $query->where('country1_id', $validated['country2_id'])
                ->where('country2_id', $validated['country1_id']);
        })->first();

        if ($existingComparison) {
            $existingComparison->update([
                'name' => $validated['name'],
                'comments' => $validated['comments'] ?? $existingComparison->comments,
                'comparison_data' => $comparisonData,
            ]);
            
            $message = 'Comparação actualizada com sucesso!';
            $comparison = $existingComparison;
        } else {
            $comparison = Comparison::create([
                'name' => $validated['name'],
                'country1_id' => $validated['country1_id'],
                'country2_id' => $validated['country2_id'],
                'comments' => $validated['comments'] ?? null,
                'parameters' => [],
                'comparison_data' => $comparisonData,
            ]);
            
            $message = 'Comparação criada com sucesso!';
        }

        return redirect()
            ->route('comparisons.show', $comparison)
            ->with('success', $message);
    }

    public function show(Comparison $comparison)
    {
        $comparison->load(['country1.activities', 'country2.activities']);
        
        return view('comparisons.show', [
            'comparison' => $comparison,
            'differences' => $this->getDifferences($comparison),
            'similarities' => $this->getSimilarities($comparison),
            'activities' => ProhibitedActivity::with('sector')->get()
        ]);
    }

    public function update(Request $request, Comparison $comparison)
    {
        $comparison->update([
            'comments' => $request->comments
        ]);
        
        return back()->with('success', 'Comentários actualizados!');
    }

    public function destroy(Comparison $comparison)
    {
        $comparison->delete();
        return redirect()->route('comparisons.index')->with('success', 'Comparação removida!');
    }

    protected function prepareComparisonData($country1Id, $country2Id): array
    {
        $country1 = Country::with('activities')->find($country1Id);
        $country2 = Country::with('activities')->find($country2Id);

        return [
            'summary' => [
                'countries' => [
                    $country1->id => [
                        'name' => $country1->name,
                        'gdp' => $country1->gdp,
                        'hdi' => $country1->hdi,
                        'activities_count' => $country1->activities->count()
                    ],
                    $country2->id => [
                        'name' => $country2->name,
                        'gdp' => $country2->gdp,
                        'hdi' => $country2->hdi,
                        'activities_count' => $country2->activities->count()
                    ]
                ],
                'exclusive_activities' => [
                    $country1->id => $country1->activities->pluck('id')->toArray(),
                    $country2->id => $country2->activities->pluck('id')->toArray()
                ],
                'common_activities' => $country1->activities->pluck('id')->intersect(
                    $country2->activities->pluck('id')
                )->toArray()
            ],
            'compared_at' => now()->toDateTimeString()
        ];
    }

    protected function getDifferences(Comparison $comparison): array
    {
        $country1Activities = $comparison->country1->activities;
        $country2Activities = $comparison->country2->activities;

        return [
            'country1' => $country1Activities->diff($country2Activities),
            'country2' => $country2Activities->diff($country1Activities)
        ];
    }

    protected function getSimilarities(Comparison $comparison)
    {
        return $comparison->country1->activities->intersect($comparison->country2->activities);
    }

    public function export($id, $format)
    {
        $comparison = Comparison::with([
            'country1.activities.sector', 
            'country2.activities.sector',
            'country1' => function($query) {
                $query->withCount('activities');
            },
            'country2' => function($query) {
                $query->withCount('activities');
            }
        ])->findOrFail($id);

        $sectors = Sector::orderBy('name')->get();

        $comparison->country1->child_population = $comparison->country1->children_percentage ?? null;
        $comparison->country1->ilo_conventions = $comparison->country1->ilo_conventions ?? null;
        $comparison->country1->prohibited_year = $comparison->country1->hazardous_activities_approval_year ?? null;
        $comparison->country1->sst_legislation = $comparison->country1->sst_legislation_robustness ?? null;
        $comparison->country1->schooling_years = $comparison->country1->education_level ?? null;
        $comparison->country1->main_sectors = $comparison->country1->gdp_contributing_sectors ?? null;

        $comparison->country2->child_population = $comparison->country2->children_percentage ?? null;
        $comparison->country2->ilo_conventions = $comparison->country2->ilo_conventions ?? null;
        $comparison->country2->prohibited_year = $comparison->country2->hazardous_activities_approval_year ?? null;
        $comparison->country2->sst_legislation = $comparison->country2->sst_legislation_robustness ?? null;
        $comparison->country2->schooling_years = $comparison->country2->education_level ?? null;
        $comparison->country2->main_sectors = $comparison->country2->gdp_contributing_sectors ?? null;

        if ($format === 'excel') {
            return Excel::download(new ComparisonExport($comparison, $sectors), $comparison->name.'.xlsx');
        }

        if ($format === 'pdf') {
            $pdf = PDF::loadView('exports.comparison-pdf', compact('comparison', 'sectors'));
            return $pdf->download($comparison->name.'.pdf');
        }

        return back()->with('error', 'Formato de exportação inválido');
    }

}