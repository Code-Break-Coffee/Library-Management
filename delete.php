<?php
include "dbconnect.php";

if(!empty($_POST["bookno"]) && !empty($_POST["title"]))
{
    $book=$_POST["bookno"];
    $title=$_POST["title"];
    $sql="SELECT  FROM books where Book_No = '$book';";
    $ob1=new check($conn,$sql,$book,$title);
    if($ob1->checked())
    {
        $delsql="DELETE from books where Book_No = '$book';";
        $ob2=new del($conn,$delsql);
        if($ob2->deleted())
        {
            echo"Book No., $book named, $title is been deleted!!!";
        }
        else
        {
            echo"Book No., $book named, $title can`t be deleted!!!";
        }
    }
}

class check
{
    private $sql,$conn,$book,$title;

    function __construct($conn,$sql,$book,$title)
    {   
        $this->conn=$conn;
        $this->sql=$sql;
        $this->book=$book;
        $this->title=$title;
    }

    public function checked()
    {
        $result=$this->conn->query($this->sql);
        if($result)
        {
            $count=0;
            while($row=$result->fetch_assoc())
            {
                if($row["Status"] != 'available')
                {
                    echo"Book No., $this->book, named, $this->title is been issued by a member of the Library, so it cannot be deleted!!!";
                    $count=1;
                    break;
                }
            }
            if($count==1)
            {
                return false;
            }
            return true;
        }
        else
        {
            echo $this->conn->error;
            return false;
        }
    }
}

class del
{
    private $conn,$delsql;

    function __construct($conn,$delsql)
    {
        $this->conn=$conn;
        $this->delsql=$delsql;
    }

    public function deleted()
    {
        $result=$this->conn->query($this->delsql);
        if($result)
        {
            return true;
        }
        return false;
    }
}
?>