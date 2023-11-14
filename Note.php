<?php
class Note {
    private $idNote;
    private $dateEnd;
    private $content;
    function __construct($idNote=0, $dateEnd=0, $content='')
    {
        $this->idNote = $idNote;
        $this->dateEnd = $dateEnd;
        $this->content = $content;
    }

    public  function setContent($content)
    {
        $this->content = $content;
    }
    public  function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }
    public  function setIdNote($idNote)
    {
        $this->idNote = $idNote;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getDateEnd()
    {
        return $this->dateEnd;
    }
    public function getIdNote()
    {
        return $this->idNote;
    }
    public function show_note(){
        $str = "Номер заметки: ".$this->idNote."<br>"." Дата задания: ".$this->dateEnd."<br>"."Заметка: ".$this->content;
        echo $str;
    }
    function __destruct() { }
}
class Organaizer { /*extends Note*/
    private $Notes=[];

    /*function __construct()
    {}*/
    function __construct(Note $Note){
        /*parent::__construct($Note->getIdNote(),$Note->getDateEnd(),$Note->getContent());*/
        $this->Notes[] = $Note;
    }
    public function getNotes()
    {
        return $this->Notes;
    }
    public function addNote (Note $Note){
        $this->Notes[$Note->getIdNote()]=$Note;
    }
    public function deleteNote($num){  //Note $Note
        unset($this->Notes[$num]); //$Note->getIdNote()
    }
    public function cnt(){
        return count($this->Notes);
    }
    public function getDay()
    {
        $today = date('Y-m-d');
        $dayNotes = [];
        foreach($this->Notes as $note){
            if($note->getDateEnd()==$today)
                $dayNotes[]=$note;
        }
         return $dayNotes;
    }

    public function getWeek()
    {
        $week = date('W');
        $weekNotes = [];
        foreach($this->Notes as $note){
            if(idate('W',strtotime($note->getDateEnd()))==$week)
                $weekNotes[]=$note;
        }
        return $weekNotes;
    }

    public function getMonth()
    {
        $month = date('m');
        $weekNotes = [];
        foreach($this->Notes as $note){
            if(idate('m',strtotime($note->getDateEnd()))==$month)
                $weekNotes[]=$note;
        }
        return $weekNotes;
    }
    public function show () {
        if(count($this->Notes)>0){
        foreach ($this->Notes as $note)
        { $note->show_note();
            echo "<br />";}}
    }

    public function save ()
    {
        $toWrite= serialize($this->Notes);
        $file = fopen("notes.txt", "w+") or die("The file can not be opened");
        fwrite($file, $toWrite);
        fclose($file);
    }
    public function load ()
    {
        $filename = "notes.txt";
        $file = fopen($filename,"a+") or die("The file can not be opened");
        if(filesize($filename)>0){
            $toRead = fread($file, filesize($filename));
            $this->Notes = unserialize($toRead);
        }
        fclose($file);
    }
    function __destruct()
    {
       /* parent::__destruct();*/
    }



}
?>