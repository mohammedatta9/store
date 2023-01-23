<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('admin.countries.index', [
            'cities' => $cities,  
            'countries' => Country::all(),
     
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create', [
            'city' => new City(),
            'countries' => Country::all(),
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
           //$request->validate(City::validateRoles());

           $data = $request->all();

           $city = City::create($data);
   
           return redirect()->route('admin.countries.index')
               ->with(
                   'success',
                   "City ($city->name) added Sccessufly!"
               );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        $countries = Country::all();

        if ($city == null) {
            abort(404);
        }
        return view('admin.countries.edit', compact('city','countries'));
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $city = City::findOrFail($id);
        if ($city == null) {
            abort(404);
        }

        //$request->validate(Type::validateRoles());
        return redirect()->route('admin.countries.index')
        ->with( 'success',"Rating ($city->name) Updated Sccessufly!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
         return redirect()->route('admin.countries.index')
             ->with('success', "City ($city->name) Deleted Sccessufly!");
   
    }
}
