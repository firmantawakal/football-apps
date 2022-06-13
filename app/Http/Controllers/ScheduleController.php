<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Schedule;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index($id_season=null)
    {
        $isActiveSeason = DB::table('season')->where('isActive',1)->first();

        if ($id_season!=null) {
            $isActiveSeason = DB::table('season')->where('id',$id_season)->first();
        }

        $club = Club::all();
        $player = Player::all();
        $season = DB::table('season')->get();
        $all_schedule = Schedule::
                    leftJoin('club AS a', 'schedule.id_club_a', '=', 'a.id')
                    ->leftJoin('club AS b', 'schedule.id_club_b', '=', 'b.id')
                    ->join('season', 'schedule.id_season', '=', 'season.id')
                    ->where('season.id',$isActiveSeason->id)
                    ->select(
                        'a.club_name as club_a',
                        'b.club_name as club_b',
                        'a.image as image_a',
                        'b.image as image_b',
                        'a.stadium as stadium_a',
                        'b.stadium as stadium_b',
                        'a.coach as coach_a',
                        'b.coach as coach_b',
                        'schedule.*','season.*')->get();

        return view('admin.schedule.schedule', compact('club','season','isActiveSeason','all_schedule','player'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_season' => 'required',
            'id_club_a' => 'required',
            'id_club_b' => 'required',
        ]);

        $time2 = $request->date.' '.$request->time;
        $time = date('Y-m-d H:i', strtotime($time2));
        $validated['time'] = $time;

        Schedule::create($validated);
        return redirect()->route('schedule')
                        ->with('success','Jadwal Berhasil di Tambah');
    }

    public function scorer($id_schedule)
    {
        $playerA = Player::leftJoin('club', 'player.id_club', '=', 'club.id')
                    ->leftJoin('schedule', 'schedule.id_club_a', '=', 'club.id')
                    ->where('schedule.id', $id_schedule)
                    ->select('player.*')->get();

        $playerB = Player::leftJoin('club', 'player.id_club', '=', 'club.id')
                    ->leftJoin('schedule', 'schedule.id_club_b', '=', 'club.id')
                    ->where('schedule.id', $id_schedule)
                    ->select('player.*')->get();

        $schedule = Schedule::
                    leftJoin('club AS a', 'schedule.id_club_a', '=', 'a.id')
                    ->leftJoin('club AS b', 'schedule.id_club_b', '=', 'b.id')
                    ->where('schedule.id', $id_schedule)
                    ->join('season', 'schedule.id_season', '=', 'season.id')
                    ->select(
                        'a.club_name as club_a',
                        'b.club_name as club_b',
                        'a.image as image_a',
                        'b.image as image_b',
                        'a.stadium as stadium_a',
                        'b.stadium as stadium_b',
                        'a.coach as coach_a',
                        'b.coach as coach_b',
                        'schedule.*','season.*')->first();

        $scorer_a = DB::table('scorer_temp')
                    ->select('player_name','scorer_temp.*')
                    ->leftJoin('player','player.id','=','scorer_temp.id_player')
                    ->orderBy('minutes_goal')
                    ->where('scorer_temp.id_schedule', $id_schedule)
                    ->where('team','a')->get();

        $scorer_b = DB::table('scorer_temp')
                    ->select('player_name','scorer_temp.*')
                    ->leftJoin('player','player.id','=','scorer_temp.id_player')
                    ->orderBy('minutes_goal')
                    ->where('scorer_temp.id_schedule', $id_schedule)
                    ->where('team','b')->get();

        return view('admin.schedule.add_scorer',compact('schedule','playerA','playerB','scorer_a','scorer_b'));
    }

    public function scorer_store(Request $request){
        $data = [
            'id_schedule' => $request->id_schedule,
            'team' => $request->team,
            'id_player' => $request->id_player,
            'minutes_goal' => $request->minutes_goal,
        ];

        $id = DB::table('scorer_temp')->insert($data);
        $result = DB::table('scorer_temp')
                    ->select('player_name','scorer_temp.*')
                    ->leftJoin('player','player.id','=','scorer_temp.id_player')
                    ->orderBy('minutes_goal')
                    ->where('team', $request->team)
                    ->where('scorer_temp.id_schedule',$request->id_schedule)->get();
        return $result;
    }

    public function scorer_destroy(Request $request)
    {
        $ply = DB::table('scorer_temp')->where('id',$request->id)->first();
        $dlt = DB::table('scorer_temp')->where('id',$request->id)->delete();

        $result = DB::table('scorer_temp')
                    ->select('player_name','scorer_temp.*')
                    ->leftJoin('player','player.id','=','scorer_temp.id_player')
                    ->orderBy('minutes_goal')
                    ->where('team', $ply->team)
                    ->where('scorer_temp.id_schedule',$request->id_schedule)->get();
        return $result;
    }

    public function finish(Request $request){
        $player = DB::table('scorer_temp')->where('id_schedule',$request->id_schedule)->get();
        if ($player) {
            // copy temp_scorer to scorer
            DB::table('scorer')->where('id_schedule', $request->id_schedule)->delete();
            foreach ($player as $ply) {
                $data = [
                    'id_schedule' => $ply->id_schedule,
                    'id_player' => $ply->id_player,
                    'minutes_goal' => $ply->minutes_goal,
                    'team' => $ply->team
                ];
                DB::table('scorer')->insert($data);
            }

            // update match score and point
            $dt = $this->get_score($request->id_schedule);
            Schedule::find($request->id_schedule)->update($dt);

            return ['response' => 'success'];
        }else{
            // update match score and point
            $dt = $this->get_score($request->id_schedule);
            Schedule::find($request->id_schedule)->update($dt);
            return ['response' => 'success'];
        }
    }

    public function get_score($id_schedule){
        $score = DB::table('scorer_temp')
        ->selectRaw('count(team) as score, team')
        ->where('id_schedule',$id_schedule)
        ->groupBy('team')->get();

        $scoreA=0;
        $scoreB=0;
        $pointA=0;
        $pointB=0;

        foreach ($score as $sc) {
            if ($sc->team == 'a') {
                $scoreA = $sc->score;
            }else{
                $scoreB = $sc->score;
            }
        }

        // set match point
        if ($scoreA == $scoreB) { // draw
            $pointA = 1;
            $pointB = 1;
        }elseif ($scoreA > $scoreB) { //A win
            $pointA = 3;
        }elseif ($scoreA < $scoreB) { //B win
            $pointB = 3;
        }

        $data = [
            'score_a' => $scoreA,
            'score_b' => $scoreB,
            'point_a' => $pointA,
            'point_b' => $pointB,
            'isFinish' => 1
        ];

        return $data;
    }

}
