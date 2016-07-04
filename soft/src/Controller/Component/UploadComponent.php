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
				$extention = explode('.', $filename);//substr(strrchr($filename, '.'), 1);
				
				$date = date_create();
				$id = date_timestamp_get($date);


				if(in_array(strtolower($extention[1]), $allowed))
				{
					if(is_uploaded_file($file_temp_name))
					{
						$filename = $extention[0]."_".$id.".".$extention[1];
						move_uploaded_file($file_temp_name, $dir.DS.$filename);

						$saved = $filename;
					}
				}
			}
		}

		return $saved;
	}

	public function savePDF($data)
	{
		$saved = false;



		if(!empty($data))
		{

			if(count($data['name']) < 2)
			{

				$filename = $data['name'];

				$file_temp_name = $data['tmp_name'];

				$dir = WWW_ROOT.'letters';

				$allowed = array('pdf');
				$extention = explode('.', $filename);//substr(strrchr($filename, '.'), 1);

				$date = date_create();
				$id = date_timestamp_get($date);


				if(in_array(strtolower($extention[1]), $allowed))
				{
					if(is_uploaded_file($file_temp_name))
					{
						$filename = $extention[0]."_".$id.".".$extention[1];
						move_uploaded_file($file_temp_name, $dir.DS.$filename);

						$saved = $filename;
					}
				}
			}
		}

		return $saved;
	}

	public function saveHeadquarterImage($data)
	{
		$saved = false;



		if(!empty($data))
		{

			if(count($data['name']) < 2)
			{

				$filename = $data['name'];

				$file_temp_name = $data['tmp_name'];

				$dir = WWW_ROOT.'img'.DS.'headquarter';

				$allowed = array('png','jpg','jpeg');
				$extention = explode('.', $filename);

				$date = date_create();
				$id = date_timestamp_get($date);


				if(in_array(strtolower($extention[1]), $allowed))
				{
					if(is_uploaded_file($file_temp_name))
					{
						$filename = $extention[0]."_".$id.".".$extention[1];
						move_uploaded_file($file_temp_name, $dir.DS.$filename);

						$saved = $filename;
					}
				}
			}
		}

		return $saved;
	}
	
	
}
