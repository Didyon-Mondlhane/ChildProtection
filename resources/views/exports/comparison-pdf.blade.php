<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comparação: {{ $comparison->name }} - Protecção Infantil</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            line-height: 1.5; 
            margin: 0;
            padding: 0;
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
            border-bottom: 2px solid #333; 
            padding-bottom: 10px; 
            width: 100vw;
            box-sizing: border-box;
            padding: 0 20px;
        }
        .title { 
            font-size: 20px; 
            font-weight: bold; 
            color: #2c3e50; 
        }
        .subtitle { 
            font-size: 14px; 
            color: #7f8c8d; 
        }
        .countries-container { 
            display: flex; 
            width: 100vw;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .country { 
            box-sizing: border-box;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            page-break-inside: avoid;
        }
        .country-1 { 
            width: 50vw;
            border-top: 4px solid #3498db;
            margin-right: 10px;
        }
        .country-2 { 
            width: 50vw;
            border-top: 4px solid #2ecc71;
            margin-right: 10px;
        }
        .country-header { 
            background-color: #f8f9fa; 
            padding: 10px; 
            font-weight: bold; 
            text-align: center; 
            font-size: 14px; 
            margin: -15px -15px 15px -15px; 
            border-bottom: 1px solid #eee; 
        }
        .country-1 .country-header { 
            background-color: #3498db; 
            color: white; 
        }
        .country-2 .country-header { 
            background-color: #2ecc71; 
            color: white; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            font-size: 11px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #f8f9fa; 
            font-weight: bold; 
        }
        .section { 
            margin-top: 30px; 
            page-break-inside: avoid; 
            width: 100vw;
            box-sizing: border-box;
            padding: 0 20px;
        }
        .section-title { 
            font-weight: bold; 
            margin-bottom: 10px; 
            font-size: 14px; 
            color: #2c3e50; 
            border-bottom: 1px solid #eee; 
            padding-bottom: 5px; 
        }
        .footer { 
            margin-top: 30px; 
            font-size: 10px; 
            text-align: center; 
            color: #7f8c8d; 
            border-top: 1px solid #eee; 
            padding-top: 10px; 
            width: 100vw;
            box-sizing: border-box;
        }
        .stats-grid { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 10px; 
            margin-top: 10px; 
        }
        .stat-item { 
            margin-bottom: 8px; 
        }
        .badge { 
            padding: 3px 6px; 
            border-radius: 3px; 
            font-size: 10px; 
            font-weight: bold; 
        }
        .badge-present { 
            background-color: #2ecc71; 
            color: white; 
        }
        .badge-absent { 
            background-color: #e74c3c; 
            color: white; 
        }
        .activity-justification { 
            font-size: 10px; 
            color: #7f8c8d; 
            margin-top: 3px; 
            font-style: italic; 
        }
        .signature { 
            margin-top: 30px; 
            text-align: right; 
            font-style: italic; 
            width: 100vw;
            box-sizing: border-box;
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Relatório de Comparação: {{ $comparison->name }}</div>
        <div class="subtitle">Protecção Infantil em Actividades Laborais Perigosas | Gerado em {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <div class="countries-container">
        <div class="country country-1">
            <div class="country-header">{{ $comparison->country1->name }}</div>
            <div class="stats-grid">
                <div class="stat-item"><strong>Continente:</strong> {{ $comparison->country1->continent ?? 'N/A' }}</div>
                <div class="stat-item"><strong>PIB:</strong> ${{ number_format($comparison->country1->gdp, 2) }}</div>
                <div class="stat-item"><strong>IDH:</strong> {{ $comparison->country1->hdi ?? 'N/A' }}</div>
                <div class="stat-item"><strong>População infantil:</strong> {{ $comparison->country1->child_population ?? 'N/A' }}%</div>
                <div class="stat-item"><strong>Convenções OIT:</strong> {{ $comparison->country1->ilo_conventions ?? 'N/A' }}</div>
                <div class="stat-item"><strong>Ano lista actividades:</strong> {{ $comparison->country1->prohibited_year ?? 'N/A' }}</div>
                <div class="stat-item"><strong>Legislação SST:</strong> {{ $comparison->country1->sst_legislation ?? 'N/A' }}</div>
                <div class="stat-item"><strong>Nível de Escolaridade:</strong> {{ $comparison->country1->schooling_years ?? 'N/A' }} </div>
            </div>
            <p><strong>Actividades Proibidas:</strong> {{ $comparison->country1->activities->count() }}</p>
            <p><strong>Sectores económicos principais:</strong> {{ $comparison->country1->main_sectors ?? 'N/A' }}</p>
        </div>
        <br><br>
        <div class="country country-2">
            <div class="country-header">{{ $comparison->country2->name }}</div>
            <div class="stats-grid">
                <div class="stat-item"><strong>Continente:</strong> {{ $comparison->country2->continent ?? 'N/A' }}</div>
                <div class="stat-item"><strong>PIB:</strong> ${{ number_format($comparison->country2->gdp, 2) }}</div>
                <div class="stat-item"><strong>IDH:</strong> {{ $comparison->country2->hdi ?? 'N/A' }}</div>
                <div class="stat-item"><strong>População infantil:</strong> {{ $comparison->country2->child_population ?? 'N/A' }}%</div>
                <div class="stat-item"><strong>Convenções OIT:</strong> {{ $comparison->country2->ilo_conventions ?? 'N/A' }}</div>
                <div class="stat-item"><strong>Ano lista actividades:</strong> {{ $comparison->country2->prohibited_year ?? 'N/A' }}</div>
                <div class="stat-item"><strong>Legislação SST:</strong> {{ $comparison->country2->sst_legislation ?? 'N/A' }}</div>
                <div class="stat-item"><strong>Nível de Escolaridade:</strong> {{ $comparison->country2->schooling_years ?? 'N/A' }} </div>
            </div>
            <p><strong>Actividades Proibidas:</strong> {{ $comparison->country2->activities->count() }}</p>
            <p><strong>Sectores económicos principais:</strong> {{ $comparison->country2->main_sectors ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Resumo Comparativo</div>
        <table>
            <thead>
                <tr>
                    <th>Indicador</th>
                    <th>{{ $comparison->country1->name }}</th>
                    <th>{{ $comparison->country2->name }}</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Actividades Proibidas</td>
                    <td>{{ $comparison->country1->activities->count() }}</td>
                    <td>{{ $comparison->country2->activities->count() }}</td>
                    <td>Total de atividades consideradas perigosas</td>
                </tr>
                <tr>
                    <td>Convenções OIT Assinadas</td>
                    <td>{{ $comparison->country1->ilo_conventions ?? 'N/A' }}</td>
                    <td>{{ $comparison->country2->ilo_conventions ?? 'N/A' }}</td>
                    <td>Número de convenções sobre trabalho infantil</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Actividades Proibidas - Comparação Detalhada</div>
        <table>
            <thead>
                <tr>
                    <th>Actividade</th>
                    <th>Sector</th>
                    <th>{{ $comparison->country1->name }}</th>
                    <th>{{ $comparison->country2->name }}</th>
                    <th>Justificativa</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $allActivities = $comparison->country1->activities->merge($comparison->country2->activities)->unique('id')->sortBy('sector.name');
                @endphp
                @foreach($allActivities as $activity)
                <tr>
                    <td>{{ $activity->name }}</td>
                    <td>{{ $activity->sector->name }}</td>
                    <td>
                        <span class="badge @if($comparison->country1->activities->contains($activity)) badge-present @else badge-absent @endif">
                            {{ $comparison->country1->activities->contains($activity) ? 'PROIBIDA' : 'PERMITIDA' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge @if($comparison->country2->activities->contains($activity)) badge-present @else badge-absent @endif">
                            {{ $comparison->country2->activities->contains($activity) ? 'PROIBIDA' : 'PERMITIDA' }}
                        </span>
                    </td>
                    <td class="activity-justification">
                        {{ $activity->justification ?? 'Riscos físicos e psicológicos para crianças' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Análise por Sector Económico</div>
        <table>
            <thead>
                <tr>
                    <th>Sector</th>
                    <th>Actividades Proibidas em {{ $comparison->country1->name }}</th>
                    <th>Actividades Proibidas em {{ $comparison->country2->name }}</th>
                    <th>Actividades Comuns</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sectors as $sector)
                @php
                    $country1Count = $comparison->country1->activities->where('sector_id', $sector->id)->count();
                    $country2Count = $comparison->country2->activities->where('sector_id', $sector->id)->count();
                    $commonCount = $comparison->country1->activities->where('sector_id', $sector->id)
                        ->intersect($comparison->country2->activities->where('sector_id', $sector->id))
                        ->count();
                @endphp
                <tr>
                    <td>{{ $sector->name }}</td>
                    <td>{{ $country1Count }}</td>
                    <td>{{ $country2Count }}</td>
                    <td>{{ $commonCount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($comparison->comments)
    <div class="section">
        <div class="section-title">Análise e Comentários</div>
        <p>{{ $comparison->comments }}</p>
    </div>
    @endif

    <div class="signature">
        <p>_________________________________________</p>
        <p>Pedro Mondlhane</p>
        <p>Médico do Trabalho</p>
    </div>

    <div class="footer">
        <strong>Relatório gerado pelo Sistema de Monitoramento de Protecção Infantil - PJM © {{ date('Y') }}</strong>
    </div>
</body>
</html>