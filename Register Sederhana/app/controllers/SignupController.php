<?php
use Phalcon\Http\Request;

// Use form
use App\Forms\RegisterForm;

class SignupController extends ControllerBase
{
	public function indexAction()
	{
		$this->view->form = new RegisterForm();
	}
	
	public function registerAction()
	{
		// Getting a request instance
		$request = new Request();		
		$user = new Users();
		$form = new RegisterForm();
		
		// Check request
		if(!$this->request->isPost()) {
			return $this->response->redirect('signup');
		}
		
		$form->bind($_POST, $user);
		// check form validation
		if (!$form->isValid()) {
			foreach ($form->getMessages() as $message) {
				$this->flashSession->error($message);
				$this->dispatcher->forward ([
					'controller' => $this->router->getControllerName(),
					'action' => 'index',
				]);
				return;
			}
		}
		
		$user->setPassword($this->security->hash($_POST['password']));
		
		if (!$user->save()) {
			foreach ($user->getMessages() as $m) {
				$this->flashSession->error($m);
				$this->dispatcher->forward ([
					'controller' => $this->router->getControllerName(),
					'action' => 'index',
				]);
				return;
			}
		}
		
		// Using session flash
		$this->flashSession->success('Thanks for registering!');
		
		// Make a full HTTP redirection
		return $this->response->redirect('signup');
			
		$this->view->disable();
	}
}