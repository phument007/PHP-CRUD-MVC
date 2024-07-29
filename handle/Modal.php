<?php
function ModelDelete(){
?>
    <!-- Modal -->
    <div class="modal fade" id="Modal_delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="text" value="" name="product_id" class="product_id">
                        <h3>Do you want to delete this?</h3>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="yes_delete" class="btn btn-success">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}






?>