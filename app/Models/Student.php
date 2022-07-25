<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $fillable = ['student_id', 'name', 'address'];


    //===Implementation of Dynamic datatable.
    function getStudentsDataWithFilters($request, $tag)
    {
        $getData = Student::select('*');
        if (!empty($request->post('student_id'))) {
            $getData->where('student_id', $request->post('student_id'));
        }

        $getData->orderBy('id', 'ASC');
        if ($tag == "Normal") {
            if ($request->length != -1) {
                $getData->offset($request->start);
                $getData->limit($request->length);
            }
            $originalData = $getData->get();
            return $originalData;
        }
        if ($tag == "Filters" || $tag == "Counts") {
            $originalData = $getData->get()->count();
            return  $originalData;
        }
    }
    public function addStudent($request)
    {
        try {
            $data = array(
                'student_id'         =>       $request->input('student_id'),
                'name'      =>       $request->input('name'),
                'address'           =>       $request->input('address')
            );
            $Student = Student::create($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getStudentById($id)
    {

        $Student = Student::where('id', $id)->get(['*']);
        return $Student;
    }

    public function updateStudent($request, $studentID)
    {
        $data = array(
            'student_id'         =>       $request->input('student_id'),
            'name'      =>       $request->input('name'),
            'address'           =>       $request->input('address')
        );
        $updateOrder = Student::find($studentID)->update($data);

        if (!$updateOrder) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteStudent($id)
    {
        try {
            Student::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
