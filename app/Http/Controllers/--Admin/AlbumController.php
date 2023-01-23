<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Properity;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        return view('admin.albumImages.index', [
            'albums' => $albums,   
            'properity' => Properity::all(),
    
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.albumImages.create', [
            'album' => new Album(),
            'properity' => Properity::all(),

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
        //$request->validate(Album::validateRoles());

        $data = $request->all();

        $album = Album::create($data);

        return redirect()->route('admin.albumImages.index')
            ->with(
                'success',
                "Alum ($album->name) added Sccessufly!"
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::findOrFail($id);

        if ($album == null) {
            abort(404);
        }
        return view('admin.albumImages.edit', [
            'album' => $album,
            'properity' => Properity::all(),
        ]);
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    { 
        $album = Album::findOrFail($id);
        if ($album == null) {
            abort(404);
        }

        //$request->validate(Album::validateRoles());
        return redirect()->route('admin.albumImages.index')
        ->with( 'success',"Album ($album->name) Updated Sccessufly!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
       
         return redirect()->route('admin.albumImages.index')
             ->with('success', "Album ($album->name) Deleted Sccessufly!");
   
    }
}
