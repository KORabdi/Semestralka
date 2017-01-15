<?php 
namespace App\Model;

use Nette;

/**
 * Model pro praci s 'Model' presenterem
 * @author KORandi
 *
 */

class GalleryModel
{
	private $database;
	
	/**
	 * Model pro praci s 'Model' presenterem
	 * @param Nette\Database\Context $database
	 */
	public function __construct(Nette\Database\Context $database){
		$this->database = $database;
	}
	
	/**
	 * Vraci vsechny fotografie z db co nemaji status hide = 1
	 * @return \Nette\Database\Table\Selection
	 */
	public function fetchAll()
	{
		return $this->database->table('gallery')->where('hide',0)->fetchAll();
	}
	
	/**
	 * Vklada fotografii do db
	 * @param array $data
	 */
	public function insert($data)
	{
		$this->database->query('
        	INSERT INTO `gallery`', $data
				);
	}
	
	/**
	 * Nastavi fotografii hide = 1, "odstrani" fotografii
	 * @param int $post_id
	 * @return \Nette\Database\ResultSet
	 */
	public function remove($post_id)
	{
		return $this->database->query('
				UPDATE `gallery`
				SET `hide` = 1
				WHERE `id` = ',$post_id
				);
	}
	
	/**
	 * Prenastavi vlastnosti fotografie
	 * @param array $array
	 */
	public function update($array){
		$this->database->query('
				UPDATE `gallery` SET ',$array,'WHERE id='.(int)$array['id']
				);
	}
	
	/**
	 * Vraci seznam fotografii ulozene na serveru
	 * @return string[]
	 */
	public function getImages(){
		$directory = BASEPATH."/www/images/gallery/small/";
		//print ($directory);
		$images = glob($directory . "*.{jpg,gif,png}", GLOB_BRACE);
		$return = array();
		foreach($images as $image)
			$return[] = basename($image);
		return $return;
	}
	
	/**
	 * Ulozi fotografii na server, udela jeji mensi kopii, a prida ji do db
	 * @param Nette\Http\FileUpload $file
	 * @param string $description
	 */
	public function save(Nette\Http\FileUpload $file, $description){
		if($file->isImage() and $file->isOk()) {
			$file_ext=strtolower(mb_substr($file->getSanitizedName(), strrpos($file->getSanitizedName(), ".")));
			$file_name = uniqid(rand(0,20), TRUE).$file_ext;
			$file->move(BASEPATH.'/www/images/gallery/'.$file_name);
			$this->insert(array(
					'name' => $file_name,
					'description' => $description,
					'hide' => 0,
					'date' => new \DateTime()
			));	
			$image = \Nette\Utils\Image::fromFile(BASEPATH.'/www/images/gallery/'.$file_name);
			if($image->getWidth() > $image->getHeight()) {
				$image->resize(140, NULL);
			}
			else {
				$image->resize(NULL, 140);
			}
			$image->sharpen();
			$image->save(BASEPATH.'/www/images/gallery/small/'.$file_name);
		}
	}
}