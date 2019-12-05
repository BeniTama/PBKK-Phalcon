<?php
namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
// validations
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;

class RegisterForm extends Form {
	public function initialize() {
		$name = new Text (
			'name',
			[
				"class" => "form-control",
				"placeholder" => "Enter Full Name"
			]
		);
		// Name validation
		$name->addValidator(
			new PresenceOf(['message' => 'Name is required'])
		);
		
		$email = new Text (
			'email',
			[
				"class" => "form-control",
				"placeholder" => "Enter Email Address"
			]
		);
		// E-mail validation
		$email->addValidators ([
			new PresenceOf (['message' => 'Email is required']),
			new Email (['message' => 'Email is not valid']),
		]);
		
		$submit = new Submit (
			'submit',
			[
				"value" => "Register",
				"class" => "btn btn-primary",
			]
		);
		
		// Password
		$password = new Password (
			'password',
			[
				"class" => "form-control",
				"placeholder" => "New Password"
			]
		);
		// Password Validation
		$password->addValidators ([
			new PresenceOf (['message' => 'Password is required']),
			new StringLength (['min' => 5, 'message' => 'Password is too short. Minimum 5 characters']),
			new Confirmation (['with' => 'password_confirm', 'message' => 'Password doesn\'t match confirmation']),
		]);
		
		// Confirm Password
		$passwordNewConfirm = new Password (
			'password_confirm',
			[
				"class" => "form-control",
				"placeholder" => "Confirm Password"
			]
		);
		$passwordNewConfirm->addValidators ([
			new PresenceOf (['message' => 'Password confirmation is required']),
		]);
		
		$this->add($name);
		$this->add($email);
		$this->add($password);
		$this->add($passwordNewConfirm);
		$this->add($submit);
	}
}