<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Model\Post;
use Model\Record;
use Model\Role;
use Model\Speciality;
use Model\Status;
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
        $post = Post::all();
        $speciality = Speciality::all();
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

        return new View('site.add_doctor',['posts' => $post,'specialities' => $speciality]);
    }

    public function add_reseption(Request $request): string
    {
        $doctor = Doctor::all();
        $patient = Patient::all();
        if ($request->method === 'POST') {
            $data = $request->all();
            Record::create([
                'id_patient' => $data['id_patient'],
                'id_doctor' => $data['id_doctor'],
                'id_status' => 1,
                'date' => $data['date']
            ]);
            return new View('site.add_reseption', ['message'=>'Пациент успешно создан', 'doctors' => $doctor, 'patients' => $patient]);
        }

        /*  */

        return (new View())->render('site.add_reseption', ['doctors' => $doctor,'patients' => $patient]);
    }
    public function patient(Request $request): string
    {
        $patient = Patient::all();

        return new View('site.patient', ['patients' => $patient]);
    }

    public function doctor(Request $request): string
    {
        $doctor = Doctor::all();

        return new View('site.doctor', ['doctors' => $doctor]);

    }

    public function record(Request $request): string
    {
        $record = Record::all();
        $user = Patient::all();
        $status = Status::all();
        $doctor = Doctor::all();

        return (new View())->render('site.record', ['statuses' => $status,'records' => $record, 'user'=>$user, 'doctors' => $doctor]);
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

    public function choice_doctor(Request $request): string
    {
        // Получение списка пациентов
        $patients = Patient::all();

        if ($request->method === 'POST') {
            $data = $request->all();
            $patientId = $data['patient_id'];

            // Находим записи, связанные с выбранным пациентом
            $records = Record::where('id_patient', $patientId)->get();

            // Извлекаем идентификаторы врачей из записей
            $doctorIds = $records->pluck('id_doctor')->toArray();

            // Получаем информацию о врачах
            $doctors = Doctor::whereIn('id', $doctorIds)->get();

            // Добавляем полное ФИО врача
            foreach ($doctors as $doctor) {
                $doctor->full_name = $doctor->surname . ' ' . $doctor->name . ' ' . $doctor->patronymic;
            }

            return new View('site.choice_doctor', ['patients' => $patients, 'doctors' => $doctors]);
        }

        return new View('site.choice_doctor', ['patients' => $patients]);
    }



    public function choice_record(Request $request): string
    {
        // Получение списка пациентов
        $patients = Patient::all();

        if ($request->method === 'POST') {
            $data = $request->all();
            $patientId = $data['patient_id'];
            $records = Record::where('id_patient', $patientId)->get();

            return new View('site.choice_record', ['patients' => $patients, 'records' => $records]);

        }

        return new View('site.choice_record', ['patients' => $patients]);
    }











}

