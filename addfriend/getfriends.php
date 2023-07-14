<?php
include "../connect.php";

$iduser = filterRequest('userone');

$stmt = $con->prepare("
SELECT 
    CASE
        WHEN friends.userone = :iduser THEN users2.id
        ELSE users1.id
    END AS other_user_id,
    CASE
        WHEN friends.userone = :iduser THEN users2.username
        ELSE users1.username
    END AS other_username,
    CASE
        WHEN friends.userone = :iduser THEN users2.image
        ELSE users1.image
    END AS other_image,
    friends.friends_id
FROM friends
INNER JOIN users AS users1 ON friends.userone = users1.id
INNER JOIN users AS users2 ON friends.usertwo = users2.id
WHERE (friends.userone = :iduser OR friends.usertwo = :iduser) AND friends.approve = 1
");
$stmt->bindParam(':iduser', $iduser);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}

