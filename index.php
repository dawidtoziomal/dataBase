<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    echo "<h2>MY SQL </h2>";

    $con = mysqli_connect("localhost","root","","moja_baza");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    } else {

        if(isset($_POST['del'])){
            echo "USUWANIE REKORDU " . $_POST['del'];
            
            $delsql = "DELETE FROM users WHERE id=10";
            
            if(mysqli_query($con,$delsql)){
                echo "RECORD DELETED";
            } else {
                echo "DELETE ERROR";
            };
        }

        //ADD RECORDS
        if(isset($_POST['add'])){
            if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['wiek'])){
                echo 'DODAWANIE ' . $_POST['imie'] . $_POST['nazwisko'] . $_POST['wiek'];
            
                $addsql = "INSERT INTO users (id, imie, nazwisko, wiek) VALUES (NULL,'" . $_POST['imie'] ."','" . $_POST['nazwisko'] . "','" . $_POST['wiek'] ."')";
            
                if(mysqli_query($con,$addsql)){
                    echo "RECORD ADDED";
                } else {
                    echo "ADD ERROR";
                };
            } else {
                echo '<p style="color:red">Wypełnij wszystkie pola</p>';
            }
        }
        //SHOW RECORDS
        echo " Connected to MySQL";

        $sql = "SELECT * FROM users";

        $result = mysqli_query($con,$sql);

        echo '<table border="1">';
        while($row = mysqli_fetch_assoc($result)){

            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['imie'] . "</td>";
            echo "<td>" . $row['nazwisko'] . "</td>";
            echo "<td>" . $row['wiek'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    mysqli_free_result($result);

    mysqli_close($con);
?>

<button id="btn">+</button>

<form id="myForm" style="display:none method="post">
    <input name="imie" placeholder="imię">
    <input name="nazwisko" placeholder="nazwisko">
    <input name="wiek" placeholder="wiek">
    <input type="submit" value="Dodaj">
</form>

<script>
    let visible = false;
    const btn = document.querySelector('#btn');
    const form = document.querySelector('#myForm');
    btn.addEventListener('click',() => {
        console.log();
        visible = !visible;
        myForm.style.display = visible ? 'block' : 'none';
    });
    

</script>
