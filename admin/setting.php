<!DOCTYPE html> bokep tayo
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Settings</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="flex min-h-screen">

    <main class="flex-1 p-8">
      <section class="bg-white p-6 rounded-xl shadow-sm border">
        <h2 class="text-xl font-semibold mb-4">Setting</h2>

        <div class="flex items-center space-x-4 mb-6">
        <div class="avatar avatar-online">
  <div class="w-24 rounded-full">
    <img src="../asset/sizu.jpeg" />
  </div>
</div>
        <div class="space-x-2">
            <button onclick="my_modal_3.showModal()" class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">+ Change Image</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">Remove Image</button>
        </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div>
            <label class="block text-sm font-medium mb-1">First Name</label>
            <input type="text" value="Mipan" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Last Name</label>
            <input type="text" value="Zuzuzu" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200">
        </div>
        </div>

        <h2 class="text-lg font-semibold mb-3">Account</h2>

        <div class="space-y-4 mb-8">
        <div class="flex items-center justify-between">
            <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" value="Mipan00@gmail.com" disabled class="border rounded-lg px-3 py-2 bg-gray-100 w-64">
            </div>
            <button onclick="my_modal_1.showModal()" class="px-3 py-2 border rounded-lg hover:bg-gray-100">Change email</button>
        </div>
        <div class="flex items-center justify-between">
            <div>
              <label class="block text-sm font-medium mb-1">Password</label>
              <input type="password" value="********" disabled class="border rounded-lg px-3 py-2 bg-gray-100 w-64">
            </div>
            <button class="px-3 py-2 border rounded-lg hover:bg-gray-100">Change password</button>
          </div>
          <div class="flex items-center justify-between">
            <p class="text-sm text-gray-600">2-Step Verifications</p>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:bg-black"></div>
              <span class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-5"></span>
            </label>
          </div>
        </div>

        <h2 class="text-lg font-semibold mb-3">Support Access</h2>

        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <p class="text-sm text-gray-600">Support access is currently granted.</p>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" checked class="sr-only peer">
              <div class="w-11 h-6 bg-black peer-focus:outline-none rounded-full peer peer-checked:bg-black"></div>
              <span class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-5"></span>
            </label>
          </div>
          <a href="../logout.php" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Log out</a>
          <button class="px-4 py-2 text-red-600 hover:underline">Delete my account</button>
        </div>
      </section>
    </main>
  </div>
  <dialog id="my_modal_3" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold">Sorry /:</h3>
    <p class="py-4">For now this site can't use that</p>
  </div>
</dialog>

<dialog id="my_modal_1" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Error</h3>
    <p class="py-4">You must logout for that</p>
    <div class="modal-action">
      <form method="dialog">
        <a href="../logout.php" class="btn btn-outline btn-error">Logout</a>
        <button class="btn">Close</button>
      </form>
    </div>
  </div>
</dialog>
</body>
</html>