<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentsTable extends Component
{
    public $students = [
        [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ],
        [
            'id' => 2,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ],
        // Add more dummy data as needed
    ];

    public $selectedStudent = null;

    public function render()
    {
        return view('livewire.students-table');
    }

    public function openModal($studentId)
    {
        $this->selectedStudent = collect($this->students)->firstWhere('id', $studentId);
    }

    public function updateStudent()
    {
        // Logic to update the student data goes here
        // For now, we'll just reset the selectedStudent
        $this->selectedStudent = null;
    }
}
