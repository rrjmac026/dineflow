<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="flex justify-end px-8 mt-4">
        <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 rounded-lg shadow-sm hover:shadow transition-all duration-200">
            <i class="fas fa-plus mr-2"></i>Add User
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 sm:rounded-lg">
                <div class="p-6 text-gray-700 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-amber-50 dark:bg-amber-900/20 border-b border-amber-200 dark:border-amber-700">
                                <tr>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Name</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Email</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Role</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($users as $user)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-amber-800/50 transition-colors duration-150">
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">{{ $user->name }}</td>
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">{{ $user->email }}</td>
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">{{ ucfirst($user->role) }}</td>
                                        <td class="py-4 px-6">
                                            @if($user->id !== auth()->id())
                                                <button type="button" 
                                                    class="text-red-700 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150"
                                                    onclick="return confirmAction('Are you sure you want to delete this user?', 'delete-user-{{ $user->id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-user-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 px-6 text-sm text-center text-gray-600 dark:text-gray-400">
                                            No users found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
