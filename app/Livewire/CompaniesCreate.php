<?php

namespace App\Livewire;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Notifications\NewCompanyCreated;

class CompaniesCreate extends Component
{
    use WithFileUploads;

    public $name, $email, $logo, $website;



    public function save()
    {
        $company = $this->createCompany();

        $this->resetInputFields();
        $this->closeModal();
        session()->flash('message', 'Company Created Successfully.');

        $this->notifyUser($company);
    }

    private function createCompany()
    {
        $validatedData = $this->validate((new CompanyRequest)->rules());
        $validatedData['logo'] = $this->uploadLogo();

        return Company::create($validatedData);
    }

    private function uploadLogo()
    {
        return $this->logo ? $this->logo->store('logos', 'public') : null;
    }

    private function resetInputFields()
    {
        $this->reset(['name', 'email', 'logo', 'website']);
    }

    public function closeModal()
    {
        $this->redirect('/companies');
    }

    private function notifyUser($company)
    {
        $userToNotify = Auth::user();
        $userToNotify->notify(new NewCompanyCreated($company));
    }

    public function render()
    {
        return view('livewire.companies-create');
    }
}
