<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EntreeArticleImport;
use App\Http\Controllers\Controller;

class EntreeArticleImportController extends Controller
{
    public function import(Request $request)
    {
      
        $request->validate([
            'file' => 'required',
        ]);
        //dd($request);
        //dd(class_exists(\Maatwebsite\Excel\Facades\Excel::class));

        \Maatwebsite\Excel\Facades\Excel::import(new EntreeArticleImport, $request->file('file'));


        return back()->with('success', 'Importation réussie !');
    }
}
