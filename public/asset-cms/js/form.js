apiHeaders['headers']['Authorization'] = 'Bearer '+$("meta[name='tapi']").attr("content");

$(document).ready(function() {
  $('.form-select').select2();
  $('.form-select-tags').select2({
    tags: true
  });
  $('.summernote-area').summernote({
      placeholder: 'Tulis sesuatu disini....',
      tabsize: 2,
      height: 200
  })
});

$("#file-upload").css("opacity", "0");
$("#file-browser").click(function(e) {
  e.preventDefault();
  $("#file-upload").trigger("click");
});

$("#btn-submit-add").on('click', function(e) {
  const form    = document.getElementById('form-add');
  const object  = $(form).data('object');
  
  form.reportValidity()
  if (!form.checkValidity()) {
  } else if($('[name="check_validity"]').val() == 0){
    iziToast.warning({
        title: "Gagal",
        message: 'Masih ada isian yang belum valid, mohon diperbaiki',
        position: 'center',
    });
  } else {
    $('#loading').show();
    $('#form').hide();
    const formData = new FormData(form);
    // for (const [key, value] of formData) {
    //   console.log('»', key, value)
    // }; return;
    axios.post(baseUrl+'/api/'+object, formData, apiHeaders)
    .then(function (response) {
      console.log('response..',response);
      if(response.status == 200) {
        iziToast.success({
            title: response.data.message,
            message: 'Anda akan diarahkan ke list data',
            position: 'center',
            progressBarColor: 'rgb(0, 255, 184)',
        });
        // setTimeout(function() {
        //   window.location = baseUrl+'/cms/'+object;
        // }, 1500);
      }else{
        iziToast.warning({
            title: "Gagal",
            message: response.data.message,
            position: 'center',
            buttons: [
                ['<button>OK</button>', function (instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                    }, toast, 'Tombol OK');
                }]
            ],
        });
      }
      $('#loading').hide();
      $('#form').show();
    })
    .catch(function (error) {
      iziToast.error({
          title: "Gagal",
          message: error.response?error.response.data.message:error.message,
          position: 'center',
          buttons: [
              ['<button>OK</button>', function (instance, toast) {
                  instance.hide({
                      transitionOut: 'fadeOutUp',
                  }, toast, 'Tombol OK');
              }]
          ],
      });
      $('#loading').hide();
      $('#form').show();
    });
  }
});

$("#btn-submit-edit").on('click', function(e) {
  const form    = document.getElementById('form-edit');
  const object  = $(form).data('object');
  const id      = $(form).data('id');

  form.reportValidity()
  if (!form.checkValidity()) {
  } else if($('[name="check_validity"]').val() == 0){
    iziToast.warning({
        title: "Gagal",
        message: 'Masih ada isian yang belum valid, mohon diperbaiki',
        position: 'center',
    });
  } else {
    $('#loading').show();
    $('#form').hide();
    const formData = new FormData(form);
    // for (const [key, value] of formData) {
    //   console.log('»', key, value)
    // }; return;
    axios.post(baseUrl+'/api/'+object+'/'+id, formData, apiHeaders) // why not put? put cant send multipart format
    .then(function (response) {
      console.log('response..',response);
      if(response.status == 200) {
        iziToast.success({
          title: response.data.message,
            message: 'Anda akan diarahkan ke list data',
            position: 'center',
            progressBarColor: 'rgb(0, 255, 184)',
        });
        setTimeout(function() {
          window.location = baseUrl+'/cms/'+object;
        }, 1500);
      }else{
        iziToast.warning({
            title: "Gagal",
            message: response.data.message,
            position: 'center',
            buttons: [
                ['<button>OK</button>', function (instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                    }, toast, 'Tombol OK');
                }]
            ],
        });
      }
      $('#loading').hide();
      $('#form').show();
    })
    .catch(function (error) {
      iziToast.error({
          title: "Gagal",
          message: error.response?error.response.data.message:error.message,
          position: 'center',
          buttons: [
              ['<button>OK</button>', function (instance, toast) {
                  instance.hide({
                      transitionOut: 'fadeOutUp',
                  }, toast, 'Tombol OK');
              }]
          ],
      });
      $('#loading').hide();
      $('#form').show();
    });
  }
});
