<nav x-data="{ open: false, searchOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 fixed z-30 w-full">
<div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="toggleSidebar()">
          <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
              <g fill="none" fill-rule="evenodd">
                <rect width="48" height="48" rx="8" fill="none"/>
                  <rect x="6" y="6" width="36" height="36" rx="2" fill="#666666" opacity=".15"/>
                    <rect x="10" y="10" width="28" height="28" rx="1" fill="#4285F4"/>
                    <path d="M 14 22 h20 v2 h-20zM 14 26 h20 v2 h-20zM 14 30 h20 v2 h-20z" fill="#FFF"/>
            </g>
          </svg>
    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Gestiunea Facturilor</span>
</a>
        <form action="#" method="GET" class="hidden lg:block lg:pl-3.5">
          <label for="topbar-search" class="sr-only">Search</label>
          <div class="relative mt-1 lg:w-96">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" name="email" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">
          </div>
        </form>
      </div>
      <div class="flex items-center">
          <div class="hidden mr-3 -mb-1 sm:block">
          </div>
          <!-- Search mobile -->
          <button id="toggleSidebarMobileSearch" type="button" class="p-2 text-gray-500 rounded-lg lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <span class="sr-only">Search</span>
            <!-- Search icon -->
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
          </button>
          <!-- Dropdown menu -->
          <div class="z-20 z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:divide-gray-600 dark:bg-gray-700" id="notification-dropdown">
            <div class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                Notifications
            </div>
            <a href="#" class="block py-2 text-base font-normal text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
                <div class="inline-flex items-center ">
                  <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                  View all
                </div>
            </a>
          </div>
          
          <!-- Right Section -->
          <div class="flex items-center space-x-4">
            <!-- Notifications Dropdown -->
            <div x-data="{ notificationsOpen: false, notifications: ['There are no notifications at the moment.'] }" class="relative">
              <button @click="notificationsOpen = !notificationsOpen" class="flex items-center text-sm p-2 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10 2a6 6 0 00-6 6v3.586L3.293 13.293A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zm0 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                </svg>
              </button>

              <!-- Notifications Drop-down Menu -->
              <div x-show="notificationsOpen" @click.outside="notificationsOpen = false" x-transition
                class="absolute right-0 z-50 mt-2 w-48 bg-white text-gray-900 rounded shadow-lg dark:bg-gray-700 dark:text-gray-200">
                <ul class="py-2">
                  <template x-for="notification in notifications" :key="notification">
                    <li class="px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md">
                      <span x-text="notification"></span>
                    </li>
                  </template>
                </ul>
              </div>
            </div>




              <!-- Profile Dropdown -->
              <div x-data="{ profileDropdownOpen: false }" class="relative">
                  <button @click="profileDropdownOpen = !profileDropdownOpen" class="flex items-center text-sm rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                    <!-- Replace <img> with SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                      <!-- Circle for the Head -->
                      <circle cx="12" cy="8" r="4" />
                      <!-- Path for the Shoulders -->
                      <path d="M4 20c0-4 4-7 8-7s8 3 8 7H4z" />
                    </svg>

                  </button>
                  <!-- TODO: De schimbat logica pt dropdown. -->
                  <div x-show="profileDropdownOpen" @click.outside="profileDropdownOpen = false" class="absolute right-0 z-50 mt-2 w-48 bg-white rounded shadow-lg dark:bg-gray-700" style="display: none;">
                      <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200">Profile</a>
                      <form method="POST" action="{{ route('logout') }}" class="block">
                          @csrf
                          <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200">Log Out</button>
                      </form>
                  </div>
              </div>

            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-2">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const hamburgerIcon = document.getElementById('toggleSidebarMobileHamburger');
    const closeIcon = document.getElementById('toggleSidebarMobileClose');
    
    if (sidebar.classList.contains('hidden')) {
        sidebar.classList.remove('hidden');
        hamburgerIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
    } else {
        sidebar.classList.add('hidden');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    }
}
</script>