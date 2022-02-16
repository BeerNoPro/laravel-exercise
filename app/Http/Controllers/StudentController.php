<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $student = Student::all();
        $pages = DB::table('student')->simplePaginate(5);
        $page = 1;
        if (isset($request->page)) {
            $page = $request->page;
        }
        $index = ($page - 1) * 5 + 1;
        return view('students/student_list', [
            'pages' => $pages,
            'index' => $index
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students/student_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $student = new Student();
        $student ->name = $request->fullname;
        $student ->phone = $request->phonenumber;
        $student ->address = $request->address;
        $student ->save();
        return redirect()->route('students.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $student = Student::find($id);
        return view('students/student_show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        // var_dump($student); die();
        return view('students/student_update', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::where('id', $id)->update([
            'name' => $request->fullname,
            'phone' => $request->phonenumber,
            'address' => $request->address,
        ]);

        return redirect()->route('students.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id)->delete();
        return redirect()->route('students.list');
    }
}
