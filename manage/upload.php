<?php
if (isset($_POST['send'])) {
    $uptypes=array(
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/pjpeg',
        'image/gif',
        'image/bmp',
        'image/x-png'
    );
	$_img_dir = substr(ROOT_PATH,0,strlen(ROOT_PATH)-6);
    $destination_folder=$_img_dir."upload/";
    $max_file_size=2000000; 
    //if ($_SERVER['REQUEST_METHOD'] == 'POST')
    //{   
        $file = $_FILES["upfile"];
        //if (!is_uploaded_file($file['tmp_name'])){ //是否存在文件
        //     echo "图片不存在!";
        //     exit;
       // }

        if($max_file_size < $file["size"]){//检查文件大小
            echo "文件太大!";
            exit;
        }

        if(!in_array($file["type"], $uptypes)){//检查文件类型
            echo "文件类型不符!".$file["type"];
            exit;
        }

        if(!file_exists($destination_folder)){
            mkdir($destination_folder);
        }

        $filename=$file["tmp_name"];
        $pinfo=pathinfo($file["name"]);
        $ftype=$pinfo['extension'];
		$imgname = time().".".$ftype;
        $destination = $destination_folder.$imgname;
        //$destination = $destination_folder.$pinfo['basename'];
        
        if (file_exists($destination)){
            echo "同名文件已经存在了";
            exit;
        }

        if(!move_uploaded_file ($filename, $destination)){
            echo "移动文件出错";
            exit;
        }
		//删除文件
		$_file = $_img_dir."upload/".$_POST['del_img']; 
		$result = @unlink ($_file); 
		//$result ? echo '删除成功' : echo '删除失败';
}
define('IMG',$imgname);
?>