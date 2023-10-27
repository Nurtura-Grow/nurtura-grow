import DataTable from "datatables.net-dt";

document.addEventListener("DOMContentLoaded", () => {
    new DataTable("#table", {
        // searching: false,
        // lengthChange: false,
        // info: false,
        // pagination: false,
        responsive: true,
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"],
        ],
        language: {
            paginate: {
                previous: "<",
                next: ">",
            },
        },
    });

    const searchInput = document.querySelector(".dataTables_filter input");
    searchInput.classList.add("form-control");

    const lengthSelect = document.querySelector(".dataTables_length select");
    lengthSelect.classList.add("form-select");
    lengthSelect.setAttribute("placeholder", "Cari data");
});
