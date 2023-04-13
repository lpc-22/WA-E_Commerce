<?php include("connection.php");
//error_reporting(0); //Enable it if all tests are runned.
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/style.css">
    <title>Online Pet Store</title>
</head>

<style>
    .list-group{
        --bs-list-group-item-padding-y : 1rem !important;
    }
</style>

<body>
    
    <?php include("navBar.php") ?>

    <div class = "container my-4">
        <div class="row">

            <div class= "col AddProduct">
                <div class="card">

                    <h2 class="card-header">Add Product</h2>

                    <div class="card-body" style="transform: rotate(0);">

                    <!--enctype="multipart/form-data" is to allowed files to be uploaded within form tag.s-->
                    <form action="admin_Product.php" method="post" enctype="multipart/form-data">
                        <label>ID:</label><br>

                        <?php

                            $lastproductQuery = "SELECT * FROM products ORDER BY id DESC LIMIT 1";
                            $lastProductRow = mysqli_query($link, $lastproductQuery);

                            if (mysqli_num_rows($lastProductRow) > 0) {
                                $theRow = mysqli_fetch_assoc($lastProductRow);
                                $lastProductID = $theRow["id"];
                            }else{
                                #If the product table does not have any product yet
                                $lastProductID = 1;
                            }

                        ?>

                        <!--To show to product ID to admin-->
                        <input class="form-control" type="text" name="AddProduct_ID" readonly value=<?php echo '"'. $lastProductID+1 .'"' ?> ><br><br>

                        <label>Name:</label><br>
                        <input class="form-control" type="text" name="AddProduct_Name" placeholder="Product Name"><br>

                        <label>Description:</label><br>
                        <input class="form-control" type="text" name="AddProduct_Description"><br>

                        <label>Category:</label><br>
                        <input class="form-check-input" type="radio" name="AddProduct_Type" value="Food">
                        <label>Food</label><br>
                        <input class="form-check-input" type="radio" name="AddProduct_Type" value="Accessories">
                        <label>Accessories</label><br>
                        <input class="form-check-input" type="radio" name="AddProduct_Type" value="Toy">
                        <label>Toy</label><br>

                        <label>Price:</label><br>
                        <input class="form-control" type="number" name="AddProduct_Price"><br>

                        <label>Image:</label><br>
                        <input class="form-control" type="file" name="AddProduct_Image"><br>

                        <input type="submit" class="btn btn-primary mt-3" name="Submit_form_ADDProduct" value="ADD" >

                    </form>
                    </div>

                </div>
            </div>

            <div class= "col ModProduct">
                <div class="card ">

                    <h2 class="card-header">Modify Product</h2>

                    <ul class="list-group list-group-flush" style="transform: rotate(0);">
                        <li class="list-group-item">
                            <!--enctype="multipart/form-data" is to allowed files to be uploaded within form tag.s-->
                            <form action="admin_Product.php" id="mod_id_autofill" method="post" enctype="multipart/form-data">
                                <label>ID:</label><br>
                                <input class="form-control" type="text" name="ModProduct_ID_AutoFill">
                                <input class="btn btn-primary mt-3" type="submit" name="Submit_form_ModProductAutoFill" value="Get" >
                            </form>
                        </li>

                        <li class="list-group-item">

                            <?php 
                            
                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Submit_form_ModProductAutoFill'])) {

                                $Mod_ID = $_POST['ModProduct_ID_AutoFill'];

                                $query = "SELECT * FROM products WHERE id = $Mod_ID";
                                $execute = mysqli_query($link, $query);
            
                                if($row = mysqli_fetch_assoc($execute)){
                                    echo'
                                    
                                    <form action="admin_Product.php" id="mod_fullform" method="post" enctype="multipart/form-data">

                                    <label>ID:</label><br>
                                    <input class="form-control" readonly type="text" name="ModProduct_ID"value='.$row['id'].'><br>

                                    <label>Name:</label><br>
                                    <input class="form-control" type="text" name="ModProduct_Name" placeholder="Product Name" value='.$row['name'].'><br>

                                    <label>Description:</label><br>
                                    <input class="form-control" type="text" name="ModProduct_Description" value='.$row['description'].'><br>
                                    
                                    <label>Category:</label><br>
                                    ';

                                    $Accessories = "";
                                    $Food = "";
                                    $Toy = "";
                                    if($row["category"] == "Accessories"){
                                        $Accessories = "checked";
                                    }else if($row["category"] == "Toy"){
                                        $Toy = "checked";
                                    }else if($row["category"] == "Food"){
                                        $Food = "checked";
                                    }

                                    echo'
                                    <input class="form-check-input" type="radio" name="ModProduct_Type" value="Food" '.$Food.'>
                                    <label>Food</label><br>
                                    <input class="form-check-input" type="radio" name="ModProduct_Type" value="Accessories" '.$Accessories.'>
                                    <label>Accessories</label><br>
                                    <input class="form-check-input" type="radio" name="ModProduct_Type" value="Toy" '.$Toy.'>
                                    <label>Toy</label><br><br>

                                    <label>Price:</label><br>
                                    <input class="form-control" type="number" name="ModProduct_Price" value='.$row['price'].'><br><br>

                                    <label>Image:</label><br><br>

                                    <div class="ratio ratio-1x1">
                                        <img src="Img/'. $row['image'] .'" class="object-fit-cover" alt="..."><br><br>
                                    </div>

                                    <label>Select new image:</label><br>
                                    <input class="form-control" type="file" name="ModProduct_Image"><br><br>

                                    <input class="btn btn-primary mt-3" type="submit" name="Submit_form_ModProduct" value="Modify" >

                                    </form>

                                    ';
                                }else{
                                    echo "Invalid ID.";
                                }

                            }
                            
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <div class= "col DelProduct">
                <div class="card">

                    <h2 class="card-header">Delete Product</h2>

                    <div class="card-body" style="transform: rotate(0);">

                        <form action="admin_Product.php" method="post" enctype="multipart/form-data">
                            <label>ID:</label><br>
                            <!--To show to product ID to admin-->
                            <input class="form-control" type="text" name="DelProduct_ID">
                            <input class="btn btn-primary mt-3" type="submit" name="Submit_form_DeleteProduct" value="Delete" >
                        </form>

                    </div>
                </div>
            </div>
        
        
        </div>
    </div>
    
    <?php include("footer.php") ?>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

