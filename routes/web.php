<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\ExpenseCreateController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\OncaController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StockProduitController;
use App\Http\Controllers\StockCapsuleController;
use App\Http\Controllers\StockCapsuleRemplieController;
use App\Http\Controllers\StockHerbController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\HerbController;
use App\Http\Controllers\FornisseurController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\CartonTypeController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified', 'superadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Stock Management
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::resource('stock-produit', StockProduitController::class);
    Route::get('/stock-produit/product/{productId}/attributes', [StockProduitController::class, 'getProductAttributes'])->name('stock-produit.product-attributes');
    Route::post('/stock-produit/{id}/restock', [StockProduitController::class, 'restock'])->name('stock-produit.restock');
    Route::post('/stock-produit/{id}/usage', [StockProduitController::class, 'usage'])->name('stock-produit.usage');
    
    // Carton Types Management
    Route::resource('carton-types', CartonTypeController::class);
    Route::patch('/carton-types/{cartonType}/toggle', [CartonTypeController::class, 'toggleActive'])->name('carton-types.toggle');
    
    Route::resource('stock-capsules', StockCapsuleController::class);
    Route::post('/stock-capsules/{id}/restock', [StockCapsuleController::class, 'restock'])->name('stock-capsules.restock');
    Route::post('/stock-capsules/{id}/usage', [StockCapsuleController::class, 'usage'])->name('stock-capsules.usage');
    Route::resource('stock-capsules-remplie', StockCapsuleRemplieController::class)->only(['index', 'show']);
    Route::resource('stock-herb', StockHerbController::class);

    // Products
    Route::resource('products', ProductController::class);
    Route::resource('herbs', HerbController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);

    // Fournisseurs
    Route::resource('fornisseurs', FornisseurController::class);

    // Clients
    Route::resource('clients', ClientController::class);

    // Commandes
    Route::post('/commandes/preview', [CommandeController::class, 'preview'])->name('commandes.preview');
    Route::post('/commandes/{commande}/update-status', [CommandeController::class, 'updateStatus'])->name('commandes.update-status');
    Route::resource('commandes', CommandeController::class);

    // Financial Management
    Route::get('/financial', [FinancialController::class, 'index'])->name('financial.index');
    Route::get('/commandes/{commande}/revenue', [FinancialController::class, 'showCommandeRevenue'])->name('financial.show-revenue');
    Route::post('/commandes/{commande}/revenue', [FinancialController::class, 'storeCommandeRevenue'])->name('financial.store-revenue');
    Route::post('/commandes/{commande}/revenue/confirm', [FinancialController::class, 'confirmRevenue'])->name('financial.confirm-revenue');

    // Revenue
    Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue.index');

    // Expenses
    Route::get('/expenses', [App\Http\Controllers\ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpenseCreateController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseCreateController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{id}/edit', [App\Http\Controllers\ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{id}', [App\Http\Controllers\ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{id}', [App\Http\Controllers\ExpenseController::class, 'destroy'])->name('expenses.destroy');
    
    // Expense Categories
    Route::get('/expense-categories', [ExpenseCategoryController::class, 'index'])->name('expense-categories.index');
    Route::get('/expense-categories/create', [ExpenseCategoryController::class, 'create'])->name('expense-categories.create');
    Route::post('/expense-categories', [ExpenseCategoryController::class, 'store'])->name('expense-categories.store');

    // Reports & Statistics
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // ONCA Documents
    // ONCA Documents
    Route::get('/onca/create/{type}', [OncaController::class, 'createForm'])->name('onca.create-form');
    Route::get('/onca/{onca}/print', [OncaController::class, 'print'])->name('onca.print');
    Route::resource('onca', OncaController::class);

    // Archives
    Route::get('/archives', [ArchiveController::class, 'index'])->name('archives.index');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

    // Profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
