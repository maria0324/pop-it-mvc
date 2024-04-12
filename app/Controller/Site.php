<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Model\Post;
use Src\Request;
use Src\View;
use Model\User;
use Src\Auth\Auth;

class Site
{
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/first_page');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/go');
        }
        return new View('site.signup');
    }


    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }


    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }
    public function first_page(Request $request): string
    {

        return new View('site.first_page');
    }
    public function add_patient(Request $request): string
    {

        return new View('site.add_patient');
    }

    public function add_doctor(Request $request): string
    {

        return new View('site.add_doctor');
    }

    public function add_reseption(Request $request): string
    {

        return new View('site.add_reseption');
    }

}
