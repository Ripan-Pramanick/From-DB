<?php
include("navbar.php");
?>

<!-- <h1>CRUD Data</h1> -->

<?php
include("config.php");
error_reporting(0);

$sql = "SELECT * FROM registration ";
$result = mysqli_query($conn, $sql);

$total = mysqli_num_rows($result);

if ($total != 0) {
    ?>

   <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white/80 backdrop-blur-sm border border-white/20 rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
                    <p class="mt-2 text-gray-600">View, edit, or delete user records from the database.</p>
                </div>
                <a href="insertFrm.php" class="mt-4 sm:mt-0 inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New User
                </a>
            </div>
        </div>

        <!-- Table Container -->
        <div class="bg-white/80 backdrop-blur-sm border border-white/20 rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <?php if ($total > 0): ?>
                <table class="w-full text-sm text-left text-gray-600">
                    <!-- Table Header -->
                    <thead class="bg-gray-100 text-xs text-gray-700 uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-4">Id</th>
                            <th scope="col" class="px-6 py-4">Name</th>
                            <th scope="col" class="px-6 py-4">Age</th>
                            <th scope="col" class="px-6 py-4">Gender</th>
                            <th scope="col" class="px-6 py-4">Email</th>
                            <th scope="col" class="px-6 py-4">Phone</th>
                            <th scope="col" class="px-6 py-4 min-w-[200px]">Address</th>
                            <th scope="col" class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($data = mysqli_fetch_array($result)): ?>
                        
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 font-bold"><?php echo htmlspecialchars($data['id']); ?></td>
                        
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"><?php echo htmlspecialchars($data['fname']." ".$data['lname']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($data['age']); ?></td>
                            <td class="px-6 py-4 capitalize"><?php echo htmlspecialchars($data['gender']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($data['email']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($data['phone']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($data['address']); ?></td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <a href="edit.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-yellow-500 rounded-md hover:bg-yellow-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                                    Edit
                                </a>
                                <a href="delete.php?id=<?php echo htmlspecialchars($data['id']); ?>" onclick="return confirm('Are you sure you want to delete this record?');" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <div class="text-center p-10">
                        <h3 class="text-xl font-semibold text-gray-700">No Records Found</h3>
                        <p class="text-gray-500 mt-2">There is no data to display. Try adding a new user.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php
}else {
    echo "<div class='text-center p-10'><h3 class='text-xl font-semibold text-gray-700'>No Records Found</h3><p class='text-gray-500 mt-2'>There is no data to display. Try adding a new user.</p></div>";
}
mysqli_close($conn);
?>


</body>
</html>
