<?php

namespace App\Livewire;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Livewire\Component;

class EmployeesCreate extends Component
{

    public $first_name, $last_name, $email, $phone, $company_id;

    public function render()
    {
        $companies = Company::all();
        return view('livewire.employees-create', compact('companies'));
    }

    public function save()
    {

        $validatedData = $this->validate((new EmployeeRequest)->rules());

        Employee::create($validatedData);
        $this->closeModal();


        $this->reset(['first_name', 'last_name', 'email', 'phone', 'company_id']);
    }
    public function closeModal()
    {
        $this->redirect('/employees');

    }
}
