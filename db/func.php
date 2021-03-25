<?php
include "connect.php";

function InsertPost($commentaire, $creationDate)
{
    try {

        $sql = "INSERT INTO `post`(`commentaire`,`creationDate`,`modificationDate`) VALUES (:commentaire, :creatonDate, :modifDate)";

        $bd = connect();

        $bd->beginTransaction();
        $query = $bd->prepare($sql);

        $query->execute([
            ':commentaire' => $commentaire,
            ':creatonDate' => $creationDate,
            ':modifDate' => $creationDate,
        ]);

        $latest_id = connect()->lastInsertId();

        $bd->commit();
        return $latest_id;
    } catch (Exception $e) {
        $bd->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}


function InsertMedia($typeMedia, $nomMedia, $creationDate, $lastid)
{
    try {
        $sql = "INSERT INTO `media`(`typeMedia`,`nomMedia`,`creationDate`,`modificationDate`,`idPost`)
    VALUES (:typeMedia,:nomMedia ,:creationDate,:modificationDate , $lastid)";
        $bd = connect();

        $bd->beginTransaction();
        $query = $bd->prepare($sql);
        $query->execute([
            ':typeMedia' => $typeMedia,
            ':nomMedia' => $nomMedia,
            ':creationDate' => $creationDate,
            ':modificationDate' => $creationDate,
        ]);
    } catch (Exception $e) {
        $bd->rollBack();
        echo "Failed: " . $e->getMessage();
    }
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
