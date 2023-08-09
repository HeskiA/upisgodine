<!-- resources/views/livewire/students-table.blade.php -->

<div>
    <table class="min-w-full">
        <!-- Table header omitted for brevity -->
        <tbody class="bg-white">
            @foreach ($students as $student)
                <tr class="divide-x divide-gray-200">
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm leading-5 font-medium text-gray-900">{{ $student['name'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="text-sm leading-5 text-gray-900">{{ $student['email'] }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                        <button wire:click="openModal({{ $student['id'] }})" class="text-indigo-600 hover:text-indigo-900">
                            Edit
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if ($selectedStudent)
        <div class="fixed inset-0 flex items-center justify-center bg-opacity-50 bg-black">
            <div @click.away="selectedStudent = null" class="bg-white p-6 rounded-lg w-1/2">
                <h3 class="text-lg font-medium mb-4">Edit Student</h3>
                <form wire:submit.prevent="updateStudent">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" wire:model="selectedStudent.name" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" wire:model="selectedStudent.email" class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="text-right">
                        <button type="button" wire:click="updateStudent" class="mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
