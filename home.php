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

   <div class="overflow-x-auto rounded-lg shadow">
            <table class="w-full text-sm text-left text-gray-500">
                <!-- Table Header -->
                <thead class="bg-gray-200 text-xs text-center text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
        
                        <th scope="col" class="px-6 py-3">Age</th>
                        <th scope="col" class="px-6 py-3">Gender</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Address</th>
                        <th scope="col" class="px-6 py-3">Password</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>

        <?php
        while ($data = mysqli_fetch_array($result)) {
            ?>
            <tbody>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><?php echo htmlspecialchars($data['fname']." ".$data['lname']); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($data['age']); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($data['gender']); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($data['email']); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($data['phone']); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($data['address']); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($data['password']); ?></td>
                        <td class="px-6 py-4">
                            <a href="edit.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="text-blue-600 hover:underline">Edit</a>
                            <a href="delete.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="text-red-600 hover:underline ml-4">Delete</a>
                        </td>
                    </tr>
            </tbody>
            <?php
        }
        ?>
    </table>


    <?php
} else {
    echo "table not found";
}
?>