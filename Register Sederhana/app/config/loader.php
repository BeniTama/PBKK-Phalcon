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
	);
	
	// Register some namespaces
	$loader->registerNamespaces (
		[
			'App\Forms' => APP_PATH .'/forms/',
		]
	);
	
	// Register autoloader
	$loader->register();