<?php
    ini_set('date.timezone', 'America/New_York');
    
    $directory = '../attached/';
    $folders = array();
    
    if(is_dir($directory))
    $folders = array_diff(scandir($directory), array('..', '.'));
    
    foreach($folders as $name_folder)
    {
        $time = stat($directory.$name_folder);
		
		//checks if the folder is 3 days ago
        if ($time['atime'] <= strtotime('-3 days'))
		{
			$uploaddir = $directory.$name_folder;
			$dir_contents = array_diff(scandir($uploaddir), array('.','..'));
			
			if(is_dir($uploaddir))
			{
				foreach($dir_contents as $content)
				{
					//delete file
					unlink($uploaddir.'/'.$content);
					
					//delete folder
					rmdir($uploaddir);
				}
			}
		}
    }
    //echo date('d/m/Y', $time['atime']).' <= '.date('d/m/Y', strtotime('-3 days'));
?>