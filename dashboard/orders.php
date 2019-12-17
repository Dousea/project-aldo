<?php require_once "db.php" ?>

<div class="modal fade" id="order-form-modal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Form</h5>
      </div>
      <div class="modal-body">

        <form id="order-form" novalidate>
          <h5 class="mb-3">Customer Details</h5>
          <div class="form-group">
            <label for="customer-id">Customer</label>
            <select id="customer-id" name="customer_id" class="form-control">
              <option value="0" selected>+ New</option>
            </select>
          </div>
          <div class="form-group">
            <label for="customer-full-name">Full Name</label>
            <input type="text" class="form-control" id="customer-full-name" name="customer_full_name">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="customer-company">Company</label>
              <input type="text" class="form-control" id="customer-company" name="customer_company">
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group col-md-6">
              <label for="customer-job-title">Job Title</label>
              <input type="text" class="form-control" id="customer-job-title" name="customer_job_title">
              <div class="invalid-feedback"></div>
            </div>
          </div>
          <hr class="mb-4">
          <h5 class="mb-3">Car Details</h5>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="car-make">Make</label>
              <select id="car-make" name="car_make" class="form-control">
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="car-model">Model</label>
              <select id="car-model" name="car_model" class="form-control">
              </select>
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="form-save-btn">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Orders</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#order-form-modal">
      <i data-feather="plus-circle"></i>
      Add
    </button>
  </div>
</div>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>Date</th>
        <th>Customer</th>
        <th>Car</th>
      </tr>
    </thead>
    <tbody>
<?php
  $query = "SELECT orders.date, customers.full_name AS customer, CONCAT(cars.make, ' ', cars.model) AS car
            FROM orders
            LEFT JOIN customers ON orders.customer_id = customers.id
            LEFT JOIN cars ON orders.car_id = cars.id
            ORDER BY date DESC";
  
  if ($result = mysqli_query($link, $query)) {
    while ($order = mysqli_fetch_array($result)) {
?>
      <tr>
        <td><?php echo $order["date"] ?></td>
        <td><?php echo $order["customer"] ?></td>
        <td><?php echo $order["car"] ?></td>
      </tr>
<?php
    }
  }
?>
    </tbody>
  </table>
</div>