<?php

namespace App\Models\Timeboard;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    /*
     * Подключение к конфигурации mysql_timeboard
     */
    protected $connection = 'mysql_timeboard';

    /*
     * Таблица модели
     */
    protected $table = 'info';

    /*
     * PrimaryKey таблицы
     */
    protected $primaryKey = 'name';

    /*
     * Поля, доступные для заполнения
     */
    protected $fillable = ['name', 'status'];

    /*
     * Отключение обновления полей updated_at и created_at
     */
    public $timestamps = false;
}
