<?php
$servername = "192.168.2.10";
$username = "royxia";
$password = "welcome";
/*$targetdb = "importscript";*/

// Create connection
$conn = new mysqli($servername, $username, $password, 'royxia');

// Check connection
if ($conn->connect_error) {
    die("Connection failed T_T: " . $conn->connect_error);
}
echo "Connected successfully to the server";


/*csv file import scripts*/


if (isset($_POST["submit"]))
{
    if($_FILES['file']['name'])
    {
        $filename = explode('.',$_FILES['file']['name']);
        if($filename[1] == 'csv')
        {
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while($data =fgetcsv($handle))
            {
                $id = mysqli_real_escape_string($conn, $data[0]);
                $first = mysqli_real_escape_string($conn, $data[1]);
                $last= mysqli_real_escape_string($conn, $data[2]);
                $age = mysqli_real_escape_string($conn, $data[3]);
                $sql="INSERT into student(id, first, last, age) values ('$id','$first','$last', '$age')";
                mysqli_query($conn, $sql);
            }
            fclose($handle);

            echo "Imported";
        }
    }
}


?>

<DOCTYPE html>
    <html>
    <head>
        <title> cvs import script </title>
    </head>
    <body>
    <p> PHP cvs import script 12</p>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="submit" value= "import">
    </form>
    </body>
    </html>