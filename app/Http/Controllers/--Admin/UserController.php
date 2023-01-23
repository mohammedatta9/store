<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users,
            'countries' => Country::all(),
            'cities' => City::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'user' => new User(),
            'countries' => Country::all(),
            'cities' => City::all(),
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
          //$request->validate(User::validateRoles());

          $data = $request->all();

          if ($request->hasFile('image')) {
              $file = $request->file('image');
              $data['image'] = $file->store('/image', [
                  'disk' => 'uploads'
              ]);
          }
  
          $user = User::create($data);
  
          return redirect()->route('admin.users.index')
              ->with(
                  'success',
                  "User ($user->name) added Sccessufly!"
              );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user == null) {
            abort(404);
        }
        return view('admin.users.edit', [
            'user' => $user,
            'countries' => Country::all(),
            'cities' => City::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        if ($user == null) {
            abort(404);
        }

        //$request->validate(User::validateRoles());

        //image
        $data = $request->all();
        $previous = false;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/image', [
                'disk' => 'uploads'
            ]);
            $previous = $user->image;
        }

        $user->update($data);
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }

        return redirect()->route('admin.users.index')
            ->with(
                'success',
                "User ($user->name) Updated Sccessufly!"
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        if ($user->image) {
            Storage::disk('uploads')->delete($user->image);
        }
        return redirect()->route('admin.users.index')
            ->with('success', "User ($user->name) Deleted Sccessufly!");
  
    }
}
