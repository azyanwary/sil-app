<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\SiteCatalog;
use App\Livewire\Pages\SiteDetail;
use App\Livewire\Pages\MapExplorer;

Route::get('/', Home::class)->name('home');
Route::get('/katalog-situs', SiteCatalog::class)->name('sites.index');
Route::get('/katalog-situs/{slugOrId}', SiteDetail::class)->name('sites.show');
Route::get('/peta', MapExplorer::class)->name('map');

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.switch');
