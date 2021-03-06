
<?php $page_title = 'Modify Puzzle'; ?>
<?php $page_title = 'GPuzzles > Modify Puzzles'; ?>
<?php 
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page="puzzles_list.php";
    verifyLogin($page);

?>
<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}</style>

<?php
include_once 'db_configuration.php';

if (isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM gpuzzles
            WHERE id = '$id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}//end if

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      if(isset($_GET['modifyPuzzle'])){
        if($_GET["modifyPuzzle"] == "fileRealFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not real, Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyPuzzle'])){
        if($_GET["modifyPuzzle"] == "answerFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your answer was not one of the choices, Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyPuzzle'])){
        if($_GET["modifyPuzzle"] == "fileTypeFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not a valid image type (jpg,jpeg,png,gif), Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyPuzzle'])){
        if($_GET["modifyPuzzle"] == "fileExistFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image does not exist, Please Try Again!</h3>';
        }
      }

      echo '<h2 id="title">Modify Puzzle</h2><br>';
      echo '<form action="modifyThePuzzle.php" method="POST" enctype="multipart/form-data">
      <br>
      
      <h3>'.$row["puzzle_name"].' by '.$row["creator_name"].' </h3> <br>
      
      <div>
        <label for="id">Id</label>
        <input type="text" class="form-control" name="id" value="'.$row["id"].'"  maxlength="5" style=width:400px readonly><br>
      </div>
      
      <div>
        <label for="name">Puzzle Name</label>
        <input type="text" class="form-control" name="puzzleName" value="'.$row["puzzle_name"].'"  maxlength="100" style=width:400px required><br>
      </div>
      
      <div>
        <label for="category">Creator Name</label>
        <input type="text" class="form-control" name="creatorName" value="'.$row["creator_name"].'"  maxlength="100" style=width:400px required><br>
      </div>
          
      <div>
        <label for="level">Author Name</label>
        <input type="text" class="form-control" name="authorName" value="'.$row["author_name"].'"  maxlength="100" style=width:400px required><br>
      </div>
          
      <div>
        <label for="facilitator">Book Name</label>
        <input type="text" class="form-control" name="bookName" value="'.$row["book_name"].'"  maxlength="100" style=width:400px required><br>
      </div>

      <div class="form-group col-md-4">
      <label for="cadence">New Puzzle Image (Not Required)</label>
      <input type="file" name="puzzleFileToUpload" id="puzzleFileToUpload" maxlength="255">
      </div>
      <input type="hidden" class="form-control" name="oldPuzzleimage" value="'.$row["puzzle_image"].'" maxlength="255" required>

      <div class="form-group col-md-4">
      <label for="cadence">New Solution Image (Not Required)</label>
      <input type="file" name="solutionFileToUpload" id="solutionFileToUpload" maxlength="255">
      </div>
      <input type="hidden" class="form-control" name="oldSolutionimage" value="'.$row["solution_image"].'" maxlength="255" required>

      <div>
        <label for="optional">Notes</label>
        <input type="text" class="form-control" name="notes" value="'.$row["notes"].'"  maxlength="100" style=width:400px required><br>
      </div>

      <br>
      <div class="text-left">
      <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Puzzle</button>
      </div>
      <br> 
      <br>
      
      </form>';
    
    }//end while
}//end if
else {
    echo "0 results";
}//end else

?>

</div>


