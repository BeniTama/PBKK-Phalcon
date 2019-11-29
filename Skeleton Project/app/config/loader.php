<?php
	$loader = new \Phalcon\Loader();
	
	/**
	* We're registering a set of directories taken from the configuration file
	*/
	$loader->registerDirs(
		[
			$config->application->controllersDir,
			$config->application->modelsDir
		]
	)->register();