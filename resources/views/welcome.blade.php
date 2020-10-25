<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Laravel & Ajax CRUD Application!</title>
  </head>
  <body>
    <header class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1> Laravel & Ajax CRUD Application! </h1>
                    <hr>
                </div>
            </div>
        </div>
    </header>
    <section class="body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Alll Customer</h3>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createCustomer">Create Customer</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Customer Name </th>
                                        <th> Customer Email </th>
                                        <th> Customer Phone </th>
                                        <th> Customer Address </th>
                                        <th style="width:150px"> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="TableBody">
                                    @foreach ($customers as $customer)
                                        <tr data-id= "{{$customer->id}}">
                                            <td>{{$customer->id}}</td>
                                            <td class="customer-name">{{$customer->name}}</td>
                                            <td class="customer-email">{{$customer->email}}</td>
                                            <td class="customer-phone">{{$customer->phone}}</td>
                                            <td class="customer-address">{{$customer->address}}</td>
                                            <td>
                                                <a id="edit" href="#" data-target="#editCustomer" data-toggle="modal" class="btn btn-sm btn-info">Edit</a>
	                                            <a id="delete" data-target="#deleteCustomer" data-toggle="modal" href="#" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr> 
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- Create Modal -->
  <div class="modal fade" id="createCustomer" tabindex="-1" role="dialog" aria-labelledby="createTaskTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <form id="createForm">
            <div class="modal-header">
            <h5 class="modal-title" id="createTitle">Create Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div id="createMsg"></div>
                <div class="form-group">
                    <label for="">Customer name</label>
                    <input id="cerate_name" type="text" class="form-control" name="name" placeholder="Customer name">
                </div>
                <div class="form-group">
                    <label for="email">Customer Email</label>
                    <input id="cerate_email" type="email" class="form-control" name="email" placeholder="Customer email">
                </div>
                <div class="form-group">
                    <label for="phone">Customer Phone</label>
                    <input id="cerate_phone" type="text" class="form-control" name="phone" placeholder="Customer phone">
                </div>
                <div class="form-group">
                    <label for="address">Customer address</label>
                    <input id="cerate_address" type="text" class="form-control" name="address" placeholder="Customer address">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create Customer</button>
            </div>
        </form>
      </div>
    </div>
  </div>
   <!-- Edit Modal -->
   <div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="editTaskTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <form id="editForm">
            <div class="modal-header">
            <h5 class="modal-title" id="editTaskTitle">Edit Csutomer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div id="editMsg"></div>
                <div class="form-group">
                    <label for="">Customer name</label>
                    <input id="edit_name" type="text" class="form-control" name="name" placeholder="Customer name">
                </div>
                <div class="form-group">
                    <label for="email">Customer Email</label>
                    <input id="edit_email" type="email" class="form-control" name="email" placeholder="Customer email">
                </div>
                <div class="form-group">
                    <label for="phone">Customer Phone</label>
                    <input id="edit_phone" type="text" class="form-control" name="phone" placeholder="Customer phone">
                </div>
                <div class="form-group">
                    <label for="address">Customer address</label>
                    <input id="edit_address" type="text" class="form-control" name="address" placeholder="Customer address">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update Customer</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteCustomer" tabindex="-1" role="dialog" aria-labelledby="deleteTaskTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <form id="deleteForm">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteTaskTitle">Delete Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body text-center">
                <div id="deleteMsg"></div>
                <h4>Are you you want to delete this?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </form>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js') }}/main.js"></script>
  </body>
</html>