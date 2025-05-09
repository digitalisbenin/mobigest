<?php

namespace App\Http\Controllers;

use App\Models\ReglementVente;
use App\Models\VenteArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ReglementVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venteArticle = VenteArticle::where('EnregistrerPar', Auth::id())
        ->where('statut', 'Disponible')
        ->where('Reste', '>', 0)
        ->get();
    
        return view('regler',compact('venteArticle'));
    }
    public function indexe()
    {
        $venteArticle = VenteArticle::where('EnregistrerPar', Auth::id())
        ->where('statut', 'Disponible')
        ->whereDate('created_at', today())
        ->where('Reste', '>', 0)
        ->get();
        // $reglementVente = ReglementVente::where('EnregistrerPar', Auth::id())
        
        // ->get();
        $startDate = request()->input('start_date');
        $endDate = request()->input('end_date');
       
        
        // Vérifier si un filtre est appliqué (sauf si c'est une requête simple sans paramètres)
        $hasFilters = $startDate || $endDate;
        
        $reglementVente = ReglementVente::query()
            ->when(!$hasFilters, function ($query) {
                // Si aucun filtre n'est appliqué, afficher uniquement les ventes du jour
                return $query->whereDate('created_at', today());
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
           
            ->where('EnregistrerPar', Auth::id())
           
            ->get();

    
        return view('listeReglement',compact('venteArticle','reglementVente'));
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
            'DateRegl' => 'required',
            'IDVente' => 'required',
        ]);

        $vente =  VenteArticle::where('IDVente', $request->IDVente)->first();
        $vente->Espece=$vente->Espece+$request->MontantReglEsp ;
        $vente->MoMo=$vente->MoMo+$request->MontantReglMoMo ;
        $vente->Reste=$request->DetteAct ;
        $vente->update();

        
            ReglementVente::create([
            'IDVente' => $request->IDVente,
            'Observations' => $request->Observations,
            'DateEcheance' => $request->DateEcheance,
            'DateRegl' => $request->DateRegl,
            'DetteAnt' => $request->DetteAnt,
            'MontantReglEsp' => $request->MontantReglEsp,
            'MontantReglMoMo' => $request->MontantReglMoMo,
            'DetteAct' => $request->DetteAct,
            'EnregistrerPar' =>Auth::id() ,
            'DateEnreg' => Carbon::now()->format('Y-m-d'),
            'HeureEnreg' =>Carbon::now()->format('H:i:s') ,
        ]);

       
        session()->flash('success', 'Reglement   a été ajouter avec succès!');
        return redirect('liste-reglement-ventes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReglementVente  $reglementVente
     * @return \Illuminate\Http\Response
     */
    public function show(ReglementVente $reglementVente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReglementVente  $reglementVente
     * @return \Illuminate\Http\Response
     */
    public function edit(ReglementVente $reglementVente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReglementVente  $reglementVente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReglementVente $reglementVente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReglementVente  $reglementVente
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReglementVente $reglementVente)
    {
        //
    }
}
