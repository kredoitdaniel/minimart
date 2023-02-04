<?php
    session_start();

    require "connection.php";

    
    $prod_id = $_GET['prod_id'];

    // function getProduct()
    function getProduct($prod_id){
        $conn = connection();

        $sql = "SELECT * FROM products WHERE id = $prod_id";

        if($result = $conn->query($sql)){
            return $result->fetch_assoc();
        }
    }
    $prod_row = getProduct($prod_id);
    // end function getProduct()



    // function removeProduct()
    function removeProduct($prod_id){
        $conn = connection();

        $sql = "DELETE FROM products WHERE id = $prod_id";

        if($conn->query($sql)){
            header("location: products.php");
            exit;
        }
        else {
            die("Error deleting product: " . $conn->error);
        }
    }
    // end function removeProduct()



    if(isset($_POST['btn_delete'])){
        removeProduct($prod_id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <?php
        include "mainNav.php";
    ?>

    <main class="card w-25 mx-auto border-0 my-5">
        <div class="card-header bg-white border-0">
            <h2 class="card-title text-center text-danger h4 mb-0">Delete Product</h2>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                <i class="fas fa-exclamation-triangle text-warning display-4 d-block mb-2"></i>
                <p class="fw-bold mb-0">Are you sure you want to delete <span class="fst-italic text-danger"><?= $prod_row['title'] ?></span>? </p>
            </div>
            <div class="row">
                <div class="col">
                    <a href="products.php" class="btn btn-secondary w-100">Cancel</a>
                </div>
                <div class="col">
                    <form method="post">
                        <button type="submit" class="btn btn-outline-danger w-100" name="btn_delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </main>







    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>