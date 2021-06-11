<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;

use App\Http\Requests\Film as FilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Affiche la liste des films
    public function index()
    {
        // pagination
        $films = Film::paginate(5);

        // On va chercher tous les films et appeler la vue index
        return view('index',compact('films'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Afficher le formulaire pour la création d’un nouveau film
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  créer un nouveau film
    public function store(Request $filmRequest)
    {
        Film::create($filmRequest->all());

        return redirect()->route('films.index')->with('info','Le film a bien été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  afficher les données d’un film
    public function show(Film $film)
    {
        //
        return view('show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  Afficher le formulaire pour la modification d’un film
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  modifier les données d’un film
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  supprimer un film
    public function destroy(Film $film)
    {
        $film->delete();

        // Message de confirmation
        return back()->with('info', 'Le film a bien été supprimé dans la base de données.');
    }
}
