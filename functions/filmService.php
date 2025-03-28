<?php

    /**
     * Permet d'insérer un nouveau film en base de données.
     *
     * @param PDO $db
     * @param array $_postData
     * @param float|null $reviewRounded
     * 
     * @return void
     */
    function createFilm(PDO $db, array $_postData, float|null $reviewRounded): void
    {
        try
        {
            $request = $db->prepare("INSERT INTO film(title, actors, review, comment, created_at, updated_at) VALUES(:title, :actors, :review, :comment, now(), now() )");

            $request->bindValue(":title", $_postData['title']);
            $request->bindValue(":actors", $_postData['actors']);
            $request->bindValue(":review", $reviewRounded);
            $request->bindValue(":comment", $_postData['comment']);

            $request->execute();

            $filmId = (int) $db->lastInsertId();

            $request->closeCursor();
        }
        catch (PDOException $exception)
        {
            throw new \Exception($exception->getMessage());
        }
    }