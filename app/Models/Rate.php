<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rate
 * @package App\Models
 * @version April 28, 2018, 5:42 pm UTC
 *
 * @property integer app_id
 * @property integer rate
 * @property string comment
 */
class Rate extends Model
{
    use SoftDeletes;

    public $table = 'rates';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'app_id',
        'rate',
        'comment'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'app_id' => 'integer',
        'rate' => 'integer',
        'comment' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
