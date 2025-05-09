<?php
use App\Http\Controllers\ArticleImportController;
use App\Http\Controllers\DepenseImportController;
use App\Http\Controllers\EntreeArticleImportController;
use App\Http\Controllers\ReglementVenteImportController;
use App\Http\Controllers\RetourArticleImportController;
use App\Http\Controllers\VenteArticleImportImportController;
use App\Http\Controllers\FamilleImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\VenteArticleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EntreeArticleController;
use App\Http\Controllers\GestionsDesStockController;
use App\Http\Controllers\RetourArticleController;
use App\Http\Controllers\ControlesController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\ReglementVenteController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Famille;
use App\Models\Article;
use App\Models\VenteArticle;
use App\Models\ReglementVente;
use App\Models\EntreeArticle;
use Illuminate\Support\Facades\Auth;
use App\Models\Depense;
use App\Models\Societe;
use Barryvdh\DomPDF\Facade\Pdf;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     $familles=Famille::all();
//     return view('welcome',compact('familles'));
// });
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/vente', function () {
    return view('vente');
});
Route::get('/depense', function () {
    return view('brouillon.depense');
});
Route::get('/ventes', function () {
    return view('ventes');
});

Route::get('/dashboards', function () {
    return view('dashboards');
});
Route::get('/depensese', function () {
    return view('brouillon.depenses');
});

