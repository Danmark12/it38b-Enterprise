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
        /* Your existing styles */
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar show" id="sidebar">
            <button class="close-btn" id="closeBtn" style="display: none;">&times;</button> <div class="logo"><span>MF</span> CLINIC</div>
            <ul class="menu" id="sidebarMenu">
                <li class="active">
                    <a href="P_dashboard.php" data-page="P_dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="appointments.php" data-page="appointments.php">Appointments</a>
                </li>
                <li>
                    <a href="medical_records.php" data-page="medical_records.php">Medical records</a>
                </li>
                <li>
                    <a href="billing_records.php" data-page="billing_records.php">Billing Records</a>
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
                        Dashboard </div>
                </div>
                <div class="search-notification-section">
                    <div class="search-bar">
                        <input type="text" placeholder="Search anything..." />
                    </div>
                    <div class="notification-icon" title="Notifications">&#128276;</div>
                </div>
            </div>

            <div id="contentArea">
                <?php include 'P_dashboard.php'; ?> </div>

            <script>
                const menuToggle = document.getElementById("menuToggle");
                const sidebar = document.getElementById("sidebar");
                const mainContent = document.getElementById("mainContent");
                const pageTitle = document.getElementById("pageTitle");
                const sidebarMenu = document.getElementById("sidebarMenu");
                const contentArea = document.getElementById("contentArea");

                // Initially set the sidebar to be always visible and main content to not be full-width
                sidebar.classList.add("show");
                sidebar.classList.remove("hide");
                mainContent.classList.remove("full-width");

                // Hide the close button as the sidebar is always open
                const closeBtn = document.getElementById("closeBtn");
                if (closeBtn) {
                    closeBtn.style.display = 'none';
                }

                menuToggle.addEventListener("click", () => {
                    sidebar.classList.toggle("show");
                    mainContent.classList.toggle("full-width");
                });

                sidebarMenu.addEventListener("click", (event) => {
                    if (event.target.tagName === 'A') {
                        event.preventDefault(); // Prevent default link behavior

                        const pageUrl = event.target.getAttribute('href');
                        const pageName = event.target.getAttribute('data-page').replace('.php', '').replace(/_/g, ' ');
                        const titleText = pageName.charAt(0).toUpperCase() + pageName.slice(1);

                        // Fetch the content of the clicked page
                        fetch(pageUrl)
                            .then(response => response.text())
                            .then(data => {
                                contentArea.innerHTML = data;
                                pageTitle.textContent = titleText;

                                // Update active class on the clicked menu item
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