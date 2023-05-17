<x-app-layout>
    @php
        $title = 'Update Todo List';
    @endphp

    <x-header-title :title='$title' />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-responsive-nav-link :href="route('todo')">
                    {{ __('Back') }}
                </x-responsive-nav-link>

                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Show flash message -->
                                <x-flash-message />
                                <p>Update Todo Details</p>

                                <!-- New Todo Form -->
                                <form method="POST" action="{{ route('todo.update', $todo->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row mb-3">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $todo->name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDescription"
                                            class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" name="description" id="description">{{ $todo->description }}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-2 col-form-label col-sm-offset-4 col-sm-4">
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
