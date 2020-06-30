<div style="text-align: center;" class="modal fade" id="modal-sold{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>{{$title}}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="now-ui-icons ui-1_simple-remove"></i>
        </button>
      </div>
      <div  class="modal-body">
        <div class="instruction">
          <div class="row">
            <div class="col-md-12">
             <table id="table-sold" class="table table-striped">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Terjual</th>
                  <th>Cabang</th>
                  <th>Tanggal Terjual</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                 <th>Nama</th>
                 <th>Terjual</th>
                 <th>Cabang</th>
                 <th>Tanggal Terjual</th>
               </tr>
             </tfoot>
             <tbody>
              @foreach ($terjual as $teling)
              @if ($row->name == $teling->name )
              <tr>
                <td>{{$teling->name}}</td>
                <td>{{$teling->terjual}}</td>
                <td>{{$teling->cabang}}</td>
                <td>{{$teling->created_at}}</td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer justify-content-center">
    <!--  -->
  </div>
</div>
</div>
</div>

<script type="text/javascript"> 
  $(document).ready(function () {
    $('#table-sold').DataTable({
      "scrollX": true,
      dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
              return typeof i === 'string' ?
              i.replace(/[\Rp,]/g, '')*1 :
              typeof i === 'number' ?
              i : 0;
            };

            // Total over all pages
            total = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );

            // Total over this page
            pageTotal = api
            .column( 4, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );

            // Update footer
            $( api.column( 4 ).footer() ).html(
              'Rp '+ pageTotal 
              );
          }
        });
  });
</script>