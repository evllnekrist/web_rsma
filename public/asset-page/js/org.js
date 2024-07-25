const id_list = '#tree';
const loadingElementImg = `<center><img src="../../asset/images/loading.gif"></center>`; 
let chart = null;

function getData(){
    $(id_list).html(loadingElementImg);
    
    axios.get(baseUrl+'/api/org', {params: {}}, apiHeaders)
    .then(function (response) {
      console.log('[DATA] response..',response.data);
      if(response.data.status) {
        // https://stackoverflow.com/questions/52624080/getorgchart-rendering-updating-drop-etc
        chart = new OrgChart(document.getElementById(id_list.replace('#','')), {
            mouseScrool: OrgChart.action.none,
            layout: OrgChart.treeRightOffset,
            template: "diva",
            searchDisplayField: 'name',
            searchFieldsWeight: {
                "name": 20, //percent
                "manager": 100 //percent
            },
            menu: {
                pdf: { text: "Export PDF" },
                png: { text: "Export PNG" },
                svg: { text: "Export SVG" },
                csv: { text: "Export CSV" },
                // xml: { text: "Export XML" },
                // json: { text: "Export JSON" }
            },
            nodeMenu: {
                png: { text: "Export PNG" },
                svg: { text: "Export SVG" }
            },
            nodeBinding: {
                field_0: "name",
                field_1: "job_title",
                img_0: "img_main"
            },
            nodes: reduceArrayObject(['created_at','created_by','updated_at','updated_by','deleted_at','deleted_by','desc_title','desc_body'],response.data.data.products)
        });
            
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