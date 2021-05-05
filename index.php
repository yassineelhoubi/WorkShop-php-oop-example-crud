<?php
//Include model.php
    include 'model.php';

    $obj    =   new model();

    /* echo '<pre>';
    print_r($obj);
    echo '</pre>'; */

//Insert Record
    if(isset($_POST['submit'])){
        $obj->insertRecord($_POST);
    }//if isset close
//Update Record
    if(isset($_POST['update'])){
        $obj->updateRecord($_POST);
    }//if isset close
//Delete record
    if(isset($_GET['deleteid'])){
        $delid  =   $_GET['deleteid'];
        $obj->deleteRecord($delid);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP OOP</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <br><h2 class="text-center text-info">CRUD Oprration in PHP Using OOPS</h2><br>
    <div class="container">

        <!-- success message -->
        <?php
        if(isset($_GET['msg']) && $_GET['msg']=='ins'){
            echo '<div class="alert alert-primary" role="alert">
            Record Inserted Successfully..!!
          </div>';
        }
        if(isset($_GET['msg'])&& $_GET['msg']=='ups'){
            echo '<div class="alert alert-primary" role="alert">
            Record Updated Successfully..!!
          </div>';
        }
        if(isset($_GET['msg'])&& $_GET['msg']=='del'){
            echo '<div class="alert alert-primary" role="alert">
            Record Delete Successfully..!!
          </div>';
        }
        ?>
        <?php
        //fetch record for updation
            if(isset($_GET['editid'])){
                $editid    =    $_GET['editid'];
                $myRecord  =    $obj->displayRecordById($editid);

        ?>  
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $myRecord['name'];?>" placeholder="Enter Your Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo $myRecord['email'];?>" placeholder="Enter Your Email" class="form-control">
            </div>
            <div class="form-group">
                <input type="hidden" name="hid" value="<?php echo $myRecord['id']; ?>">
                <input type="submit" name="update" value="Update"  class="btn btn-info">
            </div>
        </form>
        
        <?php
        }else{
        ?>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Enter Your Email" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit"  class="btn btn-info">
            </div>
        </form>
        <?php
        }//else Close
        ?>
        <br>
        <h4 class="text-center text-danger">Display Records</h4>
        <table class="table table-borderred">
            <tr class="bg-primary text-center">
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
                //Display Records
                $data   =   $obj->displayRecord();
                $sno    =   1;
                foreach($data as $value){
            ?>
            <tr class="text-center">
                <td><?php echo $sno++; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td>
                    <a href="index.php?editid=<?php echo $value['id'];?>" class="btn btn-info">Edit</a>
                    <a href="index.php?deleteid=<?php echo $value['id'];?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
                }//foreach Close
            ?>
        </table>
    </div>
</body>
</html>