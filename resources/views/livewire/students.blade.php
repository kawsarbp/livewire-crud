<div class="container my-5">
    @if($update==false)

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form wire:submit.prevent="saveData" class="bg-success p-4 rounded text-white">
                <h4>Student Add Form</h4>
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="Enter Your Name" class="form-control" wire:model="name" >
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter Your E-mail" class="form-control" wire:model="email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo"  class="form-control" wire:model="photo">
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input type="submit" value="save" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
    <br><br><br>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
               @foreach($students as $student)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td><img style="width: 50px;" src="{{ Storage::url($student->photo) }}" alt="photo"></td>
                        <td>
                            <button wire:click="updatestudent({{ $student->id }})" class="btn btn-info btn-sm">Edit</button>
                            <button wire:click="deletedata({{ $student->id }})" class="btn btn-danger btn-sm" >Delete</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form wire:submit.prevent="upData" class="bg-success p-4 rounded text-white">
                    <h4>Student Update Form</h4>
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="hidden" name="sid" wire:model="sid">
                        <input type="text" id="name" placeholder="Enter Your Name" class="form-control" wire:model="name" >
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Enter Your E-mail" class="form-control" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo"  class="form-control" wire:model="upphoto">
                    </div>
                    <div>
                        <input type="submit" value="update" class="btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>

