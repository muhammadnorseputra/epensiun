


const BUTTON = $("button#EditReferensiJenis");
const CANVAS = $("#offcanvasRight");
const FORM = $("form#FormUpdateJenisPensiun");

function Loading(isStatus, innerHtml="<b>Mohon Tunggu ...</b>") {
    if(isStatus == true) {
        FORM.css("display", "none")
        return CANVAS.find('.offcanvas-body #loading').html(innerHtml);
    }  else {
        FORM.css("display", "block")
        return CANVAS.find('.offcanvas-body #loading').html(innerHtml);
    }
}

BUTTON.on("click", function() {
    let _ = $(this),
    id = _.data('id');
    Loading(true);    
    $.post(`${_uri}/app/referensi/getJenisPensiun`, {id: id}, async function(res){
        await Loading(false,'');
        const { id, is_aktif: aktif, kelompok, keterangan, nama } = res;
        FORM.find('input[name="id"]').val(id);
        FORM.find('input[name="nama"]').val(nama);
        FORM.find('textarea[name="keterangan"]').val(keterangan);
        FORM.find('select[name="kelompok"]').val(kelompok);
        FORM.find('select[name="is_aktif"]').val(aktif);
    }, 'json');
})