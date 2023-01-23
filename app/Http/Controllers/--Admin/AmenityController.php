<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amenities = Amenity::all();
        return view('admin.amenities.index', [
            'amenities' => $amenities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenities.create', [
            'amenity' => new Amenity(),
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
        //$request->validate(Amenity::validateRoles());

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
        }

        $amenity = Amenity::create($data);

        return redirect()->route('admin.amenities.index')
            ->with(
                'success',
                "Amenity ($amenity->name) added Sccessufly!"
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);
        if ($amenity == null) {
            abort(404);
        }
        return view('admin.amenities.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $amenity = Amenity::findOrFail($id);
        if ($amenity == null) {
            abort(404);
        }

        //$request->validate(Amenity::validateRoles());

        //image
        $data = $request->all();
        $previous = false;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
            $previous = $amenity->image;
        }

        $amenity->update($data);
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }

        return redirect()->route('admin.amenities.index')
            ->with(
                'success',
                "Amenity ($amenity->name) Updated Sccessufly!"
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->delete();
        if ($amenity->image) {
            Storage::disk('uploads')->delete($amenity->image);
        }
        return redirect()->route('admin.amenities.index')
            ->with('success', "Amenity ($amenity->name) Deleted Sccessufly!");
  
    }
}
