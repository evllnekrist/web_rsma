apiHeaders['headers']['Authorization'] = 'Bearer '+$("meta[name='tapi']").attr("content");
// import { ClassicEditor, SourceEditing } from 'ckeditor5';

$(document).ready(function() {
  
  $('.form-select').select2();
  $('.form-select-tags').select2({
    tags: true
  });
  
  $('.wysiwyg-editor').each(function(i, obj) {
    CKEDITOR.replace('wysiwyg-editor-'+i, {
        language: 'id',
        // uiColor: '#018f55'
    });
  });

});

$('.upload-container').on('click', function() {
  console.log('upload window appeared');
  var index = $(this).data('index'); // Get the index from data attribute
  $('#input-file-el-' + index).trigger('click'); // Trigger the file input based on index
});
$(".input-file").css("opacity", "0");
$(".file-browser").click(function(e) {
  e.preventDefault();
  let iii = event.target.getAttribute('data-index-input-file');
  $("#input-file-el-"+iii).trigger("click");
});

$("#btn-submit-add").on('click', function(e) {
  let form_id   = 'form-add';
  let form      = document.getElementById(form_id);
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
    $('#'+form_id+'-loading').show();
    $('#'+form_id).hide();
    let formData = new FormData(form);
    // for (const [key, value] of formData) {
    //   console.log('»', key, value)
    // }; return;
    axios.post(baseUrl+'/api/'+object, formData, apiHeaders)
    .then(function (response) {
      console.log('response..',response);
      if(response.status == 200) {
        if($('#custom-inputs').length){ 
          let customInputs = $.parseJSON($('#custom-inputs').html());
          form      = document.getElementById('form-add-custom');
          formData  = new FormData(form);
          formData.append('ref_id',response.data.data.id);
          // for (const [key, value] of formData) {
          //     console.log('»', key, value)
          // }
          try{
            let axiosSub = [];
            customInputs.forEach(async function(item) {
              axiosSub[item.type] = await axios.post(item.api_url, formData, apiHeaders) 
              .then(async function (response2) {
                console.log('response2..',response2);
              })
              .catch(function (error) {
                console.log('error',error)
                iziToast.error({
                    timeout: 20000,
                    title: "Gagal [Tingkat 2]",
                    message: error.message,
                    position: 'center',
                    buttons: [
                        ['<button>OK</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                            }, toast, 'Tombol OK');
                        }]
                    ],
                });
                $('#'+form_id+'-loading').hide();
                $('#'+form_id).show();
                return;
              });
            });
            iziToast.success({
              title: response.data.message,
                message: 'Anda akan diarahkan ke list data [Tingkat 2]',
                position: 'center',
                progressBarColor: 'rgb(0, 255, 184)',
            });
            setTimeout(function() {
              window.location = baseUrl+'/cms/'+object;
            }, 1500);
          }catch(err){
            console.log(err);
            iziToast.error({
                timeout: 20000,
                title: "Gagal [Tingkat 2 pada catch]",
                message: "lihat console",
                position: 'center',
            });
            $('#'+form_id+'-loading').hide();
            $('#'+form_id).show();
          }
        }else{
          iziToast.success({
              title: response.data.message,
              message: 'Anda akan diarahkan ke list data',
              position: 'center',
              progressBarColor: 'rgb(0, 255, 184)',
          });
          setTimeout(function() {
            window.location = baseUrl+'/cms/'+object;
          }, 1500);
        }
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
      $('#'+form_id+'-loading').hide();
      $('#'+form_id).show();
    })
    .catch(function (error) {
      iziToast.error({
          timeout: 20000,
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
      $('#'+form_id+'-loading').hide();
      $('#'+form_id).show();
    });
  }
});

$("#btn-submit-edit").on('click', function(e) {
  let form_id   = 'form-edit';
  let form      = document.getElementById(form_id);
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
    $('#'+form_id+'-loading').show();
    $('#'+form_id).hide();
    let formData = new FormData(form);
    $('.wysiwyg-editor').each(function(i, obj) {
      formData.append($(obj).attr('name'),CKEDITOR.instances['wysiwyg-editor-'+i].getData());
    });
    // for (const [key, value] of formData) {
    //   console.log('»', key, value)
    // }; return;
    axios.post(baseUrl+'/api/'+object+'/'+id, formData, apiHeaders) // why not put? put cant send multipart format
    .then(async function (response) {
      console.log('response..',response);
      if(response.status == 200) {
        if($('#custom-inputs').length){
          let customInputs = $.parseJSON($('#custom-inputs').html());
          form      = document.getElementById('form-edit-custom');
          formData  = new FormData(form);
          formData.append('ref_id',id);

          try{
            let axiosSub = [];
            customInputs.forEach(async function(item) {
              // eval(item.type+'Exec')();
              axiosSub[item.type] = await axios.post(item.api_url, formData, apiHeaders) 
              .then(async function (response2) {
                console.log('response2..',response2);
              })
              .catch(function (error) {
                console.log('error',error)
                iziToast.error({
                    timeout: 20000,
                    title: "Gagal [Tingkat 2]",
                    message: error.message,
                    position: 'center',
                    buttons: [
                        ['<button>OK</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                            }, toast, 'Tombol OK');
                        }]
                    ],
                });
                $('#'+form_id+'-loading').hide();
                $('#'+form_id).show();
                return;
              });
            });
            iziToast.success({
              title: response.data.message,
                message: 'Anda akan diarahkan ke list data [Tingkat 2]',
                position: 'center',
                progressBarColor: 'rgb(0, 255, 184)',
            });
            setTimeout(function() {
              window.location = baseUrl+'/cms/'+object;
            }, 1500);
          }catch(err){
            console.log(err);
            iziToast.error({
                timeout: 20000,
                title: "Gagal [Tingkat 2 pada catch]",
                message: "lihat console",
                position: 'center',
            });
            $('#'+form_id+'-loading').hide();
            $('#'+form_id).show();
          }
        }else{
          iziToast.success({
            title: response.data.message,
              message: 'Anda akan diarahkan ke list data',
              position: 'center',
              progressBarColor: 'rgb(0, 255, 184)',
          });
          setTimeout(function() {
            window.location = baseUrl+'/cms/'+object;
          }, 1500);
        }
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
      $('#'+form_id+'-loading').hide();
      $('#'+form_id).show();
    })
    .catch(function (error) {
      iziToast.error({
          timeout: 20000,
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
      $('#'+form_id+'-loading').hide();
      $('#'+form_id).show();
    });
  }
});

$(".schedule-open-form-btn").on('click', function(e) {
  let idx = $(this).data('day-idx');
  $('#schedule-add-btn').data('day-idx', idx);
  $('#schedule-draft-day').html(days[idx]);
});

$("#schedule-add-btn").on('click', function(e) {
  if(!$('#schedule-draft-from').val() || !$('#schedule-draft-to').val()){
    iziToast.warning({
      title: "Nah!",
      message: "isian harus lengkap",
      position: 'center',
    });
  }else{
    let idx = $(this).data('day-idx');
    let counter = $('#schedule-day-'+idx+'-wrap').data('count');
    let template = `<div class="row small" style="wax-width:200px" id="schedule-item-`+idx+`-`+(++counter)+`">
                      <div class="form-group col-md-4">
                        <input type="time" name="schedule[`+idx+`][from][]" value="`+$('#schedule-draft-from').val()+`">
                      </div>
                      <div class="form-group col-md-4">
                        <input type="time" name="schedule[`+idx+`][to][]" value="`+$('#schedule-draft-to').val()+`">
                      </div>
                      <span class="col-md-4"><a onclick="removeSchedule(`+idx+`,`+counter+`)"><req><i class="fas fa-trash"></i></req></a></span>
                    </div>`;
    $('#schedule-day-'+idx+'-wrap').data('count',counter);
    $('#schedule-day-'+idx).append(template);
    $('#form-add-schedule').collapse('hide');
  }
});

function removeSchedule(idx,counter){
  $('#schedule-item-'+idx+'-'+counter).remove();
}