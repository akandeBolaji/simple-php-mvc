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
        
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        $registerModel->loadData($request->getBody());
        if ($registerModel->validate() && $registerModel->save()) {
            Application::$app->response->json([
                'message' => "Register Successful"
            ], 201);
        }
        else if (!$registerModel->validate()) {
            Application::$app->response->json([
                'message' => "Register failed",
                'data' => [
                    'errors' => $registerModel->errors
                ]
            ], 400);
        } 
        else {
            Application::$app->response->json([
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