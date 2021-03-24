<?php
/* 客戶端 */
$root_cust = "/bookstore";

/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;

$target_dir = $root_local . "/images/product/";                         //指定儲存檔案的目錄
// $target_dir = "$root_cust/images/product/";                         //指定儲存檔案的目錄

// $filepath = $root_local . "/images/product/" . $ID . "_1.jpg";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $ID . "_1.jpg";                          //上傳檔案的名稱改成ID
$uploadOk = 1;                                                       //上傳成功
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));      //strtolower：轉變為小寫    pathinfo：路徑信息   

// Check if image file is a actual image or fake image(檢查圖像文件是真實圖像還是偽圖像)
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


// Check if file already exists(檢查文件是否已經存在)
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size(檢查檔案大小)單位(KB)
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats(允許文件格式)
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error(檢查$ uploadOk是否被錯誤設置為0)
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file(如果一切正常，請嘗試上傳文件)
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {//move_uploaded_file（檔案,目的）函數將上載的文件移動到新的目的地。
    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
