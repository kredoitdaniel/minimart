<?php
    session_start();

    require "connection.php";

    // function getProducts()
    function getProducts(){
        $conn = connection();

        $sql = "SELECT products.id AS id, products.title AS title, products.description AS description, products.price AS price, sections.title AS section
        FROM products
        INNER JOIN sections
        ON products.section_id = sections.id";

        if($result = $conn->query($sql)){
            return $result;
        }
        else {
            die("Error reading all products: " . $conn->error);
        }
    }
    // end function getProducts()
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <?php
        include "mainNav.php";
    ?>

    <main class="container py-5">
        <a href="sections.php" class="btn btn-outline-info float-end ms-2"><i class="fas fa-plus-circle"></i> Add New Section</a>
        <a href="addProduct.php" class="btn btn-success float-end"><i class="fas fa-plus-circle"></i> Add New Product</a>

        <h2 class="h3 text-muted">Product List</h2>

        <table class="table table-hover mt-4">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>TITLE</th>  
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>SECTION</th>
                    <th style="width: 95px"></th>   <!-- for the action buttons -->
                </tr>
            </thead>
            <tbody>
                <?php
                    $prod_result = getProducts();
                    while($prod_row = $prod_result->fetch_assoc()){
                        // print_r($prod_row);
                ?>
                        <tr>
                            <td><?= $prod_row['id'] ?></td>
                            <td><?= $prod_row['title'] ?></td>
                            <td><?= $prod_row['description'] ?></td>
                            <td><?= $prod_row['price'] ?></td>
                            <td><?= $prod_row['section'] ?></td>
                            <td>
                                <a href="editProduct.php?prod_id=<?= $prod_row['id'] ?>" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <a href="removeProduct.php?prod_id=<?= $prod_row['id'] ?>" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>


                <?php
                    }
                ?>
            </tbody>
        </table>
    </main>    








    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>