
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-container {
            width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        input, textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
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
        img {
            display: block;
            margin: 10px auto;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h3>Edit Movie</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" value="<?php echo htmlspecialchars($movie['title'], ENT_QUOTES); ?>" required>
            <input type="text" name="genre" value="<?php echo htmlspecialchars($movie['genre'], ENT_QUOTES); ?>" required>
            <input type="text" name="director" value="<?php echo htmlspecialchars($movie['director'], ENT_QUOTES); ?>" required>
            <input type="date" name="release_date" value="<?php echo htmlspecialchars($movie['release_date'], ENT_QUOTES); ?>" required>
            <input type="text" name="duration" value="<?php echo htmlspecialchars($movie['duration'], ENT_QUOTES); ?>" placeholder="Duration (e.g., 120 minutes)" required>
            <textarea name="synopsis" placeholder="Synopsis" required><?php echo htmlspecialchars($movie['synopsis'], ENT_QUOTES); ?></textarea>

            <!-- Tampilkan poster lama -->
            <img src="<?php echo htmlspecialchars($movie['poster_url'], ENT_QUOTES); ?>" alt="Current Poster">

            <!-- Input untuk upload poster baru -->
            <input type="file" name="poster" accept="image/*">

            <button type="submit">Update Movie</button>
        </form>
    </div>
</body>
</html>

<?php
?>
