<?php

use App\Http\Controllers\Panel\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/create', [StoryController::class, 'create'])->name('stories.create');
Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
Route::get('/stories/{id}/edit', [StoryController::class, 'edit'])->name('stories.edit');
Route::post('/stories/{id}', [StoryController::class, 'update'])->name('stories.update');
Route::post('/stories/{id}/delete', [StoryController::class, 'destroy'])->name('stories.destroy');
