<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Manage Users
        </h2>
    </x-slot>

    <div class="w-screen min-h-screen bg-slate-900 py-8 px-6">
        <div class="max-w-7xl mx-auto">
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="bg-red-200 border border-red-400 text-red-900 px-4 py-2 rounded mb-4">
                    <ul class="list-disc ml-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Header --}}
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-white">All Users</h3>
            </div>

            {{-- User Table --}}
            <table class="w-full bg-slate-700 shadow rounded overflow-hidden">
                <thead class="bg-slate-800">
                    <tr>
                        <th class="text-left text-gray-100 p-3">Name</th>
                        <th class="text-left text-gray-100 p-3">Email</th>
                        <th class="text-left text-gray-100 p-3">Role</th>
                        <th class="text-left text-gray-100 p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-t border-slate-600 hover:bg-slate-700 transition">
                            <td class="text-gray-100 p-3">{{ $user->name }}</td>
                            <td class="text-gray-100 p-3">{{ $user->email }}</td>
                            <td class="text-gray-100 p-3 capitalize">{{ $user->role }}</td>
                            <td class="p-3 flex gap-2">
                                @can('delete', $user)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this user?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:underline">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-slate-400 p-4">No users available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>