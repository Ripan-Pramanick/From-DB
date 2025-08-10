<?php 
// It's good practice to include files at the top.
include 'navbar.php';
include 'config.php'; // Include config once at the top.

// Initialize variables to hold user data and messages.
$row = null;
$feedback_message = '';
$message_type = ''; // 'success' or 'error'

// --- ACTION 1: HANDLE DELETE REQUEST ---
// This block runs ONLY when the "Delete Account" button is clicked from the user data form.
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_action'])) {
    
    $id_to_delete = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if ($id_to_delete) {
        // Prepare and execute the DELETE statement.
        $stmt = $conn->prepare("DELETE FROM `registration` WHERE id = ?");
        $stmt->bind_param("i", $id_to_delete);
        
        if ($stmt->execute()) {
            // Check if any row was actually deleted.
            if ($stmt->affected_rows > 0) {
                $feedback_message = "User with ID #{$id_to_delete} has been deleted successfully.";
                $message_type = 'success';
            } else {
                $feedback_message = "Could not delete user. Record with ID #{$id_to_delete} not found.";
                $message_type = 'error';
            }
        } else {
            $feedback_message = "Error executing deletion: " . $stmt->error;
            $message_type = 'error';
        }
        $stmt->close();
    }
} 
// --- ACTION 2: HANDLE SEARCH REQUEST ---
// This block runs ONLY when the search form is submitted.
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search_action'])) {
    
    $search_id = filter_input(INPUT_POST, 'search_id', FILTER_SANITIZE_NUMBER_INT);

    if ($search_id) {
        // Prepare and execute the SELECT statement to find the user.
        $stmt = $conn->prepare("SELECT * FROM `registration` WHERE id = ?");
        $stmt->bind_param("i", $search_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            // If found, fetch the user data to display in the form.
            $row = $result->fetch_assoc();
        } else {
            $feedback_message = "No record found for ID: {$search_id}";
            $message_type = 'error';
        }
        $stmt->close();
    } else {
        $feedback_message = "Please enter a valid ID to search.";
        $message_type = 'error';
    }
}

// Close the connection after all operations for the request are done.
$conn->close();
?>

<div class="container mx-auto px-4 py-10">
    <h1 class="text-center text-3xl text-gray-800 font-bold mb-8">Manage User Data</h1>

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
        
        <!-- Feedback Message Display -->
        <?php if ($feedback_message): ?>
            <?php 
                // Determine message color based on success or error
                $color_class = ($message_type === 'success') ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100';
            ?>
            <p class="mt-4 text-center p-3 rounded-lg <?php echo $color_class; ?>">
                <?php echo $feedback_message; ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- This block displays the form ONLY if a user was successfully found -->
    <?php if ($row): ?>
    <div class="w-full max-w-2xl p-8 mx-auto space-y-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-center text-2xl font-bold text-gray-700">Editing Profile for <?php echo htmlspecialchars($row['fname']) . ' ' . htmlspecialchars($row['lname']); ?> (ID: <?php echo $row['id']; ?>)</h2>
        
        <!-- The form now submits to update-config.php for updates -->
        <form class="space-y-6" action="update-config.php" method="POST">
            <!-- Hidden ID field is crucial for both update and delete actions -->
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <!-- All form fields remain the same -->
            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first-name" class="block text-sm font-medium text-gray-600 mb-1">First Name</label>
                    <input id="first-name" name="first-name" type="text" required class="w-full px-4 py-2 text-gray-700 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" value="<?php echo htmlspecialchars($row['fname']); ?>">
                </div>
                <div>
                    <label for="last-name" class="block text-sm font-medium text-gray-600 mb-1">Last Name</label>
                    <input id="last-name" name="last-name" type="text" required class="w-full px-4 py-2 text-gray-700 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" value="<?php echo htmlspecialchars($row['lname']); ?>">
                </div>
            </div>
            <!-- ... other fields like email, phone, age, etc. go here ... -->
            <!-- For brevity, I'm omitting the other fields, but they should be here -->
             <!-- Email and Phone -->
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <input id="email" name="email" type="email" required class="w-full px-4 py-2 text-gray-700 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" value="<?php echo htmlspecialchars($row['email']); ?>">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-600 mb-1">Phone</label>
                    <input id="phone" name="phone" type="tel" required class="w-full px-4 py-2 text-gray-700 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" value="<?php echo htmlspecialchars($row['phone']); ?>">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row gap-4 pt-4">
                <!-- UPDATE BUTTON: Submits to update-config.php -->
                <button type="submit" name="update_action" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:scale-105">
                    Update Account
                </button>
                
                <!-- DELETE BUTTON: Submits back to this page to trigger the delete logic -->
                <button 
                    type="submit" 
                    name="delete_action" 
                    formaction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    onclick="return confirm('Are you sure you want to permanently delete this account? This action cannot be undone.');"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition transform hover:scale-105">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>

</body>
</html>
