<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Documents;
use App\Models\DocumentTypes;
use App\Models\Errors;
use App\Models\RejectionReason;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $student = Student::all()->where('user_id', Auth::user()->id)->first();

        if ($student->internship_status === 1) {
            if (isset($student->business_id)) {
                $business = Business::all()->where('id', $student->business_id)->first();
            } else {
                $business = null;
            }

            if (isset($student->id)) {
                $rejectionReason = RejectionReason::all()->where('student_id', $student->id)->first();
            } else {
                $rejectionReason = null;
            }

            $documentTypes = DocumentTypes::all()->where('status', 1);

            if (isset($student->id)) {
                $errorMessages = Errors::all()->where('student_id', $student->id);
            } else {
                $errorMessages = null;
            }

            return view('student.index', compact('student', 'business', 'rejectionReason', 'documentTypes', 'errorMessages'));

        } elseif ($student->internship_status === 2) {

            $student = Student::all()->where('user_id', Auth::user()->id)->first();
            $business = Business::all()->where('id', $student->business_id)->first();

            return view('student.waiting', compact('student', 'business'));


        } elseif ($student->internship_status === 3) {

            $student = Student::all()->where('user_id', Auth::user()->id)->first();
            $business = Business::all()->where('id', $student->business_id)->first();

            return view('student.approved', compact('student', 'business'));

        } elseif ($student->internship_status === 4) {

            $student = Student::all()->where('user_id', Auth::user()->id)->first();

            if (isset($student->business_id)) {
                $business = Business::all()->where('id', $student->business_id)->first();
            } else {
                $business = null;
            }

            if (isset($student->id)) {
                $rejectionReason = RejectionReason::all()->where('student_id', $student->id)->first();
            } else {
                $rejectionReason = null;
            }

            $documentTypes = DocumentTypes::all()->where('status', 1);

            if (isset($student->id)) {
                $errorMessages = Errors::all()->where('student_id', $student->id);
            } else {
                $errorMessages = null;
            }

            return view('student.red', compact('student', 'business', 'rejectionReason', 'documentTypes', 'errorMessages'));
        }
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

        $studentInformation = Student::all()->where('user_id', Auth::user()->id)->first();

        $student = $request->validate([
            'internship_start_date' => ['required', 'date_format:d/m/Y'],
            'internship_end_date' => ['required', 'date_format:d/m/Y', 'after:internship_start_date'],
            'internship_type' => ['between:1,2'],
        ]);

        $documentTypes = DocumentTypes::all()->where('status', 1)->toArray();

        foreach ($documentTypes as $documentType) {

            $allFiles[] = $request->validate([

                $documentType['document_slug'] => ['required', 'mimes:docx,jpg']

            ]);
        }


        if (!is_null($studentInformation->business_id)) {

            //$student = Student::all()->where('id', Auth::user()->id)->first();
            $student = Student::all()->where('user_id', Auth::user()->id)->first();


            return view('student.index', compact('student'))->with('message', 'Başvurunuz bulunduğu için yeni başvuru yapamazsınız...');

        } else {

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

            $businessId = Business::insertGetId($business);

            $businessApplicants = Business::where('id', $businessId)->get()->first();
            $applicants['applicants'] = $businessApplicants->applicants + 1;
            Business::where('id', $businessId)->update($applicants);

            // İşletme bilgileri son

            // Öğrenci bilgileri başlangıç

            $student['internship_start_date'] = Carbon::createFromFormat('d/m/Y', $student['internship_start_date']);
            $student['internship_end_date'] = Carbon::createFromFormat('d/m/Y', $student['internship_end_date']);
            $student['internship_type'] = 1; /// seçilene göre olacak...
            $student['user_id'] = Auth::user()->id;
            $student['business_id'] = $businessId;
            $student['student_number'] = Student::all()->where('user_id', Auth::user()->id)->first()->student_number;
            $student['internship_status'] = 2;

            Student::where('student_number', $student['student_number'])->update($student);

            // Öğrenci bilgileri son

            $studentNumberID = Student::all()->where('user_id', Auth::user()->id)->first()->id;

            if (isset($allFiles)) {
                foreach ($allFiles as $files) {

                    foreach ($files as $key => $file) {

                        $documentModel = new Documents();
                        $documentModel->student_number_id = $studentNumberID;
                        $document_slug = $key;
                        $documentModel->document_type_id = DocumentTypes::all()->where('document_slug', $document_slug)->first()->id;
                        $name = time() . rand(1, 100) . '.' . $file->extension();
                        $file->move(public_path('uploads/' . $document_slug . '/' . date('m')), $name);
                        $documentModel->file_path = '/uploads/' . $document_slug . '/' . date('m') . '/' . $name;
                        $documentModel->save();
                    }
                }
            }

            //$student = Student::all()->where('id', Auth::user()->id)->first();
            $student = Student::all()->where('user_id', Auth::user()->id)->first();
            $business = Business::all()->where('id', $student->business_id)->first();

            return view('student.index', compact('student', 'business'))->with('message', 'Başvurunuz alındı. Lütfen, size gelecek epostayı bekleyiniz...');

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


        $studentInformation = Student::all()->where('user_id', Auth::user()->id)->first();

        if (!is_null($studentInformation->business_id)) {

            //$student = Student::all()->where('id', Auth::user()->id)->first();
            $student = Student::all()->where('user_id', Auth::user()->id)->first();
            $business = Business::all()->where('id', $id)->first();

            return view('student.index', compact('student', 'business'))->with('message', 'Başvurunuz bulunduğu için yeni başvuru yapamazsınız...');

        } else {

            $student = $request->validate([
                'internship_start_date' => ['required', 'date_format:d/m/Y'],
                'internship_end_date' => ['required', 'date_format:d/m/Y', 'after:internship_start_date'],
                'internship_type' => ['between:1,2'],
            ]);
            $student['internship_start_date'] = Carbon::createFromFormat('d/m/Y', $student['internship_start_date']);
            $student['internship_end_date'] = Carbon::createFromFormat('d/m/Y', $student['internship_end_date']);
            $student['internship_status'] = 2;
            $student['user_id'] = Auth::user()->id;
            $student['business_id'] = $id;
            $student['student_number'] = $studentInformation->student_number;

            $documentTypes = DocumentTypes::all()->where('status', 1)->toArray();

            foreach ($documentTypes as $documentType) {

                $allFiles[] = $request->validate([

                    $documentType['document_slug'] => ['required', 'mimes:docx,jpg']

                ]);
            }


            Student::where('student_number', $student['student_number'])->update($student);

            // Öğrenci bilgileri son


        }

        if (isset($allFiles)) {
            foreach ($allFiles as $files) {

                foreach ($files as $key => $file) {

                    $documentModel = new Documents();
                    $documentModel->student_number_id = $studentInformation->id;
                    $document_slug = $key;
                    $documentModel->document_type_id = DocumentTypes::all()->where('document_slug', $document_slug)->first()->id;
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('uploads/' . $document_slug . '/' . date('m')), $name);
                    $documentModel->file_path = '/uploads/' . $document_slug . '/' . date('m') . '/' . $name;
                    $documentModel->save();
                }
            }
        }

        //$student = Student::all()->where('id', Auth::user()->id)->first();
        $student = Student::all()->where('user_id', Auth::user()->id)->first();
        $business = Business::all()->where('id', $student->business_id)->first();
        $rejectionReason = RejectionReason::all()->where('student_id', $student->id);

        return view('student.index', compact('student', 'business', 'rejectionReason'))->with('message', 'Başvurunuz alındı. Lütfen, size gelecek epostayı bekleyiniz...');

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

        $student = Student::all()->where('user_id', Auth::user()->id)->first();

        if (isset($student->business_id)) {
            /*
             *  Yeni eklenen bölüm proje tamamlandığında kontrol edilmeli.
             *
             * */

            if (isset($student->business_id)) {
                $business = Business::all()->where('id', $student->business_id)->first();
            } else {
                $business = null;
            }

            if (isset($student->id)) {
                $rejectionReason = RejectionReason::all()->where('student_id', $student->id)->first();
            } else {
                $rejectionReason = null;
            }

            $documentTypes = DocumentTypes::all()->where('status', 1);

            if (isset($student->id)) {
                $errorMessages = Errors::all()->where('student_id', $student->id);
            } else {
                $errorMessages = null;
            }

            return view('student.index', compact('student', 'business', 'rejectionReason', 'documentTypes', 'errorMessages'));

        }

        $documentTypes = DocumentTypes::all()->where('status', 1);

        if (isset($student->business_id)) {

            $business = Business::all()->where('id', $student->business_id)->first();

            return view('student.applicationform', compact('student', 'documentTypes', 'business'));

        } else {

            return view('student.applicationform', compact('student', 'documentTypes'));
        }
    }

    public function findMeBusiness()
    {

        $student = Student::all()->where('user_id', Auth::user()->id)->first();
        $businesses = Business::whereRaw('businesses.applicants < businesses.quota')->where('status', '=', 1)->get();

        if (isset($student->business_id)) {
            /*
             *  Yeni eklenen bölüm proje tamamlandığında kontrol edilmeli.
             *
             * */

            if (isset($student->business_id)) {
                $business = Business::all()->where('id', $student->business_id)->first();
            } else {
                $business = null;
            }

            if (isset($student->id)) {
                $rejectionReason = RejectionReason::all()->where('student_id', $student->id)->first();
            } else {
                $rejectionReason = null;
            }

            $documentTypes = DocumentTypes::all()->where('status', 1);

            if (isset($student->id)) {
                $errorMessages = Errors::all()->where('student_id', $student->id);
            } else {
                $errorMessages = null;
            }

            return view('student.index', compact('student', 'business', 'rejectionReason', 'documentTypes', 'errorMessages'));

        } else {

            return view('student.findmebusiness', compact('businesses', 'student'));

        }

        /*        if (isset($student->business_id)) {

                    $business = Business::all()->where('id', $student->business_id)->first();
                    $documentTypes = DocumentTypes::all()->where('status', 1);

                    //return view('student.applicationform', compact('student', 'documentTypes', 'business'));
                    return view('student.index', compact('student', 'business', 'rejectionReason', 'documentTypes', 'errors'));

                } */

    }

    public function apply($id)
    {

        $student = Student::all()->where('user_id', Auth::user()->id)->first();

        $business = Business::where('id', $id)->first();
        $documentTypes = DocumentTypes::all();

        return view('student.apply', compact('student', 'documentTypes', 'business'));

    }

    public function fix(Request $request)
    {
        // Burasi biraz karışık oldu sadeleştirilmesi iyi olur.

        $studentID = Student::all()->where('user_id', Auth::user()->id)->first()->id;


        if (isset($request->all()['business_error'])) {
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

            $newBusiness = Business::updateOrCreate($business);


            $businessApplicants = Business::where('id', $newBusiness->id)->get()->first();
            $applicants['applicants'] = $businessApplicants->applicants + 1;
            Business::where('id', $newBusiness->id)->update($applicants);
            Student::where('user_id', Auth::user()->id)->first()->update(['business_id' => $newBusiness->id]);
        }

        if (isset($request->all()['internship_date_error'])) {

            $student = $request->validate([
                'internship_start_date' => ['required', 'date_format:d/m/Y'],
                'internship_end_date' => ['required', 'date_format:d/m/Y', 'after:internship_start_date'],
                'internship_type' => ['between:1,2'],
            ]);

            $student['internship_start_date'] = Carbon::createFromFormat('d/m/Y', $student['internship_start_date']);
            $student['internship_end_date'] = Carbon::createFromFormat('d/m/Y', $student['internship_end_date']);
            $student['internship_type'] = 1; /// seçilene göre olacak...

            Student::where('id', $studentID)->update($student);

            unset($student);

        }

        if (isset($request->all()['documents_error'])) {

            $documentTypes = DocumentTypes::all()->where('status', 1)->toArray();

            foreach ($documentTypes as $documentType) {

                $allFiles[] = $request->validate([

                    $documentType['document_slug'] => ['required', 'mimes:docx,jpg']

                ]);
            }
        }

        $student = Student::all()->where('user_id', Auth::user()->id)->first();

        if(isset($newBusiness)){
            $business = Business::all()->where('id', $newBusiness->id)->first();
        }else{
            $business = Business::all()->where('id', $student->business_id)->first();
        }

        $student->internship_status = 2;
        $student->save();

        return redirect()->route('student.index', ['student' => $student, 'business' => $business]);

    }
}
