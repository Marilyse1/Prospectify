@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Rapports de prospection</h1>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('home') }}" class="text-decoration-none">Liste des prospects</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('reports.index') }}" class="text-decoration-none">Rapports de prospection</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Filtres
                </div>
                <div class="card-body">
                    <form action="{{ route('reports.filter') }}" method="GET" class="form-inline">
                        <div class="form-group mr-2">
                            <label for="start_date">Date de début :</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="end_date">Date de fin :</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>

                        <br>

                        <button type="submit" class="btn btn-primary ml-2">Filtrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liste des rapports de prospection
                </div>
                <div class="card-body">
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
                            @foreach($reports as $report)
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
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
