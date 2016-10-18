<?php

namespace AppBundle\Security;

use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
	private $formFactory;
	private $em;
	private $router;
	private $passwordEncoder;

	public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router, UserPasswordEncoder $passwordEncoder)
	{
		$this->formFactory = $formFactory;
		$this->em = $em;
		$this->router = $router;
		$this->passwordEncoder = $passwordEncoder;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \Symfony\Component\Security\Guard\GuardAuthenticatorInterface::getCredentials()
	 */
	public function getCredentials(Request $request) {
		/** checkh if is submitted login form */
		$isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');
		
		if(!$isLoginSubmit){
			// skip authentication, request continuse like normal
			return;
		}
		
		$form = $this->formFactory->create(LoginForm::class);
		$form->handleRequest($request);
		$data = $form->getData();
		/** Fetching the last username from the session */
		$request->getSession()->set(Security::LAST_USERNAME, $data['_username']);
		return $data;
	}
		
	
	/**
	 * @param $credentials, is equal to that we return from getCredentials() method 
	 * {@inheritdoc}
	 *
	 * @see \Symfony\Component\Security\Guard\GuardAuthenticatorInterface::getUser()
	 */
	public function getUser($credentials, UserProviderInterface $userProvider) {
		
		$username = $credentials['_username'];
		
		/** 
		 * If this return null, guard authentication will fail, and user will see an error.
		 * If this return User object. Guard calls checkCredentials(). 
		*/
		return $this->em->getRepository('AppBundle:User')
		->findOneBy(['email' => $username]);
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \Symfony\Component\Security\Guard\GuardAuthenticatorInterface::checkCredentials()
	 */
	public function checkCredentials($credentials, UserInterface $user) {
		
		$password = $credentials['_password'];
		
		if($this->passwordEncoder->isPasswordValid($user, $password)){
			return true;
		}
		
		return false;
	}
	
	/**
	 * If authenticiation fails  we need to redirect user back to the login form
	 * {@inheritdoc}
	 *
	 * @see \Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator::getLoginUrl()
	 */
	protected function getLoginUrl() {
		return $this->router->generate('security_login');
	}
	
	
	/**
	 * Automatically redireckt back  to  the last page ther tried to wisit before begin forced to login,
	 * but in case they go directly to /login and   if authenticiation is successful, redirect to dashboard. 
	 */
	protected function getDefaultSuccessRedirectUrl()
	{
		return $this->router->generate('admin_member_index');
	}
	
	
	
	






}