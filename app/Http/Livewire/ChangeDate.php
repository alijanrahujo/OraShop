<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ChangeDate extends Component
{
    public $date;

    public function mount()
    {
        $this->date = Session::get('date', Carbon::today()->format('Y-m-d'));
    }

    public function updatedDate($value)
    {
        $validatedDate = $this->validateDate($value);

        if ($validatedDate) {
            $this->date = $validatedDate;
            Session::put('date', $this->date);
        }
        $this->dispatchBrowserEvent('date-changed', ['date' => $value]);
    }

    private function validateDate($date)
    {
        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function render()
    {
        return view('livewire.change-date');
    }
}
