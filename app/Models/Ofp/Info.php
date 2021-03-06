<?php

namespace App\Models\Ofp;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    /*
 * Подключение к конфигурации sqlite_ofp
 */
    protected $connection = 'sqlite_ofp';

    /*
     * Таблица модели
     */
    protected $table = 'info';

    /*
     * PrimaryKey таблицы
     */
    protected $primaryKey = 'name';

    /*
     * Отключение обновления полей updated_at и created_at
     */
    public $timestamps = false;

    protected $hidden = ['name'];

}
