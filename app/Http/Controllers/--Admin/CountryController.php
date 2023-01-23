<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.countries.index', [
            'countries' => $countries,       
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
            'country' => new Country(),
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
         //$request->validate(Country::validateRoles());

         $data = $request->all();

         $country = Country::create($data);
 
         return redirect()->route('admin.countries.index')
             ->with(
                 'success',
                 "Country ($country->name) added Sccessufly!"
             );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        if ($country == null) {
            abort(404);
        }
        return view('admin.countries.edit', compact('country'));
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $country = Country::findOrFail($id);
        if ($country == null) {
            abort(404);
        }

        //$request->validate(Type::validateRoles());
        return redirect()->route('admin.countries.index')
        ->with( 'success',"Country ($country->name) Updated Sccessufly!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
         return redirect()->route('admin.countries.index')
             ->with('success', "Country ($country->name) Deleted Sccessufly!");
   
    }
}
