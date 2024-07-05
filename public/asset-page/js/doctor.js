const id_list = '#data-list';
const no_delete_items = [];
const loadingElementImg = `<tr>
                                <td colspan="100%"><center><img src="../../asset/images/loading.gif"></center></td>
                            </tr>`; 


function getData(move_to_page=null){
  $(id_list).html(loadingElementImg);

  if(move_to_page){
    $('[name="_page"]').val(move_to_page);
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
  axios.get(baseUrl+'/api/resourceDetail', {params: payload}, apiHeaders)
  .then(function (response) {
    console.log('[DATA] response..',response.data);
    if(response.data.status) {
        if(response.data.data.products && response.data.data.products.length > 0) {
          // i::data display-------------------------------------------------------------------------------START
            let template = ``; let imgToDisplay = ``;
            (response.data.data.products).forEach((item) => {
                imgToDisplay = baseUrl+'/asset/images/no-image-clean.png'
                img = new Image();
                img.src = item.img_main+"?_="+(new Date().getTime());
                img.onload = function () {
                    imgToDisplay = item.img_main
                    $('#product_'+item.id+'_img').attr("src",imgToDisplay)
                    $('#product_'+item.id+'_img').attr("title",item.img_main)
                }

                template += ` <tr>
                                    <td><img src="`+imgToDisplay+`" id="product_`+item.id+`_img" title="invalid image" style="width:100px"></td>
                                    <td>
                                        <strong>`+item.name+`</strong><br>
                                        <i>`+item.summary.key_label+`</i>
                                        <div>
                                            <a href="#" class="theme-btn btn-style-two small"><span class="btn-title">Lihat Detail</span></a>
                                            <a href="#" class="theme-btn btn-style-one small"><span class="btn-title">Lihat Jadwal</span></a>
                                        </div>
                                    </td>
                                </tr>`;
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

$(function () {
  getData();
});