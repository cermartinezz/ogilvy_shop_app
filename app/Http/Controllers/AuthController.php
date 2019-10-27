<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController
{
    public  $loginAfterSignUp = true;


    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => ['logout','getAuthUser']]);
    }

    public function registerClient(Request $request)
    {
        $validation = $this->validateRegister($request->all());

        if($validation->fails()) {
            return $this->respondWithErrorValidation("Hubo un error con los campos proporcionados",$validation->errors()->toArray());
        }

        $user = User::createUser($request)->load('role');

        $user = new UserResource($user);

        return $this->respondSuccessCreated("Usuario registrado con exito",['user' => $user]);

    }

    public function registerUsers(Request $request)
    {
        $validation = $this->validateRegister($request->all());

        if($validation->fails()) {
            return $this->respondWithErrorValidation("Hubo un error con los campos proporcionados",$validation->errors()->toArray());
        }

        $user = User::createUser($request)->load('role');

        $user = new UserResource($user);

        return $this->respondSuccessCreated("Usuario registrado con exito",['user' => $user]);

    }

    public function login(Request $request) {

        $input = $request->only('email', 'password');

        $jwt_token = null;

        if ( ! $token = auth('api')->attempt($input) ) {
            return $this->respondFailAuthentication("Correo o contraseña no son correctas");
        }
        return $this->respondSuccess("Usuario autenticado correctamente",['token' => $token, 'expire' => auth('api')->factory()->getTTL() * 60]);

    }

    public function logout(Request  $request) {

        if(auth()->check()){
            auth()->logout();
            return $this->respondSuccess("Cierre de session exitoso");
        }else{
            return $this->respondWithError("No hay session iniciada");
        }

    }

    public function getAuthUser(Request $request) {

        $user = auth()->user();;

        if(!$user){
            $this->respondFailAuthentication("El token no valido");
        }
        $user = (new UserResource($user))->toArray(request());

        return $this->respondSuccess("Token validado con exito",['user' => $user]);

    }

    protected function validateRegister(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['nullable'],
        ]);
    }


    protected function validateToken(array $data)
    {
        return Validator::make($data, [
            'token' => ['required'],
        ]);
    }

}
