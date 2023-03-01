<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Resources\Authentication\LoginUserResource;
use Auth;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        if (Auth::guest()) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'data' => LoginUserResource::make(Auth::user())
        ], Response::HTTP_OK);
    }
}