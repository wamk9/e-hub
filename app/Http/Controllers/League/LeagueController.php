<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Models\User\Hierarchy;
use App\Models\League\League;
use App\Models\User;
use App\Models\User\Hierarchy\ConfigHierarchy;
use App\Models\User\UserHierarchy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use Image;
use Throwable;

class LeagueController extends Controller
{
    public function create(Request $request)
    {
        DB::transaction(function() use ($request) {
            $dataToGet = [
                'name',
                'description',
                'route'
            ];

            $validateLeague = Validator::make($request->only($dataToGet), [
                'name' => 'required',
                'route' => 'required'
            ]);

            if($validateLeague->fails()){
                throw ValidationException::withMessages($validateLeague->messages()->all());
            }

            $league = new League($request->only($dataToGet));

            if (League::where('name', $league->name)->first())
                throw ValidationException::withMessages(['name' => 'League name in use',]);

            if (League::where('route', $league->route)->first())
                throw ValidationException::withMessages(['route' => 'League route in use',]);

            if ($request->only('logo_image')['logo_image'])
            {
                $path = storage_path('app/public/league/'.$league->route);

                if(!File::isDirectory($path))
                    File::makeDirectory($path, 0755, true, true);

                Image::make($request->only('logo_image')['logo_image'])->encode('webp', 90)->resize(250, 250)->save($path.'/logo.webp');
            }

            $league->save();

            $hierarchies = [
                [
                'name' => 'Admin',
                'description' => 'Admin hierarchy of eHub, here we can use all options.',
                'editable' => false,
                'league_id' => $league->id,
                'config' => [
                    'edit_league_info' => 1,
                    'edit_league_hierarchies' => 1,
                    'view_menu' => 1,
                ],
                ],
                [
                'name' => 'Club',
                'description' => 'Sign Club hierarchy of eHub.',
                'editable' => false,
                'league_id' => $league->id
                ],
                [
                'name' => 'User',
                'description' => 'User hierarchy of eHub.',
                'editable' => false,
                'league_id' => $league->id
                ],
            ];

            foreach ($hierarchies as $data)
            {
                // Hierarchy
                $hierarchyData = [
                'name' => $data['name'],
                'description' => $data['description'],
                'editable' => $data['editable'],
                'league_id' => $data['league_id'],
                ];

                $hierarchy = new Hierarchy($hierarchyData);
                $hierarchy->save();

                $userHierarchyData = [
                'user_id' => auth()->user()->id,
                'league_id' => $data['league_id'],
                'hierarchy_id' => $hierarchy->id
                ];

                $userHierarchy = new UserHierarchy($userHierarchyData);
                $userHierarchy->save();

                // Hierarchy Configuration Values
                $configHierarchyData = [
                'league_id' => $data['league_id'],
                'hierarchy_id' => $hierarchy->id,
                ];

                if (array_key_exists('config', $data))
                {
                foreach ($data['config'] as $key => $configValue)
                    $configHierarchyData[$key] = $configValue;
                }

                $configHierarchy = new ConfigHierarchy($configHierarchyData);
                $configHierarchy->save();
            }
        });

        return response()->json(['message' => 'League saved'], 200);
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $userHierarchiesOnLeague = $user->hierarchies->where('league_id', $request->route('id'));

        if (!count($userHierarchiesOnLeague))
        throw ValidationException::withMessages(['message' => 'User don\'t present in this league']);

        $canEditLeagueInfo = false;

        foreach ($userHierarchiesOnLeague as $hierarchy)
        {
            $hierarchy = Hierarchy::where('id', $hierarchy->pivot->hierarchy_id)->first();

            if ($hierarchy->config->edit_league_info)
            {
                $canEditLeagueInfo = true;
                break;
            }
        }

        if (!$canEditLeagueInfo)
        return response()->json(['message' => 'Unauthorized'], 401);

        DB::transaction(function () use ($request){
            $league = League::where('id', $request->route('id'))->first();

            $requestData = $request->only(
                [
                'name',
                'description',
                'route',
                'logo_image'
                ]
            );

            $updatedData = [];
            foreach($league->toArray() as $key => $actualInfo)
            {
                if (array_key_exists($key, $requestData) && ($actualInfo != $requestData[$key]))
                $updatedData[$key] = $requestData[$key];
            }


            if (array_key_exists('name', $updatedData) && count(League::where([['name', '=', $updatedData['name']], ['id', '!=', $league->id]])->get()->toArray()) > 0)
                throw ValidationException::withMessages(['message' => 'League name in use']);

            $league->update($updatedData);
        });

        return response()->json(['message' => 'League information updated'], 200);
    }

    public function delete (Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $userHierarchiesOnLeague = $user->hierarchies->where('league_id', $request->route('id'));

        if (!count($userHierarchiesOnLeague))
            throw ValidationException::withMessages(['message' => 'User don\'t present in this league']);

        $canDeleteLeagueInfo = false;

        foreach ($userHierarchiesOnLeague as $hierarchy)
        {
            $hierarchy = Hierarchy::where('id', $hierarchy->pivot->hierarchy_id)->first();

            if ($hierarchy->config->edit_league_info)
            {
                $canDeleteLeagueInfo = true;
                break;
            }
        }

        if (!$canDeleteLeagueInfo)
            return response()->json(['message' => 'Unauthorized'], 401);

        $league = League::where('id', $request->route('id'))->first();
        $league->delete();

        return response()->json(['message' => 'League deleted'], 200);
    }

  public function show(Request $request)
  {
    if ($request->route('leagueRoute'))
    {
       $league = League::where('route', $request->route('leagueRoute'))->first();

        if ($league)
            return response()->json(['message' => $league], 200);
    }
    else
    {
      $league = League::all();

      if ($league)
        return response()->json(['message' => $league], 200);
    }

    return response()->json(['message' => "League not found."], 404);
  }
}
