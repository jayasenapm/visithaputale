<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
 $query = "
  SELECT * FROM destination WHERE Distination = 'Haputale'
 ";
 if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
 {
  $query .= "
   AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
  ";
 }
 if(isset($_POST["brand"]))
 {
  $brand_filter = implode("','", $_POST["brand"]);
  $query .= "
   AND product_brand IN('".$brand_filter."')
  ";
 }
  if(isset($_POST["brand1"]))
 {
  $brand_filter = implode("','", $_POST["brand1"]);
  $query .= "
   AND Distination IN('".$brand_filter."')
  ";
 }
 if(isset($_POST["ram"]))
 {
  $ram_filter = implode("','", $_POST["ram"]);
  $query .= "
   AND Type IN('".$ram_filter."')
  ";
 }
 if(isset($_POST["storage"]))
 {
  $storage_filter = implode("','", $_POST["storage"]);
  $query .= "
   AND Type IN('".$storage_filter."')
  ";
 }

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="col-sm-4 col-lg-4 col-md-4">
  
    <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:300px;">
     <a href="Detail.php?dname='.$row['DName'].'"><img src="uploads/'. $row['Thumb'] .'" alt="" class="img-responsive" width="100%"   ></a>
     <p align="center"><strong><a href="Destination.php">'. $row['DName'] .'</a></strong></p>
     <h4 style="text-align:center;" class="text-danger" ></h4>
     
     Type : '. $row['Type'] .' <br />
    
    </div>

   </div>
   ';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
 echo $output;
}

?>