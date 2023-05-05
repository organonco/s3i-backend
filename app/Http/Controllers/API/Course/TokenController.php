<?php

namespace App\Http\Controllers\API\Course;

use App\Exceptions\Course\InvalidToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\Token\StoreTokenRequest;
use App\Models\CourseToken;


/**
 * @group Course
 * @subgroup Token
 */
class TokenController extends Controller
{

    /**
     * Store
     * @authenticated
     * @response 200 {}
     * @responseFile 403 app/Http/Responses/Samples/Course/invalid-token.json
     * @throws InvalidToken
     */
    public function store(StoreTokenRequest $request)
    {
        $token = CourseToken::byHash($request->getToken());
        if (is_null($token) || $token->isUsed())
            throw new InvalidToken;
        $token->setStudent($request->user());
    }

}
