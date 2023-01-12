<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Students extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $photo;
    public $sid;
    public $upphoto;
    public $update = false;

    /*add data*/
    public function saveData()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'photo' => 'required|image',
        ]);
        $student = new Student;
        $student->name = $this->name;
        $student->email = $this->email;
        $fileName = $this->photo->store('photos', 'public');
        $student->photo = $fileName;

        $student->save();
        $this->mount();
        $this->emit('alert',['type'=>'success','message'=>'data add successfully']);
//        $file = $this->photo->getClientOriginalName();
        $this->photo = '';
        $this->reset(['name', 'email']);
    }

    /*show data in livewire blade*/
    public function mount()
    {
        $this->students = Student::orderBy('id', 'desc')->get();
    }
    /*delete data*/
    public function deletedata($id)
    {
        $student = Student::find($id);
        $fileName = $student->photo;

//
//        $path_2 = storage_path($fileName);
////        dd($path_2);
//        $path = storage_path('/public/'.$fileName);
//        if(file_exists($path_2)){
//            unlink($path_2);
//        }else{
//            dd('File not found.');
//        }


//        if(Storage::url($fileName))
//        {
//            unlink($fileName);
//        }else
//        {
//            dd('not found');
//        }

        $student->delete();

        /*$file_path = storage_path('/app/public/photos/').$fileName;
        if(file_exists($file_path)){
            unlink($file_path);
        }*/

        $this->mount();
        $this->emit('alert',['type'=>'success','message'=>'data delete successfully']);
    }
    /*edit data*/
    public function updatestudent($id)
    {
        $student = Student::find($id);
        $this->sid = $student->id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->photo = $student->photo;
        $this->update = true;
    }

    public function upData()
    {
        $student = Student::find($this->sid);
        $student->name = $this->name;
        $student->email = $this->email;
        if($this->upphoto)
        {
            $fileName = $this->upphoto->store('photos', 'public');
            $student->photo = $fileName;
        }
        $student->save();
        $this->reset(['name', 'email']);
        $this->upphoto = '';
        $this->mount();
        $this->update = false;
        $this->emit('alert',['type'=>'success','message'=>'data update successfully']);

    }
    /*livewire view load*/
    public function render()
    {
        return view('livewire.students');
    }
}
