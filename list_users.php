<?php
require_once 'db_connect.php';

$sql = "SELECT * FROM `users`;";

$result = $mysqli->query($sql);

if($result->num_rows >0){
    echo "<h2>Lista uzytkownikow:</h2>";

    echo " <table border = '1'>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Birth_date</th>
      <th>Gender</th>
      <th>Description</th>
      <th>Created_at</th>
    </tr>";
    while($row = $result->fetch_object()){
    
        echo "<tr>";
        echo "<td>"."<br>" . $row->id ."</td>";
        echo "<td>"."<br>" . $row->name ."</td>";
        echo "<td>"."<br>" . $row->email ."</td>";
        echo "<td>"."<br>" . $row->birth_date . "Do poprawy" ."</td>";
        echo "<td>"."<br>" . $row->gender ."</td>";
        echo "<td>"."<br>" . $row->description ."</td>";
        echo "<td>"."<br>" . $row->created_at ."</td>";
        echo "</tr>";

    }
}
else{
    echo "brak danych w tabeli uzytkownikow";
}

$mysqli->close();