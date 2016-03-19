<?php
	namespace Phrame;
	
	require_once("phrame-config.php");
	class phrame {
		
		public function __construct($autoload=true) {
			global $phrame_modules, $phrame_config;
			
			if($autoload):
				$this->autoload();
			endif;
		}
		
		protected function autoload() {
			// iterate through modules' location for present modules
			$modules = glob(LOC_MODULES . '/*' , GLOB_ONLYDIR);
			// Loop through discovered modules
			foreach($modules as $module):
				$module = str_replace(LOC_MODULES, "", $module);
				// Load discovered module
				$this->load_module($module);
			endforeach;
			
		}
		
		public function load_module($module_path) {
			global $phrame_modules, $phrame_config;
			
			// Check if $module_path is a URL
			if(filter_var($module_path, FILTER_VALIDATE_URL)):
				$this->load_external_module($module_path);
				/*
				*	Re-set the $module_path to the newly created module directory
				*	The newly created directory name matches the zip file name of the remote module; however we need to remove the .zip extension
				*/
				$module_path = basename($module_path);
				$module_path = preg_replace('/\\.[^.\\s]{3,4}$/', '', $module_path);
			endif;
			
			$rii = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(\LOC_MODULES."/".$module_path));
			// Loop through discovered modules
			foreach($rii as $file):
				if($file->isDir()):
					$module["root"] = realpath(\LOC_MODULES."/".$module_path);
					continue;
				endif;
				
				// Get file path
				$fpath = $file->getPathname();
				
				// Get module configuration file
				$config_f_path = realpath($module["root"]."\config.xml");
				if(file_exists($config_f_path) !== false):
					$config = (array)simplexml_load_file($config_f_path);
					$module["config"] = $config;
					$phrame_config = $config;
				else:
					throw new \Exception(sprintf(\ERR_NO_CONFIG_FILE, $module["root"]), 1);
				endif;
				
				// Get module README
				if(strpos(strtolower($fpath), "readme.txt") !== false):
					$module["readme"] = file_get_contents($fpath);
				endif;
				
				// Populate module's files
				$module["files"][] = realpath($fpath);
				
				// Get file info
				$finfo = pathinfo($fpath);
				// Get file extension
				$fext = $finfo["extension"];
				// Get file name
				$fname = $finfo["filename"];
				
				// Only pull 'PHP' files, with '.inc.' in filename
				if(strpos($fpath, ".inc.") !== false && $fext == "php"):
					$class_name = strtok($fname,  '.');
					$class = array();
					$class["namespace"] = $config["namespace"]."\\".$class_name;
					$class["name"] = $class_name;
					$class["path"] = realpath($fpath);
					//$module["classes"][] = $class;
					
					// Require class file to initiate new class
					require_once($class["path"]);
					
					// Get qualified namespace of class and create a new instance of the class
					$class_name = $class["namespace"];
					$init_class = new $class_name;
					
					// Create empty function array to populate function structure - see below
					$function = array();
					
					// Iterate through the class' methods
					$methods = get_class_methods($init_class);
					foreach($methods as $method):
						// Pupulate fuction[] array with method's structure
						$function["name"] = $method;
						// Get method's arguments
						$ref_args = new \ReflectionMethod($class_name, $method);
						$ref_args = $ref_args->getParameters();
						// Create array to populate method arguments
						$method_args = array();
						foreach ($ref_args as $arg):
							// Pupulate method argument array
							$method_args[] = $arg->getName();
						endforeach;
						
						// Set current method's argument value
						$function["args"] = $method_args;
						// Create example usage of method instantiation
						$function["method"] = $class_name."::".$method."($".implode(", $", $method_args).")";
						// Update $phrame_modules array's methods with the list of functions
						$module["classes"][] = $function;
					endforeach;
					
				endif;
				
				
			endforeach;
			
			$phrame_modules[basename($module_path)] = $module;
		}
		
		// Retreive a list of currently loaded modules
		public function get_modules() {
			global $phrame_modules;
			return $phrame_modules;
		}
		
		// Retreive a specific module
		public function get_module($name) {
			global $phrame_modules;
			return $phrame_modules[$name];
		}
		
		// Retreive a specific module
		public function get_module_classes($name) {
			global $phrame_modules;
			return $phrame_modules[$name]["classes"];
		}
		
		// Retreive a module's methods
		public function get_module_methods($name) {
			global $phrame_modules;
			$methods = array();
			foreach($phrame_modules[$name]["classes"] as $method):
				$methods[] = $method["methods"];
			endforeach;
			return $methods;
		}
		
		// Load external modules from remote provider
		private function load_external_module($url) {
			
			$tmp_zip = basename($url);
			$r_zip = LOC_MODULES.'/'.$tmp_zip;
			
			// Download remote module and save to local module directory
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			file_put_contents($r_zip, $data);
			
			$zip = new \ZipArchive;
			if ($zip->open($r_zip) === TRUE):
				$zip->extractTo(realpath(LOC_MODULES));
				$zip->close();
				unlink($r_zip);
			else:
				echo 'failed';
			endif;
		}
	}
