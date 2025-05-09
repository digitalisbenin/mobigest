<?php

namespace App\Http\Controllers;

use App\Models\EntreeArticle;
use App\Models\Famille;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class EntreeArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreePortable = EntreeArticle::whereNotNull('IMEI')->latest()->first();
        $entreeAccessoire = EntreeArticle::whereNull('IMEI')->latest()->first();
        
        $entreeArticle =EntreeArticle::all();
        $familles=Famille::all();
        $articles=Article::all();
        return view('entre',compact('familles','articles','entreeArticle','entreeAccessoire','entreePortable'));
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
        //dd($request->imei);
        $this->validate($request, [
            'imei' => 'nullable|string|max:255|unique:entree_articles,IMEI',
            'NomFours' => 'required',
            'Id_Article' => 'required|exists:articles,IdArticle',
        ]);

        
        if($request->imei){
            EntreeArticle::create([
                'Id_Article' => $request->Id_Article,
                'IMEI' => $request->imei,
                'quantite' =>1,
                'Couleur' => $request->Couleur,
                'Capacite' => $request->Capacite,
                'Etat' => $request->Etat,
                'EntreeLe' => $request->EntreeLe,
                'NomFours' => $request->NomFours,
                'TelFours' => $request->TelFours,
                'Observations' => $request->Observations,
                'PrixAchat' => $request->PrixAchat,
                'PrixVente' => $request->PrixVente,
                'EntreePar' =>Auth::id() ,
                'DateEnreg' => Carbon::now()->format('Y-m-d'),
                'HeureEnreg' =>Carbon::now()->format('H:i:s') ,
            ]);
            Article::where('IdArticle', $request->Id_Article)->increment('stock_Art');
        }else{

            EntreeArticle::create([
                'Id_Article' => $request->Id_Article,
                'EntreeLe' => $request->EntreeLe,
                'quantite' => $request->quantite,
                'NomFours' => $request->NomFours,
                'TelFours' => $request->TelFours,
                'Observations' => $request->Observations,
                'PrixAchat' => $request->PrixAchat,
                'PrixVente' => $request->PrixVente,
                'EntreePar' =>Auth::id() ,
                'DateEnreg' => Carbon::now()->format('Y-m-d'),
                'HeureEnreg' =>Carbon::now()->format('H:i:s') ,
            ]);

            $article =  Article::where('IdArticle', $request->Id_Article)->first();
            $article->stock_Art= $article->stock_Art+$request->quantite;
            $article->update();

        }


        // $prod = Article::where('IdArticle',$request->Id_Article)->first();
        //     $prod->stock_Art= $prod->stock_Art+1;
        //     $prod->update();

        session()->flash('success', 'Article  a été ajouter avec succès!');
        return  back();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntreeArticle  $entreeArticle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $article_id=$id;
        //  $entreeArticle = EntreeArticle::where('Id_Article', $id)->where('EntreePar',Auth::id())->get();
        $query = EntreeArticle::where('Id_Article', $id)
        ->where('statut', 'Disponible');

// Filtrer par date de début
// if ($request->filled('date_debut')) {
// $query->whereDate('created_at', '>=', Carbon::parse($request->date_debut));
// }

// // Filtrer par date de fin
// if ($request->filled('date_fin')) {
// $query->whereDate('created_at', '<=', Carbon::parse($request->date_fin));
// }

// // Obtenir les résultats filtrés
// $entreeArticle = $query->get();

if ($request->has('date_debut') && $request->has('date_fin')) {
    $query->whereBetween('EntreeLe', [$request->date_debut, $request->date_fin]);
}

if ($request->filled('Id_Article')) {
    $query->where('Id_Article', $request->Id_Article);
}

if ($request->filled('NomFours')) {
    $query->where('NomFours', $request->NomFours);
}
if ($request->filled('capacite')) {
    $query->where('Capacite', 'like',$request->capacite.'%');
}
if ($request->filled('etat')) {
    $query->where('Etat', 'like',$request->etat.'%');
}
if ($request->filled('imei')) {
    $query->where('IMEI', 'like',$request->imei.'%');
}

if ($request->filled('designation')) {
    $query->whereHas('articlee', function ($q) use ($request) {
        $q->where('Designation', 'like', $request->designation . '%');
    });
}


$entreeArticle = $query->get();

