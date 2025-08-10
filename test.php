

<?php include 'navbar.php';

// Initialize variables to hold user data and messages.

if (isset($_POST['delete_action'])) {
    include 'config.php'; // Include config once at the top.
    $id = $_POST['id'];

   $sql = "DELETE FROM `registration` WHERE id = {$id}";
    $result = mysqli_query($conn, $sql);
    
   
    // Redirect to home page after deletion
   
    mysqli_close($conn);
}
?>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <input id="searchInput" name="id" type="search" placeholder="Search for user by ID..."
            class="w-full pl-10 pr-24 py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            value="<?php echo isset($_POST['search_id']) ? htmlspecialchars($_POST['search_id']) : ''; ?>">
        <button type="submit" name="delete_action"
            class="absolute inset-y-0 right-0 flex items-center justify-center px-5 m-1.5 bg-blue-600 text-white rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
            Search
        </button>
    </form>
</div>
</div>
</body>

</html>