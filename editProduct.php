<?php
    session_start();

    require "connection.php";

    // function getProduct()
    $prod_id = $_GET['prod_id'];

    function getProduct($prod_id){
        $conn = connection();

        $sql = "SELECT * FROM products WHERE id = $prod_id";

        if($result = $conn->query($sql)){
            return $result->fetch_assoc();
        }
    }
    $prod_row = getProduct($prod_id);
    // end function getProduct()


    // function getAllSections()
    function getAllSections(){
        $conn = connection();

        $sql = "SELECT * FROM sections";

        if($result = $conn->query($sql)){
            return $result;
        }
        else {
            die("Error reading all sections: " . $conn->error);
        }
    }
    // end function getAllSections()


    // function updateProduct()
    function updateProduct($prod_id, $title, $description, $price, $section_id){
        $conn = connection();

        $sql = "UPDATE products SET title = '$title', description = '$description', price = $price, section_id = $section_id WHERE id = $prod_id";

        if($conn->query($sql)){
            header("location: products.php");
            exit;
        }
        else {
            die("Error updating product: " . $conn->error);
        }
    }
    // end function updateProduct()



    if(isset($_POST['btn_update'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];

        updateProduct($prod_id, $title, $description, $price, $section_id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <?php
        include "mainNav.php";
    ?>

    <main class="card w-25 mx-auto my-5">
            <div class="card-header bg-success text-white">
                <h2 class="card-title h4 mb-0">Edit Product Details</h2>
            </div>
            <div class="card-body">
                <form  method="POST">
                    <label for="title" class="form-label small">Title</label>
                    <input type="text" name="title" value="<?= $prod_row['title'] ?>" id="title" class="form-control mb-2" required autofocus>

                    <label for="description" class="form-label small">Description</label>
                    <textarea name="description" id="description" class="form-control mb-2" cols="30" rows="10" required><?= $prod_row['description'] ?></textarea>

                    <label for="price" class="form-label">Price</label>
                    <div class="input-group mb-2">
                        <div class="input-group-text">$</div>
                        <input type="number" name="price" value="<?= $prod_row['price'] ?>" id="price" class="form-control" required>
                    </div>

                    <label for="section_id" class="form-label small">Section</label>
                    <select name="section_id" id="section_id" class="form-select mb-5">
                        <option value="" hidden>Select Section</option>

                        <?php
                            $sections_result = getAllSections();
                            while($sections_row = $sections_result->fetch_assoc()){
                                if ($prod_row['section_id'] == $sections_row['id']){    
                        ?>
                                    <option value="<?= $sections_row['id'] ?>" selected>
                                        <?= $sections_row['title'] ?>
                                    </option>

                        <?php
                                }else{
                        ?>
                                    <option value="<?= $sections_row['id'] ?>">
                                        <?= $sections_row['title'] ?>
                                    </option>

                        <?php
                                }
                            }
                        ?>

                    </select>

                    <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" name="btn_update" class="btn btn-success px-5">Update</button>
                </form>
            </div>
    </main>
    








    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>