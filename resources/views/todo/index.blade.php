<x-app-layout>
    @php
        $title = 'Todo List';
    @endphp

    <x-header-title :title='$title' />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Show flash message -->
                                <x-flash-message />
                                <p>Add new Todo Details</p>

                                <!-- New Todo Form -->
                                <form method="POST" action="{{ route('todo.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ old('name') }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDescription"
                                            class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-2 col-form-label col-sm-offset-4 col-sm-4">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <button type="reset" class="btn btn-warning">Refesh</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>

                                <!-- Todo Details Table-->
                                <x-todo.todo-table :todos='$todos' />

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
