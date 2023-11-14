<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meniailo_PHP_DZ6_Органайзер_форма</title>
    <style>
        #table {
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
            color: white;
        }

        .note{
            padding:3px;
            margin: 0;
            font-size: 0.7em;
            width: 285px;
            height: 260px;
        }
        .date{
            padding:2px;
            margin: 0;
            border-radius: 20px;
            font-size: 0.7em;
        }
        .flex-container {
            display: flex;
            flex-direction: column;
            padding:2px;
            flex-wrap: wrap;
            align-content: flex-start;
        }
        .middle{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .center {
            align-content: center;
            justify-content: center;
        }
        .item {

            display: flex;
            margin: 2px;
        }

        .button{
            border-radius: 50%;
            height: 45px;
            width: 45px;
            background: rgb(253, 139, 9);
            border-color: rgb(105, 58, 2);
margin: 0  4px 4px 4px;
        }
        .add {font-size: 2em; margin-left: 100px;}
        .print {font-size: 0.7em; }
        .button:hover{
            background: rgb(248, 183, 108);
            border-color: rgb(196, 118, 22);
            cursor: pointer;
        }
            .Shadow {
            filter: drop-shadow(2px 2px 2px white);
        }
        .#foot {
            background: black;
            border: 1px solid red;
            border-bottom-right-radius: 20px;
            color:white;
            width: 40vh;}

    </style>
    <?php include 'Note.php';?>
    <script>
        function myHandler() {
            let clear = document.getElementById('content');
            clear.value = '';
        }
    </script>
</head>
<body>
<?php
if(isset($_REQUEST['date']) && isset($_REQUEST['content'])){
    $endDate = htmlentities($_REQUEST['date']);
    $textNote = htmlentities($_REQUEST['content']);

    $temp = new Note(1,$endDate,$textNote);

    session_start();
    $_SESSION['note']=$temp;

    $temp->show_note();
header('Location:Organizer.php');
}?>
<form name="newNote" action="addNote.php" method="POST">
<div id="table" >
    <div id="head">Add Note</div>
    <div id="body" class="flex-container">
        <div class=" item">
            <textarea id="content" name="content"  class="note" placeholder="add new note"></textarea>
        </div>
        <div class="item middle">
            <label for="date">Дата задания</label>
                <input type="date" id="date" name="date" value="'<?php date('Y-m-d')?>'"  class="date" />
        </div>


    </div>
    <div id="foot" class="item middle">
        <input type="button" name="clear" value="clear" onClick="return myHandler()" class="button print center">
        <input type="submit" value="+" class="button add center">
    </div>
</div>

</form>
</body>
</html>

