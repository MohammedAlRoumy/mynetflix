(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

})();

//delete
$('.delete').click(function (e) {

    var that = $(this);

    e.preventDefault();

    var n = new Noty({
        text: "confirm delete data",
        type: "warning",
        killer: true,
        buttons: [
            Noty.button("yes", 'btn btn-success mr-2', function () {
                that.closest('form').submit();
            }),

            Noty.button("no", 'btn btn-primary', function () {
                n.close();
            })
        ]
    });

    n.show();

});//end of delete

//select2
$('.select2').select2();