</html>


<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //ADD
    if (isset($_POST['Submit_form_ADDProduct'])) {

        $Add_ID = $_POST['AddProduct_ID'];
        $Add_Name = $_POST['ModProduct_Name'];
        $Add_Desc = $_POST['AddProduct_Description'];
        $Add_Type = $_POST['AddProduct_Type'];
        $Add_Price = $_POST['AddProduct_Price'];

        $ImgName = $_FILES["AddProduct_Image"]['name']; //xxxx.jpg

        if($Add_Name == "" || $Add_Desc == "" || $Add_Type == "" || $Add_Price == ""){
            echo "Please fill all input fields";
        }
        else{
            if(checkUploadedImageFormat($ImgName, array('jpg', 'jpeg', 'png')) == true && checkDuplicatedProductName($Add_Name, $link, "ADD") == false) {

                $addProductQuery = "INSERT INTO products(id, name, description, category, price, image) 
                VALUES ('$Add_ID', '$Add_Name', '$Add_Desc', '$Add_Type', '$Add_Price', '$ImgName')";
                
                if(mysqli_query($link, $addProductQuery)){

                        UploadImage("AddProduct_Image");

                        echo "New product " .$Add_Name. " Added.";
                }
            }
        }
    }
    
    //MODIFY
    else if(isset($_POST['Submit_form_ModProduct'])){

        $Mod_ID = $_POST['ModProduct_ID'];
        $Mod_Name = $_POST['ModProduct_Name'];
        $Mod_Desc = $_POST['ModProduct_Description'];
        $Mod_Type = $_POST['ModProduct_Type'];
        $Mod_Price = $_POST['ModProduct_Price'];

        $ImgName = $_FILES["ModProduct_Image"]['name'];

        //If didn't uploaded new iamge
        if(empty($ImgName)){

            $MODProductQuery1 =  "UPDATE products
                                SET name = '$Mod_Name', description = '$Mod_Desc', category = '$Mod_Type', price = '$Mod_Price'
                                WHERE id = '$Mod_ID'";

            if(mysqli_query($link, $MODProductQuery1)){

                    echo "Product " .$Mod_Name. "'s detail changed.";
            }

        //If uploaded new image
        }else{

            if(checkUploadedImageFormat($ImgName, array('jpg', 'jpeg', 'png')) == true && checkDuplicatedProductName($Mod_Name, $link, "MOD", $Mod_ID) == false) {
                
                $checkProductExistQuery = "SELECT * FROM products WHERE id = '$Mod_ID'";

                if(mysqli_query($link, $checkProductExistQuery)){

                    $getProductImageQuery = "SELECT image FROM products WHERE id='$Mod_ID'";
                    $row = mysqli_fetch_assoc(mysqli_query($link, $getProductImageQuery));
                    UploadImage("ModProduct_Image");
                    DeleteImage($row);

                    $MODProductQuery2 = "UPDATE products
                                        SET name = '$Mod_Name', description = '$Mod_Desc', category = '$Mod_Type', price = '$Mod_Price', image ='$ImgName'
                                        WHERE id = '$Mod_ID'";

                    mysqli_query($link, $MODProductQuery2);
      
                    echo "Product " .$Mod_Name. "'s detail changed.";
                }

            }
        }

    }
    
    else if(isset($_POST['Submit_form_DeleteProduct'])){

        $Del_ID = $_POST['DelProduct_ID'];

        $query = "DELETE FROM products WHERE id = $Del_ID";
        $execute = mysqli_query($link, $query);

        #By using mysqli_affected_rows instead of mysqli_query, because mysqli_query function doesn't return an error when no rows are affected by the delete statement.
        if (mysqli_affected_rows($link) > 0) {
            echo "Product deleted.";
        }else{
            echo "Invalid ID.";
        }

    }

}

