<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = Business::where('status', 1)->paginate(10);

        return view('admin.business.index', compact('businesses'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.business.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'business_name' => ['required', 'min:3'],
                'business_address' => ['required'],
                'business_phone' => ['required', 'numeric'],
                'quota' => ['required','numeric'],
            ]);

        $validated['status'] = 1;

        Business::create($validated);

        $businesses = Business::where('status', 1)->paginate(10);

        return view('admin.business.index', compact('businesses'))->with('success','İşletme başarılı bir şekilde eklendi!');

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
        $business = Business::find($id);

        return view("admin.business.edit",compact('business'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate(
            [
                'business_name' => ['required'],
                'business_address' => ['required'],
                'business_phone' => ['required', 'phone:tr'],
                'quota' => ['required', 'numeric'],
            ]
        );

        Business::where('id', $id)->update($validated);

        return back()->with('success','İşletme başarılı bir şekilde düzenlendi!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statusUpdate = ['status' => 0];
        $business = new Business();
        $business->where('id', $id)->update($statusUpdate);

        return back()->with('success','İşletme başarılı bir şekilde silindi!');

    }
}
