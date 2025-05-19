<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - MF Clinic</title>
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
            align-items: flex-start; /* Changed to flex-start to align content to the left */
        }

        .about-us-content {
            max-width: 1100px;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .about-us-header {
            font-size: 2.5em;
            color: #000;
            margin-bottom: 30px;
            text-align: left;
            margin-left: 0; /* Added to ensure left alignment */
        }
        .about-us-header span{
            color:#008080
        }

        .about-us-text {
            font-size: 1.1em;
            color: #555;
            margin-bottom: 30px;
            line-height: 1.7;
            text-align: left;  /* Added to ensure left alignment */
            margin-left: 0; /* Added to ensure left alignment */
        }
        .about-us-text span{
            color:#008080;
            font-weight: bold;
        }

        .about-us-services-header {
            font-size: 2em;
            color: #000;
            margin-bottom: 20px;
            text-align: left;
            margin-left: 0; /* Added to ensure left alignment */
        }
        .about-us-services-header span{
            color: #008080;
        }

        .services-section {
            background-color: #e0f2f7;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            width: 100%;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f0f0f0;
            color: #777;
            font-size: 0.9em;
            margin-top: 20px;
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

            .about-us-content {
                text-align: center;
            }

            .about-us-header {
                font-size: 2em;
            }

            .about-us-text {
                font-size: 1em;
            }
             .about-us-services-header{
                font-size: 1.5em;
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
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="#">Log In</a>
            <a href="#" class="signup-button">Sign Up</a>
        </div>
    </header>

    <main>
        <div class="about-us-content">
            <h1 class="about-us-header"><span>About</span> Us</h1>
            <p class="about-us-text">
                <span>MF</span> Clinic offers fast, reliable, and patient-centered healthcare services using a smart system that simplifies appointments, records,
                and billing for a better clinic experience.
            </p>
            <h2 class="about-us-services-header"><span>MF</span> Clinic Services</h2>
            <div class="services-section">
                <p>Detailed information about the services offered by MF Clinic would be placed here.  This could include lists of services, descriptions of treatments, information about specialties, etc.  Since the image doesn't provide this detail, I'll leave this as a placeholder.</p>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 MF CLINIC. All rights reserved.</p>
    </footer>
</body>
</html>
