(function() {
    "use strict";

    var treeviewMenu = $(".app-menu");

    // Toggle Sidebar
    $('[data-toggle="sidebar"]').click(function(event) {
        event.preventDefault();
        $(".app").toggleClass("sidenav-toggled");
    });

    // Activate sidebar treeview toggle
    $("[data-toggle='treeview']").click(function(event) {
        event.preventDefault();
        if (
            !$(this)
                .parent()
                .hasClass("is-expanded")
        ) {
            treeviewMenu
                .find("[data-toggle='treeview']")
                .parent()
                .removeClass("is-expanded");
        }
        $(this)
            .parent()
            .toggleClass("is-expanded");
    });

    // Set initial active toggle
    $("[data-toggle='treeview.'].is-expanded")
        .parent()
        .toggleClass("is-expanded");

    //Activate bootstrip tooltips
    $("[data-toggle='tooltip']").tooltip();

    // DataTables
    $("#dt").DataTable({
        responsive: true
    });
    // Select2
    $(".select2").select2();
    // Date picker
    $(".selectDate").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
    });
    // CKeditor
    CKEDITOR.replace("editor", {
        language: "ar"
    });
    // Image preview
    $("#imgInp").change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#imgPreview").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]); // convert to base64 string
    }); //end of image preview

    // Multiple images preview in browser
    $("#photos-gallary").on("change", function() {
        var imagesContainer = $(".images-container");

        if (this.files) {
            imagesContainer.html("");
            var filesAmount = this.files.length;
            for (var i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML("<img>"))
                        .attr("src", event.target.result)
                        .attr("class", "img-fluid")
                        .css({
                            width: 100 + "px",
                            height: 100 + "px",
                            margin: 5 + "px"
                        })
                        .appendTo(imagesContainer);
                };
                reader.readAsDataURL(this.files[i]);
            }
        }
    }); //end of multiple

    // sweetalert delete btn
    $(".delete").click(function(e) {
        e.preventDefault();
        var that = $(this);
        swal(
            {
                title: "هل تريد حذف هذا العنصر؟",
                text: "لايمكن استرجاع هذا العنصر بعد الحذف",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "نعم",
                cancelButtonText: "الغاء",
                closeOnConfirm: false
            },
            function() {
                // yes button
                // submit the nearest form
                that.closest("form").submit();
                //swal("Deleted!", "Your imaginary file has been deleted.", "success");
            }
        );
    }); // end of sweetAlert
})();
