<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function create (Request $request)
    {
        $dataToGet = ['name', 'description', 'image'];

        $team = new Team($request->only($dataToGet));
        $team->save();

        return response()->json($request->only($dataToGet), 200);
    }

    public function showMyTeams(Request $request)
    {
        if (!Auth::check())
            return response()->json(['message' => 'Unauthorized', 'status' => false], 401);

        if ($request->route('id'))
        {
            $teams = Team::find($request->route('id'));
            $teams['members'] = $teams->members;

            for ($i = 0; $i < count($teams['members']); $i++)
            {
                $teams['members'][$i]['is_admin'] = $teams['members'][$i]->pivot->is_admin == 1 ? true : false;
                $teams['members'][$i] = $teams['members'][$i]->makeHidden('pivot');
            }
        }
        else
        {
            $teams = User::find(auth()->user()->id)->teams;

            for ($i = 0; $i < count($teams); $i++)
            {
                $teams[$i]['count_members'] = TeamMember::countTeamMembers($teams[$i]->id);
                $teams[$i]['is_admin'] = $teams[$i]->pivot->is_admin == 1 ? true : false;
            }

            $teams = $teams->makeHidden('pivot');
        }

        return response()->json($teams, 200);
    }

    public function read(Request $request)
    {
        if (!Auth::check())
            return response()->json(['message' => 'Unauthorized', 'status' => false], 401);

        $teams = User::all()->members;

        for ($i = 0; $i < count($teams); $i++)
            $teams[$i]['is_admin'] = $teams[$i]->pivot->is_admin == 1 ? true : false;

        $teams = $teams->makeHidden('pivot');

        //$teams['teste'] = $teams->is_admin;


        return response()->json($teams, 200);



        $where = [
            [ 'member_id', '=', auth()->user()->id ]
        ];

        if ($request->route('id'))
            array_push($where, ['id', '=', $request->route('id')]);

        $myTeam = Team::where($where);

        return response()->json($team->members, 200);
    }

    public function update(Request $request)
    {
        $myTeam = Team::where('id', '=', $request->route('id'));

        if ($request->name)
            $data['name'] = $request->name;
        if ($request->image)
            $data['image'] = $request->image;

        if(!$myTeam->count())
            return response()->json(['message' => 'not found'], 404);

        if ($data)
            $myTeam->update($data);

        return response()->json($data, 200);
    }
}
