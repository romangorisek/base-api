<?php

namespace Ekranj\Library\Response;

use Ekranj\Library\Response;

/**
 * @SWG\Definition(
 *   definition="UserResponse",
 *   type="object",
 *   @SWG\Property(property="id", type="string"),
 *   @SWG\Property(property="email", type="string"),
 *   @SWG\Property(property="role", type="number"),
 *   @SWG\Property(property="active", type="string"),
 *   @SWG\Property(property="last_login", type="string"),
 *   @SWG\Property(property="created_on", type="string"),
 *   @SWG\Property(property="created_by", type="string"),
 *   @SWG\Property(property="updated_on", type="string"),
 *   @SWG\Property(property="updated_by", type="string")
 * )
*/
class User extends Response
{
    public function build($user): array
    {
        $output = [
            'id'                => $user->id,
            'email'             => $user->email,
            'role'              => $user->role,
            'active'            => $user->active,
            'last_login'        => $user->last_login,
            'created_on'        => $user->created_on,
            'created_by'        => $user->created_by,
            'updated_on'        => $user->updated_on,
            'updated_by'        => $user->updated_by,
        ];

        return $output;
    }
}
