import DataTable from "datatables.net-dt";

document.addEventListener("DOMContentLoaded", () => {
    const table = new DataTable("#table", {
        responsive: true,
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"],
        ],
    });
});
