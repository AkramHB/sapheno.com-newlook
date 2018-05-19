function hugeitContactExportForm(JSONData,form_id) {
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) { dd='0'+dd; }

    if(mm<10) { mm='0'+mm; }

    today = mm+'/'+dd+'/'+yyyy;

    var fileName = "hugeit_contact_"+form_id+'_'+today;
    var uri = 'data:text/csv;charset=utf-8,' + escape(JSON.stringify(arrData));
    var link = document.createElement("a");
    link.href = uri;
    link.style = "visibility:hidden";
    link.download = fileName + ".hgf";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

jQuery(document).ready(function () {
    jQuery(document).on('click','#export-button',function () {
        var form_id = jQuery('#export-form').val(); /* int */

        var general_data = {
            action: "hugeit_contact_export_form",
            nonce: hugeit_forms_exportForm.nonce,
            form: form_id
        };
        jQuery(this).find('.fa-check').removeClass('fa-check').addClass('fa-spinner');
        jQuery.post(ajaxurl, general_data, function (response) {
            if (response.success) {
                hugeitContactExportForm(response.data,form_id);
            } else {
                alert('not done');
            }
        }, "json");

        return false;
    })
})
