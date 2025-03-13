<?php

namespace App\Livewire\Dashboard;

use App\Enums\ParticipantStatus;
use App\Traits\DashboardTrait;
use Livewire\Component;

class CardAttachedLive extends Component
{
    use DashboardTrait;
    public string $name;
    public int $count;
    public function render()
    {
        return view('livewire.dashboard.card-attached-live');
    }
    public function mount($count,$name)
    {
        $this->count = $count;
        $this->name = $name;
    }
}
