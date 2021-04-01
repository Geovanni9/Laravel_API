<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Genre;

use App\Http\Resources\GenreResource;

use App\Http\Resources\GenreCollection;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GenreCollection(Genre::all());

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $newGenre = Genre::addGenre($request->all());

        return response ()->json($newGenre, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id              // permet d'appliquer la fonction show  @p Genre $genre //
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre =  Genre::find($id);
        if ($genre){
            return new GenreResource($genre);
        }
        else{
            return response()->json(['message' => 'SORRY, GENRE MISTAKE'], 404);
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Genre $genre 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $updateGenre = Genre::updateGenre($genre, $request->all());

        return response ()->json($updateGenre, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response ()->json('', 204);
    }
}
