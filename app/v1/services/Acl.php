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
        $controller = get_class($handler[0]);
        $action = $handler[1];
        if ($this->isAllowed($controller, $action)) {
            return true;
        }
        return false;
    }

    public function isAllowed($controller, $action)
    {
        $role = $this->getDi()->get('auth')->getUserRole();
        if ($role == User::ROLE_SUPERADMIN) {
            return true;
        }

        //Insert custom client logic here (from database, tenant extensions..)
        $actionResult = $this->checkActionAnnotations($controller, $action, $role);
        if ($actionResult != null) {
            return $actionResult;
        }
        $controllerResult = $this->checkControllerAnnotations($controller, $role);
        if ($controllerResult != null) {
            return $controllerResult;
        }
        return false;
    }

    public function checkControllerAnnotations($controller, $userRole)
    {
        $annotations = $this->annotationReader->get($controller)->getClassAnnotations();
        return $annotations ? $this->checkAnnotationsForAcl($annotations, $userRole) : false;
    }

    public function checkActionAnnotations($controller, $action, $userRole)
    {
        $annotations = $this->annotationReader->getMethod($controller, $action);
        return $annotations ? $this->checkAnnotationsForAcl($annotations, $userRole) : false;
    }

    private function checkAnnotationsForAcl($annotations, $userRole)
    {
        if ($annotations->has("Acl")) {
            $annotation = $annotations->get("Acl");
            $requiredRole = $annotation->getNamedParameter("role");
            if ((int)$requiredRole <= $userRole) {
                return true;
            }
            return false;
        }
    }
}
