// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("#dataTable")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#dataTable .col-md-6:eq(0)");
});
