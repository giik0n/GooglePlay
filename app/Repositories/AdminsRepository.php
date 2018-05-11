<?php

namespace App\Repositories;

use App\Models\Admins;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdminsRepository
 * @package App\Repositories
 * @version April 29, 2018, 4:58 am UTC
 *
 * @method Admins findWithoutFail($id, $columns = ['*'])
 * @method Admins find($id, $columns = ['*'])
 * @method Admins first($columns = ['*'])
*/
class AdminsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Admins::class;
    }
}
