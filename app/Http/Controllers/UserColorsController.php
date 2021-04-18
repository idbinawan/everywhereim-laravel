<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserColorsController extends Controller
{
    public function getUserColors()
    {
        $users[] = (new User())->setId(1)->setName('Iwan');
        $users[] = (new User())->setId(2)->setName('Tester');
        return view('cms', ['users' => $users]);
    }
}
