<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MF Clinic</title>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff; /* White background */
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #fff;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo span {
            font-size: 1.8em;
            font-weight: bold;
        }

        .logo span:first-child {
            color: #008080; /* Teal for "MF" */
        }

        .logo span:last-child {
            color: #000; /* Black for "CLINIC" */
        }


        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            margin-left: auto; /* Push nav to the right */
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #555;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #008080; /* Teal hover */
        }

        .auth-buttons {
            display: flex;
            align-items: center;
        }

        .auth-buttons a {
            text-decoration: none;
            color: #555;
            font-weight: bold;
            margin-left: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #008080; /* Teal border */
            background-color: #fff;
            transition: background-color 0.3s ease;
            color: #008080; /* Teal text */
        }

        .auth-buttons a:hover {
            background-color: #e0f7fa; /* Light teal hover for buttons */
        }

        .auth-buttons .signup-button {
            background-color: #008080; /* Teal sign-up button */
            color: #fff;
            border: none;
        }

        .auth-buttons .signup-button:hover {
            background-color: #006666;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 30px;
            border-radius: 10px;
            margin: 20px;
        }

        .hero-content {
            flex: 1;
            padding-right: 40px;
        }

        .hero-content h1 {
            font-size: 3.5em;
            color: #000; /* Black heading */
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .hero-content p {
            color: #008080; /* Teal tagline */
            font-size: 1.5em;
            margin-bottom: 30px;
        }

        .hero-content .book-appointment-button {
            display: inline-block;
            background-color: #000080; /* Dark blue button */
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 1.1em;
        }

        .hero-content .book-appointment-button:hover {
            background-color: #000066;
        }

        .hero-image {
            flex: 1;
            text-align: center;
        }

        .hero-image img {
            max-width: 80%;
            height: auto;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f0f0f0;
            color: #777;
            font-size: 0.9em;
            margin-top: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
            }

            .logo {
                margin-bottom: 10px;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
                margin-left: 0;
            }

            nav ul li {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .auth-buttons {
                flex-direction: column;
            }
            .auth-buttons a{
                margin-left: 0;
                margin-top: 10px;
            }

            .hero {
                flex-direction: column;
                text-align: center;
                padding: 60px 20px;
            }

            .hero-content {
                padding-right: 0;
                margin-bottom: 30px;
            }

            .hero-content h1{
                font-size: 3em;
            }
            .hero-content p{
                font-size: 1.2em;
            }

            .hero-image img {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <span>MF</span><span>CLINIC</span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about_us.php">About</a></li>
                <li><a href="contacts.php">Contact</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="feature/login.php">Log In</a>
            <a href="feature/register.php" class="signup-button">Sign Up</a>
        </div>
    </header>

    <main class="hero">
        <div class="hero-content">
            <h1>MF CLINIC</h1>
            <p>We're always ready to help you.<br>You care, we care.</p>
            <a href="#" class="book-appointment-button">Book an appointment!</a>
        </div>
        <div class="hero-image">
            <img src="image/doctor.jpg" alt="Friendly Doctor">
        </div>
    </main>

    <footer>
        <p>&copy; 2025 MF CLINIC. All rights reserved.</p>
    </footer>
</body>
</html>
