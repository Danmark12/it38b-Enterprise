<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - MF Clinic</title>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
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
            color: #008080;
        }

        .logo span:last-child {
            color: #000;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            margin-left: auto;
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
            color: #008080;
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
            border: 1px solid #008080;
            background-color: #fff;
            transition: background-color 0.3s ease;
            color: #008080;
        }

        .auth-buttons a:hover {
            background-color: #e0f7fa;
        }

        .auth-buttons .signup-button {
            background-color: #008080;
            color: #fff;
            border: none;
        }

        .auth-buttons .signup-button:hover {
            background-color: #006666;
        }

        main {
            padding: 60px 30px;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-container {
            background-color: #00bcd4; /* Teal background for the contact box */
            color: #fff;
            padding: 30px;
            border-radius: 10px;
            max-width: 900px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .contact-info {
            flex: 1;
            padding-right: 20px;
        }

        .contact-info h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .contact-info p {
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .contact-details p {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .contact-details svg {
            margin-right: 10px;
            width: 20px;
            height: 20px;
            fill: #fff;
        }

        .map-container {
            flex: 1;
            border-radius: 5px;
            overflow: hidden;
            max-height: 250px; /* Adjust as needed */
            width: 100%;
            display: flex; /* Added to make the anchor work */
        }

        .map-container a {
            display: block;  /* Make the anchor fill the container */
            width: 100%;
            height: 100%;
        }

        .map-container img {
            display: block; /* Prevent extra space below image */
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure image covers the container */
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f0f0f0;
            color: #777;
            font-size: 0.9em;
            margin-top: 20px;
        }

        /* Icons */
        .icon-phone {
            /* Style for phone icon */
        }

        .icon-facebook {
            /* Style for Facebook icon */
        }

        .icon-mail {
            /* Style for email icon */
        }

        .icon-website {
            /* Style for website icon */
        }

        .icon-location {
            /* Style for location icon */
        }

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

            .auth-buttons a {
                margin-left: 0;
                margin-top: 10px;
            }

            main {
                padding: 30px 20px;
            }

            .contact-container {
                flex-direction: column;
                align-items: stretch;
            }

            .contact-info {
                padding-right: 0;
                margin-bottom: 20px;
            }

            .map-container {
                max-height: none;
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

    <main>
        <div class="contact-container">
            <div class="contact-info">
                <h1>Contact</h1>
                <p>Feel free to contact us at your clinic</p>
                <div class="contact-details">
                    <p>
                        <svg viewBox="0 0 24 24" class="icon-phone"><path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.51 5.09 6.21 6.21l1.77-1.77c.32-.32.69-.5.92-.5h3c.55 0 1 .45 1 1v3c0 .55-.45 1-1 1H5c-.55 0-1-.45-1-1V5c0-.55.45-1 1-1h3c.23 0 .4.18.5.4l1.77 1.77c-.22.23-.4.6-.5 1.04L6.62 10.79z"/></svg>
                        09758375471
                    </p>
                    <p>
                        <svg viewBox="0 0 24 24" class="icon-facebook"><path fill="currentColor" d="M12 2.04c5.51 0 10 4.49 10 10s-4.49 10-10 10S2 17.51 2 12 6.49 2.04 12 2.04m0 2.06c-4.34 0-7.9 3.56-7.9 7.9s3.56 7.9 7.9 7.9 7.9-3.56 7.9-7.9-3.56-7.9-7.9-7.9M12 10v2h2v-2h-2m-2 0h2v2H10v-2"/></svg>
                        MF Clinic
                    </p>
                    <p>
                        <svg viewBox="0 0 24 24" class="icon-mail"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-5L4 6h16l-8 7z"/></svg>
                        MFClinic@gmail.com
                    </p>
                    <p>
                        <svg viewBox="0 0 24 24" class="icon-website"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2m6 14.08L16.08 16c-.76 1.1-1.9 1.9-3.3 2.4V12c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v6.4c-1.4-.5-2.54-1.3-3.3-2.4L6 16.08C4.92 14.96 4 13.5 4 12c0-4.42 3.58-8 8-8s8 3.58 8 8c0 1.5-.92 2.96-2 4.08M12 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        MF Clinicatyourservice.com
                    </p>
                    <p>
                        <svg viewBox="0 0 24 24" class="icon-location"><path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 1.42.4 2.73 1.04 3.8L12 22.95l5.96-10.15c.64-1.07 1.04-2.38 1.04-3.8 0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        Tankulan, Manolo Fortich, Bukidnon Philippines
                    </p>
                </div>
            </div>
            <div class="map-container">
                 <a href="https://www.bing.com/th/id/OIP.TPA-WnF3J2R-0SM5CemfvgHaEl?w=159&h=185&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" target="_blank">
                    <img src="image/MF.png" alt="Map of MF Clinic Location">
                 </a>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2025 MF CLINIC. All rights reserved.</p>
    </footer>
</body>
</html>
