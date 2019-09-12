<?php

namespace App\Models\Timeboard;

use Illuminate\Database\Eloquent\Model;

class Auditory extends Model
{
    /*
     * Подключение к конфигурации mysql_timeboard
     */
    protected $connection = 'mysql_timeboard';

    /*
     * Таблица модели
     */
    protected $table = 'auditories';

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
     * Возвращает все пары для аудитории
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pairs()
    {
        $this->belongsToMany('App\Models\Timeboard\Pair', 'auditory_pair',
            'auditory_id', 'pair_id');
    }
}
