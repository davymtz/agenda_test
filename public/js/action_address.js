/* Add modal*/
$("#add_address_btn").on("click", function (e){
  e.preventDefault();
  let address = $("#add_address input[name='address']").val();
  let id_user = $("#id_user").val();
  const host = 'http://test_triara.local/api/address';
  $("#add_address_btn").text("Cargando...");
  $.post(host,{id:id_user,address:address}).done(
    data => {
      alert(data.message);
      $("#add_address").modal("hide");
      location.reload();
    }).fail(err => {
      // console.log(err);
      let response = err.responseJSON;
      errorMessage(err.status,response.errors.address,"#add_address","#add_address_btn");
    });
}); /*End add modal*/
/*Modal edit*/
function getDataAddress(id){
  const host = 'http://test_triara.local/api/address/'+id;
  $.get(host).done(data => {
    $("#edit_address input[name='id']").val(id);
    $("#edit_address input[name='address']").val(data.address);
  });
}
$("#edit_address_btn").click(e => {
  e.preventDefault();
  let $id = $("#edit_address input[name='id']").val();
  let $address = $("#edit_address input[name='address']").val();
  const host = 'http://test_triara.local/api/address/'+$id;
  $("#edit_address_btn").text("Cargando...");
  fetch(host,{
    method: "PUT",
    credentials: "omit",
    mode: 'same-origin',
    headers: {
      "Content-Type": "application/json; charset=utf-8"
    },
    body: JSON.stringify({address:$address}),
  }).then((response) => {
    if(response.ok) {
      response.json().then(data => {
        alert(data.message);
        $("#edit_address").modal("hide");
        location.reload();
      });
    } else {
      response.json().then(err => {
        errorMessage(response.status,err.errors.address,"#edit_address","#edit_address_btn");
      });
    }
  }).catch(function (err){

  });
});
/*End Modal edit*/
/*Delete modal*/
$(".btn_delete_address").click(e => {
  e.preventDefault();
  let $id = e.currentTarget.getAttribute("data-id");
  const host = 'http://test_triara.local/api/address/'+$id;
  //console.log(host)
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
