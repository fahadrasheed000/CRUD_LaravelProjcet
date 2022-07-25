<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\CreateStudentRequest; //Laravel form validation class
use App\Http\Requests\UpdateStudentRequest; //Laravel form validation class

class StudentController extends Controller
{
    function __construct()
    {
        $this->studentModel = new Student();
    }
    public function index()
    {
        return view('students.index');
    }
    //======jquery dynamic datatable Request
    public function getStudentData(Request $request)
    {
        $data = array();
        $studentList = $this->studentModel->getStudentsDataWithFilters($request, 'Normal');
        if (!empty($studentList)) {
            $count = 0;
            foreach ($studentList as $list) {
                $nestedData=array();
                $count=$count+1;
                $editButton = '<i title="update student" onclick="getStudentData(' . $list->id . ')" style="blue" class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                $deleteButton = '<i title="delete student" onclick="deleteStudent(' . $list->id . ')" style="color:red" class="fa fa-trash"></i></a>&nbsp;&nbsp;';
                $nestedData[] = $count;
                $nestedData[] = $list->student_id;
                $nestedData[] = $list->name;
                $nestedData[] = $list->address;
                $nestedData[] = $editButton . ' ' . $deleteButton;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => $this->studentModel->getStudentsDataWithFilters($request, 'Counts'),
            "recordsFiltered" => $this->studentModel->getStudentsDataWithFilters($request, 'Filters'),
            "data"            => $data
        );

        echo json_encode($json_data);
    }


    public function store(CreateStudentRequest $request)
    {
        $response = $this->studentModel->addStudent($request);

        if ($response) {
            return response()->json(['status' => 0, 'message' => 'Student added successfully']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Invalid data']);
        }
    }

    public function edit($id)
    {
        $result = $this->studentModel->getStudentById($id);
        return response()->json($result);
    }


    public function update(UpdateStudentRequest $request, $studentID)
    {
        $result = $this->studentModel->updateStudent($request, $studentID);
        if ($result) {
            return response()->json(['status' => 0, 'message' => 'Student updated successfully']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Invalid data']);
        }
    }


    public function destroy($id)
    {
        $response = $this->studentModel->deleteStudent($id);
        if ($response) {
            return response()->json(['status' => 0, 'message' => 'Student deleted successfully']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Invalid data']);
        }
    }
}
