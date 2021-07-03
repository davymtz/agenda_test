/* Add modal*/
$("#add_number_btn").on("click", function (e){
  e.preventDefault();
  let tag = $("#add_number input[name='tag']").val();
  let number = $("#add_number input[name='number']").val();
  let id_user = $("#id_user").val();
  const host = 'http://test_triara.local/api/numero';
  $("#add_number_btn").text("Cargando...");
  $.post(host,{id:id_user, tag:tag, number:number}).done(
    data => {
      alert(data.message);
      $("#add_number").modal("hide");
      location.reload();
    }).fail(err => {
      // console.log(err);
      let response = err.responseJSON;
      errorMessage(err.status,response.errors.number,"#add_number","#add_number_btn");
    });
}); /*End add modal*/
/*Modal edit*/
function getDataNumber(id){
  const host = 'http://test_triara.local/api/numero/'+id;
  $.get(host).done(data => {
    $("#edit_number input[name='id']").val(data.id);
    $("#edit_number input[name='tag']").val(data.tag);
    $("#edit_number input[name='number']").val(data.phone);
  }).fail(err => {
    let response = err.responseJSON;
    console.log(response); return false;
    // alert(response)
  });
}
$("#edit_number_btn").click(e => {
  e.preventDefault();
  let $id = $("#edit_number input[name='id']").val();
  let $tag = $("#edit_number input[name='tag']").val();
  let $phone = $("#edit_number input[name='number']").val();
  const host = 'http://test_triara.local/api/numero/'+$id;
  $("#edit_number_btn").text("Cargando...");
  fetch(host,{
    method: "PUT",
    credentials: "omit",
    mode: 'same-origin',
    headers: {
      "Content-Type": "application/json; charset=utf-8"
    },
    body: JSON.stringify({tag: $tag, number:$phone}),
  }).then((response) => {
    if(response.ok) {
      response.json().then(data => {
        alert(data.message);
        $("#edit_number").modal("hide");
        location.reload();
      });
    } else {
      response.json().then(err => {
        errorMessage(response.status,err.errors.number,"#edit_number","#edit_number_btn");
      });
    }
  }).catch(function (err){
    console.log(err);
  });
});
/*End Modal edit*/
/*Delete modal*/
$(".btn_delete_phone").click(e => {
  e.preventDefault();
  let $id = e.currentTarget.getAttribute("data-id");
  const host = 'http://test_triara.local/api/numero/'+$id;
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
      } else {
        response.json().then(data => {
          alert(data.message);
        });
      }
    }).catch(function(err) { console.log(err); });
  }
});
/*End delete modal*/
