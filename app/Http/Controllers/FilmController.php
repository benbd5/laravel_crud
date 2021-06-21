<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Film, Category};

use App\Http\Requests\Film as FilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Affiche la liste des films
    public function index($slug = null)
    {

        // Est-ce que le slug est fourni ?
        $query = $slug ? Category::whereSlug($slug)->firstOrFail()->films() : Film::query();

        // pagination et tri ordre alphabétique en fonction du slug passe dans l'url
        $films = $query->withTrashed()->oldest('title')->paginate(5);

        // On va chercher tous les films et appeler la vue index
        return view('index', compact('films', 'slug'));
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

        return redirect()->route('films.index')->with('info', 'Le film a bien été créé');
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
        // Ajout du nom de la catégorie du film
        $category = $film->category->name;

        return view('show', compact('film', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  Afficher le formulaire pour la modification d’un film
    public function edit(Film $film)
    {
        return view('edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  modifier les données d’un film
    public function update(FilmRequest $filmRequest, Film $film)
    {
        $film->update($filmRequest->all());

        return redirect()->route('films.index')->with('info', 'Le film a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  mettre un film dans la corbeille
    public function destroy(Film $film)
    {
        $film->delete();

        // Message de confirmation
        return back()->with('info', 'Le film a bien été mis dans la corbeille.');
    }

    // Supprimer un film de la corbeille
    public function forceDestroy($id)
    {
        Film::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return back()->with('info', 'Le film a bien été supprimé définitivement dans la base de données.');
    }

    // Restaurer un film de la corbeille
    public function restore($id)
    {
        Film::withTrashed()->whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'Le film a bien été restauré.');
    }
}
