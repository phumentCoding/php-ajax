<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <header class=" p-4 bg-success text-center text-light">
            <h3>PHP AJAX</h3>
        </header>

        <div class=" d-flex justify-content-between align-items-center mt-5 bg-primary p-3">
            <div class="">
                <button class="btn btn-danger btn-sum">Reset</button>
                <button class="btn btn-success btn-sum" data-bs-toggle="modal" data-bs-target="#modalCreate">add more</button>
            </div>
            <div class=""></div>
        </div>
        <table class=" table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="product-table">
                <tr>
                    <td>1</td>
                    <td>1001</td>
                    <td>I Phone 13 pro</td>
                    <td>$500</td>
                    <td>5</td> 
                    <td>
                        <span class=" badge bg-success">Active</span>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-edit btn-sm">Edit</button>
                        <button class="btn btn-danger btn-delete btn-sm">Delete</button>
                    </td>
                </tr>

            </tbody>
        </table>
        </table>
    </div>

    <!-- Modal create -->
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Insert new product</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formCreate" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Product Name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Product Price">
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="text" class="form-control" name="qty" id="qty" placeholder="Product Quantity">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Product Status</label>
                    <select name="status" id="status" class=" form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <!-- <div>
                    <label for="image">Product Image</label>
                    <input type="file" name="image" id="image" class=" form-control">
                </div> -->

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="saveProduct()" class="btn btn-success">Save</button>
        </div>
        </div>
    </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    // const saveProduct = () => {
    //         let data = new FormData($('#formCreate')[0]);
    //         let product = {
    //             'name' : data.get('name'),
    //             'price' : data.get('price'),
    //             'qty'   : data.get('qty'),
    //             'status' : data.get('status')
    //         }

        
    //         $.ajax({
    //             type: "POST",
    //             url: "ProductController.php?type=store",
    //             data: product,
    //             dataType: "json",
    //             success: function (response) {
                    
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText);
    //             }
    //         });
    // }

    
    const saveProduct = () => {
    let form = $('#formCreate')[0];
    let data = new FormData(form);

    $.ajax({
        type: "POST",
        url: "ProductController.php",
        data: data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(response) {
            console.log("Success:", response);
            if (response.status) {
                alert(response.message);
                $('#modalCreate').modal('hide');
                // Optionally refresh table data here
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.log("Response Text:", xhr.responseText);
            alert("An error occurred: " + error);
        }
    });
}

</script>
</html>