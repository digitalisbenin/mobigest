<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\EntreeArticle;
use App\Models\RetourArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class RetourArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::all();
$fournisseurs = EntreeArticle::select('NomFours')->distinct()->get();

$query = EntreeArticle::where('EntreePar', Auth::id())->where('statut', 'Disponible');

$hasFilters = false; // Vérifie si un filtre autre que la date du jour est appliqué

if ($request->has('date_debut') && $request->has('date_fin')) {
    $query->whereBetween('EntreeLe', [$request->date_debut, $request->date_fin]);
    $hasFilters = true;
}

if ($request->filled('Id_Article')) {
    $query->where('Id_Article', $request->Id_Article);
    $hasFilters = true;
}

if ($request->filled('NomFours')) {
    $query->where('NomFours', $request->NomFours);
    $hasFilters = true;
}

if ($request->filled('capacite')) {
    $query->where('Capacite', 'like', $request->capacite . '%');
    $hasFilters = true;
}

if ($request->filled('etat')) {
    $query->where('Etat', 'like', $request->etat . '%');
    $hasFilters = true;
}

if ($request->filled('imei')) {
    $query->where('IMEI', 'like', $request->imei . '%');
    $hasFilters = true;
}

if ($request->filled('designation')) {
    $query->whereHas('articlee', function ($q) use ($request) {
        $q->where('Designation', 'like', $request->designation . '%');
    });
    $hasFilters = true;
}

// Appliquer le filtre par défaut si aucun autre filtre n'est présent
if (!$hasFilters) {
    $query->whereDate('EntreeLe', today());
}

$entreeArticle = $query->get();






        // $query = EntreeArticle::where('EntreePar', Auth::id())->where('statut', 'Disponible')->whereDate('created_at', today());
        // $entreeArticle = $query->get();
        return view('retour', compact('entreeArticle','articles','fournisseurs'));
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
         //dd($request);
         $this->validate($request, [
            'Observations' => 'required',
            'RetourLe' => 'required',
        ]);
        $entreeArticles =  EntreeArticle::where('IdEntree', $request->IdEntree)->first();
        $entreeArticles->Statut="Retourner" ;
        $entreeArticles->update();

        $article =  Article::where('IdArticle', $entreeArticles->Id_Article)->first();
        $article->stock_Art= $article->stock_Art-$entreeArticles->quantite;
        $article->update();

        RetourArticle::create([
            'RetourLe' => $request->RetourLe,
            'Observations' => $request->Observations,
            'IdEntree' => $request->IdEntree,
            'RetourPar' =>Auth::id() ,
            'DateEnreg' => Carbon::now()->format('Y-m-d'),
            'HeureEnreg' =>Carbon::now()->format('H:i:s') ,
        ]);


        session()->flash('success', ' retour Article  a été ajouter avec succès!');
        return redirect('retour-articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RetourArticle  $retourArticle
     * @return \Illuminate\Http\Response
     */
    public function show(RetourArticle $retourArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RetourArticle  $retourArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(RetourArticle $retourArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RetourArticle  $retourArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RetourArticle $retourArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RetourArticle  $retourArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetourArticle $retourArticle)
    {
        //
    }
}
