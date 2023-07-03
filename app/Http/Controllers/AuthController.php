<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {   //on accessede sans connexion
        $this->middleware('auth:api',['except' => ['login','register']]);
        $this->guard = "api";
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:15'
        ]);
        //dd(auth()->attempt($validator->validated()));
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'invalide cridentials'], 401);
        }

        return $this->createNewToken($token);
        }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expired_in' => JWTAuth::factory()->getTTL() * 60,
            //'expired' => auth()->factory()->getTTL() * 480,
            'user' => auth()->user(),
            'message' => 'welecome ' . auth()->user()->prenom
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function register(Request $request)
    {
        //   if(!Gate::allows('superadmin')){
        //       return response()->json([
        //           'message'=>'vous n\'avez pas acceces aux ressources demandées'
        //       ],403);
        //   }
        //$prenomnom=$request->all()['prenom'].' '.$request->all()['nom'];
        //$matches=array();
       // preg_match("/[0-9]*$/",$request->all()['login'],$matches);
        //$defaultpassword = strtoupper(substr(uniqid(),6));
        //$idProfile = $request->profile_id;
        //$profile = DB::table('profiles')->where('id', $idProfile)->first();
        $validator = Validator::make($request->all(), [
            'prenom'=>'required',
            'nom'=>'required',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed|min:6|confirmed|max:15',
            //'login' => 'required',
            //'profile_id' => 'required',
            //'drv_id' => 'required',
            //'telephone'=>'required',
            //'adresse'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($request->password),
            ],
        ));
        return response()->json([
            'message' => "l'utilisateur  crée avec succes",
            'user' => $user->all()
        ], 201);
    }

    /**
     * Get the authenticated User.
     *
     */
    public function profile()
    {
        request()->user() ? response()->json(auth()->user()) : response()->json(['message' => 'user not found'], 404);
    }

    /**
     * Log the user out (Invalidate the token).
     * deconnexion consite à effacer le token donc il faut se connecter au prealable
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'deconnexion ...'], 200);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'type' => 'bearer',
            'expired' => auth()->factory()->getTTL() * 60,
            //'expired' => JWTAuth::factory()->getTTL() * 480,
            'user' => auth()->user(),
            'message' => 'welcome ' . auth()->user()->prenom
        ]);
    }
}
