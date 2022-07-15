<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;
use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all(['id', 'name', 'email', 'academic_record', 'cpf']);
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $student = Student::create($request->all());
        return (new StudentResource($student))
            ->response('OK')
            ->setStatusCode(201);

            /* Other method for register data in BD */
        /*
            $student = new Student;
            $student->name              = $request->name;
            $student->email             = $request->email;
            $student->academic_record   = $request->academic_record;
            $student->cpf               = $request->cpf;

            $student->save();
            return response()->json([
                'message'=>'Cadastro inserido',
                'student'=>$student,
                'status'=>200]);
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student, $id)
    {

        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json([
            'student'=>$student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json([
            'mensagem'=> 'Registro deletado com sucesso'
        ]);
    }
}
