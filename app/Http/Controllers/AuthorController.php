<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Author;

use App\Http\Resources\AuthorResource;

use App\Http\Resources\AuthorCollection;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AuthorCollection(Author::all());

        //$authors = Author::all();

        //return response()->json($authors, 200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $newAuthor = Author::addAuthor($request->all());

        return response ()->json($newAuthor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id              // permet d'appliquer la fonction show   @p Author $author //
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author =  Author::find($id);
        if ($author){
            return new AuthorResource($author);
        }
        else{
            return response()->json(['message' => 'SORRY, AUTHOR NOT FOUND'], 404);
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Author $author 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $updateAuthor = Author::updateAuthor($author, $request->all());

        return response ()->json($updateAuthor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Author $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response ()->json('', 204);
    }
}
