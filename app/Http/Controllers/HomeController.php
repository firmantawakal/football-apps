<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Club;

class HomeController extends Controller
{
    public function index()
    {
        $rank = array();
        $isActiveSeason = DB::table('season')->where('isActive',1)->first();
        $club = Club::all();
        foreach ($club as $cl) {
            $result = DB::table('schedule as s')
                    ->join('club as ca','s.id_club_a','ca.id')
                    ->join('club as cb','s.id_club_b','cb.id')
                    ->join('season', 's.id_season', 'season.id')
                    ->where('season.id',$isActiveSeason->id)
                    ->whereRaw('ca.id = '.$cl->id.' OR cb.id = '.$cl->id)
                    // ->orWhere('cb.id',$cl->id)
                    ->get();

            $play=0;
            $m=0;
            $s=0;
            $k=0;
            $pts=0;
            $goal=0;
            $goalLose=0;

            foreach ($result as $res) {
                $play+=1;
                if ($res->id_club_a == $cl->id) {
                    $pts += $res->point_a;
                    if ($res->point_a > $res->point_b) {
                        $m += 1;
                    }elseif ($res->point_a == $res->point_b) {
                        $s += 1;
                    }else{
                        $k += 1;
                    }
                    $goal += $res->score_a;
                    $goalLose += $res->score_b;
                }
                elseif ($res->id_club_b == $cl->id) {
                    $pts += $res->point_b;
                    if ($res->point_b > $res->point_a) {
                        $m += 1;
                    }elseif ($res->point_b == $res->point_a) {
                        $s += 1;
                    }else{
                        $k += 1;
                    }
                    $goal += $res->score_b;
                    $goalLose += $res->score_a;
                }
            }

            $rank[] = [
                'club_image' =>$cl->image,
                'club_name' =>$cl->club_name,
                'p' =>$play,
                'm' =>$m,
                's' =>$s,
                'k' =>$k,
                'pm' =>$goal-$goalLose,
                'pts' =>$pts,
            ];
        }

        // sorting array by pts, then pm
        usort($rank, function ($a, $b) {
            if ($a['pts'] == $b['pts']) {
                if ($a['pm'] < $b['pm']) {
                    return 1;
                }
            }
            return $a['pts'] < $b['pts'] ? 1 : -1;
        });

        $topScorer = DB::table('scorer')
                        ->select('player.*','club.*')
                        ->selectRaw('COUNT(scorer.id_player) as total_score')
                        ->leftJoin('player','player.id','=','scorer.id_player')
                        ->leftJoin('club','club.id','=','player.id_club')
                        ->leftJoin('schedule','schedule.id','=','scorer.id_schedule')
                        ->leftJoin('season','season.id','=','schedule.id_season')
                        ->where('season.id', $isActiveSeason->id)
                        ->groupBy('scorer.id_player')
                        ->orderBy('total_score', 'DESC')->get();

        return view('admin.dashboard',compact('rank','topScorer'));
    }
}
