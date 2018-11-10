<?php

class Postcards_mdl
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        $this->imageFolder = APP . 'images/';
    }

    /**
     * Get all postcard from database
     */
    public function getAllPostcards()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Add a postcard to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $image Base64 encoded png image
     * @param string $name Name
     * @param string $creatd timestamp of image creation 
     */
    public function addPostcard($image, $name, $created)
    {
        /* save image file */
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $data = base64_decode($image);
        $file = $this->imageFolder . $name;
        $success = file_put_contents($file, $data);

        if (!$success)
            return False;

        $sql = "INSERT INTO postcards (name, created) VALUES (:name, :created)";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':created' => $created);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); exit();

        $success = $query->execute($parameters);
        if (!$success) {
            echo $success;
            unlink($file);
            return False;
        }
        
        return True;
    }

    /**
     * Delete a postcard in the database
     * @param int $id Id of postcard
     */
    public function deletePostcard($id)
    {
        $sql = "DELETE FROM postcards WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
    }

    /**
     * Get a postcard from database
     */
    public function getPostcard($id)
    {
        $sql = "SELECT id, image, name, created FROM postcards WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetch();
    }

    /**
     * Update a postcard in database
     * No need for a update method for postcards
     * public function updateSong($image, $name, $created, $id)
     */
    
    /**
     * Get stats
     */
    public function getAmountOfPostcards()
    {
        $sql = "SELECT COUNT(id) AS amount_of_postcards FROM postcards";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->amount_of_postcards;
    }
}
