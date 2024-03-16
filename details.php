<?php 

    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if (mysqli_query($conn,$sql)) {
            header("Location: index.php");
        } else {
            echo "".mysqli_error($conn);
        }
    }

    if(isset($_GET['id'])) {

        // Securing Data
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // Make SQL Querie
        $sql = "SELECT * FROM pizzas WHERE id = $id";

        // Get Querie Result
        $result = mysqli_query($conn, $sql);

        // Fetch The Querie Result
        $pizzas = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <div class="center">
        <?php if ($pizzas): ?>
            <h1><?php echo htmlspecialchars($pizzas["title"])?></h1>
            <h5><?php echo "Created By: " , htmlspecialchars($pizzas["email"])?></h5>
            <h6><?php echo htmlspecialchars($pizzas["Created_at"])?></h6>
            <h4>Ingredients:</h4>
            <?php foreach(explode(',', $pizzas["Ingredients"]) as $ing):?>
                <h5><?php echo htmlspecialchars($ing)?></h5>
            <?php endforeach ?>
            <form method="POST" action="details.php">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizzas['id']?>">
                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>
        <?php else: ?>
            <h1>No Such Pizza!</h1>
        <?php endif ?>
    </div>


    <?php include('templates/footer.php'); ?>

</html>