<?php
require_once 'db_connect.php';

$selectedUser = null;


$sql = "SELECT * FROM `users`;";

$result = $mysqli->query($sql);


function calculateAge($dateBirth) {
$urodzenie = new DateTime($dateBirth); 
$dzisiaj = new DateTime();
$roznica = $dzisiaj->diff($urodzenie)->y;
return $roznica;
}


if(isset($_GET["user_id"])){
    $id = (int) $_GET["user_id"];
    $stmt = $mysqli->prepare("SELECT * FROM users where id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $selectedUser = $stmt->get_result()->fetch_object();
    $stmt->close();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista uzytkownikow</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Lista uzytkownikow</h2>
<table>
    <tr>
        <th>ID</th><th>ID</th><th>ID</th><th>ID</th><th>ID</th><th>ID</th><th>ID</th><th>ID</th><th>ID</th>
    </tr>
    <?php 
    while($row = $result->fetch_object()):
    
    ?>
    <tr>
        <td><?=$row->id  ?> </td>
        <td><?=htmlspecialchars($row->name)  ?> </td>
        <td><?=htmlspecialchars($row->email)  ?> </td>
        <td><?=$row->birth_date  ?> </td>
        <td><?=$row->gender  ?> </td>
        <td><?=calculateAge($row->birth_date)  ?> </td>
        <td><?=nl2br(htmlspecialchars($row->description))  ?> </td>
        <td><?=$row->created_at  ?> </td>
        <td><a class="detail-link" href="?user_id=<?= $row->id ?>">Szczegoly</a></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php if($selectedUser): ?>
<div class="details">
<h3>Szczegoly uzytkownika <?= htmlspecialchars($selectedUser->name) ?></h3>
<p>Email: <?= $selectedUser->email ?></p>
<p>Data urodzenia: <?= $selectedUser->birth_date ?></p>
<p>Wiek: <?= calculateAge($selectedUser->birth_date) ?></p>
<p>Plec: <?= $selectedUser->gender ?></p>
<p>Email: <?= htmlspecialchars($selectedUser->descrition) ?></p>
<p>Utworzono: <?= $selectedUser->created_at ?></p>
<p><a href="list_users.php">Ukryj szczegoly</a></p>
</div>
<?php endif; ?>
</body>
</html>
