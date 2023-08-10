<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Documents;
use App\Models\DocumentTypes;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $student = Student::all()->where('id', Auth::user()->id)->first();

        return view('student.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // İşletme bilgileri başlangıç

        $studentInformation = Student::all()->where('user_id', Auth::user()->id);

        $gelipGecici = 0;

        if(empty($studentInformation->business_id)&& $gelipGecici === 1){

            $student = Student::all()->where('id', Auth::user()->id);

            return view('student.index', compact('student'))->with('message','Başvurunuz bulunduğu için yeni başvuru yapamazsınız...');

            //$business = Business::all()->where('id', $studentInformation->business_id)->first();
            //$business = call_user_func_array('array_merge', $business);
            //$business = collect($business);
            //return view('student.applicationform', compact('student', 'documentTypes','business'));

        }else{
            //return view('student.applicationform', compact('student', 'documentTypes'));

            $business = $request->validate(
                [
                    'business_name' => ['required', 'min:3'],
                    'business_address' => ['required'],
                    'business_phone' => ['required', 'numeric'],
                ]);
            $business['quota'] = null;
            $business['status'] = 1;
            $business['created_at'] = Carbon::now();
            $business['updated_at'] = Carbon::now();

            /*        $businessModel = new Business();
                    $businessModel->create($business);*/

            $businessId = Business::insertGetId($business);

            $businessApplicants = Business::where('id', $businessId)->get()->first();
            $applicants['applicants'] = $businessApplicants->applicants + 1;
            Business::where('id', $businessId)->update($applicants);


            echo "<pre>";
            print_r($businessApplicants);
            echo "</pre>";
            exit();



            //Business::where('id', $businessId)->update('applicant');


            // İşletme bilgileri son

            // Öğrenci bilgileri başlangıç

            $student = $request->validate([
                'internship_start_date' => ['required', 'date_format:d/m/Y'],
                'internship_end_date' => ['required', 'date_format:d/m/Y'],
                'internship_type' => ['between:1,2'],
            ]);
            $student['internship_start_date'] = Carbon::createFromFormat('d/m/Y', $student['internship_start_date']);
            $student['internship_end_date'] = Carbon::createFromFormat('d/m/Y', $student['internship_end_date']);

            $student['internship_status'] = 1;
            $student['user_id'] = Auth::user()->id;
            $student['business_id'] = $businessId;
            $student['student_number'] = Student::all()->where('id', Auth::user()->id)->toArray()[0]['student_number'];

            Student::where('student_number', $student['student_number'])->update($student);

            // Öğrenci bilgileri son


            $documentTypes = DocumentTypes::all()->where('status', 1)->toArray();

            foreach ($documentTypes as $documentType) {

                $allFiles[] = $request->validate([

                    $documentType['document_slug'] => ['required', 'mimes:docx,jpg']

                ]);
            }

            $studentNumber = Student::all()->where('id', Auth::user()->id)->first->id;

            if (isset($allFiles)) {
                foreach ($allFiles as $files) {

                    foreach ($files as $key => $file) {

                        $documentModel = new Documents();
                        $documentModel->student_number_id = $studentNumber->id;
                        $document_slug = $key;
                        $documentModel->document_type_id = DocumentTypes::all()->where('document_slug', $document_slug)->first()->id;
                        $name = time() . rand(1, 100) . '.' . $file->extension();
                        $file->move(public_path('uploads/' . $document_slug . '/' . date('m')), $name);
                        $documentModel->file_path = '/uploads/' . $document_slug . '/' . date('m') . '/' . $name;
                        $documentModel->save();
                    }
                }
            }

            $student = Student::all()->where('id', Auth::user()->id)->first();

/*            echo "<pre>";
            print_r($student);
            echo "</pre>";
            exit();*/

            return view('student.index', compact('student'));

        }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function applicationForm()
    {

        $student = Student::all()->where('user_id', Auth::user()->id);


        foreach ($student as $student) {
            $student = $student;
        }

        $documentTypes = DocumentTypes::all()->where('status', 1);

        if(isset($student->business_id)){

            $business = Business::all()->where('id', $student->business_id)->first();
            //$business = call_user_func_array('array_merge', $business);
            //$business = collect($business);
            return view('student.applicationform', compact('student', 'documentTypes','business'));

        }else{
            return view('student.applicationform', compact('student', 'documentTypes'));
        }


    }
}
