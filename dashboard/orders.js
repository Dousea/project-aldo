$.get("dashboard/_get_customers.php", data => {
  let customers = JSON.parse(data)

  // Append all customers' full name
  for (let id in customers) {
    $("#customer-id").append(`<option value=${id}>${customers[id].full_name}</option>`)
  }

  $("#customer-id").on("change", event => {
    let id = parseInt($(event.target).val())
    
    if (id !== 0) {
      $("#customer-full-name")
        .attr("readonly", "readonly")
        .val(customers[id].full_name)
      $("#customer-company")
        .attr("readonly", "readonly")
        .val(customers[id].company)
      $("#customer-job-title")
        .attr("readonly", "readonly")
        .val(customers[id].job_title)
    } else {
      $("#customer-full-name")
        .removeAttr("readonly")
        .val("")
      $("#customer-company")
        .removeAttr("readonly")
        .val("")
      $("#customer-job-title")
        .removeAttr("readonly")
        .val("")
    }
  })
})

$.get("dashboard/_get_cars.php", data => {
  let cars = JSON.parse(data)
  
  // Append all car makers
  for (const [make] of Object.entries(cars))
    $("#car-make").append("<option>" + make + "</option>")

  // Append car models for current car maker
  cars[$("#car-make option:selected").val()].forEach(
    value => $("#car-model").append("<option>" + value + "</option>")
  )
  
  // Change car models based on selected car maker
  $("#car-make").on("change", event => {
    $("#car-model").empty();
    cars[$(event.target).val()].forEach(
      value => $("#car-model").append("<option>" + value + "</option>")
    )
  })
})

$("#form-save-btn").on("click", () => {
  $.post("dashboard/_new_order.php", $("#order-form").serialize(), data => {
    let err = JSON.parse(data);

    if (err["sql"]) {
      console.error(`SQL: ${err["sql"]}`)
    }

    $("#order-form input.form-control").each((_, input) => {
      let inputName = $(input).attr("name")

      if (err[inputName]) {
        $(input).addClass("is-invalid")
        $(input).siblings(".invalid-feedback").text(err[inputName])
      } else {
        $(input).removeClass("is-invalid")
      }
    })

    if (Object.keys(err).length == 0) {
      $("#order-form-modal").modal("hide")
      window.location = window.location
    }
  })
})

$("#order-form-modal").on("hidden.bs.modal", event => {
  $("#order-form").trigger("reset")
  $("#order-form input.form-control").removeClass("is-invalid")
})