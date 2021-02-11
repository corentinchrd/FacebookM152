<?php
include "connect.php";

function InsertPost($commentaire,$creationDate){
    $sql = "INSERT INTO `post`(`commentaire`,`creationDate`,`modificationDate`)
    VALUES (:commentaire, :creatonDate, :modifDate)";

    $query = connect()->prepare($sql);

    $query->execute([
        ':commentaire' => $commentaire,
        ':creatonDate' => $creationDate,
        ':modifDate' => $creationDate,
    ]);

    $latest_id = connect()->lastInsertId();
    return $latest_id;
}


function InsertMedia($typeMedia, $nomMedia, $creationDate,$lastid)
{
    $sql = "INSERT INTO `media`(`typeMedia`,`nomMedia`,`creationDate`,`modificationDate`,`idPost`)
    VALUES (:typeMedia,:nomMedia ,:creationDate,:modificationDate , $lastid)";
    
    $query = connect()->prepare($sql);
    echo $sql;
    $query->execute([
        ':typeMedia' => $typeMedia,
        ':nomMedia' => $nomMedia,
        ':creationDate' => $creationDate,
        ':modificationDate' => $creationDate,
    ]);
}
function GetAllPost()
{
    $sql = "SELECT `idPost`, `commentaire` FROM `post`";
    
    $query = connect()->prepare($sql);
    $query->execute();
    $return = $query->fetchAll();
    return $return;
}

function GetAllMediaFormID($id)
{
    $sql = "SELECT `typeMedia`,`nomMedia` FROM `media` WHERE `idPost` = $id";
    
    $query = connect()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}