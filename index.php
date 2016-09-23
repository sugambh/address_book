
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include('templates/header.php') ; ?>
  </head>
  <body>
    <div class="container">
    <?php include('templates/navbar.php') ; ?>
    <div id="lists">
      <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>First Name</th>
                <th>Street</th>
                <th>Zip Code</th>
                <th>City</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                  <?php
                    include('connection.php');
                    $result = $db->query("SELECT * FROM contacts");
                    foreach($result as $row)
                    {
                         echo "<tr>";
                         echo "<td>".$row['name']."</td>";
                         echo "<td>".$row['first_name']."</td>";
                         echo "<td>".$row['street']."</td>";
                         echo "<td>".$row['zip_code']."</td>";
                         $city_sql= "SELECT * FROM cities WHERE id = ".$row['city']; 
                         $stmt = $db->query($city_sql); 
                         $city_row = $stmt->fetch(PDO::FETCH_ASSOC);
                         echo "<td>".$city_row['name']."</td>";
                         echo "<td>"."<a href='add_contact.php?id=".$row['id']."'><button class='  btn btn-primary'><i class='fa fa-pencil-square-o pull-right' aria-hidden='true'></i></button></a>"."</td>";
                         echo "<td>"."<a href='delete.php?id=".$row['id']."'><button class='  btn btn-danger'><i class='fa fa-trash-o pull-right' aria-hidden='true'></i></button></a>"."</td>";
                         echo "</tr>";
                    }
                  ?>
        </tbody>
    </table>

    </div>
    </div> 
    <script src="static/js/jquery.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>
    <script src="static/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('#example').DataTable();
      } );
    </script>
  </body>
</html>
