<!-- BEGIN: Modal Content -->
<div id="datepicker-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Filter grafik berdasarkan tanggal
                </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                {{-- Pilih Tanggal --}}
                <p class="col-span-12 font-bold">
                    Pilih Tanggal
                </p>
                <div class="col-span-12 grid grid-cols-12 gap-4 gap-y-3">
                    <div
                        class="chooseDate col-span-12 sm:col-span-6 2xl:col-span-4 shadow-md border-2 box p-4 flex justify-center text-center items-center cursor-pointer zoom-in bg-primary text-white font-semibold">
                        Hari ini
                    </div>
                    <div
                        class="chooseDate col-span-12 sm:col-span-6 2xl:col-span-4 shadow-md border-2 box p-4 flex justify-center text-center items-center cursor-pointer zoom-in">
                        Kemarin
                    </div>
                    <div
                        class="chooseDate col-span-12 sm:col-span-6 2xl:col-span-4 shadow-md border-2 box p-4 flex justify-center text-center items-center cursor-pointer zoom-in">
                        1 Minggu Terakhir
                    </div>
                    <div
                        class="chooseDate col-span-12 sm:col-span-6 2xl:col-span-4 shadow-md border-2 box p-4 flex justify-center text-center items-center cursor-pointer zoom-in">
                        1 Bulan Terakhir
                    </div>
                    <div id="lainnya"
                        class="chooseDate col-span-12 sm:col-span-6 2xl:col-span-4 shadow-md border-2 box p-4 flex justify-center text-center items-center cursor-pointer zoom-in">
                        Lainnya
                    </div>
                </div>

                {{-- Tanggal lainnya --}}
                <div class="col-span-12 dateLainnya hidden sm:col-span-6">
                    <label for="modal-datepicker-1" class="form-label font-bold">Dari</label>
                    <input type="text" id="modal-datepicker-1" class="datepicker form-control"
                        data-single-mode="true">
                </div>
                <div class="col-span-12 dateLainnya hidden sm:col-span-6">
                    <label for="modal-datepicker-2" class="form-label font-bold">Hingga</label>
                    <input type="text" id="modal-datepicker-2" class="datepicker form-control"
                        data-single-mode="true">
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
                <button type="button" data-tw-dismiss="modal"
                    class="btn btn-outline-secondary w-36 mr-1">Batal</button>
                <button type="button" class="btn btn-primary w-36">Pilih Tanggal</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>
<!-- END: Modal Content -->
