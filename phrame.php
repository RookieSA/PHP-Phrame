<?php
	require_once("phrame-config.php");
	class phrame {
		
		public function __construct($autoload=true) {
			global $phrame_modules;
			
			if($autoload):
				$this->autoload();
				foreach($phrame_modules as $module):
					$includes = $module["includes"];
					foreach($includes as $include):
						require_once($include);
					endforeach;
				endforeach;
			endif;
		}
		
		public function autoload() {
			// iterate through modules location for present modules
			$modules = glob(LOC_MODULES . '/*' , GLOB_ONLYDIR);
			// Loop through discovered modules
			foreach($modules as $module):
				$module = str_replace(LOC_MODULES, "", $module);
				$this->load_module($module);
			endforeach;
			
		}
		
		public function load_module($module_path) {
			global $phrame_modules;
			
			$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(LOC_MODULES."/".$module_path));
			// Loop through discovered modules
			foreach($rii as $file):
				if($file->isDir()):
					$module["name"] = str_replace(LOC_MODULES, "", $file->getPathname());
					$module["root"] = $file->getPathname();
					continue;
				endif;
				// Get file path
				$fpath = $file->getPathname();
				// Get file info
				$finfo = pathinfo($fpath);
				// Get file extension
				$fext = $finfo["extension"];
				// Only populate 'PHP' files with '.inc.' in filename
				if(strpos($fpath, ".inc.") !== false && $fext == "php"):
					$module["includes"][] = $fpath;
				endif;
				// Get module README
				if(strpos(strtolower($fpath), "readme.txt") !== false):
					$module["description"] = file_get_contents($fpath);
				endif;
				
				$module["files"][] = $fpath;
			endforeach;
			
			$phrame_modules[] = $module;
		}
		
		public function get_modules() {
			global $phrame_modules;
			return $phrame_modules;
		}
	}
