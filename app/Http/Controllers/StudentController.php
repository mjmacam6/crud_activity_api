<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        return response()->json(Student::all());
     }

     // Create a new student
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'course' => 'required|string',
            'year' => 'required|in:First Year,Second Year,Third Year,Fourth Year,Fifth Year',
            'enrolled' => 'required|boolean',
        ]);

        $student = Student::create($validatedData);

        return response()->json(['message' => 'Student created successfully', 'student' => $student], 201);
    }

    // Retrieve a specific student by ID
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    // Update a student
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'firstName' => 'sometimes|required|string|max:255',
            'lastName' => 'sometimes|required|string|max:255',
            'course' => 'sometimes|required|string',
            'year' => 'sometimes|required|in:First Year,Second Year,Third Year,Fourth Year,Fifth Year',
            'enrolled' => 'sometimes|required|boolean',
        ]);

        $student->update($validatedData);

        return response()->json(['message' => 'Student updated successfully', 'student' => $student]);
    }

       // Delete a student
       public function destroy($id)
       {
           $student = Student::findOrFail($id);
           $student->delete();

           return response()->json(['message' => 'Student deleted successfully']);
       }

}
