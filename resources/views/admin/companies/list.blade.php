<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies List') }}
            <a href="{{ route('company.create') }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 float-right">Add Company</a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Alert Message --}}
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- Table --}}
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6 float-left">
                                        #
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Email
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Website
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Logo
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Edit
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $company->name }}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $company->email }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $company->website }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <img src="{{ asset('storage/'.$company->logo) }}" alt="logo image">
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('company.edit', $company->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form method="post" action="{{ route('company.destroy', $company->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 
                                                    font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $companies->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>