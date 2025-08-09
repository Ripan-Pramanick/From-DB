<?php
// This block handles the form submission for searching a user.
// We initialize $row and $error_message to avoid errors on the first page load.
$row = null;
$error_message = '';

// Check if the form was submitted via POST and the search button was clicked.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_action'])) {
    // Include your database configuration file.
    // Make sure the path to 'config.php' is correct.
    include 'config.php'; 

    // Get the ID from the search input.
    // It's good practice to ensure it's an integer.
    $reg_id = filter_input(INPUT_POST, 'search_id', FILTER_SANITIZE_NUMBER_INT);

    if ($reg_id) {
        // Prepare the SQL statement to prevent SQL injection.
        $stmt = $conn->prepare("SELECT * FROM registration WHERE id = ?");
        $stmt->bind_param("i", $reg_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            // Fetch the user data into the $row variable.
            $row = $result->fetch_assoc();
        } else {
            // Set an error message if no user was found.
            $error_message = "No user found with ID: " . htmlspecialchars($reg_id);
        }
        $stmt->close();
        $conn->close();
    } else {
        $error_message = "Please enter a valid ID.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Base font settings */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb; /* bg-gray-50 */
        }
        /* Styles for input fields with icons */
        .input-group {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 0;
            top: 0;
            padding: 0.75rem; /* 12px */
            margin-top: 0.5rem; /* mt-2 */
            pointer-events: none;
            color: #9ca3af; /* text-gray-400 */
        }
        .input-field {
            padding-left: 2.5rem; /* pl-10 */
        }
        .input-icon.top-6 {
             top: 0.5rem; /* 8px */
        }
    </style>
</head>
<body class="min-h-screen">

    <?php 
    // Include your navigation bar.
    // Make sure the path to 'navbar.php' is correct.
    include 'navbar.php'; 
    ?>

    <div class="container mx-auto px-4 py-10">
        <h1 class="text-center text-3xl text-gray-800 font-bold mb-8">Update User Data</h1>

        <!-- Search Form -->
        <div class="w-full max-w-md mx-auto mb-12">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input 
                    id="searchInput"
                    name="search_id"
                    type="search" 
                    placeholder="Search for user by ID..." 
                    class="w-full pl-10 pr-24 py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    value="<?php echo isset($_POST['search_id']) ? htmlspecialchars($_POST['search_id']) : ''; ?>"
                >
                <button 
                    type="submit" 
                    name="search_action"
                    class="absolute inset-y-0 right-0 flex items-center justify-center px-5 m-1.5 bg-blue-600 text-white rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
                >
                    Search
                </button>
            </form>
            <?php if ($error_message): ?>
                <p class="mt-4 text-center text-red-600"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>

        <!-- This PHP block checks if a user was found and displays the update form -->
        <?php if ($row): ?>
        <div class="w-full max-w-2xl p-8 mx-auto space-y-6 bg-white rounded-2xl shadow-lg">
            <h2 class="text-center text-2xl font-bold text-gray-700">Editing Profile for <?php echo htmlspecialchars($row['fname']) . ' ' . htmlspecialchars($row['lname']); ?></h2>
            <form class="space-y-6" action="update-config.php" method="POST">
                <!-- Hidden ID field to identify the user -->
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="input-group">
                        <label for="first-name" class="sr-only">First Name</label>
                        <div class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                        </div>
                        <input id="first-name" name="first-name" type="text" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" value="<?php echo htmlspecialchars($row['fname']); ?>">
                    </div>
                    <div class="input-group">
                        <label for="last-name" class="sr-only">Last Name</label>
                        <div class="input-icon">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                        </div>
                        <input id="last-name" name="last-name" type="text" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" value="<?php echo htmlspecialchars($row['lname']); ?>">
                    </div>
                </div>

                <!-- Email and Phone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="input-group">
                        <label for="email" class="sr-only">Email address</label>
                        <div class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" value="<?php echo htmlspecialchars($row['email']); ?>">
                    </div>
                    <div class="input-group">
                        <label for="phone" class="sr-only">Phone Number</label>
                        <div class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                        </div>
                        <input id="phone" name="phone" type="tel" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" value="<?php echo htmlspecialchars($row['phone']); ?>">
                    </div>
                </div>

                <!-- Age and Gender -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="input-group">
                        <label for="age" class="sr-only">Age</label>
                        <div class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                        </div>
                        <input id="age" name="age" type="number" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" value="<?php echo htmlspecialchars($row['age']); ?>">
                    </div>
                    <div class="input-group">
                        <label for="gender" class="sr-only">Gender</label>
                        <select id="gender" name="gender" required class="w-full px-4 py-3 mt-2 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled>Select your gender</option>
                            <option value="male" <?php if($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
                            <option value="female" <?php if($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
                            <option value="other" <?php if($row['gender'] == 'other') echo 'selected'; ?>>Other</option>
                            <option value="prefer-not-to-say" <?php if($row['gender'] == 'prefer-not-to-say') echo 'selected'; ?>>Prefer not to say</option>
                        </select>
                    </div>
                </div>

                <!-- Address Textarea -->
                <div class="input-group">
                    <label for="address" class="sr-only">Address</label>
                    <div class="input-icon top-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                    </div>
                    <textarea id="address" name="address" rows="3" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field"><?php echo htmlspecialchars($row['address']); ?></textarea>
                </div>

                <!-- Password Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="input-group">
                        <label for="password" class="sr-only">New Password</label>
                        <div class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="new-password" class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="New Password (optional)">
                    </div>
                    <div class="input-group">
                        <label for="confirm-password" class="sr-only">Confirm New Password</label>
                         <div class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                        </div>
                        <input id="confirm-password" name="confirm_password" type="password" autocomplete="new-password" class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="Confirm New Password">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" name="update" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:scale-105">
                        Update Account
                    </button>
                </div>
            </form>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
