<?php
  /***** EDIT BELOW LINES *****/
  $DB_TBLName = "tabla_sensor"; // MySQL Table Name
  $xls_filename = 'export_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
   // Create connection
  $conn = new mysqli("localhost", "root", "", "ardbd");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  /***** DO NOT EDIT BELOW LINES *****/
  // Create MySQL connection
  $sql = "Select * from $DB_TBLName";
  $conn->query("SET NAMES 'utf8'");
  $data = array();
  $result = $conn->query($sql);
  $fields_Name = [];
  if ($result) {
    $finfo = $result->fetch_fields();
    foreach ($finfo as $val) {
        //printf("Name:      %s\n",   $val->name);
        array_push($fields_Name,$val->name);
    }
    //$result->free();
  }
   
  // Header info settings
  header("Content-Type: application/xls");
  header("Content-Disposition: attachment; filename=$xls_filename");
  header("Pragma: no-cache");
  header("Expires: 0");
 //for Hebrew letters
  echo chr(0xEF).chr(0xBB).chr(0xBF);
  /***** Start of Formatting for Excel *****/
  // Define separator (defines columns in excel &amp; tabs in word)
  $sep = ","; // tabbed character
   
  // Start of printing column names as names of MySQL fields
  foreach ($fields_Name as $value) {
    echo $value .  $sep;
  }
  print("\n");

  // End of printing column names
  
  // Start while loop to get data
  while($row = $result->fetch_assoc())
  {
    $schema_insert = "";
    foreach ($fields_Name as $value) 
    {
      if(!isset($row[$value])) {
        $schema_insert .= "NULL".$sep;
      }
      elseif ($row[$value] != "") {
        $field_value = $row[$value];
        $field_value = str_replace($sep , "",$field_value );
        $schema_insert .= $field_value.$sep;
      }
      else {
        $schema_insert .= "".$sep;
      }
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= $sep;
    print(trim($schema_insert));
    print "\n";
  }
  $conn->close();
?>