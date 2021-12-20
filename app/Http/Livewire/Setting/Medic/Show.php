<?php

namespace App\Http\Livewire\Setting\Medic;

use App\Models\medical;
use Livewire\Component;

class Show extends Component
{
    public $med_id, $name;
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

        $item = medical::findOrFail($id);
        $this->med_id = $item->id;
        $this->name = $item->name;
        $this->update = true;
    }

    public function delete($id)
    {

        medical::find($id)->delete();

        return redirect()->to('setting/medical')->with('message', 'ข้อมูลถูกลบเรียบร้อย');
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

            medical::updateOrCreate(
                ['id' => $this->med_id],
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
        $med = medical::all();
        return view('livewire.setting.medic.show')->with([
            'med' => $med
        ]);
    }
}