?>

<?php
//Functions
function checkUploadedImageFormat($ImgName, $AllowFormat){

    if($ImgName != ""){

        $UploadedFileType = strtolower(pathinfo($ImgName,PATHINFO_EXTENSION));

        if(!in_array($UploadedFileType, $AllowFormat)) {
            echo "Wrong image format.";
            return false;
        }else{
            return true;
        }
    }else{
        echo "Please upload product picture";
    }

}

function UploadImage($POST_NAME){

    $ImgFile = $_FILES[$POST_NAME]["name"];
    $ImgTemp = $_FILES[$POST_NAME]["tmp_name"];

    #Upload that file to Img folder
    move_uploaded_file($ImgTemp, "Img/" . $ImgFile);
}

function DeleteImage($SQLRow){

    echo '<br><br><br>'.$SQLRow['image'];

    $FilePath = 'Img/'.$SQLRow['image'];
    
    if (file_exists($FilePath)) {
        unlink($FilePath);
    }
}

function checkDuplicatedProductName($ProductName, $sqlconnection, $Operation, $productID = 0){

    if($Operation == "ADD"){
        $query = "SELECT * FROM products WHERE name = '$ProductName'";
        $result = mysqli_query($sqlconnection, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "Product name already existed";
            return true;
        } else {
            return false;
        }
    }

    else if($Operation == "MOD"){

        $query = "SELECT * FROM products WHERE name = '$ProductName' and id != '$productID'";
        $result = mysqli_query($sqlconnection, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "Product name already existed";
            return true;
        } else {
            return false;
        }

    }

}

?>
