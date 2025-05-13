<?php
session_start();
require '../feature/config.php';
// It seems you're including the config twice, which is usually not necessary.
// If '../feature/config.php' contains your database connection, you can remove the line below.
    require_once __DIR__ . '/../feature/config.php';

// Assuming $conn is a PDO connection object
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT u.*, n.nurse_id FROM users u
                LEFT JOIN nurses n ON u.id = n.user_id
                WHERE u.id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Handle the case where user_id is not set in the session
    $user = null; // Or redirect to a login page
}

// Handle form submission
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which form was submitted
    if (isset($_POST['update_profile'])) {
        // Update profile information
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phoneNumber = trim($_POST['phone']);

        $updateQuery = "UPDATE users SET
                                    first_name = :first_name,
                                    last_name = :last_name,
                                    email = :email,
                                    phone_number = :phone_number
                                    WHERE id = :user_id";

        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':first_name', $firstName);
        $updateStmt->bindParam(':last_name', $lastName);
        $updateStmt->bindParam(':email', $email);
        $updateStmt->bindParam(':phone_number', $phoneNumber);
        $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_INT); // Use $userId here

        if ($updateStmt->execute()) {
            $successMessage = 'Profile updated successfully!';
            // Update session values
            $_SESSION['first_name'] = $firstName;
            $_SESSION['last_name'] = $lastName;

            // Refresh user data
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $errorMessage = 'Failed to update profile: ' . implode(":", $updateStmt->errorInfo());
        }
        $updateStmt->closeCursor(); // Fixed error on line 62
    } elseif (isset($_POST['update_password'])) {
        // Update password
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        // Verify current password
        $passwordQuery = "SELECT password_hash FROM users WHERE id = :user_id";
        $passwordStmt = $conn->prepare($passwordQuery);
        $passwordStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $passwordStmt->execute();
        $passwordResult = $passwordStmt->fetch(PDO::FETCH_ASSOC);
        $passwordStmt->closeCursor(); // Fixed error on line 75

        if ($passwordResult && !password_verify($currentPassword, $passwordResult['password_hash'])) {
            $errorMessage = 'Current password is incorrect';
        } elseif ($newPassword !== $confirmPassword) {
            $errorMessage = 'New passwords do not match';
        } else {
            // Update password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updatePassQuery = "UPDATE users SET password_hash = :hashed_password WHERE id = :user_id";
            $updatePassStmt = $conn->prepare($updatePassQuery);
            $updatePassStmt->bindParam(':hashed_password', $hashedPassword);
            $updatePassStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            if ($updatePassStmt->execute()) {
                $successMessage = 'Password updated successfully!';
            } else {
                $errorMessage = 'Failed to update password: ' . implode(":", $updatePassStmt->errorInfo());
            }
            $updatePassStmt->closeCursor(); // Fixed error on line 94
        }
    } elseif (isset($_POST['upload_avatar'])) {
        // Handle profile picture upload
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads/avatars/';

            // Create the directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Get file information
            $tmpName = $_FILES['avatar']['tmp_name'];
            $fileName = $userId . '_' . time() . '_' . basename($_FILES['avatar']['name']);
            $filePath = $uploadDir . $fileName;
            $relativeFilePath = '/uploads/avatars/' . $fileName;

            // Check if file is an image
            $imageInfo = getimagesize($tmpName);
            if ($imageInfo === false) {
                $errorMessage = 'Uploaded file is not an image';
            } else {
                // Move the uploaded file
                if (move_uploaded_file($tmpName, $filePath)) {
                    // Check if profile_image column exists in users table
                    $checkColumnQuery = "SHOW COLUMNS FROM users LIKE 'profile_image'";
                    $checkColumnResult = $conn->query($checkColumnQuery);

                    if ($checkColumnResult && $checkColumnResult->rowCount() > 0) {
                        // Column exists, proceed with update
                        $updateAvatarQuery = "UPDATE users SET profile_image = :relative_path WHERE id = :user_id";
                        $updateAvatarStmt = $conn->prepare($updateAvatarQuery);
                        $updateAvatarStmt->bindParam(':relative_path', $relativeFilePath);
                        $updateAvatarStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

                        if ($updateAvatarStmt->execute()) {
                            $successMessage = 'Profile image updated successfully!';
                            // Refresh user data
                            $stmt->execute();
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        } else {
                            $errorMessage = 'Failed to update profile image in database: ' . implode(":", $updateAvatarStmt->errorInfo());
                        }
                        $updateAvatarStmt->closeCursor(); // Fixed error on line 138
                    } else {
                        // Column doesn't exist, notify user to run the migration
                        $errorMessage = 'The profile_image column does not exist in the users table. Please run the database migration: database/migrations/add_profile_image_column.sql';
                    }
                } else {
                    $errorMessage = 'Failed to upload the image';
                }
            }
        } else {
            $errorMessage = 'Please select an image file to upload';
        }
    }
}

