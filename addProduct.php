<?php
    session_start();

    require "connection.php";

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


    // function createProduct()
    function createProduct($title, $description, $price, $section_id){
        $conn = connection();

        $sql = "INSERT INTO products (title, description, price, section_id) VALUES ('$title', '$description', $price, $section_id)";

        if($conn->query($sql)){
            // successfully adding new product
            header("location: products.php"); 
            exit;
        }
        else {
            die("Error adding new product: " . $conn->error);
        }
    }
    // end function createProduct()



    if(isset($_POST['btn_add'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];

        createProduct($title, $description, $price, $section_id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <?php
        include "mainNav.php";
    ?>

    <main class="card w-25 mx-auto my-5">
            <div class="card-header bg-success text-white">
                <h2 class="card-title h4 mb-0">Add New Product</h2>
            </div>
            <div class="card-body">
                <form  method="POST">
                    <label for="title" class="form-label small">Title</label>
                    <input type="text" name="title" id="title" class="form-control mb-2" required autofocus>

                    <label for="description" class="form-label small">Description</label>
                    <textarea name="description" id="description" class="form-control mb-2" cols="30" rows="10" required></textarea>

                    <label for="price" class="form-label">Price</label>
                    <div class="input-group mb-2">
                        <div class="input-group-text">$</div>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>

                    <label for="section-id" class="form-label small">Section</label>
                    <select name="section_id" id="section-id" class="form-select mb-5">
                        <option value="" hidden>Select Section</option>
                        
                        <?php
                            $sections_result = getAllSections();
                            while($sections_row = $sections_result->fetch_assoc()){
                        ?>
                                <option value="<?= $sections_row['id'] ?>">
                                    <?= $sections_row['title'] ?>
                                </option>

                        <?php
                            }
                        ?>

                    </select>
                    <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" name="btn_add" class="btn btn-success px-5">Add</button>
                </form>
            </div>
    </main>
    








    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>