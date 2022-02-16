<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentApi;

class StudentController extends Controller
{

    public function index() {
        // $students = StudentApi::all();
        $students = StudentApi::paginate(4);
        return response()->json(array(
            'status' => 200,
            'students' => $students
        ));
    }

    public function store(Request $request) {
        $student = new StudentApi;
        $student->name = $request->input('name');
        $student->course = $request->input('course');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        $student->save();

        return response()->json([
            'status' => 200,
            'success' => 'Student Added Successfully'
        ]);
    }

    public function edit($id) {
        $student = StudentApi::find($id);
        return response()->json([
            'status' => 200,
            'student' => $student
        ]);
    }

    public function update(Request $request, $id) {
        $student = StudentApi::find($id);
        $student->name = $request->input('name');
        $student->course = $request->input('course');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        $student->update();

        return response()->json([
            'status' => 200,
            'success' => 'Student updated Successfully'
        ]);
    }

    public function delete($id) {
        $student = StudentApi::find($id);
        if ($student) {
            $student->delete();
            return response()->json([
                'status' => 200,
                'success' => 'Student deleted Success'
            ]);
        }
    }
}
