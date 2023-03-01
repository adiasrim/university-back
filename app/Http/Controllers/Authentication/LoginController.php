<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\User\LoginUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Resources\Authentication\LoginUserResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param LoginUserAction $userAction
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request, LoginUserAction $userAction)
    {
        $data = $request->validated();

        $user = $userAction->execute($data);

        return response()->json([
            'data' => LoginUserResource::make($user),
        ], Response::HTTP_OK);
    }
}