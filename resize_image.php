<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<br>
<br>

	<form method="post" enctype="multipart/form-data">
<input type="file" name="image"> 
<br>
<br>
<br>
		<input type="submit" name="submit">
	</form>
</body>
</html>
<?php
$con=mysqli_connect("localhost","root","","forms");


                if(isset($_POST['submit']))
                {
                    extract($_POST);

                    if(isset($_FILES['image'])){
                        $errors= array();
                       
                            $file_name = $_FILES['image']['name'];
                            $file_size =$_FILES['image']['size'];
                            $file_tmp =$_FILES['image']['tmp_name'];
                            $file_type=$_FILES['image']['type'];  
                            $article_image=uniqid().$file_name;
               
                            $extension = strtolower(pathinfo($article_image,PATHINFO_EXTENSION));
                            if($extension=="jpg" || $extension=="jpeg" || $extension=="png")
                            {   
                              
                                $query="INSERT into resize (image) VALUES ('$article_image')";
                                $desired_dir="resize_image/";
                                move_uploaded_file($file_tmp,"$desired_dir/".$article_image);

                                $add2=mysqli_query($con,$query); 

                    $save = "$desired_dir" . $article_image; //This is the new file you saving
                    $file = "$desired_dir" . $article_image; //This is the original file

                    list($width, $height) = getimagesize($file) ;

                    $modwidth = 378;                  
                    $modheight = 249;
                    $tn = imagecreatetruecolor($modwidth, $modheight) ;
                    imagealphablending( $tn, false );
                    imagesavealpha( $tn, true );
                    if($extension=="jpg" || $extension=="jpeg" )
                    {

                       $image = imagecreatefromjpeg($file);
                            imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                            imagejpeg($tn, $save, 100); 
                        }
                        else if($extension=="png")
                        {

                            $image = imagecreatefrompng($file);
                            imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                            imagepng( $tn, $save, 9 );
                        }
               
                }
            
            if(empty($error)){
                echo "Success";
            }
            else
            {
            	echo "no";
            }
        }
         if($add2)
        {
         echo '<script type="text/javascript">';
         echo " alert('Blog Added Successfully.');";       
         // echo 'window.location.href = "admin_articles_list.php";';
         echo '</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo " alert('Error In Adding Blog.');";
        // echo 'window.location.href = "admin_articles_list.php";';
        echo '</script>';
    }


        

}

?>