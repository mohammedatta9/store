<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', [
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create', [
            'tag' => new Tag(),
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
        //$request->validate(Tag::validateRoles());

        $data = $request->all();

        $tag = Tag::create($data);

        return redirect()->route('admin.tags.index')
            ->with(
                'success',
                "Tag ($tag->name) added Sccessufly!"
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $tag = Tag::findOrFail($id);
        if ($tag == null) {
            abort(404);
        }
        return view('admin.tags.edit', compact('tag'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $tag = Tag::findOrFail($id);
        if ($tag == null) {
            abort(404);
        }

        //$request->validate(Type::validateRoles());
        return redirect()->route('admin.tags.index')
        ->with( 'success',"Tag ($tag->name) Updated Sccessufly!"
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
         return redirect()->route('admin.tags.index')
             ->with('success', "Tag ($tag->name) Deleted Sccessufly!");
   
    }
}
