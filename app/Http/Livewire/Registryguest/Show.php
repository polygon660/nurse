<?php

namespace App\Http\Livewire\Registryguest;

use App\Models\gender;
use App\Models\guest;
use App\Models\guest_type;
use App\Models\level;
use App\Models\prefix;
use App\Models\program;
use App\Models\room;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = ['delete'];

    public $guest_id, $input_type, $input_code, $input_prefix, $input_name, $input_surname, $input_gender,
        $input_level, $input_room, $input_program, $input_weight, $input_height;

    public $updateMode = false;

    protected $rules = [
        'input_type' => 'required',
        'input_code' => '',
        'input_prefix' => 'required',
        'input_name' => 'required',
        'input_surname' => 'required',
        'input_gender' => 'required',
        'input_level' => '',
        'input_room' => '',
        'input_program' => '',
        'input_weight' => '',
        'input_height' => '',
    ];

    public function edit($id)
    {
        $this->updateMode = true;
        $item = guest::findOrFail($id);
        $this->guest_id = $item->id;
        $this->input_type = $item->guest_type_id;
        $this->input_code = $item->code;
        $this->input_prefix = $item->prefix_id;
        $this->input_name = $item->name;
        $this->input_surname = $item->surname;
        $this->input_gender = $item->gender_id;
        $this->input_level = $item->level_id;
        $this->input_room = $item->room_id;
        $this->input_program = $item->program_id;
        $this->input_weight = $item->weight;
        $this->input_height = $item->height;
    }

    public function save()
    {

        $this->validate();

        try {
            $guest = guest::findOrFail($this->guest_id);
            $guest->update([
                'guest_type_id' => $this->input_type,
                'code' => $this->input_code,
                'prefix_id' =>  $this->input_prefix,
                'name' =>  $this->input_name,
                'surname' => $this->input_surname,
                'gender_id' => $this->input_gender,
                'level_id' => $this->input_level,
                'room_id' => $this->input_room,
                'program_id' => $this->input_program,
                'weight' => $this->input_weight,
                'height' => $this->input_height,
            ]);
            $this->reset();
            // $this->dispatchBrowserEvent('swal:modal', [
            //     'type' => 'success',
            //     'title' => 'สำเร็จ!!',
            //     'text' => 'ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว'
            // ]);
            $this->updateMode = false;
            return redirect()->to('registryguest/index')->with('message', 'ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว');

            // $this->emit('success');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'ล้มเหลว!!',
                'text' => $e
            ]);
        }
    }

    public function delete($id)
    {

            guest::where('id', $id)->delete();

            return redirect()->to('registryguest/index')->with('message', 'ข้อมูลถูกลบเรียบร้อย');
            // session()->flash('message', 'Users Deleted Successfully.');

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

    public function render()
    {
        $data = guest::with(['guest_type','prefix','level','room','program'])->get();
        $type = guest_type::all();
        $prefix = prefix::all();
        $level = level::all();
        $room = room::all();
        $program = program::all();
        $gender = gender::all();

        return view('livewire.registryguest.show')->with([
            'data' => $data,
            'type' => $type,
            'prefix' => $prefix,
            'gender' => $gender,
            'program' => $program,
            'level' => $level,
            'room' => $room,
        ]);
    }
}
