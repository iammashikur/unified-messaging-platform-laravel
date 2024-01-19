<x-app-layout>

    <!-- Inspired by slack ui clone https://tailwindcomponents.com/component/slack-clone-1 -->
    <div class="bg-gray-800 text-purple-lighter flex-none w-64 pb-6 hidden md:block">
        <div class="text-white mb-2 mt-3 px-4 flex justify-between border-b border-gray-600 py-1 shadow-xl">
            <div class="flex-auto">
                <h1 class="font-semibold text-xl leading-tight mb-1 truncate">My Server</h1>
            </div>
            <div>
                <svg class="arrow-gKvcEx icon-2yIBmh opacity-50 cursor-pointer" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.59 8.59004L12 13.17L7.41 8.59004L6 10L12 16L18 10L16.59 8.59004Z">
                    </path>
                </svg>
            </div>
        </div>
        <div class="mb-8">
            <div class="px-4 mb-2 text-white flex justify-between items-center">
                <div class="opacity-75 cursor-pointer">GENERAL</div>
                <div>
                    <svg class="fill-current h-5 w-5 opacity-50 cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" />
                    </svg>
                </div>
            </div>
            <div class="bg-teal-dark cursor-pointer font-semibold py-1 px-4 text-gray-300">#
                general</div>
        </div>
        <div class="mb-8">
            <div class="px-4 mb-2 text-white flex justify-between items-center">
                <div class="opacity-75 cursor-pointer">VOICE</div>
                <div>
                    <svg class="fill-current h-5 w-5 opacity-50 cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" />
                    </svg>
                </div>
            </div>
            <div class="bg-teal-dark hover:bg-gray-800 cursor-pointer font-semibold py-1 px-4 text-gray-300">
                ? General</div>
        </div>
    </div>
    <!-- Chat content -->
    <div class="flex-1 flex flex-col bg-gray-700 overflow-hidden">
        <!-- Top bar -->
        <div class="border-b border-gray-600 flex px-6 py-2 items-center flex-none shadow-xl">
            <div class="flex flex-col">
                <h3 class="text-white mb-1 font-bold text-xl text-gray-100">
                    <span class="text-gray-400">#</span> general
                </h3>
            </div>
        </div>
        <!-- Chat messages -->
        <div class="px-6 py-4 flex-1 overflow-y-scroll">
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/0.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">09:23</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/3.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">09:24</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/1.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">09:26</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/2.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">10:00</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/3.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">10:20</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/4.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">10:23</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/0.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">10:30</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/1.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">10:50</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/2.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">11:30</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/3.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">11:37</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/4.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">11:45</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/1.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">11:50</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/2.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">11:55</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/3.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">11:59</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/4.png"
                    class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">12:00</span>
                    </div>
                    <p class="text-white leading-normal">Discord is awesome!</p>
                </div>
            </div>
            <!-- A message -->
        </div>
        <div class="pb-6 px-4 flex-none">
            <div class="flex rounded-lg overflow-hidden">
                <span class="text-3xl text-grey border-r-4 border-gray-600 bg-gray-600 p-2">
                    <svg class="h-6 w-6 block bg-gray-500 hover:bg-gray-400 cursor-pointer rounded-xl"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"
                            fill="#FFFFFF" />
                    </svg>
                </span>
                <input type="text" class="w-full px-4 bg-gray-600" placeholder="Message #general" />
            </div>
        </div>
    </div>


</x-app-layout>
