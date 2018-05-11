<?php

namespace App\Repositories;

use App\Models\Rate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RateRepository
 * @package App\Repositories
 * @version April 28, 2018, 5:42 pm UTC
 *
 * @method Rate findWithoutFail($id, $columns = ['*'])
 * @method Rate find($id, $columns = ['*'])
 * @method Rate first($columns = ['*'])
*/
class RateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'app_id',
        'rate',
        'comment'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Rate::class;
    }
}
