import $ from "jquery";

// Change Container Lahan
function createLahanElement(lahan) {
    const div = `
        <div class="p-3 cursor-pointer hover:bg-slate-100 rounded-md flex items-center lokasi-lahan"
            data-koordinat= ${JSON.stringify({
                lat: lahan.latitude,
                lng: lahan.longitude,
            })}>
            <div class="flex flex-row gap-3">
                <div class="flex-initial">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="w-full">
                    <p class="font-bold"> ${lahan.nama_lahan}</p>
                    <p class="font-medium text-primary ${lahan.new_nama}">${
        lahan.kecamatan + ", " + lahan.kota
    }
                    </p>
                </div>
            </div>
        </div>
    `;

    return div;
}

$("#search-lahan").on("keyup", function () {
    var searchTerm = $(this).val();

    $.ajax({
        url: url,
        method: "GET",
        data: {
            search: searchTerm,
        },
        success: function (data) {
            seluruhLahan = data.data_lahan;

            $(".containerLahan").empty();
            seluruhLahan.forEach((lahan) => {
                const div = createLahanElement(lahan);
                $(".containerLahan").append(div);
            });
        },
    });
});
