<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Model\Post;
use Model\Record;
use Src\Request;
use Src\View;
use Model\User;
use Src\Auth\Auth;
use Model\Doctor;
use Model\Patient;
use Src\Validator\Validator;

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
            app()->route->redirect('/first_page');
        }
        return new View('site.signup');
    }


    public function index(Request $request): string
    {
        $doctors =Doctor ::all();
        return (new View())->render('site.doctor', ['doctors' => $doctors]);
    }


    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }
    public function first_page(Request $request): string
    {

        return new View('site.first_page');
    }


    public function add_doctor(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'surname' => ['required'],
                'name' => ['required'],
                'patronymic' => ['required'],
                'address' => ['required'],
                'number' => ['required'],
                'id_post' => ['required'],
                'id_speciality' => ['required']

            ], [
                'required' => 'Поле :field пустое',



            ]);

            if($validator->fails()){
                return new View('site.add_doctor',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Doctor::create($request->all())) {
                return new View('site.add_doctor', ['message'=>'Пациент успешно создан']);
            }
        }

        return new View('site.add_doctor');
    }

    public function add_reseption(Request $request): string
    {
        $doctor = Doctor::all();
        $patient = Patient::all();
        if ($request->method === 'POST') {

        $validator = new Validator($request->all(), [
            'id_doctor' => ['required'],
            'id_patient' => ['required'],
            'id_user' => ['required'],
            'address' => ['required'],
            'date' => ['required'],
            'id_status' => ['required'],


        ], [
            'required' => 'Поле :field пустое',



        ]);

        if($validator->fails()){
            return new View('site.add_reseption',
                ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
        }

        if (Record::create($request->all())) {
            return new View('site.add_reseption', ['message'=>'Пациент успешно создан']);
        }
    }

        return (new View())->render('site.add_reseption', ['doctors' => $doctor,'patients' => $patient]);
    }
    public function patient(Request $request): string
    {

        return new View('site.patient');
    }

    public function doctor(Request $request): string
    {

        return new View('site.doctor');

    }

    public function record(Request $request): string
    {

        return new View('site.record');
    }


    public function add_patient($request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'surname' => ['required'],
                'name' => ['required'],
                'patronymic' => ['required'],
                'gender' => ['required'],
                'address' => ['required'],
                'polis' => ['required'],
                'number' => ['required'],
                'date_birth' => ['required']
            ], [
                'required' => 'Поле :field пустое',
                'date_birth' => 'В поле :field указан неверный год'


            ]);

            if($validator->fails()){
                return new View('site.add_patient',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Patient::create($request->all())) {
                return new View('site.add_patient', ['message'=>'Пациент успешно создан']);
            }
        }
        return new View('site.add_patient');
    }



}

