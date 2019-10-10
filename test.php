// convert to a result
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $firstName=$row['firstname'];
            $lastName=$row['lastname'];
        
            // Start session
            session_start();
        $_SESSION['firstname'] = $firstName;
        $_SESSION['lastname'] = $lastName;
        $_SESSION['success'] = "You are now logged in";

        }
        // bind variables to the resulted values
    /* $stmt->bind_result($u, $p);

    * while ($row = $stmt->fetch()) {
        echo "Username = $u and Password = $p <br>";
    * }
    */