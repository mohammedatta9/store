<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('admin.currencies.index', [
            'currencies' => $currencies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencies.create', [
            'currency' => new Currency(),
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
         //$request->validate(Currency::validateRoles());

         $data = $request->all();

         $currency = Currency::create($data);
 
         return redirect()->route('admin.currencies.index')
             ->with(
                 'success',
                 "Currency ($currency->name) added Sccessufly!"
             );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        if ($currency == null) {
            abort(404);
        }
        return view('admin.currencies.edit', compact('currency'));
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $currency = Currency::findOrFail($id);
        if ($currency == null) {
            abort(404);
        }
        //$request->validate(Currency::validateRoles());
        return redirect()->route('admin.currencies.index')
        ->with( 'success',"Currency ($currency->name) Updated Sccessufly!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
         return redirect()->route('admin.currencies.index')
             ->with('success', "Currency ($currency->name) Deleted Sccessufly!");
   
 
    }
}
