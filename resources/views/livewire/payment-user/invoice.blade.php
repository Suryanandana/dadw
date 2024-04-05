<div class="w-full py-5 pl-5 pr-5 bg-gray-100 lg:pl-0">
    <div class="sticky w-full p-5 bg-white top-20">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400 border-y">
                    <tr class="text-gray-400">
                        <th class="px-6 py-3 rounded-s-lg">
                            Service name
                        </th>
                        <th class="px-6 py-3 rounded-e-lg">
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($service_invoice) == 0)
                    <tr class="bg-white dark:bg-gray-800">
                        <th colspan="2"
                            class="flex items-center w-full px-6 py-4 mx-auto font-medium text-yellow-700 gap-x-1 whitespace-nowrap dark:text-white">
                            <svg class="w-6 h-6 text-yellow-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span>tidak ada service yang dipilih</span>
                        </th>
                    </tr>
                    @endif
                    @foreach ($service_invoice as $service)
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$service->service_name}}
                        </th>
                        <td class="px-6 py-4">
                            Rp {{number_format($service->price, 0, ',', '.')}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-y">
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <th scope="row" class="px-6 py-3 text-base">Total</th>
                        <td class="px-6 py-3">Rp {{number_format($total, 0, ',', '.')}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>