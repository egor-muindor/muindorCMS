<?php

namespace App\Http\Controllers\Timeboard;

use App\Models\Timeboard\Pair;
use App\Models\Timeboard\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function searchTeacher(Request $request)
    {
        // Валидация входящего запроса
        $this->validate($request, [
            'search' => 'string|required|min:3',
        ]);

        // Подготовка данных для дальнейшей обработки
        $name = $request->input('search');

        // Поиск преподавателя

        $teachers = Teacher::name($name)->get();

        return $teachers;
    }

    public function getPairsByTeacherId(Request $request)
    {
        $this->validate($request, [
            'id' => 'int|exists:mysql_timeboard.teachers,id',
        ]);

        $id = $request->input('id');

        $pairs = Pair::teacherId($id)->orderByRaw('day ASC, pair_number ASC')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $now = Carbon::now();
                    $query->where('date_from', '<', $now)
                        ->where('date_to', '>', $now);
                }
                )->orWhere('is_session', '=', 1);
            })
            ->with('teachers:name', 'auditories:name', 'groups:name')->get();

        return $pairs;
    }
}
