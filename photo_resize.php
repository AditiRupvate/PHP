<?php /*ob_start(); */
?><!doctype html>
<html lang="en">
<head>
	<?php /*include ('includes/head.php');*/ 
	?>
	<script src="ckeditor/ckeditor.js"></script>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<?php /*include ('includes/sidebar.php');*/
		 ?>
		<!--end sidebar wrapper -->
		<!--start header -->
		<?php include ('includes/header.php'); ?>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Blog</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Blog Add</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="admin_articles_list.php"><button type="button" class="btn btn-primary">View</button></a>
							
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="row">
					<div class="col">
						<h6 class="mb-0 text-uppercase">Blog Add</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<div class="p-4 border rounded">
									<form method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate >
									    <div class="col-md-6">
											<label for="validationCustom011" class="form-label">Image</label>
											<input type="file" name="image" class="form-control" id="validationCustom011" placeholder="Select Image" accept=".png,.PNG,.jpg,.JPG,.jpeg,.JPEG" required>
											<span style="color:red">Image size should be Height:465px, Width:700px;</span>
											<div class="invalid-feedback">Please select Image</div>
										</div>
										<div class="col-md-6">
											<label for="validationCustom01" class="form-label">Title</label>
											<input type="text" class="form-control" placeholder="Enter Title" name="title" required>
											<div class="valid-feedback">Looks good!</div>
										</div>
										
										
										<div class="col-md-12">
											<label for="validationCustom01" class="form-label">Blog Description</label>
											<textarea class="form-control" placeholder="Enter Blog" id="article" name="article" required></textarea>
											<div class="valid-feedback">Looks good!</div>
										</div>
										<script>
                                                  CKEDITOR.replace('article');
                                          </script>
									
										<div class="col-12">
											<input class="btn btn-primary" value="Submit" type="submit" name="submit">
										</div>
<?php

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
                              $lawyer_id=$_SESSION['id'];
                                $query="INSERT into articles (lawyer_id, image, title, article,is_approved) VALUES('0','$article_image','$title','$article','yes')";
                                $desired_dir="../lawyer/assets/documents/article/";
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
                // echo "Success";
            }
        }

        if($add2)
        {
         echo '<script type="text/javascript">';
         echo " alert('Blog Added Successfully.');";       
         echo 'window.location.href = "admin_articles_list.php";';
         echo '</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo " alert('Error In Adding Blog.');";
        echo 'window.location.href = "admin_articles_list.php";';
        echo '</script>';
    }


}

?>
									</form>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<?php include ('includes/footer.php'); ?>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
			(function () {
			  'use strict'
	
			  // Fetch all the forms we want to apply custom Bootstrap validation styles to
			  var forms = document.querySelectorAll('.needs-validation')
	
			  // Loop over them and prevent submission
			  Array.prototype.slice.call(forms)
				.forEach(function (form) {
				  form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
					  event.preventDefault()
					  event.stopPropagation()
					}
	
					form.classList.add('was-validated')
				  }, false)
				})
			})()
	</script>
	<!--app JS-->
	<?php /*ob_end_flush();*/
	 ?>