<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentTypes;
use Illuminate\Http\Request;

class DocumentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentTypes = DocumentTypes::all()->where('status',1);

        return view('admin.documenttypes.index', compact('documentTypes'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documenttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'document_type' => ['required', 'unique:document_types,document_type']
            ]);

        $validated['status'] = 1;
        $validated['document_slug'] = $validated['document_type'];

        DocumentTypes::create($validated);

        $documentTypes = DocumentTypes::all()->where('status',1);

        return view('admin.documenttypes.index', compact('documentTypes'))->with('success','Döküman türü başarılı bir şekilde eklendi!');

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
        $documentType = DocumentTypes::find($id);

        return view("admin.documenttypes.edit",compact('documentType'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'document_type' => ['required'],
                ]
        );

        DocumentTypes::where('id', $id)->update($validated);

        return back()->with('success','Döküman türü başarılı bir şekilde düzenlendi!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statusUpdate = ['status' => 0];
        $business = new DocumentTypes();
        $business->where('id', $id)->update($statusUpdate);

        return back()->with('success','İşletme başarılı bir şekilde silindi!');

    }
}
