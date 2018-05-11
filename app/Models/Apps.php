<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Apps
 * @package App\Models
 * @version April 26, 2018, 6:25 am UTC
 *
 * @property string title
 * @property mediumText description
 * @property integer user_id
 * @property string user_email
 * @property integer download
 * @property string version
 * @property int size
 * @property string company
 * @property integer category_id
 * @property string category
 * @property string android
 */
class Apps extends Model
{
    use SoftDeletes;

    public $table = 'apps';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'user_id',
        'user_email',
        'download',
        'version',
        'rate',
        'ratecount',
        'size',
        'company',
        'category_id',
        'category',
        'android'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'user_id' => 'integer',
        'user_email' => 'string',
        'download' => 'integer',
        'version' => 'string',
        'rate' => 'integer',
        'ratecount' => 'integer',
        'company' => 'string',
        'category_id' => 'integer',
        'category' => 'string',
        'android' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
