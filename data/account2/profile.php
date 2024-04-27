<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Profile Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <?php
        // Read the JSON data
    ?>
<style>
.mainbox {
	height: 80vh;
	border: 2px solid rgb(61,61,61);
	border-radius: 3px;
}
.accountinfo {
	min-height: 10vh;
	border: 2px solid rgb(61,61,61);
	border-top: none;
	border-right: none;
	border-left: none;
	background-color: rgb(197,197,197);
}
span {
	padding: 20px;
	font-size: 18px;
}
</style>
</head>
<body>
<?php include('../../templates/logged/secure.php');?>
<?php include('../../templates/logged/logoutbtn.php');?>
<?php include('../../templates/logged/accountbtn.php');?>
<div class="content">
	<div class="mainbox">
		<div class="accountinfo">
		<?php
			session_start();

			$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
			$username = $isValidLogin ? $_SESSION['username'] : '';
			
			$salt = bin2hex(random_bytes(3));

			$jsonData = file_get_contents('/var/www/data.json');	

        		$jsonData2 = json_decode(file_get_contents('/var/www/data.json'), true);
        		$darkModeEnabled = $jsonData2[$username]['points']['darkmode']; // Adjust the key as needed

        		// Choose the CSS file based on the darkmode value
        		if ($darkModeEnabled) {
            			echo '<link rel="stylesheet" href="/templates/darkmode.css">';
        		} else {
            			echo '<link rel="stylesheet" href="/templates/main.css">';
			}
       			$userShopData = json_encode($jsonData[$username]['shop'] ?? []);
		?>
<form class="example" id="searchForm" style="padding:5px;float:right;max-width:300px">
  <input type="text" placeholder="Search..." name="search2" id="searchInput">
  <button style="width:60px;height:21px;" type="submit">Submit</button>
</form>
<div style="font-size:25px;font-weight:bold;padding:2px 20px;" id="name"></div>
</div>
<div style="padding:25px 20px;" id="searchResult"></div>
	<div id="usernameList"></div>
<div id="hiddenData" style="margin-top:-15px;display:none;padding:0px 20px;">
  <button onclick="changePassword()">Change Password</button>
  <button onclick="changeUsername()">Change Username</button>
  <button onclick="changeDescription()">Change Description</button>
  <button onclick="toggleDarkMode()">Toggle Dark Mode</button>
<div id="toggleDarkModeButton"></div>
  <div id="emailButtonContainer"></div>
</div>
<script>
const data = <?php echo $jsonData; ?>;

function displayUserData(username) {
        const user = data[username];
        const emailButtonContainer = document.getElementById('emailButtonContainer');
        const searchResult = document.getElementById('searchResult');
        const hiddenData = document.getElementById('hiddenData');
        const name = document.getElementById('name');
        const currentUser = '<?php echo $username; ?>'; // Replace with PHP variable holding current user

        if (user) {
		let emailDisplay = currentUser === username ? `<p>Email: ${user.email}</p>
			` : '';
          searchResult.innerHTML = `
            <p>Username: ${username}</p>
            <p>Description: ${user.description}</p>
            ${emailDisplay}
            <p>Registration date: ${user.registrationTime}</p>
            <p>Last login: ${user.lastLogin}</p>
            <p>Points: ${user.points.total}</p>
          `;

          name.innerHTML = `<p>${username}'s Profile</p>`;
          usernameList.style.display = 'none';

          if (currentUser === username) {
            hiddenData.style.display = 'block';
            if (user.email === null) {
                    alert("ATTENTION! If you are seeing this you do not have a email with our service, please apply one now or by 2024 or your account will be terminated!");
		emailButtonContainer.innerHTML = '<button id="addEmailButton">Add Email</button>';
                addEmailButtonEventListener(); // Attach event listener to the newly added button
            } else {
                emailButtonContainer.innerHTML = ''; // Clear the container if email exists
            }
          } else {
            hiddenData.style.display = 'none';
            emailButtonContainer.innerHTML = ''; // Clear email button container for other users
          }
        } else {
          searchResult.textContent = 'User not found, try again';
          name.textContent = 'Error retrieving profile';
          hiddenData.style.display = 'none';
          usernameList.style.display = 'block';
        }
}

  document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const searchTerm = document.getElementById('searchInput').value;
    displayUserData(searchTerm);
  });



  // Default logged-in user's data to be displayed when the page loads
  const defaultLoggedInUser = '<?php echo $username; ?>'; // Replace with PHP variable holding default username
  displayUserData(defaultLoggedInUser);

