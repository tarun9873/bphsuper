<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::orderBy('updated_at', 'desc')->get();
        return view('home', compact('notes'));
    }
    
    public function create()
    {
        $note = Note::create([
            'title' => 'New Note',
            'content' => '',
            'share_id' => Str::random(10)
        ]);
        
        return redirect()->route('note.show', $note->share_id);
    }
    
    public function show($share_id)
    {
        $note = Note::where('share_id', $share_id)->firstOrFail();
        return view('note', compact('note'));
    }
    
    public function save(Request $request)
    {
        $request->validate([
            'share_id' => 'required|string',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string'
        ]);
        
        $note = Note::where('share_id', $request->share_id)->first();
        
        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }
        
        $note->title = $request->title ?: 'Untitled';
        $note->content = $request->content ?: '';
        $note->save();
        
        return response()->json([
            'status' => 'saved',
            'updated_at' => $note->updated_at->diffForHumans(),
            'title' => $note->title
        ]);
    }
    
    public function destroy($share_id)
    {
        $note = Note::where('share_id', $share_id)->firstOrFail();
        $note->delete();
        
        if (request()->ajax()) {
            return response()->json(['status' => 'deleted']);
        }
        
        return redirect()->route('home');
    }
    
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        $notes = Note::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orderBy('updated_at', 'desc')
            ->get();
        
        if ($request->ajax()) {
            return response()->json($notes);
        }
        
        return view('home', compact('notes'));
    }
}