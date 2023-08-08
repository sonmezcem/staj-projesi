<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\DocumentTypes;
use App\Models\Student;
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

        $student = Student::all()->where('id', Auth::user()->id);

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
        $student = $request->validate([
            'internship_type' => ['between:1,2'],
            'internship_start_date' => ['required', 'date_format:d/m/Y'],
            'internship_end_date' => ['required', 'date_format:d/m/Y'],
        ]);
        $student['internship_status'] = 1;

        $business = $request->validate(
            [
                'business_name' => ['required', 'min:3'],
                'business_address' => ['required'],
                'business_phone' => ['required', 'numeric'],
            ]);

        $files = $request->all();


        $filesValidator = Validator::make($files,['documentType.*' => ['required', 'mimes:docx,jpg']]);

        $studentNumber = Student::all()->where('id', Auth::user()->id)->first->id;
        $documentModel = new Documents();
        $documentModel->student_number_id = $studentNumber->id;
        //

        if(!$filesValidator->fails()){
            foreach ($request->file('documentType') as $file){

                $document_slug = array_keys($request->file('documentType'))[0];
                $documentModel->document_type_id = DocumentTypes::all()->where('document_slug', $document_slug)->first()->id;
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('uploads/' . $document_slug . '/' . date('m')), $name);
                $documentModel->file_path = '/uploads/' . $document_slug . '/' . date('m') . '/' . $name;
                $documentModel->save();

            }
        }else{
            return 0;
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

        $documentTypes = DocumentTypes::all();


        return view('student.applicationform', compact('student', 'documentTypes'));

    }
}
