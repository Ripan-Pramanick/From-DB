<!-- -->

<?php
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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Registration Form</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-12">

    <!-- Registration Form Container -->
    <div class="w-full max-w-2xl p-8 space-y-6 bg-white rounded-xl shadow-lg">
        
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Create Your Account</h1>
            <p class="mt-2 text-sm text-gray-600">
                Please fill in the details below to register.
            </p>
        </div>

        <!-- Form -->
        <form class="space-y-6" action="#" method="POST">
            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first-name" class="text-sm font-medium text-gray-700">First Name</label>
                    <input id="first-name" name="first-name" type="text" required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="John">
                </div>
                <div>
                    <label for="last-name" class="text-sm font-medium text-gray-700">Last Name</label>
                    <input id="last-name" name="last-name" type="text" required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="Doe">
                </div>
            </div>

            <!-- Email and Phone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="text-sm font-medium text-gray-700">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="you@example.com">
                </div>
                <div>
                    <label for="phone" class="text-sm font-medium text-gray-700">Phone Number</label>
                    <input id="phone" name="phone" type="tel" required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="+1 (555) 123-4567">
                </div>
                <div>
                    <label for="age" class="text-sm font-medium text-gray-700">Age</label>
                    <input id="age" name="age" required
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
                          placeholder="123 Main St, Anytown, USA"></textarea>
            </div>

            <!-- Password Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                           class="w-full px-4 py-2 mt-2 text-base text-gray-700 placeholder-gray-500 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 ease-in-out"
                           placeholder="••••••••">
                </div>
                <div>
                    <label for="confirm-password" class="text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="confirm-password" name="password" type="password" autocomplete="new-password" required
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
                    Register
                </button>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Sign in
                </a>
            </p>
        </div>

    </div>

</body>
</html>
