<?php

namespace App\Models\Ofp;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    /*
     * Подключение к конфигурации sqlite_ofp
     */
    protected $connection = 'sqlite_ofp';

    /*
     * Таблица модели
     */
    protected $table = 'faculties';

    /*
     * PrimaryKey таблицы
     */
    protected $primaryKey = 'id';

    /*
     * Отключение обновления полей updated_at и created_at
     */
    public $timestamps = false;

    /*
     * Прячем id для отправки
     */
    protected $hidden = ['id'];

}
