@extends('layouts.app')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg ">

            <h1 class="text-start text-blue-500">Item List </h1>
            <div class="flex justify-end">
                <a class="bg-blue-500 text-white rounded-md cursor-pointer px-4 py-1"
                    href="{{ route('category#createPage') }}">+
                    Create Category</a>
            </div>
            <div class="flex items-center   mb-4 rounded bg-gray-50">

                <div class="flex items-center justify-start  ">
                    <label for="limit" class="block mr-4 mb-2 text-sm font-medium text-gray-900 ">Show:</label>
                    <select id="limit"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                        <option selected>select</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>

                    </select>

                </div>

            </div>
            <div class="" id="">

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="items-table">
                        <thead class="text-xs text-white uppercase bg-blue-500 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">

                                    <span>Action</span>

                                </th>
                                <th scope="col" class="px-6 py-3">
                                    No

                                </th>
                                <th scope="col" class="px-6 py-3">


                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category Name

                                </th>

                                <th scope="col" class="px-6 py-3">


                                </th>

                                <th scope="col" class="px-6 py-3">


                                </th>

                                <th scope="col" class="px-6 py-3">


                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Category Status

                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('category#deleteCategory', $category->id) }}"><i
                                                class="fa-solid fa-2x text-white bg-red-400 rounded-lg p-1 fa-trash-can"></i></a>
                                        <a href="{{ route('category#editPage', $category->id) }}"><i
                                                class="fa-solid fa-pencil fa-2x p-1 rounded-lg text-white bg-green-400"></i></a>
                                    </th>
                                    <td class="px-6 py-4">

                                        {{ $category->id }}
                                    </td>
                                    <td class="px-6 py-4">

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $category->category_name }}
                                    </td>
                                    <td class="px-6 py-4">

                                    </td>

                                    <td class="px-6 py-4">

                                    </td>

                                    <td class="px-6 py-4">

                                    </td>





                                    <td class="px-6 py-4 ">

                                        <div class="" style="width: 200px">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" value="" class="sr-only peer">

                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                                                </div>
                                                <span class="ml-3 text-sm font-medium text-gray-900 ">Toggle
                                                    me</span>
                                            </label>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="" id="">
                        {{ $categories->links() }}

                    </div>
                </div>

            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(() => {
            $('#limit').on('change', function() {
                let limit = $(this).val();
                return new Promise((resolve, reject) => {
                    $.ajax({
                        type: 'get',
                        url: '/items/itemList/limit',
                        data: {
                            "limit": limit
                        },
                        success: function(data) {
                            // Handle the success response
                            $('#items-table').html(data.data);
                            $('#pagination-links').html(data.links);
                            resolve(data);
                            console.log(data)
                        },
                        error: function(err) {
                            // Handle the error response
                            reject(err);
                        }
                    });
                });
            });

            $('#status').on('change', function() {
                let status = $(this).val();
                console.log()


            })
        });
    </script>
@endsection
