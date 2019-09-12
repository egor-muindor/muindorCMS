<?php

namespace App\Models\Timeboard;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    /*
     * Подключение к конфигурации mysql_timeboard
     */
    protected $connection = 'mysql_timeboard';

    /*
     * Таблица модели
     */
    protected $table = 'pairs';

    /*
     * PrimaryKey таблицы
     */
    protected $primaryKey = 'id';

    /*
     * Поля, доступные для заполнения
     */
    protected $fillable = ['subject', 'type', 'date_from', 'date_to', 'pair_number', 'day', 'is_session'];

    /*
     * Отключение обновления полей updated_at и created_at
     */
    public $timestamps = false;

    /*
     * Прячем pivot для отправки
     */
    protected $hidden = ['pivot'];

    /*
     * Возвращает всех преподавателей для пары
     */
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Timeboard\Teacher', 'teacher_pair',
            'pair_id', 'teacher_id');
    }

    /*
     * Возвращает все группы для пары
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('App\Models\Timeboard\Group', 'group_pair',
            'pair_id', 'group_id');
    }

    /*
     * Возвращает все аудитории для пары
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function auditories()
    {
        return $this->belongsToMany('App\Models\Timeboard\Auditory', 'auditory_pair',
            'pair_id', 'auditory_id');
    }

    public function scopeTeacherName($query, $name)
    {
        return $query->whereHas('teachers', function ($q) use ($name) {
            return $q->where('name', 'LIKE', "%$name%");
        });
    }

    public function scopeTeacherId($query, $id)
    {
        return $query->whereHas('teachers', function ($q) use ($id) {
            return $q->where('id', '=', $id);
        });
    }
}
