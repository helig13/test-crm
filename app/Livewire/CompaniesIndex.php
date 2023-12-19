<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;

class CompaniesIndex extends Component
{
    use WithPagination;

    public $companyId;
    public $editModal = false;
    public $createModal = false;
    public $name, $email, $logo, $website;
    public $search = '';

    public function render()
    {
        return view('livewire.companies-index', [
            'companies' => $this->getQuery()->paginate(10),
        ])->layout('layouts.app');
    }

    private function getQuery()
    {
        $query = Company::query();

        if ($this->search != '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('website', 'like', '%' . $this->search . '%');
            });
        }

        return $query;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->createModal = true;
    }

    public function edit($id)
    {
        $this->loadCompany($id);
        $this->editModal = true;
    }

    private function loadCompany($id)
    {
        $company = Company::findOrFail($id);
        $this->companyId = $id;
        $this->fill($company->toArray());
    }

    public function closeModal()
    {
        $this->reset(['editModal', 'createModal']);
    }

    public function delete($companyId)
    {
        $this->deleteCompany($companyId);
    }

    private function deleteCompany($companyId)
    {
        $company = Company::find($companyId);
        if ($company) {
            $this->deleteLogo($company);
            $company->delete();
            session()->flash('message', 'Company deleted successfully.');
        }
    }

    private function deleteLogo($company)
    {
        if ($company->logo && Storage::exists($company->logo)) {
            Storage::delete($company->logo);
        }
    }

    private function resetInputFields()
    {
        $this->reset(['name', 'email', 'logo', 'website']);
    }
}
