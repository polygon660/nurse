<?php

namespace App\Http\Livewire\Setting\Type;

use App\Models\guest_type;
use Livewire\Component;

class Show extends Component
{
    public $type_id, $name;
    public $update;
    protected $Theme = 'bootstrap';

    protected $listeners = ['delete'];


    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'กรุณาตั้งชื่อหน้าที่',
    ];

    public function edit($id)
    {

        $item = guest_type::findOrFail($id);
        $this->type_id = $item->id;
        $this->name = $item->name;
        $this->update = true;
    }

    public function delete($id)
    {

        guest_type::find($id)->delete();

        return redirect()->to('setting/type')->with('message', 'ข้อมูลถูกลบเรียบร้อย');
    }

    public function confirmDelete($id)
    {

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'error',
            'title' => 'ต้องการที่จะลบข้อมูลใช่หรือไม่',
            'text' => '',
            'id' => $id
        ]);
    }

    public function save()
    {
        $this->validate();
        try {

            guest_type::updateOrCreate(
                ['id' => $this->type_id],
                ['name' => $this->name]
            );

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'สำเร็จ!!',
                'text' => 'ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว'
            ]);

            $this->update = false;

            $this->reset();
            session()->flash('message', 'อัพเดทชื่อหน้าที่สำเร็จ!');
            session()->flash('alert-class', 'alert-success');
        } catch (\Exception $e) {
            session()->flash('message', 'อัพเดทผิดพลาด!' . $e);
            session()->flash('alert-class', 'alert-danger');
        };
    }
    public function render()
    {
        $type = guest_type::all();
        return view('livewire.setting.type.show')->with([
            'type' => $type
        ]);
    }
}
