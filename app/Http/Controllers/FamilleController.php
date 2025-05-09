<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use Illuminate\Http\Request;

class FamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $articles=Famille::all();
        
        return view('familles',compact('articles'));
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
        $request->validate([
            'LibFamille' => 'required|string|unique:familles,LibFamille'
        ]);
    
        $famille = Famille::create(['LibFamille' => strtoupper($request->LibFamille)]);
         
        return response()->json($famille);
    }
    public function stores(Request $request)
    {
        $request->validate([
            'LibFamille' => 'required|string|unique:familles,LibFamille'
        ]);
    
        $famille = Famille::create(['LibFamille' => $request->LibFamille]);
    
        return redirect('familles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function show(Famille $famille)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function edit(Famille $famille)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $article = Famille::findOrfail($id);

        $article->LibFamille = $request->LibFamille;
       
       
        $article->save();

        session()->flash('success', 'L\' article a été bien modifié!');
        return redirect('familles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $famille = Famille::findOrfail($id);
        $famille->delete();
        return redirect('familles'); 
    }
}
