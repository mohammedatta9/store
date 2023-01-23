<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NearbyPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NearbyPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nearby_places = NearbyPlace::all();
        return view('admin.nearbyPlaces.index', [
            'nearby_places' => $nearby_places,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nearbyPlaces.create', [
            'nearby_place' => new NearbyPlace(),
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
        //$request->validate(NearbyPlace::validateRoles());

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
        }

        $nearby_place = NearbyPlace::create($data);

        return redirect()->route('admin.nearbyPlaces.index')
            ->with(
                'success',
                "Nearby_Place ($nearby_place->name) added Sccessufly!"
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NearbyPlace  $nearbyPlace
     * @return \Illuminate\Http\Response
     */
    public function show(NearbyPlace $nearbyPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NearbyPlace  $nearbyPlace
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nearby_place = NearbyPlace::findOrFail($id);
        if ($nearby_place == null) {
            abort(404);
        }
        return view('admin.nearbyPlaces.edit', compact('nearby_place'));
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NearbyPlace  $nearbyPlace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $nearby_place = NearbyPlace::findOrFail($id);
        if ($nearby_place == null) {
            abort(404);
        }

        //$request->validate(Nearby_Place::validateRoles());

        //image
        $data = $request->all();
        $previous = false;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
            $previous = $nearby_place->image;
        }

        $nearby_place->update($data);
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }

        return redirect()->route('admin.nearbyPlaces.index')
            ->with(
                'success',
                "Nearby_Place ($nearby_place->name) Updated Sccessufly!"
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NearbyPlace  $nearbyPlace
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nearby_place = NearbyPlace::findOrFail($id);
        $nearby_place->delete();
        if ($nearby_place->image) {
            Storage::disk('uploads')->delete($nearby_place->image);
        }
        return redirect()->route('admin.nearbyPlaces.index')
            ->with('success', "Nearby_Place ($nearby_place->name) Deleted Sccessufly!");
  
   
    }
}
