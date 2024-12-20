apiHeaders['headers']['Authorization'] = 'Bearer '+$("meta[name='tapi']").attr("content");
const id_list = '#data-list';
loadingElementImg = `<tr>
                        <td colspan="100%"><center><img src="../../asset/images/loading.gif"></center></td>
                    </tr>`; 

function doDelete(id,name){
  const object  = $(id_list).data('object');
  if(confirm("Apakah Anda yakin menghapus '"+name+"'? Aksi ini tidak dapat dibatalkan.")){
    axios.delete(baseUrl+'/api/'+object+'/'+id, {data:{}, headers:apiHeaders['headers']})
    .then(function (response) {
      console.log('response..',response);
      if(response.status == 200) {
        iziToast.success({
            title: response.data.message,
            // message: '',
            position: 'center',
            progressBarColor: 'rgb(0, 255, 184)',
        });
        setTimeout(function() {
          window.location = baseUrl+'/cms/'+object;
        }, 500);
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
      $('#loading').hide();
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
    });
  }else{
    iziToast.info({
        title: 'Info',
        message: 'Batal dihapus',
    });
  }
}

function getData(moveToPage=null){
  const object  = $(id_list).data('object');
  $(id_list).html(loadingElementImg);

  if(moveToPage){
    $('[name="_page"]').val(moveToPage);
  }
  let payload = {}; payload['_dir'] = {}
  $("._dir").each(function() {
    if($(this).data('dir')){
      payload['_dir'][$(this).attr('id').replace('th_','')] = $(this).data('dir');
    }
  });
  $("._filter").each(function() {
    payload[$(this).attr('name')] = $(this).val();
  });
  // console.log('payload',payload); 
  // return;
  axios.get(baseUrl+'/api/'+object, {params: payload}, apiHeaders)
  .then(function (response) {
    // console.log('[DATA] response..',response.data);
    if(response.data.status) {
        if(response.data.data.products && response.data.data.products.length > 0) {
          // i::data display-------------------------------------------------------------------------------START
            let template = ``; let num = ((response.data.data.filter._page-1)*response.data.data.filter._limit);
            let imgToDisplay = ``; let imgToDisplayHtml = ``;
            (response.data.data.products).forEach((item) => {
              if(item.img_main){
                imgToDisplay = baseUrl+'/asset/images/no-image-clean.png'
                img = new Image();
                img.src = item.img_main+"?_="+(new Date().getTime());
                img.onload = function () {
                    imgToDisplay = item.img_main
                    $('#product_'+item.id+'_img').attr("src",imgToDisplay)
                    $('#product_'+item.id+'_img').attr("title",item.img_main)
                }
                imgToDisplayHtml = `<img src="`+imgToDisplay+`" id="product_`+item.id+`_img" title="invalid image" style="width:80px">`;
              }else{
                imgToDisplayHtml = `<center>-</center>`;
              }

              template += `<tr>`;
              $.each(columns, function (key, val) {
                if(val.type == 'seq_number'){
                    template += `<td><center>`+(++num)+`</center></td>`;
                }else if(val.type == 'action'){
                    template += `<td>`;
                    template += `<a class="mr-3 items-center" href="`+baseUrl+'/cms/'+object+'/'+item[pk]+`">
                                    <i class="fa fa-pen"></i>
                                </a>`;
                    if(no_delete_items.includes(item[pk])){
                        template += `<i class="small text-muted2">tidak dapat dihapus</i>`;
                    }else{
                        template += `<a onclick="doDelete(`+item.id+`,'`+item.name+`')" class="items-center text-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>`;
                    }
                    template += `</td>`;
                }else if(val.var_name == 'img_main'){
                    template += `<td>`+imgToDisplayHtml+`</td>`;
                }else{
                    template += `<td>`+(item[val.var_name]?item[val.var_name]:'<center>-</center>')+`</td>`;
                }
              });
              template += `</tr>`;
            });
            $(id_list).html(template);
          // i::data display---------------------------------------------------------------------------------END
          // i::data statistics----------------------------------------------------------------------------START
            $('#products_count_start').html(response.data.data.products_count_start);
            $('#products_count_end').html(response.data.data.products_count_end);
            $('#products_count_total').html(response.data.data.products_count_total);
          // i::data statistics------------------------------------------------------------------------------END
          // i::data pagination----------------------------------------------------------------------------START
            template = '';
            let max_page = Math.ceil(response.data.data.products_count_total/response.data.data.filter._limit);
            template += 
            `<div class="pagination">
                <a onclick="getData(`+1+`)"><i class="fas fa-angle-double-left"></i></a>
            </div>`; 
            if(response.data.data.filter._page > 1){
              template += 
              `<div class="pagination">
                  <a onclick="getData(`+(response.data.data.filter._page-1)+`)">`+(response.data.data.filter._page-1)+`</a>
              </div>`; 
            }

            template += 
            `<div class="pagination">
                <a class="active">`+response.data.data.filter._page+`</a>
            </div>`;
            
            if(response.data.data.filter._page < max_page){
              template += 
              `<div class="pagination">
                  <a onclick="getData(`+(response.data.data.filter._page+1)+`)">`+(response.data.data.filter._page+1)+`</a>
              </div>`; 
            }
            if(response.data.data.filter._page+1 < max_page){
              template += 
              `<div class="pagination">
                  <a onclick="getData(`+(response.data.data.filter._page+2)+`)">`+(response.data.data.filter._page+2)+`</a>
              </div>`; 
            }
            template += 
            `<div class="pagination">
                <a onclick="getData(`+max_page+`)"><i class="fas fa-angle-double-right"></i>
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

$('._filter_search').on('keyup', function() {
  let var_name = $(this).attr('name');
  // console.log('#_filter_msg_'+var_name);
  switch ($(this).attr('type')) {
    case 'number': break;
    default:
      if($(this).val().length != 0 && $(this).val().length < 3){
        $('#_filter_msg'+var_name).html('* pencarian minimal 3 karakter, direset pada isian kosong');
        return;
      }else{
        $('#_filter_msg'+var_name).html('');
      }
      break;
  }
  getData();
});

$(function () {
  getData();
});