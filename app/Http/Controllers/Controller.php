<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function verifyLeagueUserAuthorization($userId, $leagueRoute, $authorizationType, $authorizationName)
    {
        $user = \App\Models\User::where('id', $userId)->first();

        $league = \App\Models\League\League::where('route', $leagueRoute)->first();

        if (!$league)
            throw ValidationException::withMessages(['message' => 'League not found']);

        $userHierarchiesOnLeague = $user->hierarchies->where('league_id', $league->id);

        if (!count($userHierarchiesOnLeague))
        throw ValidationException::withMessages(['message' => 'User don\'t present in this league']);

        foreach ($userHierarchiesOnLeague as $hierarchy)
        {
            $hierarchy = \App\Models\User\Hierarchy::where('id', $hierarchy->pivot->hierarchy_id)->first();

            if ($hierarchy->{$authorizationType}->{$authorizationName})
                return true;
        }

        return false;
    }
}
