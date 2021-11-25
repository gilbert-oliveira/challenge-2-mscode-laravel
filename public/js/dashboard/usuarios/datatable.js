$(function () {
  $("#usuarios").DataTable({
    "dom": 'Bfrtip',
    "responsive": true,
    "buttons": ["pdf"],

    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "language": {
      url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json'
    },
  }).buttons().container().appendTo('#usuarios_wrapper .col-md-6:eq(0)');
});