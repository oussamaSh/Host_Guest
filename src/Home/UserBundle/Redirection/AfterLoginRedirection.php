<?php

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 08/02/2017
 * Time: 15:05
 */

namespace Home\UserBundle\Redirection;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;


class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{

    protected $router;
    protected $security;

    /**
     * AfterLoginRedirection constructor.
     * @param Router $router
     * @param AuthorizationChecker $security
     */
    public function __construct(Router $router, AuthorizationChecker $security)
    {
        $this->router = $router;
        $this->security = $security;
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        if ($this->security->isGranted('ROLE_ADMIN')) {
            $response = new RedirectResponse($this->router->generate('admin_home'));
        }else if ($this->security->isGranted('ROLE_CLIENT')){
            $response = new RedirectResponse($this->router->generate('client_home'));
        }
        return $response;
    }
}