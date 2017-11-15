<?php
$target_dir = "uploads/";
$target_file = "uploads/herbs2.jpg";
$target_file2 = "uploads/terra.png";
$target_file3 = "uploads/water.gif";
$target_file4 = "uploads/herbs2.png";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    if($_FILES["fileToUpload"]["error"] != 4) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
      if ($uploadOk) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }
      }
    }
    /*
    if($_FILES["image1"]["error"] != 4) {
      $check = getimagesize($_FILES["image1"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
      if ($uploadOk) {
        if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file2)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }
      }
    }

    if($_FILES["image2"]["error"] != 4) {
      $check = getimagesize($_FILES["image2"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
      if ($uploadOk) {
        if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file3)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }
      }
    }

    if($_FILES["image3"]["error"] != 4) {
      $check = getimagesize($_FILES["image3"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
      if ($uploadOk) {
        if (move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file4)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }
      }
    }*/
}
?>
