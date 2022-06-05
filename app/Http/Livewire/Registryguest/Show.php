<?php

namespace App\Http\Livewire\Registryguest;

use App\Models\gender;
use App\Models\guest;
use App\Models\guest_type;
use App\Models\history;
use App\Models\level;
use App\Models\prefix;
use App\Models\program;
use App\Models\room;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = ['delete'];

    public $guest_id, $guest_type, $code, $prefix, $name, $surname, $gender,
        $level, $room, $program, $weight, $height;

    public $updateMode = false;

    protected $rules = [
        'guest_type' => 'required',
        'code' => '',
        'prefix' => 'required',
        'name' => 'required',
        'surname' => 'required',
        'gender' => 'required',
        'level' => '',
        'room' => '',
        'program' => '',
        'weight' => '',
        'height' => '',
    ];

    public function edit($id)
    {
        $this->updateMode = true;
        $item = guest::findOrFail($id);
        $this->guest_id = $item->id;
        $this->guest_type = $item->guest_type->name;
        $this->code = $item->code;
        $this->prefix = $item->prefix_id;
        $this->name = $item->name;
        $this->surname = $item->surname;
        $this->gender = $item->gender->name;
        $this->level = $item->level_id;
        $this->room = $item->room_id;
        $this->program = $item->program_id;
        $this->weight = $item->weight;
        $this->height = $item->height;
    }

    public function save()
    {

        $this->validate();

        try {
            $guest = guest::findOrFail($this->guest_id);
            $guest->update([
                'guest_type_id' => $this->type,
                'code' => $this->code,
                'prefix_id' =>  $this->prefix,
                'name' =>  $this->name,
                'surname' => $this->surname,
                'gender_id' => $this->gender,
                'level_id' => $this->level,
                'room_id' => $this->room,
                'program_id' => $this->program,
                'weight' => $this->weight,
                'height' => $this->height,
            ]);
            $this->reset();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'สำเร็จ!!',
                'text' => 'ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว'
            ]);
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
            history::where('guest_id',$id)->delete();


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
        $data = guest::with(['guest_type','prefix','level','room','program'])->with('student')->get();
        $datahistry = history::where('guest_id',$this->guest_id)->get();
        $type = guest_type::all();
        $prefix = prefix::all();
        $level = level::all();
        $room = room::all();
        $program = program::all();
        $gender = gender::all();

        return view('livewire.registryguest.show')->with([
            'data' => $data,
            'datahistry' => $datahistry,
            'type' => $type,
            'prefix' => $prefix,
            'gender' => $gender,
            'program' => $program,
            'level' => $level,
            'room' => $room,
        ]);
    }
}
