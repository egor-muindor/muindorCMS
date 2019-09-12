<?php

namespace App\Models\Timeboard;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /*
     * Подключение к конфигурации mysql_timeboard
     */
    protected $connection = 'mysql_timeboard';

    /*
     * Таблица модели
     */
    protected $table = 'groups';

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
     * Возвращает все пары для группы
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pairs()
    {
        return $this->belongsToMany('App\Models\Timeboard\Pair', 'group_pair',
            'group_id', 'pair_id');
    }
}
