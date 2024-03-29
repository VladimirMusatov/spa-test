<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </div>


                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <dashboard-link></dashboard-link>
                    <a data-bs-toggle="modal" data-bs-target="#create_post_modal" href='#' class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        Create Post
                    </a>
                </div>
            </div>
            <login-or-register></login-or-register>
        </div>
    </div>
</nav>