Route::get('/dashboard', function () {
    $societe = Societe::first();
    $user = Auth::user(); // Récupération directe de l'utilisateur connecté
    

    if ($user->role->name === 'SUPERVISEUR'|| $user->role->name === 'RESPONSABLE'  || $user->role->name === 'CONTROLEUR') {
        $article=Article::all();
    $vente=VenteArticle::where('statut', 'Disponible')->get();
    $entree=EntreeArticle::where('statut', 'Disponible')->get();
    $depense=Depense::all();
     
   
    return view('dashboards',compact('article','vente','entree','depense','societe'));
    } elseif ($user->role->name === 'STOCK') {
        return redirect('/entree-articles');
    }  else {
        return redirect('/ventes-articles');
    }

   
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('/ajouter-famille', [App\Http\Controllers\FamilleController::class, 'store']);





    Route::get('/generate-pdf', function () {
        $data = [
            'client' => 'COUSIN',
            'contact' => '61413427',
            'modele' => 'SAMSUNG S9 PLUS',
            'capacite' => '64Go',
            'couleur' => 'PURPLE',
            'imei1' => '355418091453303',
            'imei2' => '-',
            'etat' => 'Scellé',
            'caracteristiques' => 'ÉCHANGE S9+ POUR PROBLÈME ÉCRAN DU 07/02/25',
            'montant' => '80 000 Francs CFA',
            'reference' => 'C/MANAF/CAISSE/037',
            'date' => '08/02/2025',
            'signature' => 'GLORIA'
        ];
    
        $pdf = PDF::loadView('decharge.pdf', $data);
        return $pdf->download('decharge.pdf');
    });

    Route::get('/decharge/download/{chapterId}', [VenteArticleController::class, 'download'])->name('decharge.download');
    Route::get('/decharge/downloads/{chapterId}', [VenteArticleController::class, 'downloads'])->name('decharge.downloads');

    Route::get('/filter-articles', [EntreeArticleController::class, 'filter'])->name('articles.filter');

    Route::get('/get-article-details', [EntreeArticleController::class, 'getArticleDetails'])->name('get.article.details');

    Route::get('/get-articles', [GestionsDesStockController::class, 'getArticle']);
    Route::get('/get-entre-article', [GestionsDesStockController::class, 'getEntreArticle']);
    Route::get('/get-article-retour-fournisseurs', [GestionsDesStockController::class, 'getRetoursFournisseurs']);
    Route::get('/get-etat-stock', [GestionsDesStockController::class, 'getEtatStock']);
    Route::get('detail/{id}/stock', [GestionsDesStockController::class, 'detailStock'])->name('detail-stock');

    Route::get('/get-vente-articles', [ControlesController::class, 'getVenteArticle']);
    Route::get('/get-article-retour-ventes', [ControlesController::class, 'getRetourVenteArticle']);
    Route::get('/get-reglements', [ControlesController::class, 'getReglements']);
    Route::get('/get-depense', [ControlesController::class, 'getDepense']);
    Route::get('/get-liste-debiteurs', [ControlesController::class, 'getListeDebiteurs']);



    /*------------------------ Articles ----------------------------*/
    Route::get('articles', [ArticleController::class, 'index']);
    Route::get('create-articles', [ArticleController::class, 'create']);
    Route::post('articles', [ArticleController::class, 'store']);
    Route::get('articles/{id}/edit', [ArticleController::class, 'edit']);
    Route::put('articles/{id}/update', [ArticleController::class, 'update']);
    Route::delete('articles/{id}/destroy', [ArticleController::class, 'destroy']);

    /*------------------------Vente Articles ----------------------------*/
    Route::get('ventes-articles', [VenteArticleController::class, 'index'])->name('filtre-ventes');
    Route::get('ventes-article', [VenteArticleController::class, 'indexe']);
    Route::get('create-vente-articles', [VenteArticleController::class, 'create']);
    Route::post('create-new-vente-articles', [VenteArticleController::class, 'store']);
    Route::get('vente-articles/{id}/edit', [VenteArticleController::class, 'edit']);
    Route::put('vente-articles/{id}/update', [VenteArticleController::class, 'update']);
    Route::put('vente-articles/{id}/updates', [VenteArticleController::class, 'updates']);
    Route::get('vente-articles/{id}/destroy', [VenteArticleController::class, 'destroy']);

    /*------------------------Entree Articles ----------------------------*/
    Route::get('entree-articles', [EntreeArticleController::class, 'index']);
    Route::get('create-entree-articles', [EntreeArticleController::class, 'create']);
    Route::post('create-new-entree-articles', [EntreeArticleController::class, 'store']);
    Route::get('entree-articles/{id}/show', [EntreeArticleController::class, 'show'])->name('entree-articles.show');
    Route::get('entree-articles/{id}/portable', [EntreeArticleController::class, 'portable']);
    Route::get('entree-articles/{id}/accessoire', [EntreeArticleController::class, 'accessoire']);
    Route::get('entree-articles/{id}/edit', [EntreeArticleController::class, 'edit']);
    Route::put('entree-articles/{id}/update', [EntreeArticleController::class, 'update']);
    Route::delete('entree-articles/{id}/destroy', [EntreeArticleController::class, 'destroy']);



    /*------------------------Retour Articles ----------------------------*/
    Route::get('retour-articles', [RetourArticleController::class, 'index']);
    Route::get('create-retour-articles', [RetourArticleController::class, 'create']);
    Route::post('create-new-retour-articles', [RetourArticleController::class, 'store']);
    Route::get('retour-articles/{id}/show', [RetourArticleController::class, 'show']);
    Route::get('retour-articles/{id}/edit', [RetourArticleController::class, 'edit']);
    Route::put('retour-articles/{id}/update', [RetourArticleController::class, 'update']);
    Route::delete('retour-articles/{id}/destroy', [RetourArticleController::class, 'destroy']);

    /*------------------------Reglement Vente ----------------------------*/
    Route::get('reglement-ventes', [ReglementVenteController::class, 'index']);
    Route::get('liste-reglement-ventes', [ReglementVenteController::class, 'indexe']);
    Route::get('create-reglement-ventes', [ReglementVenteController::class, 'create']);
    Route::post('create-new-reglement-ventes', [ReglementVenteController::class, 'store']);
    Route::get('reglement-ventes/{id}/show', [ReglementVenteController::class, 'show']);
    Route::get('reglement-ventes/{id}/edit', [ReglementVenteController::class, 'edit']);
    Route::put('reglement-ventes/{id}/update', [ReglementVenteController::class, 'update']);
    Route::delete('reglement-ventes/{id}/destroy', [ReglementVenteController::class, 'destroy']);


    /*------------------nu;e------Depense ----------------------------*/
    Route::get('depenses', [DepenseController::class, 'index']);
    Route::get('create-entree-depenses', [DepenseController::class, 'create']);
    Route::post('create-new-entree-depenses', [DepenseController::class, 'store']);
    Route::get('depenses/{id}/show', [DepenseController::class, 'show']);
    Route::get('depenses/{id}/edit', [DepenseController::class, 'edit']);
    Route::put('depenses/{id}/update', [DepenseController::class, 'update']);
    Route::delete('depenses/{id}/destroy', [DepenseController::class, 'destroy']);


    /*------------------nu;e------Societe ----------------------------*/
    Route::get('entreprises', [SocieteController::class, 'index']);
    Route::get('create-entree-entreprises', [SocieteController::class, 'create']);
    Route::post('entreprises', [SocieteController::class, 'store']);
    Route::get('entreprises/{id}/show', [SocieteController::class, 'show']);
    Route::get('entreprises/{id}/edit', [SocieteController::class, 'edit']);
    Route::put('entreprises/{id}/update', [SocieteController::class, 'update']);
    Route::delete('entreprises/{id}/destroy', [SocieteController::class, 'destroy']);

    /*------------------nu;e------Societe ----------------------------*/
    Route::get('familles', [FamilleController::class, 'index']);
    Route::get('familles-create', [FamilleController::class, 'create']);
    Route::post('familles', [FamilleController::class, 'store']);
    Route::get('familles/{id}/show', [FamilleController::class, 'show']);
    Route::get('familles/{id}/edit', [FamilleController::class, 'edit']);
    Route::put('familles/{id}/update', [FamilleController::class, 'update']);
    Route::delete('familles/{id}/destroy', [FamilleController::class, 'destroy']);


    /*------------------nu;e------Utilisateur ----------------------------*/
    Route::get('users', [UserController::class, 'index']);
    Route::get('users-create', [UserController::class, 'create']);
    Route::post('users', [UserController::class, 'store']);
    Route::get('users/{id}/show', [UserController::class, 'show']);
    Route::get('users/{id}/edit', [UserController::class, 'edit']);
    Route::put('users/{id}/update', [UserController::class, 'update']);
    Route::delete('users/{id}/destroy', [UserController::class, 'destroy']);



    Route::get('/import', function () {
        return view('import');
    });
    Route::post('/import-articles', [ArticleImportController::class, 'import'])->name('import.articles');
    Route::post('/import-depenses', [DepenseImportController::class, 'import'])->name('import.depenses');
    Route::post('/import-entrearticles', [EntreeArticleImportController::class, 'import'])->name('import.entrearticles');
    Route::post('/import-familles', [FamilleImportController::class, 'import'])->name('import.familles');
    Route::post('/import-retourarticle', [RetourArticleImportController::class, 'import'])->name('import.retourarticle');
    Route::post('/import-reglements', [ReglementVenteImportController::class, 'import'])->name('import.reglements');
    Route::post('/import-ventearticles', [VenteArticleImportImportController::class, 'import'])->name('import.ventearticles');

});


require __DIR__.'/auth.php';
