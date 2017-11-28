<?php

namespace Ekranj\Services;

use Phalcon\Annotations\Adapter\Memory as AnnotationsAdapter;
use Ekranj\Library\Authentication;
use Ekranj\Models\User;

class Acl extends ServiceBase
{
    private $annotationReader = null;

    public function __construct()
    {
        $this->annotationReader = new AnnotationsAdapter();
    }

    public function checkRoute($app)
    {
        $handler = $app->getActiveHandler();
        if (!is_array($handler)) {
            return true;
        }
        $controller = get_class($handler[0]);
        $action = $handler[1];
        if ($this->isAllowed($controller, $action)) {
            return true;
        }
        return false;
    }

    public function isAllowed($controller, $action)
    {
        $user = $this->getDi()->get('auth')->getUser();
        if ($user && $user->hasRole(User::ROLE_SUPERADMIN)) {
            return true;
        }

        //Insert custom client logic here (from database, tenant extensions..)
        $actionResult = $this->checkActionAnnotations($controller, $action, $user);
        if ($actionResult != null) {
            return $actionResult;
        }
        $controllerResult = $this->checkControllerAnnotations($controller, $user);
        if ($controllerResult != null) {
            return $controllerResult;
        }
        return false;
    }

    public function checkControllerAnnotations($controller, $user)
    {
        $annotations = $this->annotationReader->get($controller)->getClassAnnotations();
        return $annotations ? $this->checkAnnotationsForAcl($annotations, $user) : false;
    }

    public function checkActionAnnotations($controller, $action, $user)
    {
        $annotations = $this->annotationReader->getMethod($controller, $action);
        return $annotations ? $this->checkAnnotationsForAcl($annotations, $user) : false;
    }
    
    private function checkAnnotationsForAcl($annotations, $user)
    {
        if ($annotations->has("Acl")) {
            $annotation = $annotations->get("Acl");
            $requiredRoles = $annotation->getNamedParameter("roles");
            if (in_array(User::ROLE_GUEST, $requiredRoles)) {
                return true;
            }
            if (!empty(array_intersect($requiredRoles, $user->roles()))) {
                return true;
            }
            return false;
        }
    }
}
