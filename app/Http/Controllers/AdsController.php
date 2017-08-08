<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $ads = Ad::latest()->paginate(5);

        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $this->validate(request(), [
            'title' => 'required|min:2|max:50',
            'description' => 'required|min:5|max:255'
        ]);


        $ad = Ad::create([
            'title' => request('title'),
            'description' => request('description'),
            'user_id' => auth()->id()
        ]);

        session()->flash('message', 'Ad have been created');

        return redirect("/ads/$ad->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::find($id);
        return view('ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Ad::find($id);
        return view('ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ad = Ad::find($id);

        if (auth()->id() == $ad->user->id) {
            $ad->update($request->all());
        } else {
            session()->flash('message', 'You dont have permission to update this ad');
            return redirect()->home();
        }

        session()->flash('message', 'Ad have been updated');

        return redirect()->home();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::find($id);

        if (auth()->id() == $ad->user->id) {
            $ad->delete();
        } else {
            session()->flash('message', 'You dont have permission to delete this ad');
            return redirect()->home();
        }

        session()->flash('message', 'Ad have been deleted');

        return redirect()->home();
    }
}
