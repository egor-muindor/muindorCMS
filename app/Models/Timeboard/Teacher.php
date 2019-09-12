<?php

namespace App\Models\Timeboard;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /*
     * Подключение к конфигурации mysql_timeboard
     */
    protected $connection = 'mysql_timeboard';

    /*
     * Таблица модели
     */
    protected $table = 'teachers';

    /*
     * PrimaryKey таблицы
     */
    protected $primaryKey = 'id';

    /*
     * Поля, доступные для заполнения
     */
    protected $fillable = ['name'];

    /*
     * Отключение обновления полей updated_at и created_at
     */
    public $timestamps = false;

    /*
     * Прячем pivot для отправки
     */
    protected $hidden = ['pivot'];

    /*
     * Возвращает все пары преподавателя
     */
    public function pairs()
    {
        return $this->belongsToMany('App\Models\Timeboard\Pair', 'teacher_pair',
            'teacher_id', 'pair_id');
    }

    public function scopeName($query, $name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }
}
