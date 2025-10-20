<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home/Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

   <section class="min-h-screen flex flex-col items-center p-4 md:p-6">

  <div class="w-full max-w-5xl flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
      <h1 class="text-2xl md:text-3xl font-bold flex items-center gap-2">
        <span id="name"></span>
        <span class="text-2xl">
          <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Hand%20gestures/Waving%20Hand.png" width="50" height="50" alt="hand">
        </span>
      </h1>
      <p class="text-gray-600 text-sm md:text-base">Dashboard Admin SSRI</p>
    </div>
    <button class="w-full sm:w-auto bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 text-center flex items-center gap-2">
      <i class='bx bx-user'></i> User Profile
    </button>
  </div>

  <div id="weather" class="w-full max-w-5xl bg-white rounded-xl shadow p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-8">
    <div class="flex items-center gap-3">
      <div>
        <i class='bx bx-cloud text-5xl'></i>
      </div>
      <div>
        <h2 class="text-lg font-semibold text-gray-800">Denpasar, Bali</h2>
        <p id="weather-description" class="text-gray-500 text-sm">Loading...</p>
      </div>
    </div>
    <div class="text-2xl font-bold text-gray-800" id="weather-temp">--°C</div>
  </div>

  <div class="w-full max-w-5xl mb-8">
    <h2 class="text-lg font-semibold mb-3 text-gray-800">Important Actions (2)</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

      <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center gap-3">
          <div class="bg-red-100 text-red-600 p-2 rounded-lg">
            <i class='bx bx-error text-xl'></i>
          </div>
          <div class="text-sm sm:text-base">
            <p class="font-medium text-gray-800">Solve issue with: EIN Order</p>
            <p class="text-gray-500 text-xs sm:text-sm">2 days ago</p>
          </div>
        </div>
          <i class='bx bx-chevron-right text-lg'></i>
      </div>

      <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center gap-3">
          <div class="bg-orange-100 text-orange-600 p-2 rounded-lg">
            <i class='bx bx-calendar-event text-xl'></i>
          </div>
          <div class="text-sm sm:text-base">
            <p class="font-medium text-gray-800">File Annual Report</p>
            <p class="text-gray-500 text-xs sm:text-sm">due in 15 days</p>
          </div>
        </div>
          <i class='bx bx-chevron-right text-lg'></i>
      </div>
    </div>
  </div>

<div class="w-full max-w-5xl bg-white rounded-xl shadow p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-8">
  <div class="flex items-center gap-3">
    <div class="bg-green-100 text-green-600 p-3 rounded-lg">
      <i class='bx bx-dollar text-3xl'></i>
    </div>
    <div>
      <h2 class="text-lg font-semibold text-gray-800">Kurs USD ➝ IDR</h2>
      <p id="currency-description" class="text-gray-500 text-sm">Loading...</p>
    </div>
  </div>
  <div id="currency-rate" class="text-2xl font-bold text-gray-800">--</div>
</div>

  <div class="w-full max-w-5xl bg-white rounded-xl shadow p-5 overflow-x-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
      <h2 class="font-semibold text-gray-800 text-lg">Mailroom</h2>
      <div class="flex flex-wrap items-center gap-2">
        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Virtual Address</span>
        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">Registered Agent</span>
        <button class="p-2 rounded-lg hover:bg-gray-100">
          <i class='bx bx-cog text-xl'></i>
        </button>
      </div>
    </div>

    <div class="divide-y divide-gray-200 min-w-[320px]">

      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center py-4 gap-2">
        <div class="flex flex-wrap items-center gap-3">
          <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Virtual Address</span>
          <p class="text-gray-800">State Notification</p>
        </div>
        <div class="flex items-center gap-2 text-gray-500 ml-auto">
          <button class="p-2 rounded hover:bg-gray-100">
            <i class='bx bx-trash text-lg'></i>
          </button>
          <button class="p-2 rounded hover:bg-gray-100">
            <i class='bx bx-download text-lg'></i>
          </button>
          <button class="p-2 rounded hover:bg-gray-100">
            <i class='bx bx-share text-lg'></i>
          </button>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center py-4 gap-2">
        <div class="flex flex-wrap items-center gap-3">
          <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Virtual Address</span>
          <p class="text-gray-800">State Notification</p>
        </div>
        <p class="text-gray-500 text-sm ml-auto">Yesterday</p>
      </div>
    </div>
  </div>
</section>

<script src="dashboard.js"></script>
</body>
</html>
