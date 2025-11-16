<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f5f0e8] flex items-center justify-center px-4">

    <div class="bg-white shadow-xl rounded-[30px] p-10 w-full max-w-lg">

        <h1 class="text-3xl font-semibold text-center">Admin Login</h1>
        <p class="text-center text-gray-500 mt-1 text-sm">
            Silahkan masuk ke akun admin anda
        </p>

        <form action="prosesloginAdmin.php" method="POST" class="mt-8">

            <div class="mb-4">
                <label class="text-sm font-medium">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    required
                    class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-black outline-none"
                    placeholder=" username input">
            </div>

            <div class="mb-4">
                <label class="text-sm font-medium">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required
                    class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-black outline-none"
                    placeholder=" Password input">
            </div>

            <p class="text-sm text-gray-500 mb-4">Lupa password atau tidak bisa login?</p>

            <button 
                type="submit"
                class="w-full bg-[#f8b863] hover:bg-[#e5a657] transition text-black font-semibold py-3 rounded-lg">
                Sign In
            </button>
        </form>

        <p class="text-center text-gray-500 text-sm mt-8">
            Lupa Password <span class="font-semibold text-black">Hubungi Admin</span>
        </p>

    </div>

</body>
</html>
