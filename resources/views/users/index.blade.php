<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Users
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- User Table --}}
        <div class="mb-6 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">All Users</h3>
        </div>

        <table class="w-full bg-white shadow rounded overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3">Name</th>
                    <th class="text-left p-3">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3 capitalize">{{ $user->role }}</td>
                        <td class="p-3 flex gap-2">
                            @can('update', $user)
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:underline">Edit</a>
                            @endcan
                            @can('delete', $user)
                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 p-4">No users available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
