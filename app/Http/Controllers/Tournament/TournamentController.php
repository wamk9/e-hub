<?php

namespace App\Http\Controllers\Tournament;

use App\Models\League\League;
use App\Models\Tournament\Tournament;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

use Image;
class TournamentController extends Controller
{
    public function create (Request $request)
    {
        if (!$this->verifyLeagueUserAuthorization($request->user('sanctum')->id, $request->route('leagueRoute'), 'config', 'create_league_tournaments'))
            return response()->json(['message' => 'Unauthorized'], 401);

        DB::transaction(function() use ($request)
        {
            $league = League::where('route', $request->route('leagueRoute'))->first();

            if (!$league)
                throw ValidationException::withMessages(['message' => 'League not found']);

            $tournament = Tournament::where([
                ['route', '=', $request->only('route')],
                ['league_id', '=', $league->id],
            ])->first();

            if (!!$tournament)
                throw ValidationException::withMessages(['message' => 'Tournament route in use.']);

            $requestData = [
                'name',
                'description',
                'route',
                'currency_id',
                'price',
                'subscription_limit',
                'subcategory_id',
            ];

            $tournament = new Tournament($request->only($requestData));
            $tournament->league_id = $league->id;

            $tournament->save();

            if ($request->filled('logo_image'))
            {
                $path = storage_path('app/public/league/'.$league->route.'/tournament//'.$tournament->route);

                if(!File::isDirectory($path))
                    File::makeDirectory($path, 0755, true, true);

                Image::make($request->only('logo_image')['logo_image'])->encode('webp', 90)->resize(250, 250, function($constraint) { $constraint->aspectRatio(); })->save($path.'/logo.webp');
            }
        });

        return response()->json(['message' => "Tournament created"], 200);
    }

    public function updateProfile (Request $request)
    {
        if (!$this->verifyLeagueUserAuthorization($request->user('sanctum')->id, $request->route('leagueRoute'), 'config', 'edit_league_tournaments'))
            return response()->json(['message' => 'Unauthorized'], 401);

        DB::transaction(function() use ($request)
        {
            $league = League::where('route', $request->route('leagueRoute'))->first();

            if (!$league)
                throw ValidationException::withMessages(['message' => 'League not found']);

            $tournament = Tournament::where([
                ['route', '=', $request->route('tournamentRoute')],
                ['league_id', '=', $league->id],
            ])->first();

            if (!$tournament)
                throw ValidationException::withMessages(['message' => 'Tournament not found.']);

            $requestData = [
                'name',
                'description',
                'route',
                'currency_id',
                'price',
                'subscription_limit',
                'subcategory_id',
            ];

            $updatedData = [];

            foreach($tournament->toArray() as $key => $actualInfo)
                if (array_key_exists($key, $requestData) && ($actualInfo != $requestData[$key]))
                    $updatedData[$key] = $requestData[$key];

            if (array_key_exists('route', $updatedData))
            {
                $whereCondition = [
                    ['route', '=', $updatedData['route']],
                    ['league_id', '=', $league->id],
                    ['id', '!=', $tournament->id]
                ];

                if (count(Tournament::where($whereCondition)->get()->toArray()) > 0)
                    throw ValidationException::withMessages(['message' => 'Tournament route in use']);
            }


            $tournament->update($updatedData);

            if ($request->filled('logo_image'))
            {
                $path = storage_path('app/public/league/'.$league->route.'/tournament//'.$tournament->route);

                if(!File::isDirectory($path))
                    File::makeDirectory($path, 0755, true, true);

                Image::make($request->only('logo_image')['logo_image'])->encode('webp', 90)->resize(250, 250, function($constraint) { $constraint->aspectRatio(); })->save($path.'/logo.webp');
            }
        });

        return response()->json(['message' => "Tournament edited"], 200);
    }

    public function show(Request $request)
    {
		$league = League::where('route', $request->route('leagueRoute'))->first();

        if (!$league)
            throw ValidationException::withMessages(['message' => 'League not found']);

        $tournament = Tournament::where([
            ['route', '=', $request->route('tournamentRoute')],
            ['league_id', '=', $league->id],
        ])->first();

        if (!$tournament)
            throw ValidationException::withMessages(['message' => 'Tournament not found']);

        return response()->json(['message' => $tournament], 200);
    }
}
