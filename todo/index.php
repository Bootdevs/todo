<?php
 require_once("includes/database.php");
 $sql = 'SELECT id, title, created_at FROM tasks  ORDER BY created_at';
 $stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if(isset($_POST['delete_btn'])){
    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
    $sql = "DELETE FROM tasks WHERE id = $id_to_delete";
    //check if it works 
    if(mysqli_query($conn,$sql)){
        //success
        header('Location: index.php');// header is use to redirect in mysql
    }{
        //failure
        echo 'query error ' . mysql_error($conn);
    }
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="loader-overlay">
        <div class="loader"></div>
    </div>
   <section  class="section" >
   <label class="switch">
        <input type="checkbox" id="mode-toggle" >
      <span class="slider"></span>
      <i class="fas fa-moon"></i>
       <i class="fas fa-sun"></i>
      
     </label>

    
   <h2  class="title">NOTES</h2>
   

 
           <form action="./includes/add-inc.php" class=" mx-auto justify-content-center mt-5 form1" method="post" >
                <input type="text" name="title" placeholder="Title(contain letters and spaces)" required pattern="^[A-Za-z\s]+$">
                <button class="btn btn-dark ml-2" title="add" name="submit"><i class="fas fa-plus"></i></button>
            </form>
  
   </section> 

   
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <?php  $tasks_id = $row['id']; ?>
                <section  class="section">
                     <div class="content mx-auto justify-content-center">
               <div class="tasks">
               <p><?php echo $row["title"]; ?></p>
              
               <div class="left">
               <a href="./includes/edit.php?id=<?php echo $tasks_id; ?>"><button title="edit" class="btn btn-sm btn-dark " name="edit_btn"><i class="fas fa-edit"></i></button></a>

                 <form action="index.php" method = "POST" class="form2 ">
                    <input type="hidden" name="id_to_delete" value="<?php echo $tasks_id ?>">
                    <button title="delete" class="btn btn-sm btn-danger " name="delete_btn"  onclick="return confirmDelete()"><i class="fas fa-trash"></i></button>
                
               </form>
               
            </div>
            </div>
         </div>
         </section>
         <?php endwhile; ?>
         <?php else: ?>
            <div>
                <p style="font-size : 30px; text-align : center" class="mt-5">No tasks found.</p>
            </div>
        <?php endif; ?>
  
    
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this task?");
     }
</script>

   <script src="script.js"></script>
</body>
</html>