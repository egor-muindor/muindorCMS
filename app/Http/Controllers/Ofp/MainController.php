<?php

namespace App\Http\Controllers\Ofp;

use App\Http\Controllers\Controller;
use App\Models\Ofp\Info;
use App\Models\Ofp\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'group' => 'required|min:2',
        ]);

        $name = $request->input('name');
        $group = $request->input('group');
        $students = Student::search($name, $group)
            ->with(['pairs', 'group:id,name', 'teacher:id,name', 'faculty:id,name', 'standards'])->get();

        $date = Info::find('update_date');
//        dd($students);
        return ['date' => $date, 'students' => $students];
    }
}
