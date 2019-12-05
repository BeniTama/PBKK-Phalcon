<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as Uniqueness;

class Users extends \Phalcon\Mvc\Model
{
	protected $id;
	protected $name;
	protected $email;
	protected $password;
	
	public function setId($id)
	{
		$this->id = $id;
		
		return $this;
	}
	
	public function setName($name)
	{
		$this->name = $name;
		
		return $this;
	}
	
	
	public function setEmail($email)
	{
		$this->email = $email;
		
		return $this;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
		
		return $this;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function validation()
	{
		$validator = new Validation();
		
		$validator->add(
			'email',
			new EmailValidator (
				[
					'model' => $this,
					'message' => 'Please enter a correct email address',
				]
			)
		);
		
		$validator->add (
			'email',
			new Uniqueness (
				[
					'model' => $this,
					'message' => 'Another user with the same email already exist',
					'cancelOnFail' => true,
				]
			)
		);
		
		return $this->validate($validator);
	}
	
	public function initialize()
	{
		$this->setSchema("phalcon_demo-app");
		$this->setSource("users");
	}
	
	public function getSource()
	{
		return 'users';
	}
	
	public static function find ($parameters = null)
	{
		return parent::find($parameters);
	}
	
	public static function findFirst($parameters = null)
	{
		return parent::findFirst($parameters);
	}
	
	public function columnMap()
	{
		return [
			'id' => 'id',
			'name' => 'name',
			'email' => 'email',
			'password' => 'password'
		];
	}
}
	