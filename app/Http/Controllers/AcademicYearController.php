<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.academic_year');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = new AcademicYear();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('academic-year.create')->with('success', 'Academic Year Added Successfully');
    }
    public function read()
    {
        $data['academic_year'] = AcademicYear::get();
        return view('admin.academic_year_list', $data);
    }
    public function delete($id)
    {
        $data = AcademicYear::find($id);
        $data->delete();
        return redirect()->route('academic-year.read')->with('success', 'Academic Year Delete Successfully');
    }
    public function update(Request $request, AcademicYear $academicYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academicYear)
    {
        //
    }
}
