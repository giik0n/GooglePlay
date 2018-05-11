<?php

namespace App\Repositories;

use App\Models\Apps;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AppsRepository
 * @package App\Repositories
 * @version April 26, 2018, 6:25 am UTC
 *
 * @method Apps findWithoutFail($id, $columns = ['*'])
 * @method Apps find($id, $columns = ['*'])
 * @method Apps first($columns = ['*'])
*/
class AppsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'user_id',
        'user_email',
        'download',
        'version',
        'size',
        'company',
        'category_id',
        'category',
        'android'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Apps::class;
    }
}
