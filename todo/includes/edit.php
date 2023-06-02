<?php
require_once("database.php");

$task_id = $_GET["id"];

$sql = 'SELECT title FROM tasks WHERE id = ?';
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $task_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    $updated_title = mysqli_real_escape_string($conn, $_POST["title"]);
    
    $sql = "UPDATE tasks SET title = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // Bind the parameters with the user input values
        mysqli_stmt_bind_param($stmt, "si", $updated_title, $task_id);
        // Execute the statement
        mysqli_stmt_execute($stmt);
        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>
                alert('Task updated successfully!');
                window.location.href = '../index.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Error updating task. Please try again.');
                window.location.href = '../index.php';
            </script>";
            exit;
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing statement
        echo 'Query error: ' . mysqli_error($conn);
        exit;
    }
}
if (isset($_POST["cancel"])) {
    header("Location: ../index.php");
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-...">

     <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    
   <section  class="section" >



    
   <h2  class="title">UPDATE NOTES</h2>
   

 
           <form action="edit.php?id=<?php echo $task_id; ?>" class=" mx-auto justify-content-center mt-5 form3" method="post" >
                <input type="text" value="<?php echo $row["title"]; ?>" name="title" placeholder="Title(contain letters and spaces)" required pattern="^[A-Za-z\s]+$">
                <button type="submit" class="btn btn-dark " title="update" name="update">Update</button>
                <button type="submit" class="btn btn-dark "  name="cancel" title="cancel">Cancel</button>
            </form>
  
   </section> 

   

  
    


   
<script src="../script.js"></script>
</body>
</html>