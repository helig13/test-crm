<?php

namespace App\Livewire;

use App\Http\Requests\CompanyRequest;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Company;

class CompaniesEdit extends Component
{
    use WithFileUploads;

    public $companyId;
    public $name, $email, $logo, $website;
    public $newLogo;

    public function mount($companyId)
    {
        $this->loadCompany($companyId);
    }

    public function update()
    {
        $rules = (new CompanyRequest)->rules();

        // If the logo is not an uploaded file, remove the logo validation rule
        if (!$this->newLogo instanceof \Livewire\TemporaryUploadedFile) {
            unset($rules['logo']);
        }

        $validatedData = $this->validate($rules);

        $this->updateCompany($validatedData);
        session()->flash('message', 'Company Updated Successfully.');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->redirect('/companies');
    }

    public function render()
    {
        return view('livewire.companies-edit');
    }

    private function loadCompany($companyId)
    {
        $company = Company::find($companyId);
        if ($company) {
            $this->companyId = $companyId;
            $this->name = $company->name;
            $this->email = $company->email;
            $this->logo = $company->logo;
            $this->website = $company->website;
        }
    }



    private function updateCompany($validatedData)
    {
        $company = Company::find($this->companyId);
        if ($company) {
            if ($this->newLogo) {
                // Handle new logo upload
                $validatedData['logo'] = $this->newLogo->store('logos', 'public');
            }

            $company->update($validatedData);
        }
    }


    private function prepareData($validatedData)
    {
        $data = $validatedData;
        if ($this->newLogo instanceof \Livewire\TemporaryUploadedFile) {
            // If a new logo is uploaded, store it and update the logo path
            $data['logo'] = $this->newLogo->store('logos', 'public');
        }
        // No need to unset the logo, keep the existing one if no new logo is uploaded
        return $data;
    }


}
