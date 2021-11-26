<?php

namespace App\Http\Livewire\Setting\Role;

use App\Models\role;
use Livewire\Component;

class Show extends Component
{
    public $role_id, $name;

    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'กรุณาตั้งชื่อหน้าที่',
    ];

    public function edit($id){

        $item = role::findOrFail($id);
        $this->role_id = $item->id;
        $this->name = $item->name;

    }

    public function destroy($id){

        $item = role::findOrFail($id);
        $item->delete();

    }


    public function save()
    {

        try {

            role::updateOrCreate(
                [ 'id' => $this->role_id ]
                ,$this->validate()
            );

            session()->flash('message', 'อัพเดทชื่อหน้าที่สำเร็จ!');
            session()->flash('alert-class', 'alert-success');

            $this->reset();

        } catch (\Exception $e) {
            session()->flash('message', 'อัพเดทผิดพลาด!' . $e);
            session()->flash('alert-class', 'alert-danger');
        };
    }
    public function render()
    {
        $role = role::all();
        return view('livewire.setting.role.show')->with([
            'role' => $role
        ]);
    }
}
