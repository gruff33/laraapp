<?php

namespace App\Livewire\Nodes;

use Livewire\Component;
use App\Models\Node;

class NodesMainView extends Component
{
    public function render()
    {
        $NodeList=Node::orderby('id')->get();
        return view('livewire.nodes.nodes-main-view',[
            'NodeList' => $NodeList
        ]);
    }
}
