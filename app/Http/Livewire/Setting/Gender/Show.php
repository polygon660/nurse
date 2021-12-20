<?php

namespace App\Http\Livewire\Setting\Gender;

use App\Models\gender;
use Livewire\Component;

class Show extends Component
{

    public $gender_id, $name;
    public $update;
    protected $Theme = 'bootstrap';

    protected $listeners = ['delete'];


    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'กรุณาตั้งชื่อยา',
    ];

    public function edit($id)
    {

        $item = gender::findOrFail($id);
        $this->gender_id = $item->id;
        $this->name = $item->name;
        $this->update = true;
    }

    public function delete($id)
    {

        gender::find($id)->delete();

        return redirect()->to('setting/gender')->with('message', 'ข้อมูลถูกลบเรียบร้อย');
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

            gender::updateOrCreate(
                ['id' => $this->gender_id],
                ['name' => $this->name]
            );

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'สำเร็จ!!',
                'text' => 'ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว'
            ]);

            $this->update = false;

            $this->reset();
            session()->flash('message', 'อัพเดทชื่อยาสำเร็จ!');
            session()->flash('alert-class', 'alert-success');
        } catch (\Exception $e) {
            session()->flash('message', 'อัพเดทผิดพลาด!' . $e);
            session()->flash('alert-class', 'alert-danger');
        };
    }

    public function cancel()
    {
        // $this->update = false;
        $this->reset();
    }


    public function render()
    {
        $gender = gender::all();
        return view('livewire.setting.gender.show')
        ->with([
            'gender' => $gender
        ]);
    }
}
