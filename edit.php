<?php include("navbar.php"); ?>

<?php
include 'config.php';

$my_id = $_GET['id'];
$sql = "SELECT * FROM registration WHERE id = '$my_id'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$row = mysqli_fetch_array($result);

?>

 <div class="w-full max-w-2xl p-8 space-y-6 bg-white rounded-xl shadow-lg">
        
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Edit Your Account</h1>
            <p class="mt-2 text-sm text-gray-600">
                Please update & fill in the details below to register.
            </p>
        </div>

        <!-- Form -->
        <form class="space-y-6" action="#" method="POST">
            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first-name" class="text-sm font-medium text-gray-700">First Name</label>
                    <input id="first-name" name="first-name" type="text" value="<?php echo htmlentities($row['fname']); ?>" required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="John">
                </div>
                <div>
                    <label for="last-name" class="text-sm font-medium text-gray-700">Last Name</label>
                    <input id="last-name" name="last-name" type="text" value="<?php echo htmlentities($row['lname']); ?>" required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="Doe">
                </div>
            </div>

            <!-- Email and Phone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="text-sm font-medium text-gray-700">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" value="<?php echo htmlentities($row['email']); ?>"required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="you@example.com">
                </div>
                <div>
                    <label for="phone" class="text-sm font-medium text-gray-700">Phone Number</label>
                    <input id="phone" name="phone" type="tel" value="<?php echo htmlentities($row['phone']); ?>"required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="+1 (555) 123-4567">
                </div>
                <div>
                    <label for="age" class="text-sm font-medium text-gray-700">Age</label>
                    <input id="age" name="age" value="<?php echo htmlentities($row['age']); ?>" required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="001">
                </div>
            </div>

            <!-- Gender Select -->
            <div>
                <label for="gender" class="text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" name="gender" required
                        class="w-full px-4 py-2 mt-2 text-base text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out">
                    <option value="" disabled selected>Select your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                    <option value="prefer-not-to-say">Prefer not to say</option>
                </select>
            </div>

            <!-- Address Textarea -->
            <div>
                <label for="address" class="text-sm font-medium text-gray-700">Address</label>
                <textarea id="address" name="address" rows="3" required
                          class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                          placeholder="123 Main St, Anytown, USA">
                        <?php  echo htmlentities($row['address']); ?></textarea>
            </div>

            <!-- Password Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" value="<?php echo htmlentities($row['fname']); ?>"required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="••••••••">
                </div>
                <div>
                    <label for="confirm-password" class="text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="confirm-password" name="password" type="password" autocomplete="new-password" value="<?php echo htmlentities($row['fname']); ?>"required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="••••••••">
                </div>
            </div>

            <!-- Terms of Service Checkbox -->
            <div class="flex items-center">
                <input id="terms" name="terms" type="checkbox" required
                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="terms" class="ml-2 block text-sm text-gray-900">
                    I agree to the <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Terms and Conditions</a>
                </label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                    Update
                </button>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Go Back -- 
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Back
                </a>
            </p>
        </div>

    </div>
</body>
</html>