<?php
include "../connect.php";

$idone = filterRequest('userone');
$idtwo = filterRequest('usertwo');

$stmt = $con->prepare(" SELECT * FROM `friends` WHERE `userone`= ? AND `usertwo`= ? ");
$stmt->execute(array($idone,$idtwo));

$count = $stmt->rowCount();

if($count > 0){
printFailure('already friends');
}else{
    $data = array(
      "userone" => $idone,
      "usertwo" => $idtwo,
    );
    insertData('friends',$data);
}

