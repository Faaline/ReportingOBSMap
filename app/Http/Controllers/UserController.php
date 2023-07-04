<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users =User::with('profile')->orderBy('created_at','desc')->paginate(10);
        return response()->json($users, 200);
    }
}
