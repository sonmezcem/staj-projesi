<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /*        $students = Student::with('user.user')
                    ->with('business.business')
                    ->get()
                ;*/

        $status = 1;

        $students = Student::query()
            ->with('user.user', 'business.business')
            ->whereHas('user', function ($query) use ($status) {
                return $query->where('status', 'LIKE', '%' . $status . '%');
            })
            ->paginate(10);

        /*echo "<pre>";
        print_r($students);
        echo "</pre>";

        exit();*/

        return view('admin.student.index', compact('students'));

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
        //$user = User::find($id);

        $user = Student::query()
            ->with('user.user', 'business.business')
            ->whereHas('user', function ($query) {
                return $query->where('status', 'LIKE', '%' . 1 . '%');
            })
            ->get()
            ->find($id);

        return view("admin.student.edit", compact('user'));

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
        echo "tamam";
    }

    public function passwordReset($id)
    {

        echo "tamam";

    }

    public function searchBusiness(Request $request)
    {


        if ($request->ajax()) {
            $businesses = Business::where('business_name', 'LIKE', '%' . $request->search . "%")->get();
        }

        if (isset($businesses[0])) {
            $json = json_encode(array('id' => $businesses[0]->id, 'business_name' => $businesses[0]->business_name));
        } else {
            $json = json_encode(array('bos' => 0));;
        }
        return $json;

    }

}
