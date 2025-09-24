<?php
$year = date("Y");
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $msg = htmlspecialchars($_POST["message"]);
    $message = "✅ Thank you, <b>$name</b>! We’ll get back to you at <b>$email</b>.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesty - Contact</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #000; color: #e6e6e6; }
        header { background: #011d11; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; }
        header h1 { color: #00cc66; margin: 0; }
        nav a { margin: 0 12px; color: #e6e6e6; text-decoration: none; }
        nav a:hover { color: #00cc66; }
        .contact {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #111;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0,0,0,0.7);
        }
        .contact h2 { color: #00cc66; text-align: center; }
        .contact label { display: block; margin-top: 15px; }
        .contact input, .contact textarea {
            width: 100%; padding: 12px; margin-top: 5px;
            border-radius: 8px; border: none; background: #222; color: #fff;
        }
        .btn {
            margin-top: 20px; padding: 14px; width: 100%;
            background: #00cc66; border: none; color: #000;
            font-weight: bold; border-radius: 30px; cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover { background: #00994d; transform: scale(1.02); }
        .success { margin-top: 20px; text-align: center; color: #00cc66; }
        footer { text-align: center; padding: 20px; background: #011d11; color: #999; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>Contact</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="gallery.php">Gallery</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <div class="contact">
        <h2>Get in Touch</h2>
        <form method="POST" action="">
            <label>Name</label>
            <input type="text" name="name" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Message</label>
            <textarea name="message" rows="5" required></textarea>
            <button class="btn" type="submit">Send Message</button>
        </form>
        <?php if ($message): ?>
            <p class="success"><?= $message ?></p>
        <?php endif; ?>
    </div>

    <footer>
        &copy; <?= $year ?> Lesty Photography. All rights reserved.
    </footer>
</body>
</html>
