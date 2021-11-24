<?php
// connect to the database
$servername="localhost";
$username="root";
$password="";
$dbname="crudphp";

$insert=FALSE;
$update=FALSE;
$delete=FALSE;
$conn= mysqli_connect($servername,$username,$password,$dbname);

if(!$conn)
{
 die("Sorry db not able to connect");
}

if(isset($_GET['delete']))
{
  $sno=$_GET['delete'];
  $delete=TRUE;
  $sql_insert="DELETE FROM `notes` WHERE `sno` = $sno";
  $result= mysqli_query($conn,$sql_insert);
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  if(isset($_POST['snoedit']))
  {
    $sno=$_POST['snoedit'];

    $title=$_POST['titleedit'];
  $description=$_POST['descriptionedit'];
$sql_insert="UPDATE `notes` SET `title`='$title', `description`='$description'   WHERE `notes`.`sno` =$sno";
$result= mysqli_query($conn,$sql_insert);


if($result)
{
  $update=TRUE;
}
else
{
  echo "record updattion failed";
}

  }


else
{
  $title=$_POST['title'];
  $description=$_POST['description'];

$sql_insert="INSERT INTO `notes` (`title`, `description`) VALUES ('$title','$description')";
// print_r($sql_insert);die;
// print_r(mysqli_query($conn,$sql_insert));
$result= mysqli_query($conn,$sql_insert);



if($result)
{
 $insert=TRUE;
}
else
{
  echo "record insertinnon failed";
}
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
      <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
      <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
     
      <script>
        $(document).ready( function () {
    $('#mytable').DataTable();
} );
      </script>
      <style>
        .heading
        {
          color : while;
          margin-left: 430px;
    margin-top: -28px;
    font-family: cursive;
        }
      </style>
    <title>R- Notes for Easy and Fast</title>
    
  </head>
  <body>

  <!-- Edit  modal -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit  modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit  ModalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/Crudphpapp/index.php"  method="post">
      <div class="modal-body">
        <input type="hidden" name="snoedit" id="snoedit">
          <div class="mb-3">
              <label for="title" class="form-label">Notes Title</label>
              <input type="text" name="titleedit" class="form-control" id="titleedit" placeholder="enter title">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Notes Description</label>
              <textarea class="form-control" name="descriptionedit" id="descriptionedit" rows="3"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>

    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">R -Notes <div class="heading"> When your heart speaks take good notes </div> </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div> -->
        </div>
      </nav>
    
      <?php
      if($insert)
      {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Cheers your note has been saved!</strong>.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }

      if($delete)
      {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Yup your note has been delete!</strong>.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      if($update)
      {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Cheers your note has been update!</strong>.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }

      ?>
      <div class="div container my-5">
          <h2>ADD a Note</h2>
          <form action="/Crudphpapp/index.php"  method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Notes Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Notes Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description" required></textarea>
          </div>
          <button type="submit" class="btn btn-danger">Submit</button>
          </form>
      </div>

      <div class="div container my-4">
      <br>
        <table class="table" id="mytable">
  <thead>
    <tr>
      <th scope="col">S no.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php      
        $sql= "SELECT * FROM `notes`";
        $result= mysqli_query($conn,$sql);
        $s_no=0; 
        while($row = mysqli_fetch_assoc($result))
        {
          $s_no=$s_no +1;
          echo "<tr>
<th scope='row'> $s_no </th>
<td>" .$row['title'] . "</td>
<td>" .$row['description'] . "</td>
<td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> 
<button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>
</td>
</tr>"; 
          // echo  . " "  .$row['title'] . $row['description'] .$row['timestamp'] ;
          // echo "<br>";
        }
        

        ?>
    
  </tbody> 
</table>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>
      {
        element .addEventListener("click", (e)=>
        {
          console.log("edit",e.target); 
          tr=e.target.parentNode.parentNode; 
          title=tr.getElementsByTagName("td")[0].innerText;
          description=tr.getElementsByTagName("td")[1].innerText;
          console.log(title,description);
          descriptionedit.value=description;
          titleedit.value=title; 
          snoedit.value=e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');

        })
      })
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>
      {
        element .addEventListener("click", (e)=>
        {
          console.log("edit",e.target); 
         sno=e.target.id.substr(1,);
        if(confirm("Are you sure to delete!"))
        {
          console.log("yes");
          window.location=`/Crudphpapp/index.php?delete=${sno}`;
        }
        else
        {
          console.log("no");
        }

        })
      })
    </script>
  </body>
</html>