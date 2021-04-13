<?php

namespace app\controllers;


use akandebolaji\phpmvc\{
    Application,
    Controller,
    Request,
    Response
};
use akandebolaji\phpmvc\middlewares\AuthMiddleware;
use app\models\{
    User,
    LoginUser
};


class UserController extends Controller
{
    public function __construct()
    {
        // $this->registerMiddleware(new AuthMiddleware(['profile']));
    }


    public function login(Request $request)
    {
            $loginUser = new LoginUser();
            $loginUser->loadData($request->getBody());
            if ($validate = $loginUser->validate() && $token = $loginUser->login()) {
                return Application::$app->response->json([
                    'message' => "Login Successful",
                    'data' => [
                        'bearer token' => $token
                    ]
                ], 201);
            }
            else if (!$validate) {
                return Application::$app->response->json([
                    'message' => "Login failed",
                    'data' => [
                        'errors' => $loginUser->errors
                    ]
                ], 400);
            } 
            else {
                return Application::$app->response->json([
                    'message' => "Login failed",
                    'data' => [
                        'errors' => ['Unable to register at the moment']
                    ]
                ], 400);
            }
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        $registerModel->loadData($request->getBody());
        if ($validate = $registerModel->validate() && $registerModel->save()) {
            return Application::$app->response->json([
                'message' => "Register Successful"
            ], 201);
        }
        else if (!$validate) {
            return Application::$app->response->json([
                'message' => "Register failed",
                'data' => [
                    'errors' => $registerModel->errors
                ]
            ], 400);
        } 
        else {
           return Application::$app->response->json([
                'message' => "Register failed",
                'data' => [
                    'errors' => ['Unable to register at the moment']
                ]
            ], 400);
        }

    } 

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}