<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333; /* Dark background color for contrast */
            color: white; /* White font color */
            text-align: center;
            padding: 50px;
        }

        h1 {
            margin-top:12%;
            font-size: 2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        a {
            color: #5cb85c; /* Green color for links */
            text-decoration: none;
            font-size: 1.1em;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <h1>Thank You for Your Order!</h1>
    <p>Your order has been placed successfully. We appreciate your business!</p>
    <p style="margin-bottom:10%;"><a href="home.php">Return to Home</a></p>

    <?php include 'include/footer.php'; ?>
</body>
</html>
