<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as StatusResponse;


class ApiController extends Controller
{
    protected $statusCode = 200;

    public function respondSuccessCreated($message = "Registro creado con exito!",$data = null)
    {
        return $this->setStatusCode(StatusResponse::HTTP_CREATED)->respond([
           'resultado' => [
               'status' => 'success',
               'ok' => true,
               'message' => $message,
               'data' => $data
           ]
        ]);
    }

    public function respondSuccess($message = "Proceso realizado con exito",$data = null)
    {
        return $this->setStatusCode(StatusResponse::HTTP_OK)->respond([
            'resultado' => [
                'status' => 'success',
                'ok' => true,
                'message' => $message,
                'data' => $data
            ]
        ]);
    }

    public function respondNotFound($message = 'No encontrado'){
        return $this->setStatusCode(StatusResponse::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    public function respondWithErrorValidation(String $message, array $fields)
    {
        return $this->setStatusCode(StatusResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->respond([
                'resultado' => [
                    'status' => 'fail',
                    'ok' => false,
                    "message" => $message,
                    "invalid_inputs" => $fields
                ]
            ]);
    }

    public function respondFailAuthentication($message = "Credenciales incorrectas"){
        return $this->setStatusCode(StatusResponse::HTTP_UNAUTHORIZED)->respond([
            'resultado' => [
                'status' => 'fail',
                'ok' => false,
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondInternalError($message = "Hubo un error con algo, pronto lo solventaremos"){
        return $this->setStatusCode(StatusResponse::HTTP_INTERNAL_SERVER_ERROR)->respond([
            'resultado' => [
                'status' => 'fail',
                'ok' => false,
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondBadRequest($message){
        return $this->setStatusCode(StatusResponse::HTTP_BAD_REQUEST)->respond([
            'resultado' => [
                'status' => 'fail',
                'ok' => false,
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'resultado' => [
                'status' => 'fail',
                'ok' => false,
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respond($data,$headers = [])
    {
        return Response::json($data,$this->getStatusCode(),$headers);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

}
