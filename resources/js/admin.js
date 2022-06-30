/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.boolpress = {
    currentForm: null,
    itemid: null,
    openModal(e, id) {
        e.preventDefault();
        console.log(id);
        this.itemid = id;
        //console.log(e.currentTarget);
        this.currentForm = e.currentTarget.parentNode;
        // console.log(this.currentForm);
        $("#deleteModal-body").html(
            `sei sicuro di voler eliminare questo elemento?`
        );
        $("#deleteModal").modal("show");
    },
    openModalComments(e, id) {
        e.preventDefault();
        console.log(id);
        this.itemid = id;
        //console.log(e.currentTarget);
        this.currentForm = e.currentTarget.parentNode;
        // console.log(this.currentForm);
        $("#deleteModal-body").html(
            `sei sicuro di voler eliminare questo commento?`
        );
        $("#deleteModal").modal("show");
    },
    previewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src =
                oFREvent.target.result;
        };
    },
    submitForm() {
        this.currentForm.submit();
    },
};
