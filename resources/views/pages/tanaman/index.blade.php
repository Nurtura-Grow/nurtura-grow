@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Daftar Tanaman
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{ route('tanaman.create') }}">
                <button class="btn btn-secondary text-white hover:text-rgb-secondary shadow-md">
                    <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Tanaman
                </button>
            </a>
        </div>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            {{-- Todo: Benerin filter --}}
            {{-- <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Field</label>
                    <select id="tabulator-html-filter-field"
                        class="form-select w-full  2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <option value="name">Name</option>
                        <option value="category">Category</option>
                        <option value="remaining_stock">Remaining Stock</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Type</label>
                    <select id="tabulator-html-filter-type" class="form-select w-full mt-2 sm:mt-0 sm:w-auto">
                        <option value="like" selected>like</option>
                        <option value="=">=</option>
                        <option value="<">&lt;</option>
                        <option value="<=">&lt;=</option>
                        <option value=">">></option>
                        <option value=">=">>=</option>
                        <option value="!=">!=</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                    <input id="tabulator-html-filter-value" type="text"
                        class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                </div>
                <div class="mt-2 xl:mt-0">
                    <button id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16">Go</button>
                    <button id="tabulator-html-filter-reset" type="button"
                        class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1 text-white hover:text-rgb-secondary">Reset</button>
                </div>
            </form> --}}

            {{-- Todo: benerin biar bisa  export & print --}}
            {{-- <div class="flex mt-5 sm:mt-0">
                <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2"> <i data-lucide="printer"
                        class="w-4 h-4 mr-2"></i> Print </button>
                <div class="dropdown w-1/2 sm:w-auto">
                    <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false"
                        data-tw-toggle="dropdown"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export <i
                            data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a id="tabulator-export-csv" href="javascript:;" class="dropdown-item"> <i
                                        data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export CSV </a>
                            </li>
                            <li>
                                <a id="tabulator-export-json" href="javascript:;" class="dropdown-item"> <i
                                        data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export JSON </a>
                            </li>
                            <li>
                                <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item"> <i
                                        data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export XLSX </a>
                            </li>
                            <li>
                                <a id="tabulator-export-html" href="javascript:;" class="dropdown-item"> <i
                                        data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export HTML </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- Todo:Benerin isi tabelnya + bikin responsive kayak di contoh: http://127.0.0.1:5500/side-menu-light-tabulator.html --}}
        <div class="overflow-x-auto scrollbar-hidden">
            <table id="table" class="display stripe hover overflow-x-auto">
                <thead>
                    <tr>
                        <th class="border-b-2 whitespace-nowrap">Name</th>
                        <th class="border-b-2 whitespace-nowrap">Category</th>
                        <th class="border-b-2 whitespace-nowrap">Remaining Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i < 10; $i++)
                        <tr>
                            <td class="border-b">Item {{ $i }}</td>
                            <td class="border-b">Category {{ $i }}</td>
                            <td class="border-b">{{ $i * 10 }}</td>
                        </tr>
                    @endfor
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css"></script>
    @vite('resources/js/pages/datatable.js')
@endpush
