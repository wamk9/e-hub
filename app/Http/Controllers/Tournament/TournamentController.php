<?php

namespace App\Http\Controllers\Tournament;

use App\Models\League\League;
use App\Models\Tournament\Tournament;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TournamentController extends Controller
{
    public function create (Request $request) {
        DB::transaction(function() use ($request) {
            $league = League::where('route', $request->route('leagueRoute'))->first();

            if (!$league)
                throw ValidationException::withMessages(['message' => 'League not found']);

            $tournament = Tournament::where([
                ['route', '=', $request->only('route')],
                ['league_id', '=', $league->id],
            ])->first();

            if (!!$tournament)
                throw ValidationException::withMessages(['message' => 'Tournament route in use.']);

            $dataToGet = [
                'name',
                'description',
                'route',
                'price',
                'subscription_limit',
                'banner_image',
                'logo_image',
                'category_id',
            ];

            $tournament = new Tournament($request->only($dataToGet));
            $tournament->league_id = $league->id;

            $tournament->save();
        });

        return response()->json(['message' => "Tournament created"], 200);
    }

    public function show(Request $request) {
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
    //
}
