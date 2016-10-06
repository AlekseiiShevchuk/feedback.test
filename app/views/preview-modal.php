<!-- Modal -->
<div id="previewModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Предпросмотр отзыва</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <b>Имя: </b> <span id="preName"></span> | <b> Дата: </b><span id="preDate">2016-10-06 15:10:58</span> |
                    <b>Email: </b><span id="preEmail"></span>
                </div>
                <div class="container">
                    <h4 class="media-heading">Отзыв:</h4>
                    <p id="preText"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        $("#preview").click(function(e){
            e.preventDefault();
            $("#preName").text(function () {
                return $("#name").val();
            }) ;

            $("#preEmail").text(function () {
                return $("#email").val();
            }) ;

            $("#preText").text(function () {
                return $("#text").val();
            }) ;

            $("#previewModal").modal();
        });
    });
</script>