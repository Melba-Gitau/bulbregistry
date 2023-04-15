<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>bulb_registry</title>
</head>
<style>
    *{
        margin:0;
        padding:0;
        font-family:sans-serif;
    }
  
    form{
        margin-left:20%;
        margin-top:5%;
        background-color:grey;
        box-shadow:2px 2px 2px #000;
        height:200px;
        width:250px;
        padding:10px;
        border-radius:5px;
    }
    button{
        padding:5px;
        background-color:black;
        color:white;
        margin-top:10px;
        border-radius:5px;
    }
    table{
        margin-top:5%;
        margin-left:20%;
        border:5px;
        width:20%;
        border:2px black;
        box-shadow:2px 2px 2px black;
    }
   th, td{
    padding:8px;
    border-bottom: 2px solid black;
   }
</style>
<body>
    <div class = "result">
    <form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
        <div>
        <label for = "name">Name:</label>
        <input type = "text" name = "Name" required>
        </div>
        <div>
        <label for = "name">Probability:</label>
        <input type = "text" name = "Probability" required>
        </div>
        <div>
        <button type="submit" name="submit">Register</button>
        </div>
    </form>   
    <table>
       <thead>
       </tr>
        <td>Id</td>
        <td>Name</td>
        <td>Probability</td>
        <td>Test</td>
        </tr>
       </thead>
      
    </table>
    <div>
</body>
</html>

<?php

require_once "conn.php";


if($_SERVER['REQUEST_METHOD'] == "POST" && "POST" != ""){
    $name = $_POST["Name"];
    $prob = $_POST["Probability"];
   

    if($prob == "20%"){
         $testtype = "Functionality test";
    }else if ($prob == "7%"){
         $testtype ="structural test";
    }else{
        $testtype = "-";
    }
  

$var = mysqli_query($conn, "INSERT INTO bulbs (Name,Probability,Test) VALUES ('$name','$prob','$testtype')") or die(mysqli_error($conn));

}

$result = mysqli_query($conn, "SELECT * From bulbs");

echo "<table>";
while($bulb = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$bulb['Id']."</td>";
    echo "<td>".$bulb['Name']."</td>";
    echo "<td>".$bulb['Probability']."</td>";
    echo "<td>".$bulb['Test']."</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
?>