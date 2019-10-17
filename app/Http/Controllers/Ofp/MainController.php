<?php

namespace App\Http\Controllers\Ofp;

use App\Models\Ofp\Student;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     * @throws \Illuminate\Validation\ValidationException
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

//        dd($students);
        return $students;
    }
}
