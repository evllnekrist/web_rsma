
$("#in_score").rating({
    hoverOnClear: false,
    // theme: 'krajee-svg',
    theme: 'krajee-fas',
    step: 1,
    stars: 5,
    tabindex: 0,
    mouseEnabled:true,
    clearValue: 0,
    hoverChangeStars:true,
    hoverChangeCaption:true,
    showClear: false,
    showCaption: true,
    zeroAsNull: true,
    displayOnly: false,
    // filledStar:'<span class="krajee-icon krajee-icon-star"></span>',
    // emptyStar:'<span class="krajee-icon krajee-icon-star"></span>',
    starCaptions: {0:'<b>Belum Dinilai</b>', 1:'<b>Sangat Kurang </b>', 2:'<b>Kurang</b>', 3:'<b>Cukup (Memadai)</b>', 4:'<b>Baik</b>', 5: '<b>Sangat Baik</b>'},
    starCaptionClasses: {0: 'text-grey', 1: 'txt-strawberry', 2: 'text-warning', 3: 'text-info', 4: 'text-primary', 5: 'text-success'}
});

$("#btn-submit-satisfaction").on('click', function(e) {
    let form_id     = 'form-satisfaction';
    let form        = document.getElementById(form_id);
    
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
      axios.post(baseUrl+'/api/satisfaction', formData, apiHeaders)
      .then(function (response) {
        console.log('response..',response);
        if(response.status == 200) {
            iziToast.success({
                title: response.data.message,
                message: 'Halaman akan direload',
                position: 'center',
                progressBarColor: 'rgb(0, 255, 184)',
            });
            setTimeout(function() {
              window.location = baseUrl+'?dslist=open';
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

function getDataSatisfaction(moveToPage=null){
    let id_list         = '#data-list-satisfaction';
    loadingElementImg   = `<tr>
                                <td colspan="100%"><center><img src="../../asset/images/loading.gif"></center></td>
                            </tr>`;
    $(id_list).html(loadingElementImg);
  
    if(moveToPage){
      $('._filter_satisfaction[name="_page"]').val(moveToPage);
    }
    let payload = {}; payload['_dir'] = {}
    $("._dir_satisfaction").each(function() {
      if($(this).data('dir')){
        payload['_dir'][$(this).attr('id').replace('th_','')] = $(this).data('dir');
      }
    });
    $("._filter_satisfaction").each(function() {
      payload[$(this).attr('name')] = $(this).val();
    });
    // console.log('payload',payload); 
    // return;
    axios.get(baseUrl+'/api/satisfaction', {params: payload}, apiHeaders)
    .then(function (response) {
      console.log('[DATA] response..',response.data);
      if(response.data.status) {
          if(response.data.data.products && response.data.data.products.length > 0) {
            // i::data display-------------------------------------------------------------------------------START
              let template = ``; let templateStar = ``; let sIdx = 0; 
              let num = ((response.data.data.filter._page-1)*response.data.data.filter._limit);
              (response.data.data.products).forEach((item) => {
                templateStar = ''; sIdx = 0;
                while(sIdx<item.star){ 
                    templateStar += '<i class="fas fa-star text-warning"></i>';
                    sIdx++;
                }
                template += `<tr>
                                <td>`+(++num)+`</td>
                                <td>`+item.name+`</td>
                                <td>`+templateStar+`</td>
                                <td class="small">`+(item.description?item.description:``)+`</td>
                                `;
                template += `</tr>`;
              });
              $(id_list).html(template);
            // i::data display---------------------------------------------------------------------------------END
            // i::data statistics----------------------------------------------------------------------------START
              $('#products_count_start_satisfaction').html(response.data.data.products_count_start);
              $('#products_count_end_satisfaction').html(response.data.data.products_count_end);
              $('#products_count_total_satisfaction').html(response.data.data.products_count_total);
            // i::data statistics------------------------------------------------------------------------------END
            // i::data pagination----------------------------------------------------------------------------START
              template = '';
              let max_page = Math.ceil(response.data.data.products_count_total/response.data.data.filter._limit);
              template += 
              `<div class="pagination">
                  <a onclick="getDataSatisfaction(`+1+`)"><i class="fas fa-angle-double-left"></i></a>
              </div>`; 
              if(response.data.data.filter._page > 1){
                template += 
                `<div class="pagination">
                    <a onclick="getDataSatisfaction(`+(response.data.data.filter._page-1)+`)">`+(response.data.data.filter._page-1)+`</a>
                </div>`; 
              }
  
              template += 
              `<div class="pagination">
                  <a class="active">`+response.data.data.filter._page+`</a>
              </div>`;
              
              if(response.data.data.filter._page < max_page){
                template += 
                `<div class="pagination">
                    <a onclick="getDataSatisfaction(`+(response.data.data.filter._page+1)+`)">`+(response.data.data.filter._page+1)+`</a>
                </div>`; 
              }
              if(response.data.data.filter._page+1 < max_page){
                template += 
                `<div class="pagination">
                    <a onclick="getDataSatisfaction(`+(response.data.data.filter._page+2)+`)">`+(response.data.data.filter._page+2)+`</a>
                </div>`; 
              }
              template += 
              `<div class="pagination">
                  <a onclick="getDataSatisfaction(`+max_page+`)"><i class="fas fa-angle-double-right"></i>
                  </a>
              </div>`; 
  
              $(id_list+'-pagination').html(template);
              $('[name="_page"]').val(response.data.data.filter._page);
            // i::data pagination------------------------------------------------------------------------------END
          }else{
            $(id_list).html(`<tr>
                                  <td colspan="100%" class="py-5"><center><i>tidak ada data</i></center></td>
                              </tr>`);
          }
            
      }else{
        iziToast.warning({
            title: "Gagal",
            html: response.data.message,
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
    });
  }

$(function (){
    getDataPost(1,'news');
    getDataPost(1,'article',2);
    console.log('$_GET',$_GET)
    if($_GET['dslist']){
        $("#data-satisfaction").collapse("show");
        getDataSatisfaction();
        window.location.hash = '#data-satisfaction';
    }
});