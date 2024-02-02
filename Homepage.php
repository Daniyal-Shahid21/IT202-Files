<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles1.css">
    <link href="https://fonts.cdnfonts.com/css/whitney-2" rel="stylesheet">
    <script src="scripts.js"></script>
    <link rel="icon" type="image/png" href="icons8-discord-50.png">
    <title>Offbrand Discord</title>
</head>
<body>
    <div class="container">
        <div class="side-bar">
            <?php
            $server = "sql1.njit.edu";
            $username = "sds";
            $password = "Pillowcase#1";
            $db = "sds";
            $conn = mysqli_connect($server, $username, $password, $db);

            $sql = "SELECT users FROM `user_table` WHERE text <> ''";
            $data = mysqli_query($conn, $sql);

            echo '<h2>Returning user?</h2><br>';
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_assoc($data)) {
                    echo '<label class="users"><input type="radio" name="selected_user" value="' . $row['users'] . '" onclick="updateNameTextbox(\'' . $row['users'] . '\')">' . $row['users'] . '</label><br>';
                }
            }
            mysqli_close($conn);
            ?>
        </div>

        <div class="mid_column">
            <header>
                <h2><label for="senderName">Name:</label></h2>
                <input type="text" id="senderName"><br/>

                <h2><label for="senderPass">Password:</label></h2>
                <input type="text" id="senderPass"><br/>

                <p id="warning" style="display: none">Warning, User not found</p>
            </header>

            <div class="chat">
                <textarea id="message" rows="10" cols="50"></textarea><br>
            </div>

            <footer>
                <h3><label for="recieverName">Name:</label>
                <input type="text" id="recieverName"> </h3>
                <p id="displayedMSG"></p>
            </footer>
        </div>
    </div>
</body>
</html>
