<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meniailo_PHP_DZ6_Органайзер_форма</title>
    <style>
    #main {
        width: 300px;
        max-width: 400px;
        background-color: black;
        border-radius: 20px;
        border-collapse: collapse;
    }
    #head {
        text-align: center;
        color:white;
        font-size: 2em;}
    #body {
        height: 300px;
        max-width: 400px;
        background-color: black;
    }
    .brdr{border:2px solid rgb(253, 139, 9);}
    .note{
        padding:2px;
        margin: 0;
        background-color: white;
        width: 200px;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        font-size: 0.7em;
        }
    .date{
        padding:2px;
        margin: 0;
        background-color: white;
        width: 55px;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        font-size: 0.7em;

    }
    .flex-container {display: flex;
        padding:2px;
        flex-wrap: wrap;
        align-content: flex-start;
    }
    .middle{
        display: flex;
        align-items: center;
    }
    .center {
    align-content: center;
    justify-content: center;
}
    .item {
        flex-direction: row;
        display: flex;
        margin: 2px;
    }

    .button{
        border-radius: 50%;
        height: 45px;
        width: 45px;
        background: rgb(253, 139, 9);
        border-color: rgb(105, 58, 2);
        margin-bottom: 4px;
    }
    .add {font-size: 2em; color: black;  margin-left: 50px;}
    .print {font-size: 0.7em; }
    .button:hover{
        background: rgb(248, 183, 108);
        border-color: rgb(196, 118, 22);
        cursor: pointer;
    }
    .del {
        border-radius: 50%;
        height: 24px;
        width: 24px;
        margin: 5px 5px 0 5px;
        background: rgb(253, 139, 9);
        border-color: rgb(105, 58, 2);
    }
    .del:hover{
        background: rgb(248, 183, 108);
        border-color: rgb(196, 118, 22);
        cursor: pointer;
    }

   .Shadow {
        filter: drop-shadow(2px 2px 2px white);
    }
    table {
        margin-top:30px;
        border:1px solid red;
    border-collapse: collapse; }

    th:first-child,td:first-child {width: 100px; border:1px solid red;}
    th,td {width: 400px; border:1px solid red;}
    a {text-decoration: none;}
</style>
  <?php
  include 'Note.php';
  $obj = new Note();
  $notes = new Organaizer($obj);
  $printNotes=new Organaizer($obj);
  ?>

</head>
<body>
    <form id="main" class="" action="Organizer.php" method="post">
        <div id="head">Organizer</div>
        <div id="body" class="flex-container">

            <?php
            session_start();
            $counter=0;
            if (file_exists('notes.txt')) {
                $notes->load();
                $counter = $notes->cnt();
                if(isset($_SESSION["note"])){
                    $obj=$_SESSION['note'];
                    unset($_SESSION['note']);
                    $obj->setIdNote($counter);
                    $notes->addNote($obj);
                }
                if(isset($_POST["delNote"])){
                    $idNote = (int)htmlspecialchars($_POST['delNote']);
                    $notes->deleteNote($idNote);
                    }
                $notes->save();

                if(isset($_POST["btnDay"]))
                    foreach($notes->getDay() as $note)
                    $printNotes->addNote($note);
                else if (isset($_POST["btnWeek"]))
                    foreach($notes->getWeek() as $note)
                        $printNotes->addNote($note);
                else if (isset($_POST["btnMonth"]))
                    foreach($notes->getMonth() as $note)
                        $printNotes->addNote($note);
                else $printNotes=$notes;

                foreach($printNotes->getNotes() as $note){
                    echo '<div class=" item " ><div class="date middle">'.$note->getDateEnd().'</div>
                         <div class="note middle">'.$note->getContent().'</div>
                         <div ><input type="submit"  name="delNote" value="'.$note->getIdNote().'" class="del middle center"></div></div>';/*onClick="myHandler()"   id="'.$note->getIdNote().'"  */
                }

            }


            ?>

        </div>
        <div id="foot" class=" item center">
            <input type="submit" name="btnDay" value="Day"  class="button middle print center"> <!--onClick="getDay()"-->
            <input type="submit" name="btnWeek" value="Week"  class="button middle print center"> <!--onClick="getWeek()"-->
            <input type="submit" name="btnMonth" value="Month"  class="button middle print center"> <!--onClick="getMonth()"-->
            <input type="submit" name="btnAll" value="AllNotes"  class="button middle print center">
            <a href="addNote.php" class="button middle add center">+</a>>
        </div>
    </form>

<table id="table" style="display: none">
    <tr><th>Date end</th><th>Task</th></tr>
<tr id="tbody">
</tr>
</table>

    <script>
        function myHandler (e) {
            //let num = e.currentTarget.appid;
            let table = document.getElementById("table");
            table.style.display = "block";
        }
        function getDay () {
        <?php
           //print_r($notes->getDay());?>
        }

        function getWeek() {
        }
        function getMonth () {

        }


    </script>


</body>
</html>


<?php
//$GLOBALS['notes']->show();
?>

