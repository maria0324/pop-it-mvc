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
use Model\Image;
use Src\Auth\Auth;
use Model\Doctor;
use Model\Patient;
use Src\Validator\Validator;


class Site
{
    public function login(Request $request): string
    {

        if ($request->method === 'GET') {
            return new View('site.login');
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/first_page');
        }

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
        $images = Image::all();

        if ($request->method === 'POST') {
            $image = $_FILES['image']['name'];
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/pop-it-mvc/public/img/";
            $uploaded_file = $imagePath . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file);

            if (Image::create(['image' => $uploaded_file, 'name' => $image])) {
                app()->route->redirect('/first_page');
            }
        }

        return new View('site.first_page', ['images' => $images]);
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

        $records = Record::all();

        $user = Patient::all();

        $status = Status::all();


        $doctor = Doctor::all();


        $activeRecords = [];
        $cancelledRecords = [];

        foreach ($records as $record) {
            if ($record->id_status === 1) {

                $activeRecords[] = $record;
            } else {

                $cancelledRecords[] = $record;
            }
        }


        $sortedRecords = array_merge($activeRecords, $cancelledRecords);


        return new View('site.record', [
            'statuses' => $status,
            'records' => $sortedRecords,
            'user' => $user,
            'doctors' => $doctor
        ]);
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

        $patients = Patient::all();

        if ($request->method === 'POST') {
            $data = $request->all();
            $patientId = $data['patient_id'];


            $records = Record::where('id_patient', $patientId)->get();


            $doctorIds = $records->pluck('id_doctor')->toArray();


            $doctors = Doctor::whereIn('id', $doctorIds)->get();


            foreach ($doctors as $doctor) {
                $doctor->full_name = $doctor->surname . ' ' . $doctor->name . ' ' . $doctor->patronymic;
            }

            return new View('site.choice_doctor', ['patients' => $patients, 'doctors' => $doctors]);
        }

        return new View('site.choice_doctor', ['patients' => $patients]);
    }



    public function choice_record(Request $request): string
    {

        $patients = Patient::all();

        if ($request->method === 'POST') {
            $data = $request->all();
            $patientId = $data['patient_id'];
            $records = Record::where('id_patient', $patientId)->get();

            return new View('site.choice_record', ['patients' => $patients, 'records' => $records]);

        }

        return new View('site.choice_record', ['patients' => $patients]);
    }

    public function choice_patient(Request $request): string
    {
        if ($request->method === 'POST') {
            $doctorId = $request->all()['doctor_id'] ?? null;
            $date = $request->all()['date'] ?? null;


            if (!$doctorId || !$date) {
                return new View('error', ['message' => 'Необходимо указать врача и дату']);
            }

            $records = Record::where('id_doctor', $doctorId)
                ->where('date', $date)
                ->get();

            $patientIds = $records->pluck('id_patient')->toArray();


            $patients = Patient::whereIn('id', $patientIds)->get();


            return new View('site.choice_patient', ['patients' => $patients]);
        }



        $doctors = Doctor::all();
        return new View('site.choice_patient', ['doctors' => $doctors]);
    }


    public function recordInfo($id) {
        $request = new Request();
        $record = Record::find($id);
        $patient = Patient::where('id', $record->id_patient)->first();
        $doctor = Doctor::where('id', $record->id_doctor)->first();
        $statuses = Status::all();


        if ($request->method === 'POST') {
            if (isset($_GET['goToInfoRecord'])) {
                $record->update($request->all());
                return (new View())->render('site.record_info', ['record' => $record, 'patient' => $patient, 'doctor' => $doctor, 'statuses' => $statuses]);
            }
        }
        return (new View())->render('site.record_info', ['record' => $record, 'patient' => $patient, 'doctor' => $doctor, 'statuses' => $statuses]);
    }

    public function changeStatus($id) {
        $request = new Request();
        $record = Record::find($id);
        $patient = Patient::where('id', $record->id_patient)->first();
        $doctor = Doctor::where('id', $record->id_doctor)->first();
        $statuses = Status::all();


        if ($request->method === 'POST') {
            if (isset($_GET['goToInfoRecord'])) {
                $record->update($request->all());
                return (new View())->render('site.record', ['record' => $record, 'patient' => $patient, 'doctor' => $doctor, 'statuses' => $statuses]);
            }
        }
        return (new View())->render('site.record', ['record' => $record, 'patient' => $patient, 'doctor' => $doctor, 'statuses' => $statuses]);

    }

}

