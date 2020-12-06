<?php

namespace App\Http\Livewire\Componente;

use App\Models\Resource;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class InnerResource extends Component
{

    public $resources;
    protected $listeners = ['addedResourceEvent' => 'handleResources'];

    public function render()
    {
        return view('livewire.componente.inner-resource');
    }

    public function handleResources($value)
    {
        $this->resources = $value;

    }
    public function deleteResource($val)
    {
        $this->emit('deleteResourceEvent',['resource' => $val]);
    }



}
