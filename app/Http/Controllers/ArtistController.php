<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::latest()->paginate(5);
    
        return view('artists.index',compact('artists'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ArtistName' => 'required',
            'PackageName' => 'required',
            'ImageURL' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ReleaseDate'=>'required',
            'Price'=>'required|numeric',
            'SampleURL'=>'required',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('ImageURL')) {
            $destinationPath = 'images/';
            $PackageImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $PackageImage);
            $input['ImageURL'] = "$PackageImage";
        }
    
        Artist::create($input);
     
        return redirect()->route('artists.index')
                        ->with('success','New Music Adding successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        return view('artists.edit',compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'ArtistName' => 'required',
            'PackageName' => 'required',
            'ReleaseDate' => 'required',
            'Price' => 'required|numeric',
            'SampleURL' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('ImageURL')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['ImageURL'] = "$profileImage";
        }else{
            unset($input['ImageURL']);
        }
          
        $artist->update($input);
    
        return redirect()->route('artists.index')
                        ->with('success','Music updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('artists.index');
    }
}
