<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class UploadComponent extends Component
{
	public function save($data)
	{
		$saved = false;



		if(!empty($data))
		{
			
			if(count($data['name']) < 2)
			{

				$filename = $data['name'];

				$file_temp_name = $data['tmp_name'];

				$dir = WWW_ROOT.'img'.DS.'invoices';

				$allowed = array('png','jpg','jpeg');
				$extention = substr(strrchr($filename, '.'), 1);



				if(in_array(strtolower($extention), $allowed))
				{
					if(is_uploaded_file($file_temp_name))
					{
						move_uploaded_file($file_temp_name, $dir.DS.$filename);

						$saved = true;
					}
				}
			}
		}

		return $saved;
	}
}
