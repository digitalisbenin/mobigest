
@extends('layouts.admin')
@section('title', 'Vente')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class=" mb-0 text-gray-800"> ENREGISTRER UNE VENTE</h5>

                        <div class" col d-flex">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#venteModal">
                                Vendre un Portable
                            </button>

                            <button type="button" class="btn btn-primary  mb-1" data-bs-toggle="modal" data-bs-target="#venteAccessoireModal">
                                Vendre un Accessoire
                            </button>





                        </div>

                    </div>




                    <!-- Content Row -->

                      <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-1">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    {{--  <h6 class="m-0 font-weight-bold text-primary">Filtrer les Articles</h6>  --}}

                                    <div class="col-md-12 d-flex align-items-center">
                                        <form method="GET" action="{{route('filtre-ventes')}}" class="d-flex  mt-3">

                                            <!-- Champ pour la date de début -->
                                            <div class="mb-1 me-1 mt-2  d-flex align-items-center">
                                                <label for="start_date" class="form-label mt-2 d-flex">DEBUT</label>
                                                <input type="date" class="form-control ml-2 me-3" id="start_date" name="start_date" value="{{ request('start_date') }}">
                                            </div>

                                            <!-- Champ pour la date de fin -->
                                            <div class="mb-1 me-3 mt-2 d-flex align-items-center">
                                                <label for="end_date" class="form-label mt-2 d-flex">FIN</label>
                                                <input type="date" class="form-control ml-2" id="end_date" name="end_date" value="{{ request('end_date') }}">
                                            </div>

                                            <!-- Champ pour la désignation -->
                                            <div class="mb-1 mt-2 me-3">

                                                <input type="text" class="form-control " id="designation" placeholder="Désignation..."  name="designation" value="{{ request('designation') }}" >
                                            </div>

                                            <!-- Champ pour l'IMEI -->
                                            <div class="mb-1 mt-2 me-3">

                                                <input type="text" class="form-control" id="imei" placeholder="IMEI..."  name="imei" value="{{ request('imei') }}">
                                            </div>

                                            <!-- Champ pour le client -->
                                            <div class="mb-1 mt-2 me-3">

                                                <input type="text" class="form-control" id="client" placeholder="Client..." name="client"  value="{{ request('client') }}" >
                                            </div>
                                            <div class="mb-1 mt-2 me-3">
                                                 <button type="submit" class="btn btn-primary ">Filtrer</button>
                                            </div>

                                            <!-- Bouton de soumission -->

                                        </form>
                                    </div>
                                     {{--  <button type="button"  class="btn btn-secondary " onclick="window.location='{{ url('ventes-articles') }}'">Réinitialiser</button>  --}}
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="table-responsive" style=" overflow-y: auto; height:350px;">
                                    <table id="tableVente" class="table table-bordered table-striped table-hover align-middle">
                                        <thead class="table-primary text-center">
                                            <tr style="white-space: nowrap;">
                                                <th>Date</th>
                                                <th>Désignation</th>
                                                <th>IMEI</th>
                                                <th>Couleur</th>
                                                <th>Capacité</th>

                                                <th>État</th>
                                                <th>Client</th>
                                                <th>Contact</th>
                                                {{--  <th>Prix Boutique</th>  --}}
                                                <th>Montant</th>
                                                <th>Espèces</th>
                                                <th>MoMo</th>
                                                <th>Reste</th>
                                                {{--  <th>Auteur(s)</th>  --}}
                                                <th>Date échéance</th>
                                                <th>Observations</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @if($venteArticle->isEmpty())
                                            <tr>
                                                <td colspan="13" class="text-center text-muted">Aucune donnée disponible</td>
                                            </tr>
                                        @else
                                        @foreach($venteArticle->sortByDesc('created_at') as $vente)
                                        <tr class="text-center" style=" white-space: nowrap;">
                                            <td>{{ \Carbon\Carbon::parse($vente->DateVente)->format('d-m-Y') }} {{ $vente->HeureVente }}</td>
                                            <td>{{ $vente->entreeArticle->articlee->Designation  }}</td>
                                            <td>{{ $vente->entreeArticle->IMEI ?? "-" }}</td>
                                            <td>{{ $vente->entreeArticle->Couleur ?? "-" }}</td>
                                            <td>{{ $vente->entreeArticle->Capacite ?? "-" }}</td>

                                            <td>{{ $vente->entreeArticle->Etat ?? "-" }}</td>
                                            <td>{{ $vente->NomClient }}</td>
                                            <td>{{ $vente->TelClient }}</td>
                                            {{--  <td >{{ number_format($vente ->entreeArticle->PrixVente, 0, ',', ' ') }} </td>  --}}
                                            <td class="montant">{{ number_format($vente->MontantVente, 0, ',', ' ') }} </td>
                                            <td class="espece">{{ number_format($vente->Espece, 0, ',', ' ') }} </td>
                                            <td class="momo">{{ number_format($vente->MoMo, 0, ',', ' ') }} </td>
                                            <td class="reste" >{{ number_format($vente->Reste, 0, ',', ' ') }} </td>
                                            <td>
                                                {{ $vente->DateEcheance ? \Carbon\Carbon::parse($vente->DateEcheance)->format('d-m-Y') : '-' }}
                                            </td>

                                            <td  >{{ $vente->Observations ?? "-" }} </td>

                                            {{--  <td>{{ $vente->usere->name }}</td>  --}}
                                            <td class="d-flex">


                                                @if($vente->entreeArticle->IMEI)
                                                <a href="#" class="btn btn-sm btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#modifierVenteModal{{ $vente->IDVente }}" data-bs-placement="top" title="Modifier vente Portable">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-sm btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modifierVenteAccessoireModal{{ $vente->IDVente }}" data-bs-placement="top" title="Modifier vente Accessoire">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @endif
                                                @if($vente->Reste > 0)
                                                <a href="#" class="btn btn-sm btn-secondary mx-2" data-bs-toggle="modal" data-bs-target="#annulerVenteModal{{ $vente->IDVente }}" data-bs-placement="top" title="Annuler la vente">
                                                    <i class="bi bi-cash"></i>
                                                    {{--  <i class="bi bi-wallet2"></i>  --}}
                                                </a>

                                                  <a href="#" class="btn btn-sm btn-warning mx-1" title="Imprimer" >
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-sm btn-secondary mx-2"  data-bs-placement="top" title="Annuler la vente"  >
                                                    <i class="bi bi-cash"></i>
                                                    {{--  <i class="bi bi-wallet2"></i>  --}}
                                                </a>
                                                 <a href="{{ route('decharge.downloads', $vente->IDVente) }}" target="blank" class="btn btn-sm btn-warning mx-1" title="Imprimer" >
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                                @endif
                                                {{--  <a href="#" class="btn btn-sm btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#annulerVenteModal{{ $vente->IDVente }}" data-bs-placement="top" title="Annuler la vente">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>  --}}


                                                <!-- Boutons d'action -->

                                                {{--  <button onclick="imprimerTable()" class="btn btn-warning">
                                                <i class="bi bi-printer"></i>
                                             </button>  --}}
                                               {{--  <button onclick="imprimerLigne(this)" class="btn btn-sm btn-warning mx-1" title="Imprimer">
                                                <i class="bi bi-printer"></i>
                                                </button>    --}}
                                                 {{--  <button onclick="imprimerLigneAvecEntete(this)" class="btn btn-sm btn-warning mx-1" title="Imprimer">
                                                    <i class="bi bi-printer"></i>
                                                </button>  --}}

                                            </td>
                                        </tr>




                    <div class="modal fade" id="annulerVenteModal{{ $vente->IDVente }}" tabindex="-1" aria-labelledby="annulerVenteModalLabel{{ $vente->IDVente }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="annulerVenteModalLabel{{ $vente->IDVente }}">CONFIRMATION DE L'ANNULATION </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('vente-articles/'.$vente->IDVente.'/updates', ) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">DESIGNATION</label>
                                            <input type="text" class="form-control" name="" id="" value="{{$vente->entreeArticle->articlee->Designation}}" disabled>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">DATE ANNULATION</label>
                                            <input type="date" class="form-control" name="DateAnnul" id="TelClient" value="" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">MOTIF ANNULATION</label>
                                        <textarea class="form-control" rows="3" name="CauseAnnulat" id="CauseAnnulat" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                        <button type="submit" class="btn btn-danger">Confirmer l'annulation</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




        <div class="modal fade" id="modifierVenteAccessoireModal{{ $vente->IDVente }}" tabindex="-1" aria-labelledby="modifierVenteAccessoireModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifierVenteAccessoireModalLabel">MODIFIER LA VENTE ACCESSOIRE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('vente-articles/'.$vente->IDVente.'/update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_vente" id="id_vente"> <!-- ID de la vente à modifier -->

                            <div class="row">
                                <div class="col-md-8 equal-height">
                                    <div class="card p-1 mb-1 h-90">
                                        <h5 class="text-primary">INFORMATIONS SUR L'ACCESSOIRE</h5>
                                        <div class="row">
                                            <div class="col-md-7 mb-3">
                                                <label class="form-label">ACCESSOIRES</label>
                                                <select class="form-select" id="IdEntree" name="IdEntree" disabled>
                                                    <option value="">Sélectionner un accessoire</option>
                                                    @foreach($entreeArticles as $article)
                                                        <option value="{{ $article->IdEntree }}"
                                                            @if(isset($vente) && $vente->IdEntree == $article->IdEntree) selected @endif>
                                                            {{ $article->articlee->Designation }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class=" col-md-5 mb-1">
                                                <label class="form-label">QUANTITE</label>
                                                <input type="number" class="form-control" name="quantite" id="DateVente" value="{{$vente->quantite}}">
                                            </div>

                                        </div>

                                        <h5 class="text-primary">INFORMATIONS CLIENT</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">NOM DU CLIENT</label>
                                                <input type="text" style="text-transform: uppercase;"  class="form-control" name="NomClient" id="NomClient" value="{{$vente->NomClient}}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">CONTACT(S)</label>
                                                <input type="number" class="form-control" name="TelClient" id="TelClient" value="{{$vente->TelClient}}">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">OBSERVATIONS</label>
                                            <textarea class="form-control"style="text-transform: uppercase;"  rows="4" name="Observations" id="Observations">{{$vente->Observations}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 equal-height">
                                    <div class="card p-1">
                                        <h5 class="text-primary">DÉTAILS DE VENTE</h5>

                                        <div class="mb-1">
                                            <label class="form-label">DATE VENTE</label>
                                            <input type="date" class="form-control" name="DateVente" id="DateVente" value="{{$vente->DateVente}}">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">PRIX VENTE</label>
                                            <input type="number" id="prixvente" class="form-control text-end" name="MontantVente" value="{{$vente->MontantVente}}" disabled>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">ESPÈCE PERÇU</label>
                                            <input type="number" class="form-control text-end" name="Espece" id="Espece" value="{{$vente->Espece}}" disabled>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">MoMo REÇU</label>
                                            <input type="number" class="form-control text-end" name="MoMo" id="MoMo" value="{{$vente->MoMo}}" disabled>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">RESTE</label>
                                            <input type="number" class="form-control text-end" name="Reste" id="Reste" value="{{$vente->Reste}}" disabled>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">ÉCHÉANCE</label>
                                            <input type="date" class="form-control" name="DateEcheance" id="DateEcheance" disabled>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100 mt-1">MODIFIER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




                            <!-- Modal Modifier Vente -->
                            <div class="modal fade" id="modifierVenteModal{{$vente->IDVente}}" tabindex="-1" aria-labelledby="modifierVenteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modifierVenteModalLabel">MODIFIER FICHE DE VENTE PORTABLE</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('vente-articles/'.$vente->IDVente.'/update') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT') <!-- Si tu méthode est PUT pour la mise à jour -->

                                                <div class="row">
                                                    <div class="col-md-8 equal-height">
                                                        <div class="card p-1 mb-1 h-90">
                                                            <h5 class="text-primary">INFORMATIONS CONCERNANT LE TELEPHONE</h5>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">IMEI</label>
                                                                    <input type="text" class="form-control" value="{{ $vente->entreeArticle->IMEI  }}" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">MODÈLE DE TÉLÉPHONE</label>
                                                                    <input type="text" class="form-control"  value="{{ $vente->entreeArticle->articlee->Designation  }}" readonly>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label class="form-label">COULEUR</label>
                                                                    <input type="text" class="form-control" value="{{ $vente->entreeArticle->Couleur  }}"  readonly>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label class="form-label">CAPACITÉ</label>
                                                                    <input type="text" class="form-control" value="{{ $vente->entreeArticle->Capacite  }}"  readonly>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label class="form-label">ÉTAT</label>
                                                                    <input type="text" class="form-control" value="{{ $vente->entreeArticle->Etat  }}"  readonly>
                                                                </div>




                                                            </div>


                                                            <h5 class="text-primary">INFORMATIONS CONCERNANT LE CLIENT</h5>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">NOM DU CLIENT</label>
                                                                    <input type="text"style="text-transform: uppercase;"  class="form-control" name="NomClient" value="{{ $vente->NomClient  }}" >
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">CONTACT(S)</label>
                                                                    <input type="number" class="form-control" name="TelClient" value="{{ $vente->TelClient  }}">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">OBSERVATIONS</label>
                                                                <textarea style="text-transform: uppercase;"  class="form-control" rows="4" name="Observations" >{{ $vente->Observations  }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 equal-height">
                                                        <div class="card p-1">
                                                            <h5 class="text-primary">DÉTAILS DE VENTE</h5>

                                                            <div class="mb-1">
                                                                <label class="form-label">DATE VENTE</label>
                                                                <input type="date" class="form-control" name="DateVente" value="{{ $vente->DateVente  }}">
                                                            </div>
                                                            <div class="mb-1">
                                                                <label class="form-label">PRIX VENTE</label>
                                                                <input type="number" id="prixvente" class="form-control text-end" name="MontantVente"  value="{{ $vente->MontantVente  }}" >
                                                            </div>
                                                            <div class="mb-1">
                                                                <label class="form-label">ESPÈCE PERÇU</label>
                                                                <input type="number" class="form-control text-end"  name="Espece" value="{{ $vente->Espece  }}" >
                                                            </div>
                                                            <div class="mb-1">
                                                                <label class="form-label">MoMo REÇU</label>
                                                                <input type="number" class="form-control text-end" name="MoMo" value="{{ $vente->MoMo }}" >
                                                            </div>
                                                            <div class="mb-1">
                                                                <label class="form-label">RESTE</label>
                                                                <input type="number" class="form-control text-end" name="Reste" value="{{ $vente->Reste  }}" >
                                                            </div>
                                                            <div class="mb-1">
                                                                <label class="form-label">ÉCHÉANCE</label>
                                                                <input type="date" class="form-control" name="DateEcheance"value="{{ $vente->DateEcheance  }}">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-success w-100 mt-1">VALIDER</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>




                                    @endforeach

                                        @endif
                                        </tbody>

                                        <tfoot class="table-light">
                                            <tr class="text-center fw-bold">
                                                <td colspan="8">TOTAL</td>
                                                <td id="totalMontant">0</td>
                                                <td id="totalEspece">0</td>
                                                <td id="totalMoMo">0</td>
                                                <td id="totalReste">0</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="d-flex justify-content-center" >
                                        @if($venteArticle->count()> 0)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : {{$venteArticle->count()}}</div>

                                         @else
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : 0</div>

                                         @endif
                                    </div>
                                </div>

        <div class="modal fade" id="venteModal" tabindex="-1" aria-labelledby="venteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="venteModalLabel">FICHE DE VENTE PORTABLE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('create-new-vente-articles') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-8 equal-height">
                                    <div class="card p-1 mb-1 h-90">
                                        <h5 class="text-primary">INFORMATIONS CONCERNANT LE TELEPHONE</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">IMEI</label>
                                                <input type="text" class="form-control" id="imeis">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">MODÈLE DE TÉLÉPHONE</label>
                                                <input type="text" class="form-control" id="modele" readonly>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">COULEUR</label>
                                                <input type="text" class="form-control" id="couleur" readonly>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">CAPACITÉ</label>
                                                <input type="text" class="form-control" id="capacite" readonly>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ÉTAT</label>
                                                <input type="text" class="form-control" id="etat"  readonly>
                                            </div>


                                                <input type="hidden" name="IdEntree" class="form-control" id="IdEntre" readonly>
                                                <input type="hidden" name="IdArticle" class="form-control" id="Id_Article" readonly>

                                        </div>

                                        {{--  <div class="mb-1">
                                            <label class="form-label">QUANTITE</label>
                                            <input type="number" class="form-control" name="quantite" required>
                                        </div>  --}}

                                        <h5 class="text-primary">INFORMATIONS CONCERNANT LE CLIENT</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">NOM DU CLIENT</label>
                                                <input type="text" class="form-control" name="NomClient" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">CONTACT(S)</label>
                                                <input type="number" class="form-control" name="TelClient" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">OBSERVATIONS</label>
                                            <textarea class="form-control" rows="4" name="Observations" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 equal-height">
                                    <div class="card p-1">
                                        <h5 class="text-primary">DÉTAILS DE VENTE</h5>

                                        <div class="mb-1">
                                            <label class="form-label">DATE VENTE</label>
                                            <input type="date" class="form-control" name="DateVente" required>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">PRIX VENTE</label>
                                            <input type="number" id="prixvente" class="form-control text-end" name="MontantVente" value="0" required>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">ESPÈCE PERÇU</label>
                                            <input type="number" class="form-control text-end"  name="Espece"value="0">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">MoMo REÇU</label>
                                            <input type="number" class="form-control text-end" name="MoMo" value="0">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">RESTE</label>
                                            <input type="number" class="form-control text-end" name="Reste" value="0">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">ÉCHÉANCE</label>
                                            <input type="date" class="form-control" name="DateEcheance">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-1">VALIDER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




<div class="modal fade" id="venteAccessoireModal" tabindex="-1" aria-labelledby="venteAccessoireModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="venteAccessoireModalLabel">FICHE DE VENTE ACCESSOIRE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('create-new-vente-articles') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 equal-height">
                            <div class="card p-1 mb-1 h-90">
                                <h5 class="text-primary">INFORMATIONS SUR L'ACCESSOIRE</h5>
                                <div class="row">

                                   <div class="col-md-6 mb-3">
    <label class="form-label">ACCESSOIRES</label>
    <select class="form-select" id="IdEntree" name="IdEntree" required onchange="updatePrix()">
        <option value="">Sélectionner un accessoire</option>
        @foreach($entreeArticles as $article)
            <option value="{{ $article->IdEntree }}" data-prix-unitaire="{{ $article->PrixVente ?? 0 }}">
                {{ $article->articlee->Designation }}
            </option>
        @endforeach
    </select>
</div>                      <div class="col-md-6 mb-3">
    <label class="form-label">PRIX UNITAIRE</label>
    <input type="text" class="form-control" id="prixUnitaire" name="prixUnitaire" oninput="calculatePrixVente()" >
</div>

                                    <div class=" col-md-6 mb-1">
                                    <label class="form-label">QUANTITE</label>
                                    <input type="number" id="quantites" class="form-control" name="quantite" required oninput="calculatePrixVente()">
                                </div>

<div class=" col-md-6 mb-3">
    <label class="form-label">PRIX VENTE</label>
    <input type="number" id="prixventes" class="form-control text-end" name="MontantVente"  required>
</div>

                                </div>

                                <h5 class="text-primary">INFORMATIONS CLIENT</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">NOM DU CLIENT</label>
                                        <input type="text" style="text-transform: uppercase;" class="form-control" name="NomClient" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">CONTACT(S)</label>
                                        <input type="number" class="form-control" name="TelClient" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">OBSERVATIONS</label>
                                    <textarea class="form-control" style="text-transform: uppercase;"  rows="4" name="Observations"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 equal-height">
                            <div class="card p-1">
                                <h5 class="text-primary">DÉTAILS DE VENTE</h5>

                                <div class="mb-1">
                                    <label class="form-label">DATE VENTE</label>
                                    <input type="date" class="form-control" name="DateVente" required>
                                </div>

                                <div class="mb-1">
                                    <label class="form-label">ESPÈCE PERÇU</label>
                                    <input type="number" class="form-control text-end" name="Espece" value="0">
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">MoMo REÇU</label>
                                    <input type="number" class="form-control text-end" name="MoMo" value="0">
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">RESTE</label>
                                    <input type="number" class="form-control text-end" name="Reste" value="0">
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">ÉCHÉANCE</label>
                                    <input type="date" class="form-control" name="DateEcheance">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-1">VALIDER</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





                                </div>
                            </div>
                        </div>


                    </div>


@endsection
@section("scripts")

{{--  <script>
    $(document).ready(function() {
        console.log("Script chargé !");

        $("#imei").on("input", function() {
            console.log("IMEI saisi :", $(this).val());

            var imei = $(this).val();
            if (imei.length > 3) {
                $.ajax({
                    url: "{{ route('get.article.details') }}",
                    type: "GET",
                    data: { imei: imei },
                    success: function(response) {
                        console.log("Réponse du serveur :", response);

                        if (response.success) {
                            $("#modele").val(response.data.modele);
                            $("#couleur").val(response.data.couleur);
                            $("#capacite").val(response.data.capacite);
                            $("#etat").val(response.data.etat);
                            $("#IdEntre").val(response.data.IdEntre);
                        } else {
                            $("#modele, #couleur, #capacite, #etat").val("");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Erreur AJAX :", error);
                    }
                });
            }
        });
    });
</script>  --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script >
    $(document).ready(function() {
        console.log("Script chargé !");

        $("#imeis").on("input", function() {
            console.log("IMEI saisi :", $(this).val());

            var imei = $(this).val();

            // Si le champ IMEI est vide, on vide les champs correspondants
            if (imei === "" ||imei.length <= 3) {
                $("#modele, #couleur, #capacite, #etat, #IdEntre").val("");
            } else if (imei.length > 3) {
                $.ajax({
                    url: "{{ route('get.article.details') }}",
                    type: "GET",
                    data: { imei: imei },
                    success: function(response) {
                        console.log("Réponse du serveur :", response);

                        if (response.success) {
                            $("#modele").val(response.data.modele);
                            $("#couleur").val(response.data.couleur);
                            $("#capacite").val(response.data.capacite);
                            $("#etat").val(response.data.etat);
                            $("#IdEntre").val(response.data.IdEntre);
                            $("#prixvente").val(response.data.prixvente);
                            $("#Id_Article").val(response.data.Id_Article);
                        } else {
                            // Si l'IMEI ne correspond à rien, on vide les champs
                            $("#modele, #couleur, #capacite, #etat").val("");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Erreur AJAX :", error);
                    }
                });
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let modal = document.getElementById("venteModal"); // ID correct du modal
        let form, prixVente, espece, momo, reste, dateEcheance;

        // Exécuter le script quand le modal s'affiche
        modal.addEventListener("shown.bs.modal", function () {
            form = modal.querySelector("form");
            prixVente = modal.querySelector("input[name='MontantVente']");
            espece = modal.querySelector("input[name='Espece']");
            momo = modal.querySelector("input[name='MoMo']");
            reste = modal.querySelector("input[name='Reste']");
            dateEcheance = modal.querySelector("input[name='DateEcheance']");

            function calculerReste() {
                let totalVente = parseFloat(prixVente.value) || 0;
                let totalEspece = parseFloat(espece.value) || 0;
                let totalMomo = parseFloat(momo.value) || 0;
                let totalReste = totalVente - totalEspece - totalMomo;

                reste.value = totalReste.toFixed(0); // Met à jour le champ reste
            }

            // Met à jour "Reste" à chaque changement de valeur
            prixVente.addEventListener("input", calculerReste);
            espece.addEventListener("input", calculerReste);
            momo.addEventListener("input", calculerReste);

            // Vérifie la validité avant la soumission
            form.addEventListener("submit", function (event) {
                if (parseFloat(reste.value) > 0 && !dateEcheance.value) {
                    event.preventDefault(); // Bloque la soumission
                    alert("Veuillez renseigner la date d'échéance si un reste est présent.");
                    dateEcheance.focus();
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("[id^='modifierVenteModal']").forEach(function (modal) {
            let form, prixVente, espece, momo, reste, dateEcheance;

            // Exécuter le script quand le modal s'affiche
            modal.addEventListener("shown.bs.modal", function () {
                form = modal.querySelector("form");
                prixVente = modal.querySelector("input[name='MontantVente']");
                espece = modal.querySelector("input[name='Espece']");
                momo = modal.querySelector("input[name='MoMo']");
                reste = modal.querySelector("input[name='Reste']");
                dateEcheance = modal.querySelector("input[name='DateEcheance']");

                function calculerReste() {
                    let totalVente = parseFloat(prixVente.value) || 0;
                    let totalEspece = parseFloat(espece.value) || 0;
                    let totalMomo = parseFloat(momo.value) || 0;
                    let totalReste = totalVente - totalEspece - totalMomo;

                    reste.value = Math.round(totalReste); // Arrondi sans décimales
                }

                // Met à jour "Reste" à chaque changement de valeur
                prixVente.addEventListener("input", calculerReste);
                espece.addEventListener("input", calculerReste);
                momo.addEventListener("input", calculerReste);

                // Vérifie la validité avant la soumission
                form.addEventListener("submit", function (event) {
                    if (parseFloat(reste.value) > 0 && !dateEcheance.value) {
                        event.preventDefault(); // Bloque la soumission
                        alert("Veuillez renseigner la date d'échéance si un reste est présent.");
                        dateEcheance.focus();
                    }
                });
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let modal = document.getElementById("venteAccessoireModal");
        let form, prixVente, espece, momo, reste, dateEcheance;

        // Exécuter le script quand le modal s'affiche
        modal.addEventListener("shown.bs.modal", function () {
            form = modal.querySelector("form");
            prixVente = modal.querySelector("input[name='MontantVente']");
            espece = modal.querySelector("input[name='Espece']");
            momo = modal.querySelector("input[name='MoMo']");
            reste = modal.querySelector("input[name='Reste']");
            dateEcheance = modal.querySelector("input[name='DateEcheance']");

            function calculerReste() {
                // Récupère les valeurs en tant que nombres flottants
                let totalVente = parseFloat(prixVente.value) || 0;
                let totalEspece = parseFloat(espece.value) || 0;
                let totalMomo = parseFloat(momo.value) || 0;

                // Calcul du reste
                let totalReste = totalVente - totalEspece - totalMomo;

                // Mettre à jour le champ "reste"
                reste.value = totalReste.toFixed(0);
            }

            // Met à jour le "reste" à chaque changement de valeur
            prixVente.addEventListener("input", calculerReste);
            espece.addEventListener("input", calculerReste);
            momo.addEventListener("input", calculerReste);

            // Vérifie la validité avant la soumission
            form.addEventListener("submit", function (event) {
                if (parseFloat(reste.value) > 0 && !dateEcheance.value) {
                    event.preventDefault(); // Bloque la soumission
                    alert("Veuillez renseigner la date d'échéance si un reste est présent.");
                    dateEcheance.focus();
                }
            });
        });
    });

</script>
{{--  <script>
    function imprimerTable() {
        var contenu = document.getElementById('tableVente').outerHTML;
        var fenetreImpression = window.open('', '', 'height=600,width=800');

        fenetreImpression.document.write('<html><head><title>Impression</title>');
        fenetreImpression.document.write('<style>');
        fenetreImpression.document.write('table { width: 100%; border-collapse: collapse; }');
        fenetreImpression.document.write('th, td { border: 1px solid black; padding: 8px; text-align: center; }');
        fenetreImpression.document.write('</style>');
        fenetreImpression.document.write('</head><body>');
        fenetreImpression.document.write('<h2 style="text-align:center;">Liste des Ventes</h2>');
        fenetreImpression.document.write(contenu);
        fenetreImpression.document.write('</body></html>');

        fenetreImpression.document.close();
        fenetreImpression.print();
    }
</script>  --}}
{{--  <script>
    function imprimerLigne(button) {
        var ligne = button.closest('tr'); // Trouver la ligne parente du bouton cliqué
        var contenu = ligne.outerHTML; // Récupérer uniquement la ligne

        var fenetreImpression = window.open('', '', 'height=600,width=800');
        fenetreImpression.document.write('<html><head><title>Impression</title>');
        fenetreImpression.document.write('<style>');
        fenetreImpression.document.write('table { width: 100%; border-collapse: collapse; }');
        fenetreImpression.document.write('th, td { border: 1px solid black; padding: 8px; text-align: center; }');
        fenetreImpression.document.write('</style>');
        fenetreImpression.document.write('</head><body>');
        fenetreImpression.document.write('<h2 style="text-align:center;">Détails de la Vente</h2>');
        fenetreImpression.document.write('<table>' + contenu + '</table>');
        fenetreImpression.document.write('</body></html>');

        fenetreImpression.document.close();
        fenetreImpression.print();
    }
</script>  --}}
{{--  <script>
    function imprimerLigneAvecEntete(button) {
        var ligne = button.closest('tr'); // Trouver la ligne parente du bouton cliqué
        var entete = document.querySelector('thead').outerHTML; // Récupérer l'en-tête du tableau
        var contenu = ligne.outerHTML; // Récupérer uniquement la ligne sélectionnée

        var fenetreImpression = window.open('', '', 'height=600,width=800');
        fenetreImpression.document.write('<html><head><title>Impression</title>');
        fenetreImpression.document.write('<style>');
        fenetreImpression.document.write('table { width: 100%; border-collapse: collapse; margin: auto; }');
        fenetreImpression.document.write('th, td { border: 1px solid black; padding: 8px; text-align: center; }');
        fenetreImpression.document.write('</style>');
        fenetreImpression.document.write('</head><body>');
        fenetreImpression.document.write('<h2 style="text-align:center;">Détails de la Vente</h2>');
        fenetreImpression.document.write('<table>' + entete + contenu + '</table>'); // Afficher l'en-tête + ligne
        fenetreImpression.document.write('</body></html>');

        fenetreImpression.document.close();
        fenetreImpression.print();
    }
</script>  --}}
<script>
    function calculerTotaux() {
        let totalMontant = 0, totalEspece = 0, totalMoMo = 0, totalReste = 0;

        document.querySelectorAll('.montant').forEach(cell => {
            totalMontant += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
        });
        document.querySelectorAll('.espece').forEach(cell => {
            totalEspece += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
        });
        document.querySelectorAll('.momo').forEach(cell => {
            totalMoMo += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
        });
        document.querySelectorAll('.reste').forEach(cell => {
            totalReste += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
        });

        document.getElementById('totalMontant').innerText = totalMontant.toLocaleString();
        document.getElementById('totalEspece').innerText = totalEspece.toLocaleString();
        document.getElementById('totalMoMo').innerText = totalMoMo.toLocaleString();
        document.getElementById('totalReste').innerText = totalReste.toLocaleString();
    }

    window.onload = calculerTotaux;

</script>
  {{--  <script>
    document.getElementById('IdEntree').addEventListener('change', function() {
        var select = this;
        var selectedOption = select.options[select.selectedIndex];
        var prixUnitaire = selectedOption.getAttribute('data-prix-unitaire');
        document.getElementById('prixUnitaire').value = prixUnitaire;

    });
    function updatePrix() {
        var select = document.getElementById('IdEntree');
        var selectedOption = select.options[select.selectedIndex];
        var prixUnitaire = selectedOption.getAttribute('data-prix-unitaire');
        document.getElementById('prixUnitaire').value = prixUnitaire;

    }

    document.getElementById('IdEntree').addEventListener('change', updatePrix);

    function calculatePrixVente() {
        var prixUnitaire = parseFloat(document.getElementById('prixUnitaire').value) || 0;
        var quantite = parseInt(document.getElementById('quantite').value) || 0;
        var prixVente = prixUnitaire * quantite;
        // Vous pouvez ajouter du code ici pour afficher le prix total si nécessaire

    }

    function calculatePrixVente() {
        var prixUnitaire = parseFloat(document.getElementById('prixUnitaire').value) || 0;
        var quantite = parseInt(document.getElementById('quantite').value) || 0;
        var prixVente = prixUnitaire * quantite;



    }
    document.getElementById('prixUnitaire').addEventListener('input', calculatePrixVente);
document.getElementById('quantite').addEventListener('input', calculatePrixVente);


</script>    --}}

  <script>
    document.getElementById('IdEntree').addEventListener('change', function() {
        var select = this;
        var selectedOption = select.options[select.selectedIndex];
        var prixUnitaire = selectedOption.getAttribute('data-prix-unitaire');
        document.getElementById('prixUnitaire').value = prixUnitaire;
        console.log("Prix unitaire mis à jour:", prixUnitaire);
        console.log("Option sélectionnée:", selectedOption);
        calculatePrixVente();
    });

    function updatePrix() {
        var select = document.getElementById('IdEntree');
        var selectedOption = select.options[select.selectedIndex];
        var prixUnitaire = selectedOption.getAttribute('data-prix-unitaire');
        document.getElementById('prixUnitaire').value = prixUnitaire;
        console.log("Prix unitaire mis à jour:", prixUnitaire);



        console.log("Option sélectionnée:", selectedOption);

        calculatePrixVente();
    }

    document.getElementById('IdEntree').addEventListener('change', updatePrix);

    function calculatePrixVente() {
        var prixUnitaire = parseFloat(document.getElementById('prixUnitaire').value) || 0;
        var quantite = parseInt(document.getElementById('quantites').value) || 0;
        var prixVente = prixUnitaire * quantite;
        console.log("Quantité entrée:", quantite);
        console.log("Prix unitaire:", prixUnitaire);
        console.log("Prix de vente calculé:", prixVente);

        // Mettre à jour l'input pour afficher le prix de vente
        document.getElementById('prixventes').value = prixVente.toFixed(0);
        console.log("Prix de vente mis à jour:", prixVente.toFixed(0));
    }

    document.getElementById('prixUnitaire').addEventListener('input', calculatePrixVente);
    document.getElementById('quantite').addEventListener('input', calculatePrixVente);


</script>


{{--
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectEntree = document.getElementById('IdEntree');

        function updatePrix() {
            var selectedOption = selectEntree.options[selectEntree.selectedIndex];
            var prixUnitaire = selectedOption.dataset.prixUnitaire || '0';

            console.log("Option sélectionnée:", selectedOption.outerHTML);
            console.log("Prix unitaire récupéré:", prixUnitaire);

            document.getElementById('prixUnitaire').value = prixUnitaire;
            calculatePrixVente();
        }

        function calculatePrixVente() {
            var prixUnitaire = parseFloat(document.getElementById('prixUnitaire').value) || 0;
            var quantite = parseInt(document.getElementById('quantites').value) || 0;
            var prixVente = prixUnitaire * quantite;

            document.getElementById('prixventes').value = prixVente.toFixed(0);
        }

        selectEntree.addEventListener('change', updatePrix);
    });

</script>  --}}







{{--  <script>
    function calculerTotaux() {
        let totalMontant = 0, totalEspece = 0, totalMoMo = 0, totalReste = 0;

        document.querySelectorAll('.montant').forEach(cell => totalMontant += parseFloat(cell.innerText) || 0);
        document.querySelectorAll('.espece').forEach(cell => totalEspece += parseFloat(cell.innerText) || 0);
        document.querySelectorAll('.momo').forEach(cell => totalMoMo += parseFloat(cell.innerText) || 0);
        document.querySelectorAll('.reste').forEach(cell => totalReste += parseFloat(cell.innerText) || 0);

        document.getElementById('totalMontant').innerText = totalMontant.toLocaleString();
        document.getElementById('totalEspece').innerText = totalEspece.toLocaleString();
        document.getElementById('totalMoMo').innerText = totalMoMo.toLocaleString();
        document.getElementById('totalReste').innerText = totalReste.toLocaleString();
    }

    window.onload = calculerTotaux;
</script>  --}}


{{--  <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Sélection des champs
        let prixVente = document.getElementById("prixvente");
        let espece = document.querySelector("input[name='Espece']");
        let momo = document.querySelector("input[name='MoMo']");
        let reste = document.querySelector("input[name='Reste']");

        function calculerReste() {
            let prix = parseFloat(prixVente.value) || 0;
            let especePaye = parseFloat(espece.value) || 0;
            let momoPaye = parseFloat(momo.value) || 0;

            let resteAPayer = prix - especePaye - momoPaye;

            // Empêche un reste négatif
            reste.value = resteAPayer >= 0 ? resteAPayer : 0;
        }

        // Écouteurs d'événements pour recalculer en temps réel
        prixVente.addEventListener("input", calculerReste);
        espece.addEventListener("input", calculerReste);
        momo.addEventListener("input", calculerReste);
    });
</script>  --}}
{{--  <script>
    document.addEventListener("DOMContentLoaded", function () {
        let reste = document.querySelector("input[name='Reste']");
        let dateEcheance = document.querySelector("input[name='DateEcheance']");

        function verifierObligationDate() {
            if (parseFloat(reste.value) > 0) {
                dateEcheance.setAttribute("required", "required");
            } else {
                dateEcheance.removeAttribute("required");
            }
        }

        // Vérifier au chargement si un reste est déjà présent
        verifierObligationDate();

        // Écouter les changements sur le champ RESTE
        reste.addEventListener("input", verifierObligationDate);
    });
</script>  --}}
{{--  <script>
    document.addEventListener("DOMContentLoaded", function () {
        let form = document.querySelector("form"); // Sélectionne ton formulaire
        let reste = document.querySelector("input[name='Reste']");
        let dateEcheance = document.querySelector("input[name='DateEcheance']");

        form.addEventListener("submit", function (event) {
            if (parseFloat(reste.value) > 0 && !dateEcheance.value) {
                event.preventDefault(); // Empêche l'envoi du formulaire
                alert("Veuillez renseigner la date d'échéance si un reste est présent.");
                dateEcheance.focus();
            }
        });
    });
</script>  --}}
