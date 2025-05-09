<?php

namespace App\Http\Controllers;
use App\Models\EntreeArticle;
use App\Models\Article;
use App\Models\Societe;
use App\Models\VenteArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class VenteArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $startDate = request()->input('start_date');
$endDate = request()->input('end_date');
$designation = request()->input('designation');
$imei = request()->input('imei');
$client = request()->input('client');

// Vérifier si un filtre est appliqué (sauf si c'est une requête simple sans paramètres)
$hasFilters = $startDate || $endDate || $designation || $imei || $client;

$venteArticle = VenteArticle::query()
    ->when(!$hasFilters, function ($query) {
        // Si aucun filtre n'est appliqué, afficher uniquement les ventes du jour
        return $query->whereDate('created_at', today());
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    })
    ->when($designation, function ($query) use ($designation) {
        return $query->whereHas('entreeArticle.articlee', function ($q) use ($designation) {
            $q->where('Designation', 'like', $designation . '%');
        });
    })
    ->when($imei, function ($query) use ($imei) {
        return $query->whereHas('entreeArticle', function ($q) use ($imei) {
            $q->where('IMEI', 'like', $imei . '%');
        });
    })
    ->when($client, function ($query) use ($client) {
        return $query->where('NomClient', 'like', $client . '%');
    })
    ->where('EnregistrerPar', Auth::id())
    ->where('statut', 'Disponible')
    ->get();



    $entreeArticles = EntreeArticle::whereHas('articlee.famille', function ($query) {
        $query->where('LibFamille', 'ACCESSOIRE');
    })
    ->where('Statut', 'Disponible')
    ->latest('created_at')
    ->get()
    ->unique('Id_Article');


    return view('vente', compact('venteArticle', 'entreeArticles'));
}


    // public function index()
    // {
    //     $venteArticle = VenteArticle::query()
    // ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
    //     return $query->whereBetween('created_at', [$startDate, $endDate]);
    // })
    // ->when($designation, function ($query) use ($designation) {
    //     return $query->where('designation', 'like', '%' . $designation . '%');
    // })
    // ->when($imei, function ($query) use ($imei) {
    //     return $query->where('imei', 'like', '%' . $imei . '%');
    // })
    // ->when($client, function ($query) use ($client) {
    //     return $query->where('client', 'like', '%' . $client . '%');
    // })
    // ->where('EnregistrerPar', Auth::id())
    // ->where('statut', 'Disponible')
    // ->get();

    //     $entreeArticles = EntreeArticle::whereHas('articlee.famille', function ($query) {
    //         $query->where('LibFamille', 'ACCESSOIRE');
    //     })
    //     ->where('Statut', 'Disponible')
    //      ->latest('created_at')
    //     ->get()
    //      ->unique('Id_Article')
    //     ;

    //     //dd($entreeArticles);
    //     return view('vente', compact('venteArticle','entreeArticles'));

    // }
    // public function indexe()
    // {
    //     $venteArticle = VenteArticle::where('EnregistrerPar', Auth::id())->where('statut', 'Disponible')->get();
    //     $entreeArticles =EntreeArticle::all();
    //     return view('annuler', compact('venteArticle','entreeArticles'));
    // }
    public function indexe(Request $request)
{
   $startDate = request()->input('start_date');
$endDate = request()->input('end_date');
$designation = request()->input('designation');
$imei = request()->input('imei');
$client = request()->input('client');

// Vérifier si un filtre est appliqué (sauf si c'est une requête simple sans paramètres)
$hasFilters = $startDate || $endDate || $designation || $imei || $client;

$venteArticle = VenteArticle::query()
    ->when(!$hasFilters, function ($query) {
        // Si aucun filtre n'est appliqué, afficher uniquement les ventes du jour
        return $query->whereDate('created_at', today());
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    })
    ->when($designation, function ($query) use ($designation) {
        return $query->whereHas('entreeArticle.articlee', function ($q) use ($designation) {
            $q->where('Designation', 'like',  $designation . '%');
        });
    })
    ->when($imei, function ($query) use ($imei) {
        return $query->whereHas('entreeArticle', function ($q) use ($imei) {
            $q->where('IMEI', 'like', $imei . '%');
        });
    })
    ->when($client, function ($query) use ($client) {
        return $query->where('NomClient', 'like',  $client . '%');
    })
    ->where('EnregistrerPar', Auth::id())
    ->where('statut', 'Disponible')
    ->get();




    $entreeArticles = EntreeArticle::all();

    return view('annuler', compact('venteArticle', 'entreeArticles'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'NomClient' => 'required',
            'TelClient' => 'required',
            'IdEntree' => 'required|exists:entree_articles,IdEntree',
        ]);
        $entreeArticles =  EntreeArticle::where('IdEntree', $request->IdEntree)->first();

        // $margeBenefic=($entreeArticles->PrixVente-$entreeArticles->PrixAchat)*$request->quantite;
        $article = Article::where('IdArticle', $entreeArticles->Id_Article)->first();
        //dd($article);
        if ($entreeArticles) {
            $margeBenefic = ($entreeArticles->PrixVente - $entreeArticles->PrixAchat) * $request->quantite;
            VenteArticle::create([
                'DateVente' => $request->DateVente,
                'quantite' => $request->quantite,
                'MontantVente' => $request->MontantVente,
                'Observations' => $request->Observations,
                'IdEntree' => $request->IdEntree,
                'Espece' => $request->Espece,
                'MoMo' => $request->MoMo,
                'Reste' => $request->Reste,
                // 'Statut' => "Vendu",
                'MargeBenefic' => $margeBenefic,
                'DateEcheance' => $request->DateEcheance,
                'NomClient' => $request->NomClient,
                'TelClient' => $request->TelClient,
                'PrixVente' => $request->PrixVente,
                'EnregistrerPar' =>Auth::id() ,
                'HeureVente' =>Carbon::now()->format('H:i:s') ,
            ]);

            $article = Article::where('IdArticle', $entreeArticles->Id_Article)->first();

            if ($article) {
                $article->stock_Art -= $entreeArticles->quantite;
                $article->update();
            }

            if (isset($entreeArticles->IMEI)) {
                $entreeArticles->Statut = "Vendu";
                $entreeArticles->update();
            }
        }
        // $article =  Article::where('IdArticle', $entreeArticles->Id_Article)->first();
        //     $article->stock_Art= $article->stock_Art-$request->quantite;
        //     $article->update();
        //     $entreeArticles
        //    if( $entreeArticles->IMEI)
        //    {
        //     $entreeArticles =  EntreeArticle::where('IdEntree', $request->IdEntree)->first();
        //     $entreeArticles->Statut= "Vendu";
        //     $entreeArticles->update();
        //    }
        return redirect('ventes-articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VenteArticle  $venteArticle
     * @return \Illuminate\Http\Response
     */
    public function show(VenteArticle $venteArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VenteArticle  $venteArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(VenteArticle $venteArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VenteArticle  $venteArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        // dd($request);
        $this->validate($request, [
            'NomClient' => 'required',
            'TelClient' => 'required',

        ]);
        $venteArticle = VenteArticle::findOrfail($id);

        $venteArticle->Reste = $request->Reste;
        $venteArticle->MoMo = $request->MoMo;
        $venteArticle->Espece = $request->Espece;
        $venteArticle->MontantVente = $request->MontantVente;
        $venteArticle->DateVente = $request->DateVente;
        $venteArticle->NomClient = $request->NomClient;
        $venteArticle->TelClient = $request->TelClient;
        $venteArticle->Observations = $request->Observations ;
        $venteArticle->ModifPar =Auth::id() ;
        $venteArticle->HeureModif =Carbon::now()->format('H:i:s') ;
        $venteArticle->DateModif =Carbon::now()->format('Y-m-d') ;
        $venteArticle->quantite = $request->quantite ;
        $venteArticle->DateEcheance = $request->DateEcheance ;
        $venteArticle->save();


        return redirect('ventes-articles');
    }
    public function updates(Request $request,  $id)
    {
        $this->validate($request, [
            'DateAnnul' => 'required',
            'CauseAnnulat' => 'required',

        ]);
        $venteArticle = VenteArticle::findOrfail($id);
        $article =  Article::where('IdArticle', $venteArticle->entreeArticle->Id_Article)->first();
        $article->stock_Art= $article->stock_Art+$venteArticle->entreeArticle->quantite;
        $article->update();

        $entreeArticles =  EntreeArticle::where('IdEntree', $venteArticle->IdEntree)->first();
        if (isset($entreeArticles->IMEI)) {
            $entreeArticles->Statut = "Disponible";
            $entreeArticles->update();
        }

        $venteArticle->CauseAnnulat = $request->CauseAnnulat ;
        $venteArticle->AnnulerPar =Auth::id() ;
        $venteArticle->HeureAnnul =Carbon::now()->format('H:i:s') ;
        $venteArticle->DateAnnul =$request->DateAnnul ;
        $venteArticle->Statut ="Annuler" ;

        $venteArticle->save();


        return redirect('ventes-article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VenteArticle  $venteArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(VenteArticle $venteArticle)
    {
        //
    }
    public function download($chapterId)
    {
        $user = Auth::user();
        // $certificate = Certificate::where('user_id', $user->id)
        //     ->where('formation_id', $chapterId)
        //     ->first();
        $vente = VenteArticle::where('IDVente', $chapterId)->first();

        if (!$vente) {
            return redirect()->back()->with('error', 'Certificat non disponible.');
        }

        $societe = Societe::first();

        $data = [
            'user' => $user,
            'vente' => $vente,
            'societe' => $societe,
            'caracteristiques' => 'ÉCHANGE S9+ POUR PROBLÈME ÉCRAN DU 07/02/25',

            'reference' => 'C/MANAF/CAISSE/037',
        ];

        $pdf = PDF::loadView('decharge.pdf', $data);

        return $pdf->download('decharges.pdf');
    }
    public function downloads($chapterId)
            {
                $user = Auth::user();
                $vente = VenteArticle::where('IDVente', $chapterId)->first();

                if (!$vente) {
                    return redirect()->back()->with('error', 'Certificat non disponible.');
                }

                $societe = Societe::first();

                $data = [
                    'user' => $user,
                    'vente' => $vente,
                    'societe' => $societe,
                    'caracteristiques' => 'ÉCHANGE S9+ POUR PROBLÈME ÉCRAN DU 07/02/25',
                    'reference' => 'C/MANAF/CAISSE/037',
                ];

                $pdf = PDF::loadView('decharge.pdf', $data);

                // Afficher le PDF dans le navigateur au lieu de le télécharger
                return $pdf->stream('decharges.pdf');
            }

}
