<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParametreController;
use App\Http\Controllers\Admin\ImageVitrineController;
use App\Http\Controllers\Admin\ProduitController;
use Illuminate\Support\Facades\Route;

// ============================================
// SITE PUBLIC
// ============================================
Route::get('/', [SiteController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [SiteController::class, 'apropos'])->name('apropos');
Route::get('/produits', [SiteController::class, 'produits'])->name('produits');
Route::get('/realisations', [SiteController::class, 'realisations'])->name('realisations');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

// ============================================
// ADMIN - Auth
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('admin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Paramètres
        Route::get('parametres', [ParametreController::class, 'edit'])->name('parametres.edit');
        Route::put('parametres', [ParametreController::class, 'update'])->name('parametres.update');

        // Images vitrine
        Route::get('images', [ImageVitrineController::class, 'index'])->name('images.index');
        Route::post('images', [ImageVitrineController::class, 'store'])->name('images.store');
        Route::put('images/{image}', [ImageVitrineController::class, 'update'])->name('images.update');
        Route::delete('images/{image}', [ImageVitrineController::class, 'destroy'])->name('images.destroy');
        Route::patch('images/{image}/toggle', [ImageVitrineController::class, 'toggle'])->name('images.toggle');
        Route::patch('images/{image}/order', [ImageVitrineController::class, 'order'])->name('images.order');


        // Catégories
        Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
        Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');
        Route::put('categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
        Route::delete('categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');

        // Produits
        Route::get('produits', [ProduitController::class, 'index'])->name('produits.index');
        Route::get('produits/create', [ProduitController::class, 'create'])->name('produits.create');
        Route::post('produits', [ProduitController::class, 'store'])->name('produits.store');
        Route::get('produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
        Route::put('produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
        Route::delete('produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');
    });
});
