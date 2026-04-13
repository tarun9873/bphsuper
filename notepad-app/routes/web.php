<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', [NoteController::class, 'index'])->name('home');
Route::get('/new', [NoteController::class, 'create'])->name('note.create');
Route::get('/note/{share_id}', [NoteController::class, 'show'])->name('note.show');
Route::post('/save-note', [NoteController::class, 'save'])->name('note.save');
Route::delete('/note/{share_id}', [NoteController::class, 'destroy'])->name('note.destroy');
Route::post('/note/search', [NoteController::class, 'search'])->name('note.search');