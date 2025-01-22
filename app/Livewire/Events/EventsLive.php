<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Traits\DropDownListTrait;
use App\Traits\EventsTrait;
use Livewire\Component;
use Livewire\WithPagination;

class EventsLive extends Component
{
    use EventsTrait, WithPagination, DropDownListTrait;
    public bool $openModal = false;
    public bool $openModalDelete = false;
    public bool $isEdit = false;
    public string $name='';
    public string $imagen='';
    public string $start_date='';
    public string $id='';
    public string $type='';
    public Event $event;

    public function render()
    {
        return view('livewire.events.events-live',[
            'events' => $this->getEvents()->paginate(50),
            'typeForm' => $this->DDLTypeForm()
        ]);
    }
    public function store():void
    {
        $this->storeEvent([
            'name' => $this->name,
            'imagen' => $this->imagen,
            'start_date' => $this->start_date,
            'type' => $this->type
        ]);
        $this->openModal = false;
    }
    public function edit($id):void
    {
        $this->show($id);
        $this->name = $this->event->name;
        $this->imagen = $this->event->imagen;
        $this->start_date = $this->event->start_date;
        $this->openModal = true;
        $this->isEdit = true;
    }
    public function delete($id):void
    {
        $this->show($id);
        $this->openModalDelete = true;
        $this->name = $this->event->name;
        $this->id = $this->event->id;
    }
    public function show($id):void
    {
        $this->event = $this->getEventById($id);
    }
    public function update():void
    {
        $this->event->update([
            'name' => $this->name,
            'imagen' => $this->imagen,
            'start_date' => $this->start_date
        ]);
        $this->openModal = false;
        $this->isEdit = false;
    }
    public function destroy():void
    {
        $this->event->delete();
        $this->openModalDelete = false;
    }
    public function cancel():void
    {
        $this->isEdit = false;
        $this->openModal = false;
        $this->openModalDelete = false;
        $this->name = '';
        $this->imagen = '';
        $this->start_date = '';
    }
}
