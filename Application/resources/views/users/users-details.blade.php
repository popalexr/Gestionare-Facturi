<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Client Details Card -->
        <div class="mt-12 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">User Details</h2>

                    @can('users-form')
                        <a href="{{ route('users.form', ['id' => $user->id]) }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                    @endcan
                </div>

                <div class="py-4 md:py-8">
                    <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                      <div class="space-y-4">
                        <div class="flex space-x-4">
                          <img class="h-16 w-16 rounded-lg" src="{{ asset($user->avatar ?? config('users.default_avatar')) }}" alt="avatar" />
                          <div class="my-auto">
                            <h2 class="text-xl font-bold leading-none text-gray-900 dark:text-white sm:text-2xl">{{ $user->name }}</h2>
                          </div>
                        </div>
                        <dl class="">
                          <dt class="font-semibold text-gray-900 dark:text-white">Email Address</dt>
                          <dd class="text-gray-500 dark:text-gray-400">{{ $user->email }}</dd>
                        </dl>
                        <dl>
                          <dt class="font-semibold text-gray-900 dark:text-white">Status</dt>
                          @if ($user->isOnline())
                            <dd class="mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"></path>
                                </svg>
                                Online
                            </dd>
                            @else
                                <dd class="mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                    <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"></path>
                                    </svg>
                                    Offline
                                </dd>
                            @endif
                        </dl>
                      </div>
                      <div class="space-y-4">
                        <dl>
                          <dt class="font-semibold text-gray-900 dark:text-white">Phone Number</dt>
                          <dd class="text-gray-500 dark:text-gray-400">{{ $user->phone ?? 'Not set' }}</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 dark:text-white">Permissions</dt>
                            @if($user->isAdmin())
                                <dd class="mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                    Admin
                                </dd>
                            @elseif(count($user->getPermissions()) == 0)
                                <dd class="mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                    No permissions
                                </dd>
                            @else
                                @foreach($user->getPermissionsWithDescriptions() as $permission)
                                    <dd class="mt-1.5 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                        {{ $permission }}
                                    </dd>
                                @endforeach
                            @endif
                        </dl>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>