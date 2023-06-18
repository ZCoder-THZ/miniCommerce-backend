@extends('layouts.app')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4  border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="p-4 flex items-center  ">
                <a class="mr-4 text-black" href="{{ route('itemList') }}">Item List</a> <i
                    class="fa-solid fa-greater-than"></i>
                <h1 class="ml-4 text-blue-500">Create Page</h1>
            </div>

            <h1 class="text-left p-4 mb-4 text-black bg-green-100 rounded-tl-md rounded-tr-md">Add Item</h1>
            <form action="{{ route('createItem') }}" class="" enctype="multipart/form-data" method="post">
                @csrf

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="  rounded   ">
                        <h1 class="text-left pl-4">Item Informations</h1>

                        <div class="mb-3 p-4">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Item
                                name</label>
                            <input type="text" id="email" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="..." required>
                            @error('name')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                        </div>
                        <div class="mb-3 p-4">

                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Select an
                                category</label>
                            <select id="countries" name="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a Category</option>
                                @foreach ($categories as $key => $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                        </div>
                        <div class="mb-3 p-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                            <input type="number" name="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="" required>
                            @error('price')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                        </div>
                        <div class="mb-3 p-4">

                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <textarea id="editor" rows="6" name="description"
                                class="block p-2.5 h-40 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>
                            @error('description')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror

                        </div>

                        <div class="mb-3 p-4">

                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Item
                                Condition</label>
                            <select id="countries" name="itemCondition"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>select item condition</option>
                                @foreach ($itemConditions as $key => $itemCondition)
                                    <option value="{{ $itemCondition->item_condition }}">
                                        {{ $itemCondition->item_condition }}</option>
                                @endforeach

                            </select>
                            @error('itemCondition')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror

                        </div>
                        <div class="mb-3 p-4">

                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Item
                                Type</label>
                            <select id="countries" name="itemType"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose an item type</option>
                                @foreach ($itemTypes as $key => $itemType)
                                    <option value="{{ $itemType->item_type }}">
                                        {{ $itemType->item_type }}</option>
                                @endforeach


                            </select>
                            @error('itemType')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                        </div>
                        <div class="mb-3 p-4">
                            <div class="flex items-center mb-4">
                                <input id="default-checkbox" type="checkbox" onchange="updateValue(this)" name="status"
                                    value="avaliable"
                                    class="w-4 h-4 text-blue-600 p-3 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2">

                                <label for="default-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Default
                                    checkbox</label>
                            </div>
                            @error('checkbox')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                        </div>
                        <div class="mb-3 p-4">

                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800  hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" class="hidden" name="image" />
                                </label>
                            </div>
                            @error('image')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror

                        </div>
                    </div>
                    <div class=" rounded ">
                        <h1 class="text-start pl-4">Owner info</h1>
                        <div class="mb-3 p-4">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">name</label>
                            <input type="text" id="" name="uploader" value="{{ Auth::user()->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="" required>
                            @error('uploader')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                        </div>
                        <div class="mb-3 p-4">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    +95
                                </span>
                                <input type="number" id="website-admin" name="phone"
                                    class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5   dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="9...">
                            </div>
                            @error('phone')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                        </div>
                        <div class="mb-3 p-4">

                            <label for="" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                            <textarea rows="6" name="address"
                                class="block p-2.5 h-40 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>
                            @error('address')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror

                        </div>
                        <input type="number" name="user_id" value="1" hidden>
                        <div class="mb-3 p-4">
                            <input type="text" class="hidden" name="ltd" id="ltd">
                            <input type="text" class="hidden" name="lng" id="lng">
                            <div id="mmap">

                            </div>
                            @error('ltd')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                            @error('lng')
                                <h1 class="text-red-400">{{ $message }}</h1>
                            @enderror
                        </div>
                    </div>
                    <button class="bg-blue-500 px-4 py-2 text-white">Save</button>
            </form>


        </div>
    </div>

    <script>
        var map = L.map('mmap');
        let ltd = document.getElementById('ltd').value
        let lng = document.getElementById('lng').value
        console.log(ltd)
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.setView([ltd, lng], 16);

        var marker = L.marker([ltd, lng]).addTo(map)

        function onMapClick(e) {
            document.getElementById('ltd').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;

            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            console.log(e.latlng);
        }

        map.on('click', onMapClick);
    </script>
    <script>
        function updateValue(checkbox) {
            if (checkbox.checked) {
                checkbox.value = "avaliable";
                console.log(checkbox.value)
            } else {
                checkbox.value = "unavaliable";
                console.log(checkbox.value)

            }
        }
    </script>
    <style>
        #mmap {
            height: 600px;
        }

        .ck-editor__editable {
            min-height: 100px;
            border-radius: 10%;
        }
    </style>
@endsection
