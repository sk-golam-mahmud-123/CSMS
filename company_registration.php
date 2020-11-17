<!DOCTYPE html>
<html>
    <?php
        $e_id = $name = $dob = $addr = $doj = $fileToUpload = $country = $state = $city = $e_idErr = $nameErr = $dobErr = $addrErr = $dojErr = $fileToUploadErr = $countryErr =  $stateErr = $cityErr = "" ;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target_dir = "files/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $fileToUpload = $_FILES["fileToUpload"]["name"];
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            require_once 'reg_db.php';
            $db = new reg_db();
            $conn=$db->OpenCon();
            
            
            if (empty($_POST["e_id"])) {
                $e_idErr = "Please enter employee ID";
            }
            else {
                $e_id = $_POST["e_id"];
            }
        
            if (empty($_POST["name"])) {
                $nameErr = "Please enter your name";
            }
            else {
                $name = $_POST["name"];
            }
        
            if (empty($_POST["dob"]))  {
                $dobErr = "Please enter DOB";
            }
            else {
                $dob = $_POST["dob"];
            }

            if (empty($_POST["addr"]))  {
                $addrErr = "Please enter your address";
            }
            else {
                $addr = $_POST["addr"];
            }

            if (empty($_POST["doj"]))  {
                $dojErr = "Please enter you date of joint";
            }
            else {
                $doj = $_POST["doj"];
            }

            if (empty($_POST["fileToUpload"]))  {
                $fileToUploadErr = "";
            }
            else {
                $fileToUpload = $_POST["fileToUpload"];
            }
        
            if (!isset($_POST["country"])) {
                $countryErr = "You must select 1 option";
            }
            else {
                $country = $_POST["country"];
            }

            if (!isset($_POST["state"])) {
                $stateErr = "You must select 1 option";
            }
            else {
                $state = $_POST["state"];
            }
            
            if (!isset($_POST["city"])) {
                $cityErr = "You must select 1 option";
            }
            else {
                $city = $_POST["city"];
            }
            $db->input_val($conn,$name,$e_id,$dob,$addr,$country,$state,$city,$doj,$fileToUpload);
            $db->CloseCon($conn);
        }
    ?>

    <body>
        <form method="post" action="" enctype="multipart/form-data"> 
        <table>
            <tr>
                <td><label for="e_id">Emp ID:</label></td>
                <td><input type="text" name="e_id" value="<?php echo htmlspecialchars($e_id);?>">
                    <span class="error"><?php echo $e_idErr;?></span></td>
            </tr><br>
             <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" name="name" value="<?php echo htmlspecialchars($name);?>">
                    <span class="error"><?php echo $nameErr;?></span></td>
            </tr><br>
            <tr>
                <td><label for="dob">Date of Birth:</label></td>
                <td><input type="date" name="dob" value="<?php echo htmlspecialchars($dob);?>">
                    <span class="error"><?php echo $dobErr;?></span></td>
            </tr><br>
            <tr>
                <td><label for="addr">Address:</label></td>
                <td><input type="text" name="addr" value="<?php echo htmlspecialchars($addr);?>">
                    <span class="error"><?php echo $addrErr;?></span></td>
            </tr><br>
            <tr>
                <td><label for="country">Country:</label></td>
                <td><select name="country" id="country">
                    <option selected disabled hidden>Please select Country</option>
                    <option value="India">India</option>
                    </select></td>
            </tr><br>
            <tr>
                <td><label for="state">State:</label></td>
                <td><select name="state" id="state">
                    <option value="Punjab">Punjab</option>
                    <option value="West Bengal">West Bengal</option>
                    </select></td>
            </tr><br>
            <tr>
                <td><label for="city">City:</label></td>
                <td><select name="city" id="city">
                    <option value="Amritsar">Amritsar</option>
                    <option value="Kolkata">Kolkata</option>
                    </select></td>
            </tr><br>
            <tr>
                <td><label for="doj">Date of Joining:</label></td>
                <td><input type="date" name="doj" value="<?php echo htmlspecialchars($doj);?>">
                    <span class="error"><?php echo $dojErr;?></span></td>
            </tr><br>
            <tr>
                <td><label for="fileToUpload">Profile Pic:</label></td>
                <td><input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo htmlspecialchars($fileToUpload);?>">
                    <span class="error"><?php echo $fileToUploadErr;?></span></td>
            </tr><br>
    </table>
    <input type="Submit">
    </body>
</html>