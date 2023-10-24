import DataTable from "datatables.net-dt";

document.addEventListener("DOMContentLoaded", () => {
    const table = new DataTable("#table", {
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
