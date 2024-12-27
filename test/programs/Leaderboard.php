<?php
// Path to the user database
$userDatabaseFile = './scripts/users.json';

// Function to get leaderboard data
function getLeaderboardData($userDatabaseFile) {
    if (!file_exists($userDatabaseFile)) {
        return [];
    }

    $userDatabase = json_decode(file_get_contents($userDatabaseFile), true);

    // Extract users and their scores into an array for sorting
    $leaderboard = [];
    foreach ($userDatabase as $name => $data) {
        $leaderboard[] = ['name' => $name, 'score' => $data['score']];
    }

    // Sort users by their scores in descending order
    usort($leaderboard, function ($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    return $leaderboard;
}

// Return leaderboard data if this is an AJAX request
if (isset($_GET['ajax'])) {
    echo json_encode(getLeaderboardData($userDatabaseFile));
    exit;
}

// For initial rendering
$leaderboard = getLeaderboardData($userDatabaseFile);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #ecf0f1;
            color: #2c3e50;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #34495e;
            color: #ecf0f1;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Leaderboard</h1>
    <table id="leaderboard-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            foreach ($leaderboard as $entry) {
                echo "<tr>
                        <td>{$rank}</td>
                        <td>{$entry['name']}</td>
                        <td>{$entry['score']}</td>
                      </tr>";
                $rank++;
            }
            ?>
        </tbody>
    </table>
    <script>
        function updateLeaderboard() {
            fetch('Leaderboard.php?ajax=1')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#leaderboard-table tbody');
                    tbody.innerHTML = ''; // Clear the existing rows

                    // Populate the leaderboard with new data
                    data.forEach((entry, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${entry.name}</td>
                            <td>${entry.score}</td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error updating leaderboard:', error));
        }

        // Update leaderboard every 10 seconds
        setInterval(updateLeaderboard, 10000);
    </script>
</body>
</html>

