<?php
    session_start();

    require "connection.php";

    // function createSection()
    function createSection($title){
        // connection
        $conn = connection();

        // sql
        $sql = "INSERT INTO sections (title) VALUES ('$title')";

        // execution
        if($conn->query($sql)){ #query = asking | conn will deliver the $sql to the database
            // successful
            header("refresh: 0"); // will refresh the page immediately
        }
        else {
            // failed
            die("Error adding new section: " . $conn->error);
        }
    }
    // end function createSection()



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



    if(isset($_POST['btn_add'])){
        $title = $_POST['title'];

        createSection($title);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Section</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <?php
        include "mainNav.php";
    ?>
    
    <main class="py-5">
        <!-- Add New Section -->
        <form action="" method="post">
            <div class="card w-50 mx-auto">
            <div class="card-header">
                <h2>ADD New Section</h2>
            </div>
                
                <div class="card-body">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control mb-2">

                    <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" name="btn_add" class="btn btn-info">Add</button>
                </div>
            </div>

        </form>

        <!-- Display Section or Retrieve Data -->
        <div class="container w-25 mx-auto mt-2">
                <h2 class="h3 text-muted">Section List</h2>

                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sections_result = getAllSections();
                            // print_r($sections_result);
                            while($sections_row = $sections_result->fetch_assoc()){
                                // fetch_assoc() ---> transform the result into associative array
                                // print_r($sections_row);   
                        ?>
                                <tr>
                                    <td><?= $sections_row['id'] ?></td>
                                    <td><?= $sections_row['title'] ?></td>
                                </tr>

                        <?php
                            }
                        ?>
                    </tbody>
                </table>
        </div>
    </main> 








    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>