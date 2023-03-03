<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::latest() -> paginate(5);

        return view('index', compact('data')) -> with('i',(request() -> input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'std_name' => 'required|min:3|max:7',
            'std_email' => 'required|email|unique:students',
            'std_number' => 'required|min:10|max:10|regex:/^[\d]+$/',
            'std_password' => 'required|min:6|max:15'
        ],[
            'std_name.required' => 'Name should not be empty',
            'std_name.min' => 'Name is too short',
            'std_name.max' => 'Name is too large',

            'std_email.required' => 'Email should not be empty',
            'std_email.email' => 'Please insert a valid email',

            'std_number.regex' => 'Please enter a valid number',
            'std_number.required' => 'Number should not be empty',
            'std_number.min' => 'Number should have 10 digits',
            'std_number.max' => 'Number should have 10 digits',

            'std_password.required' => 'Password should not be empty',
            'std_password.min' => 'Password should have minimum of 6 characters',
            'std_password.max' => 'Password should have maximum of 15 characters'
        ]);

        $student = new Student;

        $student -> std_name = $request -> std_name;
        $student -> std_email = $request -> std_email;
        $student -> std_number = $request -> std_number;
        $student -> std_password = $request -> std_password;

        $student -> save();

        return redirect() -> route('students.index') -> with('Success', 'Student Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request -> validate([
            'upd_name' => 'required|min:3',
            'upd_email' => 'required|email',
            'upd_number' => 'required|min:10|max:10|regex:/^[\d]+$/',
            'upd_password' => 'required|min:6|max:15'
        ],[
            'upd_name.required' => 'Name should not be empty',
            'upd_name.min' => 'Name is too short',

            'upd_email.required' => 'Email should not be empty',
            'std_email.email' => 'Please insert a valid email',

            'upd_number.regex' => 'Please enter a valid number',
            'upd_number.required' => 'Number should not be empty',
            'upd_number.min' => 'Number should have 10 digits',
            'upd_number.max' => 'Number should have 10 digits',

            'upd_password.required' => 'Password should not be empty',
            'upd_password.min' => 'Password should have minimum of 6 characters',
            'upd_password.max' => 'Password should have maximum of 15 characters'
        ]);

        $student = Student::find($request -> hidden_id);

        $student -> std_name = $request -> upd_name;
        $student -> std_email = $request -> upd_email;
        $student -> std_number = $request -> upd_number;
        $student -> std_password = $request -> upd_password;

        $student -> save();

        return redirect() -> route('students.index') -> with('Success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {

        $student -> delete();

        return redirect() -> route('students.index');
    }
}
