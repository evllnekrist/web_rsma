
$(document).ready(function() {
    CKEDITOR.replace('wysiwyg-editor-0', {
        language: 'id'
    });
});
  
  $("#schedule-add-btn").on('click', function(e) {
    if(!$('#schedule-label').val()){
      iziToast.warning({
        title: "Nah!",
        message: "isian harus lengkap",
        position: 'center',
      });
    }else{
      let counter = $('#data-schedule-wrap').data('count');
      let template = ` <div class="row" id="schedule-item-`+(++counter)+`">
                            <div class="form-group col-md-8">
                                <input type="text" name="schedule[]" value="`+$('#schedule-label').val()+`">
                            </div>
                            <div class="form-group col-md-4">
                                <center><a onclick="removeElement('schedule',`+counter+`)"><req><i class="fas fa-trash"></i></req></a></center>
                            </div>
                        </div>`;
      $('#data-schedule-wrap').data('count',counter);
      $('#data-schedule-wrap').append(template);
    }
  });
  
  $("#slider-add-btn").on('click', function(e) {
      let counter = $('#data-slider-wrap').data('count');
      let template = ` <div class="form-group col-md-4" id="slider-item-`+(++counter)+`">
                            <div class="pull-left x-ear">
                                <button type="button" class="close" aria-label="Close" onclick="removeElement('slider',`+counter+`)">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> 
                            <div class="upload-wrapper">
                                <div class="upload-container">
                                    <div class="upload-container-in">
                                        <div class="border-container-in">
                                            <div class="icons fa-4x mt-3 mb-5" id="input-file-none-slide-`+counter+`">
                                                <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                                                <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                            </div>
                                            <div class="mx-auto mb-1" id="input-file-preview-slide-`+counter+`"></div>
                                            <input type="file" id="file-upload" data-index-input-file="slide-`+counter+`" name="sliders[`+counter+`][img_main]" class="input-sm" onchange="inputFile(event)">
                                            <p class="mb-2"><small>Drag dan drop file, atau <a href="#" id="file-browser">cari disini</a>.</small></p>
                                            <textarea class="textarea-compact" placeholder="Judul" name="sliders[`+counter+`][label]"></textarea>
                                            <textarea class="textarea-compact" placeholder="Sub judul atas" name="sliders[`+counter+`][value]"></textarea>
                                            <textarea class="textarea-compact" placeholder="Sub judul bawah" name="sliders[`+counter+`][description]"></textarea>
                                            <input type="text" placeholder="Link tombol" name="sliders[`+counter+`][value2]" class="nospace_rw_hypen lowercase">
                                            <span class="text-muted smaller">* isi, hanya jika, ingin bagian tersebut tampil</span>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>`;
      $('#data-slider-wrap').data('count',counter);
      $('#data-slider-wrap').append(template);
  });
  
  $("#related-link-add-btn").on('click', function(e) {
      let counter = $('#data-related-link-wrap').data('count');
      let template = ` <div class="form-group col-md-4" id="related-link-item-`+(++counter)+`">
                            <div class="pull-left x-ear">
                                <button type="button" class="close" aria-label="Close" onclick="removeElement('related-link',`+counter+`)">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="upload-wrapper">
                                <div class="upload-container">
                                    <div class="upload-container-in">
                                        <div class="border-container-in">
                                            <div class="icons fa-4x mt-3 mb-5" id="input-file-none-related-link-`+counter+`">
                                                <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                                                <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                            </div>
                                            <div class="mx-auto mb-1" id="input-file-preview-related-link-`+counter+`"></div>
                                            <input type="file" id="file-upload" data-index-input-file="related-link-`+counter+`" name="related_links[`+counter+`][img_main]" class="input-file input-sm" >
                                            <p class="mb-2"><small>Drag dan drop file, atau <a href="#" id="file-browser">cari disini</a>.</small></p>
                                            <textarea class="textarea-compact" placeholder="Nama" name="related_links[`+counter+`][label]"></textarea>
                                            <input type="text" placeholder="Link" name="related_links[`+counter+`][value2]" class="nospace_rw_hypen lowercase">
                                            <span class="text-muted smaller">* isi, hanya jika, ingin bagian tersebut tampil</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>`;
      $('#data-related-link-wrap').data('count',counter);
      $('#data-related-link-wrap').append(template);
  });

  function removeElement(elId,counter){
    console.log('removing: ','#'+elId+'-item-'+counter);
    $('#'+elId+'-item-'+counter).remove();
  }

  
$("#btn-submit-edit").on('click', function(e) {
    let form_id   = 'form-edit';
    let form      = document.getElementById(form_id);
  
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
    //   $('#'+form_id).hide();
      let formData = new FormData(form);
      $('.wysiwyg-editor').each(function(i, obj) {
        formData.append($(obj).attr('name'),CKEDITOR.instances['wysiwyg-editor-'+i].getData());
      });
      // for (const [key, value] of formData) {
      //   console.log('»', key, value)
      // }; return;
      axios.post(baseUrl+'/api/web-info/manage', formData, apiHeaders) // why not put? put cant send multipart format
      .then(async function (response) {
        console.log('response..',response);
        if(response.status == 200) {
            iziToast.success({
              title: response.data.message,
                message: 'Anda akan diarahkan ke list data',
                position: 'center',
                progressBarColor: 'rgb(0, 255, 184)',
            });
            setTimeout(function() {
              window.location = baseUrl+'/cms/web';
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