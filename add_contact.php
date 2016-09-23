
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include('templates/header.php') ; ?>
  </head>
  <body>
   <div class="container">
   <?php include('templates/navbar.php') ; ?>
   <?php 

    // define variables and set to empty values
        $message=$id=$name = $first_name = $street = $zip_code = $city = "";
        $is_edit=false;
        include('connection.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $name = test_input($_POST["name"]);
          $first_name = test_input($_POST["first_name"]);
          $street = test_input($_POST["street"]);
          $zip_code = test_input($_POST["zip_code"]);
          $city = test_input($_POST["city"]);
          $edit = test_input($_POST["is_edit"]);
          if (empty($name) || empty($first_name) || empty($street) || empty($zip_code) || empty($city)){
            $message="please provide all fields";
          }
          else{
                        try {
              $stmt = $db->prepare("INSERT INTO contacts(name, first_name, street, zip_code, city ) VALUES (:name, :first_name, :street, :zip_code, :city)");
              if($edit==1){
                //echo "string";
                //exit();
                $contact_id= test_input($_POST["id"]);
                $stmt=$db->prepare("
                  UPDATE `contacts`   
                     SET `first_name` = :first_name,
                         `name` = :name,
                         `street` = :street,
                         `zip_code` = :zip_code,
                         `city` = :city 
                   WHERE `id` = :contact_id 

                  ");
                $stmt->bindParam(':contact_id', $contact_id, PDO::PARAM_INT);
              }
              $stmt->bindParam(':name', $name, PDO::PARAM_STR, 100);
              $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR, 100);
              $stmt->bindParam(':street', $street, PDO::PARAM_STR, 100);
              $stmt->bindParam(':zip_code', $zip_code, PDO::PARAM_STR, 100);
              $stmt->bindParam(':city', $city, PDO::PARAM_INT);
              if ($stmt->execute()) {
                echo $first_name.' has been added to contacts';
              }
          } catch(PDOException $e) {
              trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
              exit();
          }
          header('Location: '."index.php");
          }
        


        }
        if (isset($_GET["id"])) {
          $is_edit=true;
          $id=$_GET['id'];
          $contact_sql= "SELECT * FROM contacts WHERE id = ".$id; 
          $stmt1 = $db->query($contact_sql); 
          $contact_row = $stmt1->fetch(PDO::FETCH_ASSOC);
          $name = $contact_row['name'];
          $first_name = $contact_row['first_name'];
          $street = $contact_row['street'];
          $zip_code = $contact_row['zip_code'];
          $city = $contact_row['city'];          
        }
        


        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
   ?>
  <div class="row">
      <div class="col-md-6 col-md-offset-3">
      <?php
        if(!empty($message))
        echo "<div class='alert alert-danger'>".$message."</div>";
        ?>
        <div class="well well-sm">
          <form class="form-horizontal" action="add_contact.php" method="post">
          <fieldset>
            <legend class="text-center">Add/New Contact</legend>
    
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Full Name</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" value='<?=$name?>'placeholder="Your name" class="form-control">
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="first_name">First Name</label>
              <div class="col-md-9">
                <input id="first_name" name="first_name" value='<?=$first_name?>'type="text" placeholder="Your first name" class="form-control">
              </div>
            </div>

             <div class="form-group">
              <label class="col-md-3 control-label" for="street">Street</label>
              <div class="col-md-9">
                <input id="street" name="street" type="text" value='<?=$street ?>' placeholder="Your street" class="form-control">
              </div>
            </div>

             <div class="form-group">
              <label class="col-md-3 control-label" for="zip_code">Zip Code</label>
              <div class="col-md-9">
                <input id="zip_code" name="zip_code" type="text" value='<?=$zip_code?>' placeholder="Your zip code" class="form-control">
              </div>
            </div>
            <input type="hidden" name="is_edit" value='<?=$is_edit?>'>
            <input type="hidden" name="id" value='<?=$id?>'>
            <div class="form-group">
                <label  class="col-md-3 control-label" for="city">Select City</label>
              <div class="col-md-9">
                   <select class="form-control" id="city" name="city" >
                        <?php
                        $result = $db->query("SELECT * FROM cities");
                        foreach($result as $row1)
                        {    
                            if($row1['id']==$city){

                             echo "<option selected='selected' value='".$row1['id']."'>".$row1['name']."</option>";
                            }
                            else{
                              echo "<option value='".$row1['id']."'>".$row1['name']."</option>";
                            }
                        }
                        ?>
                  </select>
              </div>
              
           
            </div>
                  
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-success btn-block">Submit</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
  </div>
</div>
    <script src="static/js/jquery.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
