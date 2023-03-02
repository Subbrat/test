<?php
if (isset($_GET['url']) && $_GET['url'] === 'cloudtext') {
    include 'chat.php';
    exit;
}

// Display the home page
?>

<!DOCTYPE html>
<html>
<head>
	<title>cloudtext</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="s6css.css">
</head>
<body>
	<div class="container">
		<div class="messages" id="messages">
			<?php
				$servername = "localhost";
				$username = "id20250442_minad";
				$password = "sp^a@PcWruXXxJ77JqhL";
				$dbname = "id20250442_ctx";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT text, created_at FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row in reverse order
    $rows = array_reverse($result->fetch_all(MYSQLI_ASSOC));
    foreach ($rows as $row) {
        echo "<div class='line'>" . $row["text"]. "<br><div class='time'>" . $row["created_at"]. "</div></div>";
    }
} else {
    echo "";
}

				$conn->close();
			?>
		</div>
		<form action="submit.php" method="post">
			<div class="form-group">
				<input type="text" name="text" autofocus required>
			</div>
		</form>
	</div>
	<script>
	   function updateScroll() {
    var element = document.getElementById("messages");
    element.scrollTop = element.scrollHeight;
}

function addMessage() {
    var form = document.getElementById("message-form");
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", form.action, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var messages = document.getElementById("messages");
            messages.innerHTML += xhr.responseText;
            updateScroll();
            form.reset();
        }
    };
    xhr.send(formData);
}

window.onload = function() {
    updateScroll();
    var form = document.getElementById("message-form");
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        addMessage();
    });
};

	</script>
</body>
</html>
