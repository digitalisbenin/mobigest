<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\VenteArticle;
use App\Models\ReglementVente;
use App\Models\EntreeArticle;
use App\Models\Famille;
use App\Models\Depense;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ControlesController extends Controller
{
    public function getVenteArticle(Request $request)
    {
        $venteArticle = VenteArticle::where('statut', 'Disponible')->get();
       
    
        return view('controles.vente', compact('venteArticle'));   
    }
    public function getRetourVenteArticle(Request $request)
    {
        $query = VenteArticle::where('statut', 'Annuler');

// Filtrer par date de début
if ($request->filled('date_debut')) {
$query->whereDate('created_at', '>=', $request->date_debut);
}

// Filtrer par date de fin
if ($request->filled('date_fin')) {
$query->whereDate('created_at', '<=', $request->date_fin);
}

$venteArticle = $query->get();


return view('controles.annuler', compact('venteArticle'));
    }
    public function getReglements(Request $request)
    {
        $reglementVente = ReglementVente::all();
    
        return view('controles.listeReglement',compact('reglementVente')); 
    }
    public function getDepense(Request $request)
    {
        $query = Depense::query();

        // Filtrer par date de début ->whereDate('created_at', today())
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
    
        // Filtrer par date de fin
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }
    
        
    
        // Récupérer les dépenses filtrées
        $depense = $query->get();
    
        return view('controles.depense', compact('depense')); 
    }
    public function getListeDebiteurs(Request $request)
    {
        $venteArticle = VenteArticle::where('statut', 'Disponible')
        ->where('Reste', '>', 0)
        ->get();
    
        return view('controles.debiteurs',compact('venteArticle')); 
    }
}
