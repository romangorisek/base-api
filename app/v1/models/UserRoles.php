<?php

namespace Ekranj\Models;

use Phalcon\Http\Client\Request;

/**
 * @SWG\Definition(type="object", @SWG\Xml(name="UserRoles"))
 */
class UserRoles extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('user_roles');

        $this->belongsTo(
            'user_id',
            'Ekranj\Models\User',
            'id'
        );

        $this->belongsTo(
            'role_id',
            'Ekranj\Models\Role',
            'id'
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
    public $user_id;
    
    /**
    * @SWG\Property()
    * @var string
    */
    public $role_id;

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
}
