import $ from 'jquery';
import DataTable from "datatables.net-dt";
import 'datatables.net-responsive';

$(document).ready(function () {
    const table = new DataTable("#table", {
        responsive: true,
        lengthMenu: [
            [5, 10, 25, 50, 100, -1], // Value
            [5, 10, 25, 50, 100, "Semua"], // Label
        ],
        language: {
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
});
