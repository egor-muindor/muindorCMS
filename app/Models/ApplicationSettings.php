<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSettings extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'application_settings';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';


    /**
     * Disable auto-setup timestamp for Eloquent.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Array of fillable fields in table.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'comment'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
