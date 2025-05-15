<?php
session_start();
require '../feature/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Patient Area</title>
    <link rel="stylesheet" href="../patientcss/patient.css" />
    <style>
        /* Optional: smooth transition */
        .sidebar {
            transition: transform 0.3s ease;
        }

        .sidebar.hide {
            transform: translateX(-100%);
        }

        .main.full-width {
            width: 100%;
            margin-left: 0;
        }

        .logo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-right: 10px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar show" id="sidebar">
            <div class="logo-container">
                <div class="logo"><span>MF</span> CLINIC</div>
                <button class="close-btn" id="closeBtn">&times;</button>
            </div>

            <ul class="menu" id="sidebarMenu">
                <li class="active">
                    <a href="P_dashboard.php" data-page="P_dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="patients.php" data-page="patients.php  ">Patients</a>
                </li>
                <li>
                    <a href="appointments.php" data-page="appointments.php">Appointments</a>
                </li>
                <li>
                    <a href="medical_records.php" data-page="medical_records.php">Medical Records</a>
                </li>
            </ul>
            <div class="bottom-user">
                <div class="user-info">
                    <img src="image/user.jpg" alt="User" />
                    <div>
                        <strong><?= $_SESSION['first_name'] ?? 'User' ?></strong>
                        <p><?= ucfirst($_SESSION['user_type'] ?? 'admin') ?></p>
                    </div>
                </div>
                <a href="../feature/logout.php" class="logout-btn">Log Out</a>
            </div>
        </div>

        <div class="main" id="mainContent">
            <div class="top-bar">
                <div class="menu-section">
                    <button class="menu-toggle" id="menuToggle">
                        <span>&#9776;</span>
                    </button>
                    <div class="dashboard-title" id="pageTitle">
                        Dashboard
                    </div>
                </div>
                <div class="search-notification-section">
                    <div class="search-bar">
                        <input type="text" placeholder="Search anything..." />
                    </div>
                    <div class="notification-icon" title="Notifications">&#128276;</div>
                </div>
            </div>

            <div id="contentArea">
                <?php include 'P_dashboard.php'; ?>
            </div>

            <script>
                const menuToggle = document.getElementById("menuToggle");
                const sidebar = document.getElementById("sidebar");
                const mainContent = document.getElementById("mainContent");
                const pageTitle = document.getElementById("pageTitle");
                const sidebarMenu = document.getElementById("sidebarMenu");
                const contentArea = document.getElementById("contentArea");
                const closeBtn = document.getElementById("closeBtn");

                // Toggle sidebar on hamburger click
                menuToggle.addEventListener("click", () => {
                    sidebar.classList.add("show");
                    sidebar.classList.remove("hide");
                    mainContent.classList.remove("full-width");
                });

                // Close sidebar on close button click
                closeBtn.addEventListener("click", () => {
                    sidebar.classList.remove("show");
                    sidebar.classList.add("hide");
                    mainContent.classList.add("full-width");
                });

                // Dynamic page loading
                sidebarMenu.addEventListener("click", (event) => {
                    if (event.target.tagName === 'A') {
                        event.preventDefault();
                        const pageUrl = event.target.getAttribute('href');
                        const pageName = event.target.getAttribute('data-page').replace('.php', '').replace(/_/g, ' ');
                        const titleText = pageName.charAt(0).toUpperCase() + pageName.slice(1);

                        fetch(pageUrl)
                            .then(response => response.text())
                            .then(data => {
                                contentArea.innerHTML = data;
                                pageTitle.textContent = titleText;

                                document.querySelectorAll('#sidebarMenu li').forEach(li => {
                                    li.classList.remove('active');
                                });
                                event.target.parentNode.classList.add('active');
                            })
                            .catch(error => {
                                console.error('Error fetching page:', error);
                                contentArea.innerHTML = '<p>Failed to load content.</p>';
                            });
                    }
                });
            </script>
        </div>
    </div>
</body>
</html>
