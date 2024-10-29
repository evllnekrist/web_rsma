const id_list = '#tree';
// let graph = null;

function getData(){
    $(id_list).html(loadingElementImg);
    
    axios.get(baseUrl+'/api/org', {params: {}}, apiHeaders)
    .then(function (response) {
      console.log('[DATA] response..',response.data);
      if(response.data.status) {
        let items = response.data.data.products
        const itemMap = {}; // Object to store each item by its id for quick access
        const result = []; // Array to store the root parent objects

        items.forEach(function(item,idx) {
            items[idx] = itemMap[item.id] = {
                id: item.id,
                pid: item.pid,
                data: {
                    name: item.name,
                    img_main: item.img_main,
                    job_title: item.job_title,
                },
                children: []
            } 
        });

        items.forEach(item => {
            if (item.pid === null) {
                result.push(item);
            } else if (itemMap[item.pid]) {
                itemMap[item.pid].children.push(item);
            }
        });

        $(id_list).html('');
        const data = {
            id: 'ms',
            data: {
              img_main: baseUrl+'/asset/images/logo-rsma.webp',
              job_title: 'RSUD Mas Amsyar',
            },
            options: {
              nodeBGColor: '#cdb4db',
              nodeBGColorHover: '#cdb4db',
            },
            children: result
        };
        const options = {
            contentKey: 'data',
            width: 1200,
            height: 700,
            nodeWidth: 200,
            nodeHeight: 70,
            childrenSpacing: 70,
            siblingSpacing: 30,
            direction: 'top',
            highlightOnHover: true,
            containerClassName: 'root',
            canvasStyle: '',
            enableToolbar: true,
            nodeTemplate: (content) => {
            //   console.log(content);
              return `
                <div style="display: flex; flex-direction: column; height: 100%;">
                    <div style='display: flex;flex-direction: row;justify-content: space-between;align-items: center;height: 100%; box-shadow: 1px 2px 4px #ccc; padding: 0 7px;'>
                        <img style='width: 50px;height: 50px;border-radius: 50%;' src='`+(content.img_main?content.img_main:`/asset/images/no-man.png`)+`' alt=''>
                        <div style="font-family: Arial; font-size: 10px; line-height:1; margin-left: 5px;">
                            <b>${content.job_title}`+(content.name?`</b><br><br>${content.name}`:``)+`
                        </div>
                    </div>
                    <div style='margin-top: auto; border-bottom: 10px solid #01e486'></div>
                </div>`;
            },
            nodeStyle: 'box-shadow: -3px -6px 8px -5px rgba(0,0,0,0.31);',
            canvasStyle: 'border: 1px solid black;background: #f6f6f6;',
        };
        let tree = new ApexTree($(id_list), options);
        let graph = tree.render(data);

        document.getElementById('layoutTop').addEventListener('click', (e) => {
            graph.changeLayout('top');
        });
        document.getElementById('layoutBottom').addEventListener('click', (e) => {
            graph.changeLayout('bottom');
        });
        document.getElementById('layoutLeft').addEventListener('click', (e) => {
            graph.changeLayout('left');
        });
        document.getElementById('layoutRight').addEventListener('click', (e) => {
            graph.changeLayout('right');
        });
        document.getElementById('fitScreen').addEventListener('click', (e) => {
            graph.fitScreen();
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