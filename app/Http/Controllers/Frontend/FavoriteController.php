<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\FavoriteAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to favorite agents',
                'redirect' => route('client.login')
            ], 401);
        }

        $agentId = $request->input('agent_id');
        $user = Auth::user();

        $favorite = FavoriteAgent::where('user_id', $user->id)
            ->where('agent_id', $agentId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $isFavorited = false;
        } else {
            FavoriteAgent::create([
                'user_id' => $user->id,
                'agent_id' => $agentId,
            ]);
            $isFavorited = true;
        }

        return response()->json([
            'status' => 'success',
            'is_favorited' => $isFavorited
        ]);
    }
}