function changePassword() {
  const newPassword = prompt('Enter your new password:');

  if (newPassword !== null && newPassword !== '') {
    if (confirm('Are you sure you want to update your password?')) {
         function hashPassword(newPassword) {
                 const salt = "<?php echo $salt ?>";
                const encoder = new TextEncoder();
                const data = encoder.encode(newPassword + salt); // Combine password and salt
                return crypto.subtle.digest('SHA-256', data)
                .then(hash => {
                        const hashArray = Array.from(new Uint8Array(hash));
                        const hashedPassword = hashArray.map(byte => ('00' + byte.toString(16)).slice(-2)).join('');
                        return { hashedPassword, salt };
                        });
                }

        hashPassword(newPassword)
        .then(({ hashedPassword, salt }) => {
          // Make a POST request to update password in the JSON file
          const formData1 = new FormData();
          formData1.append('hashedPassword', hashedPassword);
          formData1.append('salt', salt);

          fetch('changePassword.php', {
            method: 'POST',
            body: formData1
          })
          .then(response => {
            if (response.ok) {
              alert('Password updated successfully!');
            } else {
              throw new Error('Failed to update password');
            }
          })
          .catch(error => {
            console.error('Password update failed:', error);
            alert('Failed to update password. Please try again.');
          });
        })
        .catch(err => console.error('Error:', err));
    }
  }
}

function changeUsername() {
  const newUsername = prompt('Enter your new username:');

  if (newUsername !== null && newUsername !== '') {
    if (confirm('Are you sure you want to update your username?')) {
      const formData2 = new FormData();
      formData2.append('newUsername', newUsername);

      fetch('changeUsername.php', {
        method: 'POST',
        body: formData2
      })
        .then(response => {
          if (response.ok) {
                displayUserData(defaultLoggedInUser);
                return response.json();
          } else {
            throw new Error('Failed to update username');
          }
        })
        .then(data => {
          alert(data.message); // Assuming 'message' is returned from server-side PHP script
        })
        .catch(error => {
          console.error('Username update failed:', error);
          alert('Failed to update username. Please try again.');
        });
    }
  }
}

function changeDescription() {
  const newDescription = prompt('Enter your new description:');

  if (newDescription !== null && newDescription !== '') {
          if(newDescription.length >= 120) {
                  alert('Character limit (120) reached!');
            throw new Error('Failed to update description');
           } else {
        const formData3 = new FormData();
      formData3.append('newDescription', newDescription);

      fetch('changeDescription.php', {
        method: 'POST',
        body: formData3
      })
        .then(response => {
          if (response.ok) {
                  return response.json();
          } else {
            throw new Error('Failed to update description');
          }
        })
        .then(data => {
          alert(data.message); // Assuming 'message' is returned from server-side PHP script
        })
        .catch(error => {
          console.error('Description update failed:', error);
          alert('Failed to update descritpion. Please try again.');
          });
        }
  }
}


function addEmailButtonEventListener() {
    document.getElementById('addEmailButton').addEventListener('click', function() {
        const newEmail = prompt("Enter a email address(ONE TIME CHANGE)");
        if (newEmail && validateEmail(newEmail)) {
            const formData4 = new FormData();
            formData4.append("username", "currentUser"); // Replace with the actual username variable
            formData4.append("newEmail", newEmail);

            fetch('changeEmail.php', {
                method: 'POST',
                body: formData4
            })
            .then(response => response.json())
            .then(data => alert(data.message))
            .catch(error => console.error('Error:', error));
        } else {
            alert('Invalid email address.');
        }
    });
}
    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email.toLowerCase());
    }

    function toggleDarkMode() {
	    
	    let user = "<?php echo $username ?>";
        data[user]['points']['darkmode'] = !data[user]['points']['darkmode'];

        // Send AJAX request to update the JSON file
        const formData5 = new FormData();
        formData5.append('username', user);
        formData5.append('darkmode', data[user]['points']['darkmode']);

        fetch('changeDarkmode.php', {
            method: 'POST',
            body: formData5
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Dark mode updated successfully!');
            } else {
                throw new Error('Failed to update dark mode');
            }
        })
        .catch(error => {
            console.error('Dark mode update failed:', error);
            alert('Failed to update dark mode. Please try again.');
        });
    }
displayToggleDarkModeButton();
</script>
</div>
</div>
</div>
<?php include('../../templates/footer.php');?>
</body>
</html>
