<?php

namespace App\Livewire\Change;

use Livewire\Component;
use App\Models\ChangeMain;

/*
            $table->string('change_id');
            $table->string('title');
            $table->string('description');
            $table->unsignedBigInteger('sponsor');
            $table->unsignedBigInteger('chargecode');
            $table->string('external_ref')->nullable();
*/

class ChangeMainView extends Component
{
    public $ChangeSearch;
    public $AddChangeModal=false;
    public $NewChange_Id;
    public $NewTitle;
    public $NewDescription;


    public function render()
    {
        return view('livewire.change.change-main-view',[
            'ChangeList' => ChangeMain::where('title','like','%'.$this->ChangeSearch.'%')->get()
        ]);
    }
    public function OpenNewChangeDialog()
    {
        $this->AddChangeModal=true;
        $ChangeRecord=ChangeMain::create([
            'change_id' => 'draft',
            'title' => 'Title',
            'description' => 'Description',
            'sponsor' => 1,
            'chargecode' => 1
        ]);
        $this->NewChange_Id=$ChangeRecord->id;
    }
    public function CancelNewChange()
    {
        $this->AddChangeModal=false;
        $tmpChange=ChangeMain::where('id','=',$this->NewChange_Id)->firstOrFail();
        $tmpChange->delete();
    }
    public function SubmitChangeMain()
    {
        $tmpChange=ChangeMain::where('id','=',$this->NewChange_Id)->firstOrFail();

        $tmpChange->change_id   = 'NC'.$this->NewChange_Id;
        $tmpChange->title       = $this->NewTitle;
        $tmpChange->description = $this->NewDescription;
        $tmpChange->save();
        $this->AddChangeModal=false;
    }
    public function DeleteChange($DChange_Id)
    {
        $tmpChange=ChangeMain::where('id','=',$DChange_Id)->firstOrFail();
        $tmpChange->delete();
    }
}
