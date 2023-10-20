    {{-- Todo: Add Backend untuk simpan filter by date --}}
    <!-- BEGIN: Modal Content -->
    <div id="datepicker-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Filter by Date
                    </h2>
                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"
                            data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="javascript:;" class="dropdown-item"> <i data-lucide="file"
                                            class="w-4 h-4 mr-2"></i> Download Docs </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modal Body -->
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-datepicker-1" class="form-label">From</label>
                        <input type="text" id="modal-datepicker-1" class="datepicker form-control"
                            data-single-mode="true">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-datepicker-2" class="form-label">To</label>
                        <input type="text" id="modal-datepicker-2" class="datepicker form-control"
                            data-single-mode="true">
                    </div>
                </div>
                <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer text-right">
                    <button type="button" data-tw-dismiss="modal"
                        class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <button type="button" class="btn btn-primary w-20">Submit</button>
                </div>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
    <!-- END: Modal Content -->
