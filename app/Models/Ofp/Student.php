<?php

namespace App\Models\Ofp;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /*
 * Подключение к конфигурации sqlite_ofp
 */
    protected $connection = 'sqlite_ofp';

    /*
     * Таблица модели
     */
    protected $table = 'students';

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
    protected $hidden = ['id', 'group_id', 'teacher_id', 'faculty_id'];

    /**
     * Возвращает факультет
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faculty(){
        return $this->belongsTo('App\Models\Ofp\Faculty');
    }

    /**
     * Возвращает куратора
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(){
        return $this->belongsTo('App\Models\Ofp\Teacher');
    }

    /**
     * Возвращает группу
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(){
        return $this->belongsTo('App\Models\Ofp\Group');
    }

    /**
     * Возвращает список посещений
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pairs(){
        return $this->hasMany('App\Models\Ofp\Pair');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function standards(){
        return $this->hasMany('App\Models\Ofp\Standard');
    }

    public function scopeSearch($query, $name, $group) {
        return $query->where('name', 'like', "%$name%")->whereHas('group', function ($q) use ($group) {
            return $q->where('name', 'LIKE', "%$group%");
        });
    }
}
