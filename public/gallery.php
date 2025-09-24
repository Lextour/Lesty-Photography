<?php
$year = date("Y");
$galleryPath = __DIR__ . "/images/gallery/";
$images = glob($galleryPath . "*.{jpg,png,jpeg}", GLOB_BRACE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesty - Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #000; color: #e6e6e6; }
        header { background: #011d11; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; }
        header h1 { color: #00cc66; margin: 0; }
        nav a { margin: 0 12px; color: #e6e6e6; text-decoration: none; }
        nav a:hover { color: #00cc66; }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            padding: 40px;
        }
        .gallery img {
            width: 100%;
            border-radius: 10px;
            border: 2px solid #013220;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(0,0,0,0.7);
        }
        footer { text-align: center; padding: 20px; background: #011d11; color: #999; }
    </style>
</head>
<body>
    <header>
        <h1>Gallery</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="gallery.php">Gallery</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <section class="gallery">
        <?php foreach ($images as $img): ?>
            <img src="images/gallery/<?= basename($img) ?>" alt="Photo">
        <?php endforeach; ?>
    </section>

    <footer>
        &copy; <?= $year ?> Lesty Photography. All rights reserved.
    </footer>
</body>
</html>
