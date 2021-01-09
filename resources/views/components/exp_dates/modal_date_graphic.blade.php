<div class="modal" id="modalShowGrafic{{ $date }}" tabindex="-1" role="dialog" aria-labelledby="modalShowGraficLabel"aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowGraficLabel">Evolução (QUANTIDATE vs DIA)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-3" id="chart_div{{$date}}"></div>
            </div>
        </div>
    </div>
</div>