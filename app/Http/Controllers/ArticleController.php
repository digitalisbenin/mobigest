<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Famille;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familles=Famille::all();
        $articles=Article::all();
        return view('article',compact('familles','articles'));
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
            'Designation' => 'required|string|max:255|unique:articles,Designation',
            'Id_famille' => 'required|exists:familles,IDFamille',
        ]);

        Article::create([
            'Id_famille' => $request->Id_famille,
            'Designation' => $request->Designation,
            'stock_Alert' => $request->stock_Alert,
            'stock_Art' => $request->stock_Art,
            'Entre_par' =>Auth::id() ,
            'Entre_le' => Carbon::now()->format('Y-m-d'),
            'Heure_enreg' =>Carbon::now()->format('H:i:s') ,
        ]);
        session()->flash('success', 'Article  a été ajouter avec succès!');
        return redirect('articles'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Designation' => 'required',
            'Id_famille' => 'required',
        ]);
        $article = Article::findOrfail($id);

        $article->Id_famille = $request->Id_famille;
        $article->Designation = $request->Designation;
        $article->stock_Alert = $request->stock_Alert;
        $article->stock_Art = $request->stock_Art ;
        $article->Modifier_par =Auth::id() ;
        $article->Modifier_le =Carbon::now()->format('Y-m-d') ;
       
        $article->save();

        session()->flash('success', 'L\' article a été bien modifié!');
        return redirect('articles'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $article = Article::findOrfail($id);
        $article->delete();
        return redirect('articles'); 
    }
}
