<?php

namespace Modules\User\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        return apiResponse()->respond(User::create($request->validated()), Response::HTTP_CREATED);
    }

    /**
     * Show the User resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond($user);
    }
}
