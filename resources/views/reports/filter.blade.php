@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Résultats du filtrage</h1>
                <div class="card">
                    <div class="card-header">Liste des rapports de prospection
                        @if($reports->count() > 0)
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <form action="{{ route('reports.export') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                    <button type="submit" class="btn btn-success float-end">Exporter vers Excel</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($reports->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom de l'agent</th>
                                    <th>Nom du client</th>
                                    <th>Adresse du client</th>
                                    <th>Date</th>
                                    <th>Heure de début</th>
                                    <th>Heure de fin</th>
                                    <th>Durée</th>
                                    <th>Produit</th>
                                    <th>Observations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $number = $number + 1 }}</td>
                                        <td>{{ $report->agent_name }}</td>
                                        <td>{{ $report->client_name }}</td>
                                        <td>{{ $report->client_address }}</td>
                                        <td>{{ $report->date }}</td>
                                        <td>{{ $report->start_time }}</td>
                                        <td>{{ $report->end_time }}</td>
                                        <td>{{ $report->duration }} minutes</td>
                                        <td>{{ $report->product }}</td>
                                        <td>{{ $report->observations }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>Aucun prospect trouvé pour la période sélectionnée.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
