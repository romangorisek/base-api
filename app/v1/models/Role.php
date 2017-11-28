<?php

namespace Ekranj\Models;

use Phalcon\Http\Client\Request;

/**
 * @SWG\Definition(type="object", @SWG\Xml(name="Role"))
 */
class Role extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('roles');

        $this->hasManyToMany(
            'id',
            'Ekranj\Models\UserRoles',
            'role_id',
            'user_id',
            'Ekranj\Models\User',
            'id',
            [
                'alias' => 'RoleUsers',
            ]
        );
    }

    /**
     * @SWG\Property()
     * @var string
     */
    public $id;
    
    /**
    * @SWG\Property()
    * @var string
    */
    public $name;
    
    /**
    * @SWG\Property()
    * @var string
    */
    public $description;

    /**
    * @SWG\Property()
    * @var string
    */
    public $child_id;

    /**
     * @SWG\Property()
     * @var string
     */
    public $created_on;

    /**
     * @SWG\Property()
     * @var string
     */
    public $created_by;

    /**
     * @SWG\Property()
     * @var string
     */
    public $updated_on;

    /**
     * @SWG\Property()
     * @var string
     */
    public $updated_by;

    public function hasChildRole()
    {
        return ($this->child_id != '' && $this->child_id != null);
    }
}
