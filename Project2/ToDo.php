<?php
class Todo
{
    private $id;
    private $description;
    private $createDate;
    private $dueDate;
    private $done;
    public function __construct($id, $desc, $cd, $dd, $do) {
        $this->id = $id;
        $this->description = $desc;
        $this->createDate = $cd;
        $this->dueDate = $dd;
        $this->done = $do;
    }
    public function getDone()
    {
        return $this->done;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getDueDate()
    {
        return $this->dueDate;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getCreateDate()
    {
        return $this->createDate;
    }
    public function setDueDate($dd)
    {
        $this->dueDate = $dd;
    }
    public function setDescription($d)
    {
        $this->description = $d;
    }
    public function setCreateDate($cd)
    {
        $this->createDate = $cd;
    }
    public function printRow() {
        $desc = $this->getDescription();
        $cd = $this->getCreateDate();
        $dd = $this->getDueDate();
        echo '<td>';
        echo $desc;
        echo '</td>';
        echo '<td>';
        echo $cd;
        echo '</td>';
        echo '<td>';
        echo $dd;
        echo '</td>';
    }
}
?>