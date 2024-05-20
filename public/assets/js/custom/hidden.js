"use strict";
var KTFormsTinyMCEHidden = (function () {
    var form;
    return {
        init: function () {
            (form = document.querySelector("#prueba"))
            // form.value="zddasds"
            console.log(form)
            // tinymce.init({
            //     selector: "#kt_docs_tinymce_hidden",
            //     menubar: !1,
            //     toolbar: [
            //         // "styleselect fontselect fontsizeselect",
            //         // "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
            //         // "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code",
            //     ],
            //     plugins:
            //         "advlist autolink link image lists charmap print preview code",
            // });


        },
    }


})();


KTUtil.onDOMContentLoaded(function () {
    KTFormsTinyMCEHidden.init();
});
