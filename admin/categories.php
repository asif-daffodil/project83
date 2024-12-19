<?php
function get_content()
{
    require_once './connection.php';
    ob_start();
    $categories = $cn->query("SELECT * FROM `categories`");
?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Categories</h2>
                        <p>Welcome to the admin categories.</p>
                    </div>
                    <div class="col-md-6 align-content-center">
                        <button class="btn btn-primary" id="AddCat">
                            <i class="fa-solid fa-plus"></i> Add new Category
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- show All previous categories -->
                <table class="table table-striped" id="allCat">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($category = $categories->fetch_assoc()) :
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $category['name'] ?></td>
                                <td>
                                    <button data-editId="<?= $category['id'] ?>" class="btn btn-sm btn-warning btnEdit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button data-dekId="<?= $category['id'] ?>" class="btn btn-sm btn-danger btnDelete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCatModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="add-category.php" method="post" id="addCatForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button class="btn btn-primary" name="addCategory">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCatModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="edit-category.php" method="post" id="editCatForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="editName" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button class="btn btn-primary" name="editCategory">Edit Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete category modal -->
    <div class="modal fade" id="deleteCatModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Category</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this category?</p>
                    <form action="delete-category.php" method="post" id="deleteCatForm">
                        <button class="btn btn-danger" name="deleteCategory">Delete Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#allCat').DataTable({
                lengthMenu: [5, 10, 20],
                order: [0, 'desc'],
                drawCallback: function(settings) {
                    // Update the serial numbers
                    var api = this.api();
                    api.column(0, {
                        page: 'current'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            });

            $('#AddCat').click(function() {
                $('#addCatModal').modal('show');
            });

            $('#addCatForm').submit(function(e) {
                e.preventDefault();
                const data = new FormData(this);
                data.append('addCategory', 'true');
                // check if name is not empty
                if (data.get('name') == '') {
                    $('#name').addClass('is-invalid');
                    $('#name').next().html('Please fill the category name');
                } else {
                    $('#name').removeClass('is-invalid');
                    $('#name').next().html('');
                    $.ajax({
                        url: "./ajax/category.php",
                        method: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'success') {
                                toastr.success('Category added successfully');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                toastr.error('Failed to add category');
                            }
                        }
                    });
                }
            });

            $(".btnEdit").on('click', function(){
                $('#editCatModal').modal('show');
                const id = $(this).data('editid');
                $.ajax({
                    url: "./ajax/category.php",
                    method: "POST",
                    data: {id: id, editId: true},
                    success: function(response){
                        const data = JSON.parse(response);
                        $('#editName').val(data.name);
                        $('#editCatForm').append(`<input type="hidden" name="id" value="${data.id}">`);
                    }
                });
            });

            $('#editCatForm').submit(function(e) {
                e.preventDefault();
                const data = new FormData(this);
                data.append('editCategory', 'true');
                // check if name is not empty
                if (data.get('name') == '') {
                    $('#editName').addClass('is-invalid');
                    $('#editName').next().html('Please fill the category name');
                } else {
                    $('#editName').removeClass('is-invalid');
                    $('#editName').next().html('');
                    $.ajax({
                        url: "./ajax/category.php",
                        method: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'success') {
                                toastr.success('Category updated successfully');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                toastr.error('Failed to update category');
                            }
                        }
                    });
                }
            });

            $(".btnDelete").on('click', function(){
                $('#deleteCatModal').modal('show');
                const id = $(this).data('dekid');
                $('#deleteCatForm').append(`<input type="hidden" name="id" value="${id}">`);
            });

            $('#deleteCatForm').submit(function(e) {
                e.preventDefault();
                const data = new FormData(this);
                data.append('deleteCategory', 'true');
                $.ajax({
                    url: "./ajax/category.php",
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 'success') {
                            toastr.success('Category deleted successfully');
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            toastr.error('Failed to delete category');
                        }
                    }
                });
            });

        });
    </script>
<?php
    return ob_get_clean();
}

$content = get_content();
require_once './layout.php';
?>