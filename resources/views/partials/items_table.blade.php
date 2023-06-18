<div id="items-table">
    <table class="w-full text-sm text-left text-gray-500" id="items-table">
        <thead class="text-xs text-white uppercase bg-blue-500 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">

                    <span>Action</span>
                    <i class="fa-solid fa-chevron-down "></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    No
                    <i class="fa-solid fa-chevron-down "></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Item
                    <i class="fa-solid fa-chevron-down "></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                    <i class="fa-solid fa-chevron-down "></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                    <i class="fa-solid fa-chevron-down "></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                    <i class="fa-solid fa-chevron-down "></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Ownder
                    <i class="fa-solid fa-chevron-down "></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                    <i class="fa-solid fa-chevron-down "></i>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="bg-white border-b  ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->item_name }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $item->category_name }}

                    </td>
                    <td class="px-7 py-4">
                        {{ $item->description }}

                    </td>
                    <td class="px-3 py-4">
                        {{ $item->price }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $item->name }}

                    </td>
                    <td class="px-6 py-4">

                        <div class="" style="width: 200px">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="status" value="" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                    me</span>
                            </label>

                        </div>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="" id="pagination-links">
        {{ $items->links() }}
    </div>

</div>
