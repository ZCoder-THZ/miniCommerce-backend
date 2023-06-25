@extends('layouts.app')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg ">
            <div class="flex space-x-3  w-[100%]  md:w-3/4  justify-center mx-auto flex-col md:flex-row lg:flex-row  ">

                <div class="p-4 border-2 border-dashed border-gray-400 w-1/4 h-50">

                    @if (Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="w-40 mx-auto"
                            alt="">
                    @else
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Windows_10_Default_Profile_Picture.svg"
                            class="w-40 mx-auto" alt="">
                    @endif

                </div>
                <div class="w-3/4 p-4 border-2 border-dashed border-gray-400 ">
                    <h3 class="text-gray-400 text-2xl">Profile Info</h3>
                    <div class="h-1 w-1/4 bg-gray-400 my-3"></div>

                    <form action="" enctype="multipart/form-data">
                        <div class="mb-6">
                            <label for="default-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                            <input type="file" id="default-input"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full    ">
                        </div>
                        <div class="mb-6">
                            <label for="default-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Default input</label>
                            <input type="text" id="default-input" value="{{ Auth::user()->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   ">
                        </div>
                        <div class="mb-6">
                            <label for="small-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Small
                                input</label>
                            <input type="text" id="small-input" value="{{ AUth::user()->email }}"
                                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500   ">
                        </div>
                        <div class="mb-6">
                            <label for="small-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                            <input type="text" id="small-input" value="{{ AUth::user()->phone }}"
                                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500   ">
                        </div>

                        <div class="mb-6">
                            <label for="large-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Large
                                input</label>
                            <input type="text" id="large-input" value="{{ AUth::user()->address }}"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500   ">
                        </div>
                        <div class="flex justify-end ">
                            <button type="submit" class="px-3 py-2 rounded-md text-white bg-blue-400">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