// Récupération des articles et fournisseurs pour les listes déroulantes
$articles = Article::all();
$fournisseurs = EntreeArticle::select('NomFours')->distinct()->get();


    return view('detailEntre', compact('entreeArticle','article_id','id','articles', 'fournisseurs'));
    }

    public function portable(Request $request, $id)
    {
        $article_id=$id;
 
        $entreePortable = EntreeArticle::whereNotNull('IMEI')->latest()->first();
        $article = Article::findOrfail($id);



    return view('portable', compact('entreePortable','article_id','id','article'));
    }
    public function accessoire(Request $request, $id)
    {
        $article_id=$id;
 
        $entreeAccessoire = EntreeArticle::whereNull('IMEI')->latest()->first();
        $article = Article::findOrfail($id);



    return view('accessoire', compact('entreeAccessoire','article_id','id','article'));
    }


   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntreeArticle  $entreeArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(EntreeArticle $entreeArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntreeArticle  $entreeArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $entreeArticle = EntreeArticle::findOrfail($id);

        if($request->IMEI){

            $entreeArticle->IMEI = $request->IMEI;
        $entreeArticle->Couleur = $request->Couleur;
        $entreeArticle->Capacite = $request->Capacite;
        $entreeArticle->Etat = $request->Etat ;
        $entreeArticle->quantite = $request->quantite ;
        $entreeArticle->EntreeLe = $request->EntreeLe ;
        $entreeArticle->NomFours = $request->NomFours ;
        $entreeArticle->TelFours = $request->TelFours ;
        $entreeArticle->Observations = $request->Observations ;
        $entreeArticle->PrixAchat = $request->PrixAchat ;
        $entreeArticle->PrixVente = $request->PrixVente ;
        $entreeArticle->ModifierPar =Auth::id() ;
        $entreeArticle->ModifierLe =Carbon::now()->format('Y-m-d') ;

        $entreeArticle->save();

        }else{

            $entreeArticle->EntreeLe = $request->EntreeLe ;
            $entreeArticle->quantite = $request->quantite ;
            $entreeArticle->NomFours = $request->NomFours ;
            $entreeArticle->TelFours = $request->TelFours ;
            $entreeArticle->Observations = $request->Observations ;
            $entreeArticle->PrixAchat = $request->PrixAchat ;
            $entreeArticle->PrixVente = $request->PrixVente ;
            $entreeArticle->ModifierPar =Auth::id() ;
            $entreeArticle->ModifierLe =Carbon::now()->format('Y-m-d') ;

            $entreeArticle->save();
            Article::where('IdArticle', $request->Id_Article)
            ->update(['stock_Art' => $request->quantite]);

        }


        session()->flash('success', 'L\' entree article a été bien modifié!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntreeArticle  $entreeArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $entreeArticle = EntreeArticle::findOrfail($id);
        // Article::where('IdArticle',$entreeArticle->Id_Article)->decrement('stock_Art');
        $article =  Article::where('IdArticle', $entreeArticle->Id_Article)->first();
        $article->stock_Art= $article->stock_Art-$entreeArticle->quantite;
        $article->update();

        $entreeArticle->delete();
        return back();
    }
    public function filtrers(Request $request)
{
    // Récupérer l'utilisateur connecté
    $user = auth()->user();

    // Récupérer les valeurs des filtres
    $dateDebut = $request->input('date_debut');
    $dateFin = $request->input('date_fin');
    $articleId = $request->input('article');

    // Requête de base avec filtrage par utilisateur
    $query = Article::where('user_id', $user->id);

    // Filtrer par date de début et date de fin
    if ($dateDebut) {
        $query->whereDate('created_at', '>=', $dateDebut);
    }

    if ($dateFin) {
        $query->whereDate('created_at', '<=', $dateFin);
    }

    // Filtrer par article si un article spécifique est sélectionné
    if ($articleId) {
        $query->where('id', $articleId);
    }

    // Exécuter la requête et récupérer les articles filtrés
    $articles = $query->orderBy('created_at', 'desc')->get();

    // Retourner la vue avec les articles filtrés
    return view('admin.index', compact('articles'));
}

public function filter(Request $request)
{
    $query = EntreeArticle::query();

    // Filtrer par utilisateur connecté
    $query->where('EntreePar', Auth::id());

    // Filtrer par date de début
    if ($request->filled('date_debut')) {
        $query->whereDate('created_at', '>=', $request->date_debut);
    }

    // Filtrer par date de fin
    if ($request->filled('date_fin')) {
        $query->whereDate('created_at', '<=', $request->date_fin);
    }

    // Filtrer par article
    if ($request->filled('Id_Article')) {
        $query->where('Id_Article', $request->Id_Article);
    }

    // Récupérer les résultats
    $entreeArticle = $query->get();

    // Retourner la vue avec les résultats filtrés
    return view('detailEntre', compact('entreeArticle'));
}

public function getArticleDetails(Request $request)
{
    $article = EntreeArticle::where('IMEI', $request->imei)
    ->where('statut', 'Disponible')
                 ->first();

    if ($article) {
        return response()->json([
            'success' => true,
            'data' => [
                'modele' => $article->articlee->Designation ,
                'Id_Article' => $article->Id_Article,
                'couleur' => $article->Couleur,
                'capacite' => $article->Capacite,
                'etat' => $article->Etat,
                'IdEntre' => $article->IdEntree,
                'prixvente' => $article->PrixVente,
            ]
        ]);
    } else {
        return response()->json(['success' => false]);
    }
}


}
