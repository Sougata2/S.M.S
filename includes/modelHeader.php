<!-- Button trigger modal -->
<button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fa-solid fa-trash"></i>
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">confirm delete ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strong>Student: </strong> <?php echo $name ?>
            </div>