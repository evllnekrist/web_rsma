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
  let payload = {
    _type: $('#post-type').val()
  }; payload['_dir'] = {}
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
  axios.get(baseUrl+'/api/post', {params: payload}, apiHeaders)
  .then(function (response) {
    console.log('[DATA] response..',response.data);
    if(response.data.status) {
        if(response.data.data.products && response.data.data.products.length > 0) {
          // i::data display-------------------------------------------------------------------------------START
            let template = ``; let imgToDisplay = ``; let templateUrl = '';
            (response.data.data.products).forEach((item) => {
                imgToDisplay = baseUrl+'/asset/images/resource/news-1.jpg'
                img = new Image();
                img.src = item.img_main+"?_="+(new Date().getTime());
                img.onload = function () {
                    imgToDisplay = item.img_main
                    $('#product_'+item.id+'_img').attr("src",imgToDisplay)
                    $('#product_'+item.id+'_img').attr("title",item.img_main)
                }

                templateUrl = baseUrl+`/`+$('#post-type').val()+`/`+item.slug;
                template += `
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image">
                            <a href="`+templateUrl+`">
                                <img src="`+imgToDisplay+`" id="product_`+item.id+`_img" alt=""></a>
                            </figure>
                            <a href="#" class="date">`+dayjs(item.created_at).format('D MMM YYYY')+`</a>
                        </div>
                        <div class="lower-content">
                            <h4><a href="blog-post-image.html">`+item.title+`</a></h4>
                            <div class="text">`+shorten(jQuery(item.content).text(), 30, "...", false)+`</div>
                            <div class="post-info">
                                <div class="post-author"><small>Oleh `+(item.created_by_attr?item.created_by_attr.name:'-')+`</small></div>
                                <ul class="post-option">
                                    <li><a onclick="copyToClipboard('`+templateUrl+`')"><i class="fa fa-share-alt"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>`;
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