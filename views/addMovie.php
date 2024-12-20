
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 32px;
            color: #333;
        }
        .addMovie-form {
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .addMovie-form input, .addMmovie-form textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .logout-btn, .back-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            background-color: #dc3545;
            color: white;
            text-align: center;
            border-radius: 4px;
            text-decoration: none;
        }
        .back-btn {
            background-color: #007bff;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Movie</h2>
        <div class="addMovie-form">
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Title" required>
                <input type="text" name="genre" placeholder="Genre" required>
                <input type="text" name="director" placeholder="Director" required>
                <input type="date" name="release_date" required>
                <input type="text" name="duration" placeholder="Duration (in minutes)" required>
                <textarea name="synopsis" placeholder="Synopsis" rows="4" required></textarea>
                <input type="file" name="poster" accept="image/*" required>
                <button type="submit">Add Movie</button>
            </form>
        </div>
        <a href="index.php?action=home" class="back-btn">Back to Movie List</a>
    </div>
</body>
</html>

<?php
?>

