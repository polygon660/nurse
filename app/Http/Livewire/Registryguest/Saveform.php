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

class Saveform extends Component
{

    public $input_type, $input_code, $input_prefix, $input_name, $input_surname, $input_gender,
        $input_level, $input_room, $input_program, $input_weight, $input_height;

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

    public function save()
    {

        $this->validate();

        try {
            guest::create([
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
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'สำเร็จ!!',
                'text' => 'ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว'
            ]);
            return redirect()->to('registryguest/index')->with('message', 'ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'ล้มเหลว!!',
                'text' => $e
            ]);
        }


    }

    public function render()
    {
        $type = guest_type::all();
        $prefix = prefix::all();
        $level = level::all();
        $room = room::all();
        $program = program::all();
        $gender = gender::all();

        return view('livewire.registryguest.saveform')->with([

            'type' => $type,
            'prefix' => $prefix,
            'gender' => $gender,
            'program' => $program,
            'level' => $level,
            'room' => $room,
        ]);
    }
}
