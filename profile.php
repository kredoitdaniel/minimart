<?php
    session_start();

    require "connection.php";
    
    // function updatePhoto()
    function updatePhoto($user_id, $photo_name, $photo_tmp){
        $conn = connection();

        $sql = "UPDATE users SET photo = '$photo_name' WHERE id = $user_id";

        if($conn->query($sql)){
            $destination = "img/$photo_name";
            move_uploaded_file($photo_tmp, $destination);
            header("refresh: 0");
        }
        else {
            die("Error uploading photo: " . $conn->error);
        }
    }
    // end function updatePhoto()


    // function getUser()
    
    $user_id = $_SESSION['user_id'];
    
    function getUser($user_id){
        $conn = connection();

        $sql = "SELECT * FROM users WHERE id = $user_id";

        if($result = $conn->query($sql)){
            return $result->fetch_assoc();
        }
        else {
            die("Error reading user: " . $conn->error);
        }
    }
    $row = getUser($user_id);
    // end function getUser()


    if(isset($_POST['btn_upload_photo'])){
        $user_id = $_SESSION['user_id'];
        $photo_name = $_FILES['photo']['name']; // $_FILES 2D Associative array
        $photo_tmp = $_FILES['photo']['tmp_name'];
            
            // 'photo' -> name of the input
            // 'name' -> name of the actual image
            // 'tmp_name' -> temporary storage of the image

        updatePhoto($user_id, $photo_name, $photo_tmp);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <?php
        include "mainNav.php";
    ?>

    <main class="container py-5">
        <div class="card w-25 mx-auto">
             
            <img src="img/<?= $row['photo'] ?>" alt="<?= $row['photo'] ?>">

            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="input-group mb-2">
                        <input type="file" name="photo" class="form-control" aria-label="Choose Photo">
                        <input type="submit" class="btn btn-outline-secondary" name="btn_upload_photo" value="Update"></input>
                    </div>                
                </form>

                <div class="mt-5">
                    <p class="lead fw-bold mb-0">
                        <?= $_SESSION['username'] ?>
                    </p>
                    <p class="lead">
                        <?= $_SESSION['full_name'] ?>
                    </p>
                </div>
            </div>
        </div>
    </main>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>