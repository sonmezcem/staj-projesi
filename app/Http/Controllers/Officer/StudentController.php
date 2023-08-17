<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Documents;
use App\Models\DocumentTypes;
use App\Models\Errors;
use App\Models\RejectionReason;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = 1;

        $students = Student::query()
            ->with('user.user', 'business.business')
            ->whereHas('user', function ($query) use ($status) {
                return $query->where('status', 'LIKE', '%' . $status . '%');
            })
            ->paginate(10);

        return view('officer.student.index', compact('students'));

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
        //
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
        $documentTypes = DocumentTypes::all();

        $user = Student::query()
            ->with('user.user', 'business.business', 'document.document', 'rejection.rejection','error.error')
            ->whereHas('user', function ($query) {
                return $query->where('status', 'LIKE', '%' . 1 . '%');
            })
            ->get()
            ->find($id);

        return view("officer.student.edit", compact('user', 'documentTypes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $business = $request->validate([
            'business.*' => ''
        ]);


        Business::where('id', $business['business']['id'])->update($business['business']);


        $student = $request->validate([
            'student.internship_start_date' => ['required', 'date_format:d/m/Y'],
            'student.internship_end_date' => ['required', 'date_format:d/m/Y', 'after:internship_start_date'],
            'student.internship_type' => ['between:1,2'],
        ]);

        $student['student']['internship_start_date'] = Carbon::createFromFormat('d/m/Y', $student['student']['internship_start_date']);
        $student['student']['internship_end_date'] = Carbon::createFromFormat('d/m/Y', $student['student']['internship_end_date']);
        $student['student']['business_id'] = $business['business']['id'];
        Student::where('id', $id)->update($student['student']);



        $approvalStatus = $request->all()['approval-radio'];

        if ($approvalStatus == "dismiss") {

            $validated = $request->validate([
                'reason' => 'required',
                'errors' => 'required'
            ]);

            $validated['student_id'] = $id;

            RejectionReason::updateOrCreate(    [
                'student_id'   => $id,
            ],$validated);



            $student = Student::findOrFail($id);
            $student->internship_status = 4;
            $student->save();


            if (isset($request->all()['errors'])) {
                foreach ($request->all()['errors'] as $error) {
                    $errorUpdateOrCreate['student_id'] = $id;
                    $errorUpdateOrCreate['problem'] = $error;
                    $errorUpdateOrCreate['status'] = 1;
                    Errors::updateOrCreate($errorUpdateOrCreate);

                    if($error === "business_error"){

                        $student = Student::findOrFail($id);
                        $student->business_id = null;
                        $student->save();

                    }

                    if($error === "internship_date_error"){
                        $student = Student::findOrFail($id);
                        $student->internship_start_date = null;
                        $student->internship_end_date = null;
                        $student->internship_type = 1;
                        $student->save();
                    }
                }
            }


            /*
             *  Buraya eposta ile bilgilendirme gelecek.
             *
             *
             */

            return back()->with('rejection', 'Red ediliş gerekçesi öğrenciye iletildi!');


        } else {


            /*
             *
             *
             * */

            Errors::where('student_id', $id)->delete();
            RejectionReason::where('student_id', $id)->delete();


            $student = Student::findOrFail($id);
            $student->internship_status = 3;
            $student->save();

            return back()->with('success', 'Öğrencinin staj durumu başarılı bir şekilde onaylandı.');

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function passwordReset($id)
    {

        $characters = "abcdefghijklmnoprstuvyzABCDEFGHIJKLMNOPRSTUVYZ0123456789!+$&=";
        $password = substr(str_shuffle($characters), 0, 9);

        Mail::send('student.password', compact('password'), function ($message) {
            $message->to('staj@trends.com.tr')->subject('Şifreniz sıfırlandı');
            $message->from('staj@trends.com.tr', 'Staj Takip Sistemi');
        });

        $user = User::findOrFail($id);
        $user->password = Hash::make($password);
        $user->save();

    }

    public function searchBusiness(Request $request)
    {

        if ($request->ajax()) {
            $businesses = Business::where('business_name', 'LIKE', '%' . $request->search . "%")->get();
        }

        if (isset($businesses[0])) {
            $json = json_encode(array(
                    'id' => $businesses[0]->id,
                    'business_name' => $businesses[0]->business_name,
                    'business_address' => $businesses[0]->business_address,
                    'business_phone' => $businesses[0]->business_phone)
            );
        } else {
            $json = json_encode(array('bos' => 0));
        }
        return $json;

    }

    public function internshipRemoval($id){

        $studentModel['internship_start_date'] = null;
        $studentModel['internship_end_date'] = null;
        $studentModel['internship_status'] = 1;
        $studentModel['internship_type'] = 1;
        $studentModel['business_id'] = null;

        Student::where('id', $id)->update($studentModel);

        RejectionReason::where('student_id', $id)->delete();
        Documents::where('student_number_id', $id)->delete();
        Errors::where('student_id', $id)->delete();

        // Öğrenciye sıfırlandığına dair email gönderilmesi...

    }

    public function imageRemoval($id){

        $file = Documents::where('id', $id)->first()->file_path;
        $file = public_path($file);
        File::delete($file);

        Documents::where('id', $id)->delete();

    }

}
