<?php

// ===============================
// GET FORM DATA
// ===============================

$name = isset($_POST['name']) ? trim($_POST['name']) : '';

$process = isset($_POST['process']) ? trim($_POST['process']) : '';

$query = isset($_POST['query']) ? trim($_POST['query']) : '';


// ===============================
// CHECK EMPTY FIELDS
// ===============================

if($name == "" || $process == "" || $query == ""){

    echo "
    <h2 style='color:red;font-family:Arial'>
    ❌ All fields are required
    </h2>
    ";

    exit;
}


// ===============================
// CREATE QUERY FILE IF NOT EXISTS
// ===============================

if(!file_exists("queries.txt")){

    fopen("queries.txt","w");

}


// ===============================
// SAVE QUERY
// ===============================

$data = "

Name    : $name
Process : $process
Query   : $query

----------------------------------------

";

file_put_contents("queries.txt", $data, FILE_APPEND);


// ===============================
// WINDOWS POPUP NOTIFICATION
// ===============================

$message = "$name ($process) submitted a new query";

$message = addslashes($message);


// ===============================
// WINDOWS MESSAGE POPUP
// ===============================

$command = 'mshta vbscript:Execute("msgbox ""'.$message.'"",64,""New Query Received"":close")';

pclose(popen($command, "r"));


// ===============================
// SUCCESS MESSAGE
// ===============================

echo "
<h2 style='color:#00ff99;font-family:Arial'>
✅ Query Submitted Successfully
</h2>
";

?>