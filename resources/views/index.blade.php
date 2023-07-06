@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tableau de bord</h1>
    <br>
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
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Nombre total de prospects</h5>
                    <p class="card-text">{{ $prospects->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Ventes conclues</h5>
                    <p class="card-text">{{ $totalSales->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>

<div class="container">
    <div class="row">
        
                        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liste des prospects
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#myModal">
                        Nouveau prospect
                    </button>
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><strong>Nouveau prospect</strong></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('prospects.store') }}">
                                    @csrf
        
                                    <div class="form-group">
                                        <label for="agent_name"><strong>Nom de l'agent commercial :</strong></label>
        
                                        <div class="col-md-12">
                                            <input id="agent_name" type="text" class="form-control @error('agent_name') is-invalid @enderror" name="agent_name" value="{{ old('agent_name') }}" required autofocus>
        
                                            @error('agent_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <br>

                                    <div class="form-group">
                                        <label for="client_name"><strong>Nom du client :</strong></label>
        
                                        <div class="col-md-12">
                                            <input id="client_name" type="text" class="form-control @error('client_name') is-invalid @enderror" name="client_name" value="{{ old('client_name') }}" required>
        
                                            @error('client_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <br>

                                    <div class="form-group">
                                        <label for="client_address"><strong>Adresse du client :</strong></label>
        
                                        <div class="col-md-12">
                                            <input id="client_address" type="text" class="form-control @error('client_address') is-invalid @enderror" name="client_address" value="{{ old('client_address') }}" required>
        
                                            @error('client_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <br>

                                    <div class="form-group">
                                        <label for="date"><strong>Date :</strong></label>
        
                                        <div class="col-md-12">
                                            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
        
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <br>

                                    <div class="form-group">
                                        <label for="start_time"><strong>Heure de début :</strong></label>
        
                                        <div class="col-md-12">
                                            <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" onchange="calculateDuration()" value="{{ old('start_time') }}" required>
        
                                            @error('start_time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <br>

                                    <div class="form-group">
                                        <label for="end_time"><strong>Heure de fin :</strong></label>
        
                                        <div class="col-md-12">
                                            <input id="end_time" type="time" onchange="calculateDuration()" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" required>
        
                                            @error('end_time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label for="duration"><strong>Duration :</strong></label>

                                        <div class="col-md-12">
                                            <input id="duration" type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" readonly>
        
                                            @error('duration')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <br>

                                    <div class="form-group">
                                        <label for="product"><strong>Produit présenté :</strong></label>
        
                                        <div class="col-md-12">
                                            <select id="product" class="form-control @error('product') is-invalid @enderror" name="product" required>
                                                <option value="">Sélectionner un produit</option>
                                                <option value="Produit 1">Produit 1</option>
                                                <option value="Produit 2">Produit 2</option>
                                                <option value="Produit 3">Produit 3</option>
                                            </select>
        
                                            @error('product')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <br>

                                    <div class="form-group">
                                        <label for="observations"><strong>Observations du client :</strong></label>
        
                                        <div class="col-md-12">
                                            <textarea id="observations" class="form-control @error('observations') is-invalid @enderror" name="observations">{{ old('observations') }}</textarea>
        
                                            @error('observations')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <br>

                                    <div class="form-group">
                                        <label for="sale_concluded"><strong>Vente conclue :</strong></label>
        
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sale_concluded" id="sale_concluded" value="1" {{ old('sale_concluded') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="sale_concluded">
                                                    Oui
                                                </label>
                                            </div>
        
                                            @error('sale_concluded')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <br>
        
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>            
                            </div>
                        </div>
                        </div>
                    </div>
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
                                <th>Vente conclue</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prospects as $prospect)
                                <tr>
                                    <td>{{ $number = $number + 1 }}</td>
                                    <td>{{ $prospect->agent_name }}</td>
                                    <td>{{ $prospect->client_name }}</td>
                                    <td>{{ $prospect->client_address }}</td>
                                    <td>{{ $prospect->date }}</td>
                                    <td>{{ $prospect->start_time }}</td>
                                    <td>{{ $prospect->end_time }}</td>
                                    <td>{{ $prospect->duration }} minutes</td>
                                    <td>{{ $prospect->product }}</td>
                                    <td>{{ $prospect->observations }}</td>
                                    <td>{{ $prospect->sale_concluded ? 'Oui' : 'Non' }}</td>
                                    <td>
                                        <div class="d-flex">
                                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#update_prospect{{ $prospect->id }}">
                                            Modifier
                                        </button>
                                        <div class="modal fade" id="update_prospect{{ $prospect->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><strong>Modifier ce prospect</strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('prospect_update', ['id' => $prospect->id]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="agent_name"><strong>Nom de l'agent commercial :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <input id="agent_name" type="text" value="{{ $prospect->agent_name }}" class="form-control @error('agent_name') is-invalid @enderror" name="agent_name" value="{{ old('agent_name') }}" required autofocus>
                                
                                                                    @error('agent_name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <br>

                                                            <div class="form-group">
                                                                <label for="client_name"><strong>Nom du client :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <input id="client_name" type="text" value="{{ $prospect->client_name }}" class="form-control @error('client_name') is-invalid @enderror" name="client_name" value="{{ old('client_name') }}" required>
                                
                                                                    @error('client_name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <br>

                                                            <div class="form-group">
                                                                <label for="client_address"><strong>Adresse du client :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <input id="client_address" type="text" value="{{ $prospect->client_address }}" class="form-control @error('client_address') is-invalid @enderror" name="client_address" value="{{ old('client_address') }}" required>
                                
                                                                    @error('client_address')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <br>

                                                            <div class="form-group">
                                                                <label for="date"><strong>Date :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <input id="date" type="date" value="{{ $prospect->date }}" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                                
                                                                    @error('date')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <br>

                                                            <div class="form-group">
                                                                <label for="start_time"><strong>Heure de début :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <input id="start_time" type="time" value="{{ $prospect->start_time }}" class="form-control @error('start_time') is-invalid @enderror" name="start_time" onchange="calculateDuration()" value="{{ old('start_time') }}" required>
                                
                                                                    @error('start_time')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <br>

                                                            <div class="form-group">
                                                                <label for="end_time"><strong>Heure de fin :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <input id="end_time" type="time" value="{{ $prospect->end_time }}" onchange="calculateDuration()" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" required>
                                
                                                                    @error('end_time')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                    
                                                            <br>

                                                            <div class="form-group">
                                                                <label for="duration"><strong>Duration :</strong></label>
                    
                                                                <div class="col-md-12">
                                                                    <input id="duration" type="text" value="{{ $prospect->duration }}" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" readonly>
                                
                                                                    @error('duration')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <br>

                                                            <div class="form-group">
                                                                <label for="product"><strong>Produit présenté :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <select id="product" value="{{ $prospect->product }}" class="form-control @error('product') is-invalid @enderror" name="product" required>
                                                                        <option value="">Sélectionner un produit</option>
                                                                        <option value="Produit 1">Produit 1</option>
                                                                        <option value="Produit 2">Produit 2</option>
                                                                        <option value="Produit 3">Produit 3</option>
                                                                    </select>
                                
                                                                    @error('product')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <br>
                                
                                                            <div class="form-group">
                                                                <label for="observations"><strong>Observations du client :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <textarea id="observations" value="{{ $prospect->observations }}" class="form-control @error('observations') is-invalid @enderror" name="observations">{{ old('observations') }}</textarea>
                                
                                                                    @error('observations')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <br>

                                                            <div class="form-group">
                                                                <label for="sale_concluded"><strong>Vente conclue :</strong></label>
                                
                                                                <div class="col-md-12">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="{{ $prospect->sale_concluded }}" name="sale_concluded" id="sale_concluded" value="1" {{ old('sale_concluded') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="sale_concluded">
                                                                            Oui
                                                                        </label>
                                                                    </div>
                                
                                                                    @error('sale_concluded')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#destroy_prospect{{ $prospect->id }}">
                                            Supprimer
                                        </button>
                                        <div class="modal fade" id="destroy_prospect{{ $prospect->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer cette categorie</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <form action="{{ route('prospect_destroy', ['id' => $prospect->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <p>Etes-vous sure de vouloir supprimer ce prospect?</p>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Supprimer</button>
                                                        </div>
                                                      </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function calculateDuration() {
            var startTimeInput = document.getElementById('start_time');
            var endTimeInput = document.getElementById('end_time');
            var durationInput = document.getElementById('duration');

            var startTime = startTimeInput.valueAsDate;
            var endTime = endTimeInput.valueAsDate;

            if (startTime && endTime) {
                var difference = endTime.getTime() - startTime.getTime();
                var duration = difference / 60000;
                durationInput.value = duration.toFixed(2);
            } else {
            durationInput.value = '';
            }
        }
    </script>
@endsection


