<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $album_images = AlbumImage::all();
        return view('admin.albumImages.index', [
            'album_images' => $album_images,
            'albums' => Album::all(),

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
            'album_images' => new AlbumImage(),
            'albums' => Album::all(),

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
        //$request->validate(AlbumImage::validateRoles());

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
        }

        $album_image = AlbumImage::create($data);

        return redirect()->route('admin.albumImages.index')
            ->with(
                'success',
                "Alum_Image ($album_image->name) added Sccessufly!"
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlbumImage  $albumImage
     * @return \Illuminate\Http\Response
     */
    public function show(AlbumImage $albumImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlbumImage  $albumImage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album_image = AlbumImage::findOrFail($id);
        $albums = Album::all();

        if ($album_image == null) {
            abort(404);
        }
        return view('admin.albumImages.edit', compact('album_image', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlbumImage  $albumImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $album_image = AlbumImage::findOrFail($id);
        if ($album_image == null) {
            abort(404);
        }

        //$request->validate(AlbumImage::validateRoles());

        //image
        $data = $request->all();
        $previous = false;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
            $previous = $album_image->image;
        }

        $album_image->update($data);
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }
        return redirect()->route('admin.albumImages.index')
            ->with(
                'success',
                "Album_Image ($album_image->name) Updated Sccessufly!"
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlbumImage  $albumImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album_image = AlbumImage::findOrFail($id);
        $album_image->delete();
        if ($album_image->image) {
            Storage::disk('uploads')->delete($album_image->image);
        }
        return redirect()->route('admin.albumImages.index')
            ->with('success', "Album_Image ($album_image->name) Deleted Sccessufly!");
    }
}
