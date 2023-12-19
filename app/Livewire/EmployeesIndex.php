<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesIndex extends Component
{
    use WithPagination;

    /**
     * @var true
     */
    use WithPagination;

    public $editModal = false;
    public $createModal = false;
    public $first_name, $last_name, $phone, $email, $company_id;
    public $search = '';
    public $employeeId;

    public function render()
    {
        return view('livewire.employees-index', [
            'employees' => $this->getFilteredEmployees(),
        ])->layout('layouts.app');
    }

    private function getFilteredEmployees()
    {
        $query = Employee::with('company');
        if ($this->search != '') {
            $query = $this->applySearch($query);
        }
        return $query->paginate(10);
    }

    private function applySearch($query)
    {
        return $query->where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->orWhereHas('company', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
    }

    public function create()
    {
        $this->resetInputFields();
        $this->createModal = true;
    }

    public function edit($employeeId)
    {
        $this->loadEmployee($employeeId);
        $this->editModal = true;
    }

    private function loadEmployee($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $this->employeeId = $employeeId;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->company_id = $employee->company_id;
    }

    public function delete($employeeId)
    {
        $this->deleteEmployee($employeeId);
    }

    private function deleteEmployee($employeeId)
    {
        if ($employee = Employee::find($employeeId)) {
            $employee->delete();
            session()->flash('message', 'Employee Deleted Successfully.');
        }
    }

    private function resetInputFields()
    {
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'company_id']);
    }

}
