<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Company') }}
            <a href={{ route('companies') }} class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 
                focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 
                dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 float-right">Back</a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="card">
                        <div class="card-header">
                            Edit Company
                        </div>
                        <div class="card-body">
                            {{-- Form --}}
                            <form action="{{ route('company.update', $company->id) }}" method="post" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $company->name }}">
                                        @error('name')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="emial" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{ $company->email }}">
                                        @error('email')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="emial" class="col-sm-2 col-form-label">Website</label>
                                    <div class="col-sm-10">
                                        <input type="url" class="form-control  @error('website') is-invalid @enderror" id="website" name="website" value="{{ $company->website }}">
                                        @error('url')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="emial" class="col-sm-2 col-form-label">Logo</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control px-3 py-2.5 mr-2 mb-2  @error('logo') is-invalid @enderror" id="logo" name="logo">
                                        <img src="{{ asset('storage/'.$company->logo) }}" width="100px">
                                        @error('logo')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg 
                                    text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>