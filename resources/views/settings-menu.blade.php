<div class="h-full px-3 py-4 overflow-y-auto bg-gray-800 dark:bg-gray-800 w-[300px] flex flex-col justify-between">
    <ul class="space-y-2 font-medium">




        @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
            @can('view-any', App\Models\Channel::class)
                <li>
                    <a href="{{ route('settings.channel') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700

        {{ request()->routeIs('settings.channel') ? 'bg-gray-700' : '' }}

        group">
                        <i class="fab fa-slack text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                        <span class="ms-3">Channels</span>
                    </a>
                </li>
            @endcan

            @can('view-any', App\Models\User::class)
                <li>
                    <a href="{{ route('users.index') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700

             {{ request()->routeIs('users.index') ? 'bg-gray-700' : '' }}
         group">
                        <i class="fas fa-user-tag text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                        <span class="ms-3">Users</span>
                    </a>
                </li>
            @endcan

            @can('view-any', Spatie\Permission\Models\Role::class)
                <li>
                    <a href="{{ route('roles.index') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700

                 {{ request()->routeIs('roles.index') ? 'bg-gray-700' : '' }}

             group">
                        <i class="fas fa-user-tag text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                        <span class="ms-3">Roles</span>
                    </a>
                </li>
            @endcan
            @can('view-any', Spatie\Permission\Models\Permission::class)
                <li>
                    <a href="{{ route('permissions.index') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700

                     {{ request()->routeIs('permissions.index') ? 'bg-gray-700' : '' }}

             group">
                        <i class="fas fa-user-tag text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                        <span class="ms-3">Permissions</span>
                    </a>
                @endcan
        @endif






        <li>
            <a href="#"
                class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700  group">
                <i class="fas fa-plug text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                <span class="ms-3">Integrations</span>
            </a>
        </li>

        <li>
            <a href="#"
                class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700  group">
                <i class="fas fa-bell text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                <span class="ms-3">Notifications</span>
            </a>
        </li>
        <li>
            <a href="#"
                class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700  group">
                <i class="fas fa-moon text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                <span class="ms-3">Appearance</span>
            </a>
        </li>
        <li>
            <a href="#"
                class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700  group">
                <i class="fas fa-language text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                <span class="ms-3">Language</span>
            </a>
        </li>
        <li>
            <a href="#"
                class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700  group">
                <i class="fas fa-universal-access text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                <span class="ms-3">Accessibility</span>
            </a>
        </li>
        {{-- Add more list items here --}}
    </ul>











    {{-- stick to bottom --}}

    <ul class="space-y-2 font-medium ">
        <li>
            <a href="{{ route('settings.profile') }}"
                class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-700  group">
                <i class="fas fa-user text-blue-500 dark:text-blue-300 mr-2 fa-lg fa-fw"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
            </a>
        </li>
    </ul>
</div>

<!-- Inspired by slack ui clone https://tailwindcomponents.com/component/slack-clone-1 -->
