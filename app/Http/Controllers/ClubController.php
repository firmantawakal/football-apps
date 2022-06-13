<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Player;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $club = Club::all();
        return view('admin.club.list_club',compact('club'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.club.create_club');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_name' => 'required',
            'stadium' => 'required',
            'coach' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $random = mt_rand(1000000000, 9999999999);
            $destinationPath = 'image/club/';
            $name = date('YmdHis-').$random."." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $name);
            $validated['image'] = $name;
        }

        Club::create($validated);
        return redirect()->route('club.index')
                        ->with('succes','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {

        $club = Club::where('id',$id)->first();
        $player = Player::where('id_club',$id)->get();
        return view('admin.club.detail_club',compact('player','club'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        $dt_club = Club::where('id',$club->id)->first();
        return view('admin.club.edit_club',compact('dt_club'));
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
        $validated = $request->validate([
            'club_name' => 'required',
            'stadium' => 'required',
            'coach' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $random = mt_rand(1000000000, 9999999999);
            $destinationPath = 'image/club/';
            $name = date('YmdHis-').$random."." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $name);
            $validated['image'] = $name;

            if ($request->image_old!=null) {
                if (file_exists(public_path().'/image/club/'.$request->image_old)){
                    unlink("image/club/".$request->image_old);
                }
            }
        }

        try {
            Club::find($id)->update($validated);
            return redirect()->route('club.index')
                        ->with('success','Data berhasil diubah');
        }  catch (\Exception $ex) {
            dd($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
