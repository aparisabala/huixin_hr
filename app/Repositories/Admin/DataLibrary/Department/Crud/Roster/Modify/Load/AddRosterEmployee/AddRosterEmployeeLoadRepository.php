<?php

namespace App\Repositories\Admin\DataLibrary\Department\Crud\Roster\Modify\Load\AddRosterEmployee;

use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
class AddRosterEmployeeLoadRepository extends BaseRepository implements IAddRosterEmployeeLoadRepository {

    use BaseTrait;
    public function __construct() {
    }

    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
    public function index($request) : array
    {
       return [];
    }


    /**
     * Load view data
     *
     * @param Request $request
     * @return array
     */
    public function display($request) : array
    {
        $data['item'] = null;
        return $data;
    }
}