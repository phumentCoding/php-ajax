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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="product-table">
                

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
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div>
                            <label for="image">Product Image</label>
                            <input type="file" name="image" id="image" class=" form-control">
                        </div>

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

    const getAllProduct = () => {
        $.ajax({
            type : 'GET',
            url  : 'ProductController.php?type=list',
            dataType: "json",
            success : (response) => {
                if(response.status == true){
                    let tr = ``;
                    $.each(response.products,(index,value) => {
                        tr += `
                           <tr class="align-middle">
                                <td>${index + 1}</td>
                                <td>${value.id}</td>
                                <td>
                                   <img width="50" height="60" src="images/${value.image}"/>
                                </td>
                                <td>${value.name}</td>
                                <td>$${value.price}</td>
                                <td>${value.qty}</td> 
                                <td>
                                    <span class=" badge bg-success">Active</span>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-edit btn-sm">Edit</button>
                                    <button onclick="deleteProduct(${value.id})" class="btn btn-danger btn-delete btn-sm">Delete</button>
                                </td>
                            </tr>
                        `;
                    })

                    $("#product-table").html(tr);
                }
            }

        });
    }

    getAllProduct();
    
    const saveProduct = () => {
        let form = $('#formCreate')[0];
        let data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "ProductController.php?type=store",
            data: data,
            dataType: "json",
            processData : false,
            contentType : false,
            success: function(response) {
                if(response.status == true){
                    $('#modalCreate').modal('hide');
                    $('#formCreate').trigger('reset');

                    getAllProduct();
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                console.log("Response Text:", xhr.responseText);
                alert("An error occurred: " + error);
            }
        });
    }

    const deleteProduct = (id) => {
        

        if(confirm('Do you want to delete this?')){
            $.ajax({
                type : 'POST',
                url  : 'ProductController.php?type=delete',
                data : {
                    'id' : id
                },
                dataType: "json",
                success : (response) => {
                    if(response.status == true){
                        getAllProduct();
                    }
                }
                
            });
        }
    }

</script>
</html>