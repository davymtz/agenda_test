/* Add modal*/
$("#add_email_btn").on("click", function (e){
  e.preventDefault();
  let email = $("#add_email input[name='email']").val();
  let id_user = $("#id_user").val();
  const host = 'http://test_triara.local/api/email';
  $("#add_email_btn").text("Cargando...");
  $.post(host,{id:id_user,email:email}).done(
    data => {
      alert(data.message);
      $("#add_email").modal("hide");
      location.reload();
    }).fail(err => {
      let response = err.responseJSON;
      errorMessage(err.status,response.errors.email,"#add_email","#add_email_btn");
    });
}); /*End add modal*/
/*Modal edit*/
function getDataEmail(id){
  const host = 'http://test_triara.local/api/email/'+id;
  $.get(host).done(data => {
    $("#edit_email input[name='id']").val(id);
    $("#edit_email input[name='email']").val(data.email);
  });
}
$("#edit_email_btn").click(e => {
  e.preventDefault();
  let $id = $("#edit_email input[name='id']").val();
  let $email = $("#edit_email input[name='email']").val();
  const host = 'http://test_triara.local/api/email/'+$id;
  $("#edit_email_btn").text("Cargando...");
  fetch(host,{
    method: "PUT",
    credentials: "omit",
    mode: 'same-origin',
    headers: {
      "Content-Type": "application/json; charset=utf-8"
    },
    body: JSON.stringify({email:$email}),
  }).then((response) => {
    if(response.ok) {
      response.json().then(data => {
        alert(data.message);
        $("#edit_email").modal("hide");
        location.reload();
      });
    } else {
      response.json().then(err => {
        errorMessage(response.status,err.errors.email,"#edit_email","#edit_email_btn");
      });
    }
  }).catch(function (err){ console.error("Error",err); });
});
/*End Modal edit*/
/*Delete modal*/
$(".btn_delete_email").click(e => {
  e.preventDefault();
  let $id = e.currentTarget.getAttribute("data-id");
  const host = 'http://test_triara.local/api/email/'+$id;
  // console.log(host)
  $confirm = confirm("¿Estás seguro que deseas eliminar este registro?");
  if($confirm) {
    fetch(host,{
      method: "DELETE",
      headers: {
        "Content-Type": "application/json; charset=utf-8"
      }
    }).then((response) => {
      if(response.ok){
        response.json().then(data => {
          alert(data.message);
          location.reload();
        });
      }
    }).catch(function(err) { console.log(err); });
  }
});
/*End delete modal*/
