<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\User;
use App\Models\UserColor;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use LogicException;

class UserColorController extends Controller
{
    /**
     * Get all users and their colors
     *
     * @return JsonResponse
     */
    public function getUsers()
    {
        $users = User::all();

        foreach($users as $user) {
            $user->colors = self::getColors($user->getAttribute('id'));
        }

        return response()->json($users);
    }

    /**
     * Get a user and his colors
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getUser(int $id)
    {
        $user = User::find($id);
        $user->colors = self::getColors($user->getAttribute('id'));

        return (!empty($user)) ? response()->json($user) : response()->json(['message' => 'Not Found!'], 404);
    }

    /**
     * Get UserColor
     *
     * @param int $id
     * @return UserColor
     */
    public function show(int $id)
    {
        return UserColor::find($id);
    }

    /**
     * Create a new UserColor (POST)
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $colors = self::getColors($request->input('user_id'));
        return UserColor::create(array_merge($request->all(), ['position' => count($colors) + 1]));
    }

    /**
     * Update UserColor (PUT)
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id)
    {
        $userColor = UserColor::findOrFail($id);
        $userColor->update($request->all());

        return $userColor;
    }

    /**
     * Delete color from a user
     *
     * @param int $id
     * @return Response
     */
    public function delete(int $id)
    {
        $userColor = UserColor::findOrFail($id);
        $userColor->delete();
        return response()->noContent();
    }

    /**
     * Delete user and his colors
     *
     * @param int $userId
     * @return Response|void
     */
    public function deleteUserColors(int $userId)
    {
        try {
            $userColors = UserColor::where('user_id', $userId)->delete();
            User::findOrFail($userId)->delete();
            return response()->noContent();
        } catch (\Throwable $th) {
            return response()->noContent()->withException($th);
        }
    }

    /**
     * Create a new user & one randomly chosen color (POST)
     *
     * @return Response
     */
    public function createUserColor() {
        try {
            $user = User::create(['name' => time()]);
            $colors = Color::all();
            $randomColor = $colors->shuffle()->first();
            $userColor = UserColor::create([
                            'user_id' => $user->id,
                            'color_id' => $randomColor->id,
                            'position' => 1,
                        ]);
            return $this->getUser($user->id);
        } catch (\Throwable $th) {
            return response()->noContent()->withException($th);
        }
    }

    /**
     * Shuffle the order or the colors belong to a user
     *
     * @param int $userId
     * @return array
     */
    public function shuffleColors(int $userId)
    {
        $userColors = UserColor::where('user_id', $userId)->get();
        $shuffledColors = $userColors->shuffle();
        $shuffledColors->all();

        $i = 1;
        foreach($shuffledColors as $userColor) {
            $userColor->position = $i;
            $userColor->save();
            $i++;
        }

        return $shuffledColors;
    }

    /**
     * Get colors of a user
     *
     * @param int $userId
     *
     * return array
     */
    private static function getColors(int $userId)
    {
        return app('App\Http\Controllers\ColorController')->show($userId);
    }
}
