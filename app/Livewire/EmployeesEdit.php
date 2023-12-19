<?php

namespace App\Livewire;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Livewire\Component;

class EmployeesEdit extends Component
{
    public $employeeId, $first_name, $last_name, $email, $phone, $company_id;

    public function mount($employeeId)
    {
        $this->loadEmployee($employeeId);
    }

    public function update()
    {
        $validatedData = $this->validate((new EmployeeRequest)->rules());
        $this->updateEmployee($validatedData);
        $this->closeModal();
        session()->flash('message', 'Employee Updated Successfully.');
    }

    public function closeModal()
    {
        $this->redirect('/employees');
    }

    public function render()
    {
        return view('livewire.employees-edit', [
            'companies' => Company::all(),
        ]);
    }

    private function loadEmployee($employeeId)
    {
        if ($employee = Employee::find($employeeId)) {
            $this->fill($employee->toArray());
            $this->employeeId = $employeeId;
        }
    }

    private function updateEmployee($validatedData)
    {
        if ($employee = Employee::find($this->employeeId)) {
            $employee->update($validatedData);
        }
    }
}
