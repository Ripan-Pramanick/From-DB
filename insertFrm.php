<!-- -->

<?php
include("navbar.php");
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = isset($_POST['first-name']) ? $_POST['first-name'] : '';
    $lname = isset($_POST['last-name']) ? $_POST['last-name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO `registration` (`fname`, `lname`, `email`, `phone`, `age`, `gender`, `address`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fname, $lname, $email, $phone, $age, $gender, $address, $hashed_password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

if (isset($stmt) && $stmt instanceof mysqli_stmt) {
    $stmt->close();
}
?>


    <!-- Registration Form Container -->
    <div class="w-full max-w-3xl p-8 space-y-6 form-container rounded-2xl shadow-2xl mx-auto">
        
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800">Create Your Account</h1>
            <p class="mt-3 text-md text-gray-600">
                Join us today! Please fill in the details below to get started.
            </p>
        </div>

        <!-- Form -->
        <form class="space-y-6" action="#" method="POST">
            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="input-group">
                    <label for="first-name" class="text-sm font-medium text-gray-700 sr-only">First Name</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                    </div>
                    <input id="first-name" name="first-name" type="text" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="First Name">
                </div>
                <div class="input-group">
                    <label for="last-name" class="text-sm font-medium text-gray-700 sr-only">Last Name</label>
                    <div class="input-icon">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                    </div>
                    <input id="last-name" name="last-name" type="text" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="Last Name">
                </div>
            </div>

            <!-- Email and Phone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="input-group">
                    <label for="email" class="text-sm font-medium text-gray-700 sr-only">Email address</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
                    </div>
                    <input id="email" name="email" type="email" autocomplete="email" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="you@example.com">
                </div>
                <div class="input-group">
                    <label for="phone" class="text-sm font-medium text-gray-700 sr-only">Phone Number</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                    </div>
                    <input id="phone" name="phone" type="tel" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="+1 (555) 123-4567">
                </div>
            </div>

            <!-- Age and Gender -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="input-group">
                    <label for="age" class="text-sm font-medium text-gray-700 sr-only">Age</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                    </div>
                    <input id="age" name="age" type="number" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="Age">
                </div>
                <div class="input-group">
                    <label for="gender" class="text-sm font-medium text-gray-700 sr-only">Gender</label>
                    <select id="gender" name="gender" required class="w-full px-4 py-3 mt-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out">
                        <option value="" disabled selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                        <option value="prefer-not-to-say">Prefer not to say</option>
                    </select>
                </div>
            </div>

            <!-- Address Textarea -->
            <div class="input-group">
                <label for="address" class="text-sm font-medium text-gray-700 sr-only">Address</label>
                <div class="input-icon top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                </div>
                <textarea id="address" name="address" rows="3" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="123 Main St, Anytown, USA"></textarea>
            </div>

            <!-- Password Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="input-group">
                    <label for="password" class="text-sm font-medium text-gray-700 sr-only">Password</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="••••••••">
                </div>
                <div class="input-group">
                    <label for="confirm-password" class="text-sm font-medium text-gray-700 sr-only">Confirm Password</label>
                     <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                    </div>
                    <input id="confirm-password" name="confirm_password" type="password" autocomplete="new-password" required class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-500 border border-gray-300 rounded-lg input-field" placeholder="••••••••">
                </div>
            </div>

            <!-- Terms of Service Checkbox -->
            <div class="flex items-center">
                <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="terms" class="ml-2 block text-sm text-gray-800">
                    I agree to the <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Terms and Conditions</a>
                </label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                    Register
                </button>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign in
                </a>
            </p>
        </div>
    </div>

    <script>
        // Client-side script for password confirmation
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm-password');

        function validatePassword() {
            if (passwordInput.value === '' || confirmPasswordInput.value === '') {
                confirmPasswordInput.classList.remove('password-match', 'password-mismatch');
                return;
            }
            if (passwordInput.value === confirmPasswordInput.value) {
                confirmPasswordInput.classList.add('password-match');
                confirmPasswordInput.classList.remove('password-mismatch');
            } else {
                confirmPasswordInput.classList.add('password-mismatch');
                confirmPasswordInput.classList.remove('password-match');
            }
        }

        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePassword);
    </script>

</body>
</html>
