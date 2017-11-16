<?php

namespace Ekranj\Models;

use Phalcon\Http\Client\Request;

/**
 * @SWG\Definition(type="object", @SWG\Xml(name="User"))
 */
class User extends BaseModel
{
    const ROLE_SUPERADMIN = 1000;
    const ROLE_ADMIN = 900;
    const ROLE_USER = 100;

    public function initialize()
    {
        parent::initialize();
        $this->setSource('users');
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
    * @var integer
    */
    public $role;
    
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

    public static function login($email, $password, $role = self::ROLE_ADMIN)
    {
        $user = self::findFirst([
            'email = :email: AND active = 1 AND role >= :role:',
            'bind' => [
                'email' => $email,
                'role' => $role
            ]
        ]);

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }
}
