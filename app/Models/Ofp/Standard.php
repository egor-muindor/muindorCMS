<?php

namespace App\Models\Ofp;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    /*
     * Подключение к конфигурации sqlite_ofp
     */
    protected $connection = 'sqlite_ofp';

    /*
     * Таблица модели
     */
    protected $table = 'standards';

    /*
     * PrimaryKey таблицы
     */
    protected $primaryKey = 'id';

    /*
     * Поля, доступные для заполнения
     */
    protected $fillable = ['name'];

    /*
     * Прячем id для отправки
     */
    protected $hidden = ['id'];

    /*
     * Отключение обновления полей updated_at и created_at
     */
    public $timestamps = false;

}
