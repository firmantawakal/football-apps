<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Season;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = Season::all();
        return view('admin.season.index', compact('seasons'));
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
            'season_name' => 'required',
        ]);

        $input = $request->all();

        Season::create($input);

        return redirect()->route('season.index')
                        ->with('success','Data musim berhasil ditambah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Season $season)
    {
        $val = $request->validate([
            'season_name' => 'required',
        ]);

        $val['isActive'] = 0;

        if($request->isActive=='on'){
            $getActive = Season::where('isActive',1)->first();
            Season::where('id',$getActive->id)->update(['isActive' => 0]);
            $val['isActive'] = 1;
        }

        // $input = $request->all();
        $season->update($val);

        return redirect()->route('season.index')
                        ->with('success','Data musim berhasil diubah');
    }
}
