<?php

namespace Ekranj\Models;

use Phalcon\Http\Client\Request;
use Ekranj\Models\Role;

/**
 * @SWG\Definition(type="object", @SWG\Xml(name="User"))
 */
class User extends BaseModel
{
    const ROLE_SUPERADMIN = "super_admin";
    const ROLE_ADMIN = "admin";
    const ROLE_USER = "user";
    const ROLE_GUEST = "guest";

    public function initialize()
    {
        parent::initialize();
        $this->setSource('users');

        $this->hasManyToMany(
            'id',
            'Ekranj\Models\UserRoles',
            'user_id',
            'role_id',
            'Ekranj\Models\Role',
            'id',
            [
                'alias' => 'UserRoles',
            ]
        );
    }

    public function beforeValidationOnCreate()
    {
        parent::beforeValidationOnCreate();

        if (property_exists($this, 'password')) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
    }

    public function beforeValidationOnUpdate()
    {
        parent::beforeValidationOnUpdate();

        if (property_exists($this, 'password')) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
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
    public $email;
    
    /**
    * @SWG\Property()
    * @var string
    */
    public $password;

    /**
    * @SWG\Property()
    * @var array
    */
    public $roles;
    
    /**
     * @SWG\Property()
     * @var boolean
     */
    public $active;

    /**
     * @SWG\Property()
     * @var string
     */
    public $recovery_token;

    /**
     * @SWG\Property()
     * @var string
     */
    public $last_login;

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

    public function getJWT()
    {
        $auth = $this->getDi()->get('auth');
        return $auth->createToken([
            'user_id'   => $this->id,
            'email' => $this->email,
        ]);
    }

    public static function login($email, $password)
    {
        $user = self::findFirst([
            'email = :email: AND active = 1',
            'bind' => [
                'email' => $email
            ]
        ]);

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    public function roles()
    {
        if (is_array($this->roles)) {
            return $this->roles;
        }
        $roles = [];
        foreach ($this->userRoles as $role) {
            $roles[] = $role->name;
            $childRoles = $this->findChildRoles($role);
            foreach ($childRoles as $childRole) {
                if (! in_array($childRole, $roles)) {
                    $roles[] = $childRole;
                }
            }
        }
        $this->roles = $roles;
        return $roles;
    }

    public function hasRole($role)
    {
        return in_array($role, $this->roles());
    }

    private function findChildRoles($role, $childRoles = [])
    {
        if ($role->hasChildRole()) {
            $childRole = Role::get($role->child_id);
            $childRoles[] = $childRole->name;
            $this->findChildRoles($childRole, $childRoles);
        }
        return $childRoles;
    }
}
