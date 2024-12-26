<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Users List</h3>
                    </div>

                    <a href="{{ route('clients.form') }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
                        Add user
                    </a>
                </div>
                <!-- Table -->
                <div class="flex flex-col mt-6">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="p-4 text-xs text-left font-medium tracking-wider text-gray-500 uppercase dark:text-white">
                                                Name
                                            </th>
                                            <th scope="col" class="p-4 text-xs text-center font-medium tracking-wider text-gray-500 uppercase dark:text-white">
                                                Email
                                            </th>
                                            <th scope="col" class="p-4 text-xs text-right font-medium tracking-wider text-gray-500 uppercase dark:text-white">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800">
                                        @if($users->count() == 0)
                                            <tr>
                                                <td scope="row" class="p-4 text-center text-sm font-medium text-gray-900 dark:text-white" colspan="4">
                                                    {{ __('No users found') }}
                                                </td>
                                            </tr> 
                                        @else
                                            @foreach($users as $user)
                                                <tr>
                                                    <td class="p-4 text-left text-sm text-gray-900 dark:text-white">
                                                        {{ $user->name }}
                                                    </td>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        {{ $user->email }}
                                                    </td>
                                                    <td class="p-4 text-sm font-medium text-right dark:text-white">
                                                        <!-- View user details -->
                                                        <a href="{{ route('users.details', ['id' => $user->id]) }}" 
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-2"
                                                            data-tooltip-target="tooltip-view-{{ $user->id }}"
                                                        >
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </a>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-view-{{ $user->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                        >
                                                            View
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>

                                                        <!-- Edit user details -->
                                                        <a href="{{ route('clients.form', ['id' => $user->id]) }}" 
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200"
                                                            data-tooltip-target="tooltip-edit-{{ $user->id }}"
                                                        >
                                                            <i class="fa-solid fa-pen"></i>
                                                        </a>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-edit-{{ $user->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                        >
                                                            Edit
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->onEachSide(3)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
