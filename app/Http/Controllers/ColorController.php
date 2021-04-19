<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    /**
     * Get all colors belong to a user
     *
     * @param int $user_id
     * @return array
     */
    public function show(int $user_id)
    {
        return DB::table('user_colors')
                ->join('colors', 'user_colors.color_id', '=', 'colors.id')
                ->select('user_colors.id', 'user_colors.position', 'user_colors.color_id', 'colors.name', 'colors.color_code')
                ->where('user_colors.user_id', '=', $user_id)
                ->orderBy('user_colors.position')
                ->get();
    }
}
