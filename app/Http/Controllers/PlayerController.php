<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Club;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $player = Player::select('player.*', 'club.club_name')
                    ->leftJoin('club', 'player.id_club', '=', 'club.id')
                    ->get();

        return view('admin.player.list_player',compact('player'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $club = Club::orderBy('club_name')->get();
        return view('admin.player.create_player', compact('club'));
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
            'id_club' => 'required',
            'player_name' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'number' => 'required',
            'position' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $validated['birth_date'] = date('Y-m-d', strtotime($request->birth_date));

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $random = mt_rand(1000000000, 9999999999);
            $destinationPath = 'image/player/';
            $name = date('YmdHis-').$random."." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $name);
            $validated['image'] = $name;
        }

        Player::create($validated);
        return redirect()->route('club.detail', $request->id_club)
                        ->with('success','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $dt_player = Player::where('id',$player->id)->first();
        return view('admin.player.edit_player',compact('dt_player'));
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
            'id_club' => 'required',
            'player_name' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'number' => 'required',
            'position' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $validated['birth_date'] = date('Y-m-d', strtotime($request->birth_date));

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $random = mt_rand(1000000000, 9999999999);
            $destinationPath = 'image/player/';
            $name = date('YmdHis-').$random."." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $name);
            $validated['image'] = $name;

            if ($request->image_old!=null) {
                if (file_exists(public_path().'/image/player/'.$request->image_old)){
                    unlink("image/player/".$request->image_old);
                }
            }
        }

        try {
            Player::find($id)->update($validated);
            return redirect()->route('club.detail', $request->id_club)
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
        $pl = Player::find($id)->first();
        $pl->delete();

        return redirect()->route('club.detail', $pl->id_club)
                         ->with('success','Data berhasil dihapus');
    }
}
