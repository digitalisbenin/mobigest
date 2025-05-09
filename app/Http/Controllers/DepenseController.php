<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $depense=Depense::all();
    
    //     return view('depense',compact('depense'));
    // }
    public function index(Request $request)
{
    $query = Depense::where('Enregister_par', Auth::id());

    if ($request->filled('date_debut') || $request->filled('date_fin')) {
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }
    } else {
        // Si aucune date n'est fournie, filtre par la date du jour
        $query->whereDate('created_at', today());
    }

    

    // Récupérer les dépenses filtrées
    $depense = $query->get();

    return view('depense', compact('depense'));
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
        // dd($request);
        $this->validate($request, [
            'DateDepense' => 'required',
            'MontantDepense' => 'required',
        ]);

        Depense::create([
            'DateDepense' => $request->DateDepense,
            'MotifDepense' => $request->MotifDepense,
            'MontantDepense' => $request->MontantDepense,
            'Observations' => $request->Observations,
            'Enregister_par' =>Auth::id() ,
            
            'HeureDepense' =>Carbon::now()->format('H:i:s') ,
        ]);
        session()->flash('success', 'Article  a été ajouter avec succès!');
        return redirect('depenses'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function edit(Depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $this->validate($request, [
            'DateDepense' => 'required',
            'MontantDepense' => 'required',
        ]);
        $depense = Depense::findOrfail($id);
          
        $depense->DateDepense = $request->DateDepense;
        $depense->MotifDepense = $request->MotifDepense;
        $depense->MontantDepense = $request->MontantDepense;
        $depense->Observations = $request->Observations ;
      
       
        $depense->save();

        session()->flash('success', 'La depense a été bien modifié!');
        return redirect('depenses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $depense = Depense::findOrfail($id);
        $depense->delete();
        return redirect('depenses'); 
    }
}