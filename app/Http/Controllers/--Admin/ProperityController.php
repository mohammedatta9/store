<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Properity;
use App\Models\Tag;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProperityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properities = Properity::all();
        return view('admin.properities.index', [
            'properities' => $properities,
            'countries' => Country::all(),
            'cities' => City::all(),
            'users' => User::all(),
            'types' => Type::all(),
            'categories' => Category::all(),
            'currencies' => Currency::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.properities.create', [
            'properity' => new Properity(),
            'countries' => Country::all(),
            'users' => User::all(),
            'types' => Type::all(),
            'categories' => Category::all(),
            'cities' => City::all(),
            'currencies' => Currency::all(),
            'tags' => Tag::all(),
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
        //$request->validate(Properity::validateRoles());

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
        }

        $properity = Properity::create($data);

        return redirect()->route('admin.properities.index')
            ->with(
                'success',
                "Properity ($properity->name) added Sccessufly!"
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Properity  $properity
     * @return \Illuminate\Http\Response
     */
    public function show(Properity $properity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Properity  $properity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $properity = Properity::findOrFail($id);
        if ($properity == null) {
            abort(404);
        }
        return view('admin.properities.edit', [
            'properity' => $properity,
            'countries' => Country::all(),
            'users' => User::all(),
            'types' => Type::all(),
            'categories' => Category::all(),
            'cities' => City::all(),
            'currencies' => Currency::all(),
            'tags' => Tag::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Properity  $properity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $properity = Properity::findOrFail($id);
        if ($properity == null) {
            abort(404);
        }

        //$request->validate(Properity::validateRoles());

        //image
        $data = $request->all();
        $previous = false;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
            $previous = $properity->image;
        }

        $properity->update($data);
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }

        return redirect()->route('admin.properities.index')
            ->with(
                'success',
                "Properity ($properity->name) Updated Sccessufly!"
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Properity  $properity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $properity = Properity::findOrFail($id);
        $properity->delete();
        if ($properity->image) {
            Storage::disk('uploads')->delete($properity->image);
        }
        return redirect()->route('admin.properities.index')
            ->with('success', "Properity ($properity->name) Deleted Sccessufly!");
    }
}
