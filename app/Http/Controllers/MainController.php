<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\Genre;
use App\Models\Movie;

class MainController extends Controller
{
    public function home(){
        $genres = Genre :: all();
        return view('pages.home', compact('genres'));
    }
    
    public function movies() {
        $movies = Movie :: all();
        return view('pages.movies', compact('movies'));
    }

    // delete
    public function delete(Movie $movie) {
        $movie -> tags() -> sync([]);
        $movie -> delete();
        return redirect() -> route('movies');
    }

    // create
    public function create() {
        $genres = Genre :: all();
        $tags = Tag :: all();

        return view('pages.createMovie', compact('genres', 'tags'));
    }

    public function store(Request $request) {
        
        $data = $request -> validate([
            'name' => 'required|string|max:64',
            'release_date' => 'required|date|before:today',
            'cashOut' => 'required|integer',
            'genre_id' => 'required|integer',
            'tags' => 'required|array'
        ]);

        $movie = New Movie();

        $movie -> name = $data ['name'];
        $movie -> release_date = $data ['release_date'];
        $movie -> cashOut = $data ['cashOut'];
        
        $genre = Genre :: find($data['genre_id']);
        $movie -> genre() -> associate($genre);

        $movie -> save();

        $tags = tag :: find($data['tags']);
        $movie -> tags() -> attach($tags);

        return redirect() -> route('movies');

    }

    // edit
    public function edit(Movie $movie) {
        $tags = Tag :: all();
        $genres = Genre :: all();

        return view('pages.editMovie', compact('movie', 'tags', 'genres'));
    }

    public function update(Request $request, Movie $movie) {
        
        $data = $request -> validate([
            'name' => 'required|string|max:64',
            'release_date' => 'required|date|before:today',
            'cashOut' => 'required|integer',
            'genre_id' => 'required|integer',
            'tags' => 'required|array'
        ]);

        $movie -> name = $data ['name'];
        $movie -> release_date = $data ['release_date'];
        $movie -> cashOut = $data ['cashOut'];
        
        $genre = Genre :: find($data['genre_id']);
        $movie -> genre() -> associate($genre);

        $movie -> save();

        $tags = tag :: find($data['tags']);
        $movie -> tags() -> attach($tags);

        return redirect() -> route('movies');

    }
}
