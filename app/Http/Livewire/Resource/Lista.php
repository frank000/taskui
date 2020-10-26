<?php

namespace App\Http\Livewire\Resource;

use App\Http\Controllers\Adm\Resources;
use App\Models\Resource;
use Livewire\Component;
use function Psy\debug;

class Lista extends Component
{
    public $resources;
    public function render()
    {
        $this->resources =  Resource::all()->where("type_resource_id","!=",null);

        return view('livewire.resource.lista');
    }
}
