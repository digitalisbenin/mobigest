<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Famille;
use App\Models\EntreeArticle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\RetourArticle;
class GestionsDesStockController extends Controller
{
    public function getArticle(Request $request)
    {  $entreeArticle =EntreeArticle::all();
        $articles=Article::all();
        return view('gestions.article',compact('articles','entreeArticle'));
    }
    public function getEntreArticle(Request $request)
    {
        $entreeArticle =EntreeArticle::all();
        $familles=Famille::all();
        $articles=Article::all();
        return view('gestions.entre',compact('familles','articles','entreeArticle'));
    }
    public function getRetoursFournisseurs(Request $request)
    {
        $retourArticle = RetourArticle::all();
        $articles = Article::all();
        $fournisseurs = EntreeArticle::select('NomFours')->distinct()->get();
                $query = EntreeArticle::where('EntreePar', Auth::id())->where('statut', 'Disponible');
                $entreeArticle = $query->get();
                return view('gestions.retour', compact('entreeArticle','articles','fournisseurs','retourArticle'));
    }
    public function getEtatStock(Request $request)
    {
        $entreeArticle =EntreeArticle::all();
        $familles=Famille::all();
        $articles=Article::all();
        return view('gestions.stock',compact('familles','articles','entreeArticle')); 
    }
    public function detailStock(Request $request, $id)
    {
        $article_id=$id;
        
        $query = EntreeArticle::where('Id_Article', $id)
        ->where('statut', 'Disponible');



if ($request->has('date_debut') && $request->has('date_fin')) {
    $query->whereBetween('EntreeLe', [$request->date_debut, $request->date_fin]);
}

if ($request->filled('Id_Article')) {
    $query->where('Id_Article', $request->Id_Article);
}

if ($request->filled('NomFours')) {
    $query->where('NomFours', $request->NomFours);
}



$entreeArticle = $query->get();

$articles = Article::all();
$fournisseurs = EntreeArticle::select('NomFours')->distinct()->get();


    return view('gestions.show', compact('entreeArticle','article_id','id','articles', 'fournisseurs'));
    }

}
