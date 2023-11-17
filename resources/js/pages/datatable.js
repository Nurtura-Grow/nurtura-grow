import $ from 'jquery';
import DataTable from "datatables.net-dt";
import 'datatables.net-responsive';
import 'datatables.net-rowgroup';

$(document).ready(function () {
    const table = new DataTable("table", {
        responsive: true,
        lengthMenu: [
            [5, 10, 25, 50, 100, -1], // Value
            [5, 10, 25, 50, 100, "Semua"], // Label
        ],
        rowGroup: {
            dataSrc: 1
        },
        language: {
            sSearch: "Cari data:",
            sEmptyTable: "Tidak ada data", // Tabel Empty
            sLengthMenu: "Tunjukkan _MENU_ data", // Info
            sInfo: "Menunjukkan data ke-_START_ hingga ke-_END_ dari _TOTAL_ data", // Info bawah kiri (showing 0 to 5 of 10 entries)
            sInfoEmpty: "Tidak ada data",
            paginate: {
                previous: "<",
                next: ">",
            },
            oAria: {
                sSortAscending: ": activate to sort column ascending",
                sSortDescending: ": activate to sort column descending",
            },
        },
    })

    const searchInput = document.querySelector(".dataTables_filter input");
    searchInput.classList.add("form-control");

    const lengthSelect = document.querySelector(".dataTables_length select");
    lengthSelect.classList.add("form-select");
    lengthSelect.setAttribute("placeholder", "Cari data");

    // Hide the initial hidden column
    table.columns('.hidden-column').visible(false);

    $('#btn-keterangan').on('click', function () {
        var column = table.column('.hidden-column');
        var columnVisible = !column.visible();

        if (columnVisible) {
            $(this).html('<i class="fa-regular fa-eye-slash mr-2"></i>Sembunyikan Keterangan');
        } else {
            $(this).html('<i class="fa-regular fa-eye mr-2"></i> Tampilkan Keterangan');
        }

        column.visible(columnVisible);
    });
});
