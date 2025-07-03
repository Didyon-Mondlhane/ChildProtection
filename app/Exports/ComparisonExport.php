<?php

namespace App\Exports;

use App\Models\Comparison;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ComparisonExport implements FromCollection, WithHeadings, WithMapping
{
    protected $comparison;

    public function __construct(Comparison $comparison)
    {
        $this->comparison = $comparison;
    }

    public function collection()
    {
        $allActivities = collect();
        
        foreach ($this->comparison->country1->activities as $activity) {
            $allActivities->push([
                'activity' => $activity,
                'country1' => 'Sim',
                'country2' => $this->comparison->country2->activities->contains($activity) ? 'Sim' : 'Não'
            ]);
        }
        
        foreach ($this->comparison->country2->activities as $activity) {
            if (!$allActivities->where('activity.id', $activity->id)->count()) {
                $allActivities->push([
                    'activity' => $activity,
                    'country1' => 'Não',
                    'country2' => 'Sim'
                ]);
            }
        }
        
        return $allActivities;
    }

    public function headings(): array
    {
        return [
            'Atividade',
            'Setor',
            $this->comparison->country1->name,
            $this->comparison->country2->name
        ];
    }

    public function map($item): array
    {
        return [
            $item['activity']->name,
            $item['activity']->sector->name,
            $item['country1'],
            $item['country2']
        ];
    }
}