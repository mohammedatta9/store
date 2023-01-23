<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Properity;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = Rating::all();
        return view('admin.ratings.index', [
            'ratings' => $ratings,
            'properity' => Properity::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ratings.create', [
            'rating' => new Rating(),
            'properity' => Properity::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->validate(Rating::validateRoles());

        $data = $request->all();

        $rating = Rating::create($data);

        return redirect()->route('admin.ratings.index')
            ->with(
                'success',
                "Rating ($rating->name) added Sccessufly!"
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rating = Rating::findOrFail($id);
        if ($rating == null) {
            abort(404);
        }

        return view('admin.ratings.edit', [
            'rating' => $rating,
            'properity' => Properity::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);
        if ($rating == null) {
            abort(404);
        }

        //$request->validate(Type::validateRoles());
        return redirect()->route('admin.ratings.index')
            ->with(
                'success',
                "Rating ($rating->name) Updated Sccessufly!"
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return redirect()->route('admin.ratings.index')
            ->with('success', "Rating ($rating->name) Deleted Sccessufly!");
    }
}