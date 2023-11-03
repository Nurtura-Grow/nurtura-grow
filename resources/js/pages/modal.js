import $ from 'jquery';

$('.delete-lahan').on("click", function () {
    console.log("clicked")
    let idLahan = $(this).data("lahan").id_lahan;

    console.log(idLahan);
    $("#deleteLahan").attr("action", `/lahan/${idLahan}`);
});
