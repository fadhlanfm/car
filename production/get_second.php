<!DOCTYPE html>

<html>
<?php
include "connect_db.php";
$query="SELECT * FROM unit WHERE kode_dir='".$_POST["kode"]."'";

$result=$db->query($query);
?>

<option disabled>Pilih Unit</option>
<?php

    while($rs=$result->fetch_object())
    {
        echo '<option value="'.$rs->kode.'">'.$rs->kode.' - '.$rs->nama.'</option>';
    
    }

?>

</html>
