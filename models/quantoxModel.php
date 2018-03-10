<?php
class quantoxModel extends baseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertUser($data)
    {
        $q = $this->db->prepare("SELECT Id FROM users where email=:email");
        $q->bindValue(':email', $data[0], PDO::PARAM_STR);
        $q->execute();

        if ($q->rowCount() > 0)
        {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO users VALUES('',?,?,?)");
        $stmt->execute($data);
        if($stmt->rowCount()>0)
        {
            return true;
        }
        return false;
    }

    public function loginUser($data)
    {
        $q = $this->db->prepare("SELECT name,email FROM users WHERE email=:email AND password=:pass");
        $q->bindValue(':email', $data[0], PDO::PARAM_STR);
        $q->bindValue(':pass', $data[1], PDO::PARAM_STR);
        $q->execute();

        if ($q->rowCount() > 0)
        {
            $check = $q->fetchall(PDO::FETCH_OBJ);
            return $check;
        }
        else
        {
            return false;
        }
    }

    public function search($search)
    {

        $q = $this->db->prepare("SELECT email,name FROM users WHERE name LIKE ? OR email LIKE ?");
        $q->bindValue(1, "%$search%", PDO::PARAM_STR);
        $q->bindValue(2, "%$search%", PDO::PARAM_STR);
        $q->execute();

        if ($q->rowCount() > 0)
        {
            $check = $q->fetchall(PDO::FETCH_OBJ);
            return $check;
        }
        else
        {
            return false;
        }
    }
}
