<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class SocieteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $articles=Societe::all();
        return view('entreprise',compact('articles'));
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
        $logo;
        $this->validate($request, [
            'NomSociete' => 'required',
            'Adresse' => 'required',
        ]);
       
        if ($request->hasFile('Logo')) {
            $file = $request->file('Logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/logo',$filename);
            $logo = $filename;
        }
        Societe::create([
            'NomSociete' => $request->NomSociete,
            'Adresse' => $request->Adresse,
            'CodePostal' => $request->CodePostal,
            'Ville' => $request->Ville,
            'responsable' => $request->responsable,
            'ifu' => $request->ifu,
            'rccm' => $request->rccm,
            'Telephone' => $request->Telephone,
            'Fax' => $request->Fax,
            'email' => $request->email,
            'Logo' =>$logo ?? "",
          
        ]);
        session()->flash('success', 'Article  a été ajouter avec succès!');
        return redirect('entreprises'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function show(Societe $societe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function edit(Societe $societe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $societe = Societe::findOrfail($id);

       
        if ($request->hasFile('Logo')) {
            $path='assets/uploads/logo'.$societe->Logo;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file =$request->file('Logo');
            $ext=$file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/logo',$filename);
            $societe->Logo= $filename;
        }
       

        $societe->NomSociete = $request->NomSociete;
        $societe->Adresse = $request->Adresse;
        $societe->CodePostal = $request->CodePostal;
        $societe->Ville = $request->Ville;
        $societe->responsable = $request->responsable;
        $societe->ifu = $request->ifu;
        $societe->rccm = $request->rccm;
        $societe->Fax = $request->Fax;
        $societe->email = $request->email;
        $societe->Telephone = $request->Telephone;
       
      
        $societe->save();

       session()->flash('success', 'La catégorie a été bien modifiée !');
       return redirect('entreprises');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $societe = Societe::findOrfail($id);
        $societe->delete();
        return redirect('entreprises'); 
    }
}
