<?php

include "../connect.php";

$username    = filterRequest('username');
$id    = filterRequest('id');

$stmt = $con->prepare("
    SELECT 
        u.id, u.username, u.image,
        CASE
            WHEN f.friends_id IS NOT NULL THEN 'already friends'
            ELSE 'not friends'
        END AS friendship_status
    FROM users u
    LEFT JOIN friends f ON (u.id = f.userone AND f.usertwo = :currentUserId) OR (u.id = f.usertwo AND f.userone = :currentUserId)
    WHERE u.username LIKE :searchUsername AND u.id != :currentUserId
");

$stmt->bindValue(':currentUserId', $id, PDO::PARAM_INT);
$stmt->bindValue(':searchUsername', "%$username%", PDO::PARAM_STR);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($data)) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}

//getAllData('users'," username LIKE '%$username%' AND id != '$id' ");

/*
 
 from users => list users
 from friends => users as friends & users as random
 if(user is friend){
    json_encode(array("status" => "success", "message" => "already friends"));
 }if(user is not friend){
    json_encode(array("status" => "success", "message" => "not friends"));
 }

*/ 

