<?php
include "../connect.php";

$iduser = filterRequest('userid');


$stmt = $con->prepare("
SELECT 
        CASE
            WHEN userone_id = :iduser THEN usertwo_id
            ELSE userone_id
        END AS other_user_id,
        CASE
            WHEN userone_id = :iduser THEN usertwo_username
            ELSE userone_username
        END AS other_username,
        CASE
            WHEN userone_id = :iduser THEN usertwo_image
            ELSE userone_image
        END AS other_image,
        friends_id
    FROM friendsview
    WHERE (userone_id = :iduser OR usertwo_id = :iduser) AND approve = 1
    ORDER BY message_time DESC
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