const id_el_list = '#data-list';
const no_delete_items = [];
const loadingElementImg = `<tr>
                                <td colspan="5"><img src="../../asset/images/loading.gif" class="mx-auto"></td>
                            </tr>`; 

function doDelete(id,name){
  if(confirm("Apakah Anda yakin menghapus user '"+name+"'? Aksi ini tidak dapat dibatalkan.")){
    axios.delete(baseUrl+'/api/user/post-delete/'+id, {}, apiHeaders)
    .then(function (response) {
      console.log('response..',response);
      if(response.status == 200 && response.data.status) {
        iziToast.success({
            title: 'OK',
            message: 'Berhasil!',
        });
        window.location = baseUrl+'/users';
      }else{
        iziToast.warning({
            title: "Gagal",
            html: response.data.message,
        });
      }
      $('#loading').hide();
      $('#form').show();
    })
    .catch(function (error) {
      iziToast.error({
          title: 'Error',
          message: error,
      });
      $('#loading').hide();
      $('#form').show();
    });
  }else{
    iziToast.info({
        title: 'Info',
        message: 'Batal dihapus',
    });
  }
}
function getData(move_to_page=null){
  $(id_el_list).html(loadingElementImg);
  if(move_to_page){
    $('[name="_page"]').val(move_to_page);
  }
  let url = baseUrl+'/api/org'
  let payload = {};
  payload['_dir'] = {}
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
  axios.get(url, {param: payload}, apiHeaders)
  .then(function (response) {
    console.log('[DATA] response..',response.data);
    if(response.data.status) {
        if(response.data.data.products && response.data.data.products.length > 0) {
          // i::data display-------------------------------------------------------------------------------START
            let template = ``; let num = ((response.data.data.filter._page-1)*response.data.data.filter._limit);
            (response.data.data.products).forEach((item) => {
              imgToDisplay = baseUrl+'/img/no-image-clean.png'
              img = new Image();
              img.src = item.img_main+"?_="+(new Date().getTime());
              img.onload = function () {
                imgToDisplay = item.img_main
                $('#product_'+item.id+'_img').attr("src",imgToDisplay)
              }
              template +=
              `<tr>
                <td>`+(++num)+`</td>
                <td><img src="`+imgToDisplay+`" id="product_`+item.id+`_img"></td>
                <td>`+item.name+`</td>
                <td>`+item.job_title+`</td>
                <td>`+item.parent_id+`</td>
                <td>`;
              if(no_delete_items.includes(item.id)){
                template += 
                        `<i>tidak dapat dihapus</i>`;
              }else{
                template +=
                        `<a class="mr-3 flex items-center" href="`+baseUrl+'/cms/org/'+item.id+`">
                            <i class="fa fa-pen"></i>
                        </a>
                        <a onclick="doDelete(`+item.id+`,'`+item.name+`')" class="flex items-center text-danger">
                            <i class="fa fa-trash"></i>
                        </a>`;
              }
              template +=
                    `</div>
                </td>
              </tr>`;
            });
            $(id_el_list).html(template);
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

            $(id_el_list+'-pagination').html(template);
            $('[name="_page"]').val(response.data.data.filter._page);
          // i::data pagination------------------------------------------------------------------------------END
        }else{
          $(id_el_list).html('<h3 class="mt-5">Tidak ada data</h3>');
        }
          
    }else{
      iziToast.warning({
          title: "Gagal",
          html: response.data.message,
      });
    }
  })
  .catch(function (error) {
    iziToast.error({
        title: 'Error',
        message: error.message,
    });
    console.log(error);
  });
}

$(function () {
  getData();
});