// The initial $stmt for fetching user data might still be open if user_id wasn't set.
// It's good practice to close it if it was prepared.
if (isset($stmt)) {
    $stmt->closeCursor(); // Fixed potential error
}
?>
    <link rel="stylesheet" href="../style/profile.css" />

<div class="container mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 border-b pb-2">User Settings</h2>

        <?php if (!empty($successMessage)): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg></div>
                    <div>
                        <p class="font-bold">Success!</p>
                        <p><?php echo $successMessage; ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                                        viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg></div>
                    <div>
                        <p class="font-bold">Error!</p>
                        <p><?php echo $errorMessage; ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <h3 class="text-lg font-semibold text-blue-700 mb-4 border-b pb-2">Profile Image</h3>
                <div class="flex flex-col items-center">
                    <div
                        class="w-40 h-40 rounded-full overflow-hidden mb-6 bg-gray-200 shadow-md border-4 border-white">
                        <?php
                        // Check if profile_image exists in the user array
                        $hasProfileImage = isset($user['profile_image']) && !empty($user['profile_image']);

                        if ($hasProfileImage):
                            ?>
                            <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image"
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-blue-100 text-blue-500">
                                <span class="material-symbols-outlined text-6xl">person</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <form method="post" enctype="multipart/form-data" class="w-full">
                        <div class="mb-4">
                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Choose
                                Image</label>
                            <input type="file" name="avatar" id="avatar" accept="image/*" class="w-full text-sm text-gray-500
                                                                  file:mr-4 file:py-2 file:px-4
                                                                  file:rounded-md file:border-0
                                                                  file:text-sm file:font-semibold
                                                                  file:bg-blue-50 file:text-blue-700
                                                                  hover:file:bg-blue-100
                                                                  cursor-pointer">
                        </div>
                        <button type="submit" name="upload_avatar"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors shadow-md">
                            Upload Image
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-2 bg-gray-50 p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <h3 class="text-lg font-semibold text-blue-700 mb-4 border-b pb-2">Profile Information</h3>
                <form method="post" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First
                                Name</label>
                            <input type="text" name="first_name" id="first_name"
                                   value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last
                                Name</label>
                            <input type="text" name="last_name" id="last_name"
                                   value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email"
                               value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" id="phone"
                               value="<?php echo htmlspecialchars($user['phone_number'] ?? ''); ?>"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <div class="pt-4">
                        <button type="submit" name="update_profile"
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-md transition-colors shadow-md">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <div class="md:col-span-3 bg-gray-50 p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <h3 class="text-lg font-semibold text-blue-700 mb-4 border-b pb-2">Change Password</h3>
                <form method="post" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current
                                Password</label>
                            <input type="password" name="current_password" id="current_password" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New
                                Password</label>
                            <input type="password" name="new_password" id="new_password" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                                New Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus
                                   focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" name="update_password"
                                class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-6 rounded-md transition-colors shadow-md">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>