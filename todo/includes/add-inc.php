<?php
if(isset($_POST["submit"])){
    require("database.php");
   
    // Define an array to hold validation errors
    $errors = array();

    // Validate title
    if(!preg_match("/^[A-Za-z ]+$/", $_POST["title"])) {
        $errors['title'] = "Title must contain only letters and spaces.";
    }

    // If there are no validation errors, insert the form data into the database
    if(empty($errors)) {
        // Prepare the SQL statement
        $sql = "INSERT INTO tasks (title) VALUES (?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt){
            // Bind the parameters with the user input values
            
            mysqli_stmt_bind_param($stmt, "s", $_POST["title"]);
            // Execute the statement
            mysqli_stmt_execute($stmt);
            // Save the image to file system if insert is successful
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo
                "<script>
                    alert('new task created!');
                    document.location.href = '../index.php';
                </script>";
            } else {
                echo
                "<script>
                    alert('Error adding task. Pls try again.');
                    document.location.href = '../index.php';
                </script>";
            }
            
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Error preparing statement
        }
    }

    mysqli_close($conn);
}
?>