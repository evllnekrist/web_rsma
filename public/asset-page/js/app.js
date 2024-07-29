console.log('____app js');

const baseUrl = window.location.origin;
const apiHeaders = {
    headers: {
        "Accept": "*/*",
        "Access-Control-Allow-Origin": "*",
        "Content-Type": "multipart/form-data",
    }
};
let loadingElement = `<div class="mx-auto">memuat...</div>`;
let days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

function nospace(event,changeWith=""){
    if((event.target.value).includes(' ')){
        iziToast.warning({
            title: 'Whoops...',
            message: 'Input ini tidak menerima spasi'+(changeWith != ""?', otomatis diganti karakter '+changeWith:''),
            position: 'topRight',
        });
    }
    event.target.value =  event.target.value.replaceAll(" ",changeWith)
}
$('.nospace').on('keyup', function(event) {
    nospace(event);
});
$('.nospace_rw_hypen').on('keyup', function(event) {
    nospace(event,'-');
});

function numeric(event){
    if ((event.target.value).match(/[^$,.\d]/)){
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            html: 'Input ini hanya boleh angka',
            showConfirmButton: false,
            timer: 2000
        });
    }
    event.target.value =  event.target.value.replace(/[^\d]+/g,'')
}
$('.numeric').on('keyup', function(event) {
    numeric(event);
});

function uppercase(event){
    event.target.value =  event.target.value.toUpperCase()
}
$('.uppercase').on('keyup', function(event) {
    uppercase(event);
});

function lowercase(event){
    event.target.value =  event.target.value.toLowerCase()
}
$('.lowercase').on('keyup', function(event) {
    lowercase(event);
});

function expandable(el){
    let is_truncated = true;
    $($(el).data('target')).each(function() {
        if($(this).hasClass('truncate')){
            $(this).removeClass('truncate');
            is_truncated = false;
        }else{
            $(this).addClass('truncate');
        }
    });
    if(!is_truncated){
        $(el).addClass('bg-warning/20');
        $(el).removeClass('bg-white dark:bg-darkmode-600');
    }else{
        $(el).removeClass('bg-warning/20');
        $(el).addClass('bg-white dark:bg-darkmode-600');
    }
}

function inputFile(event){
    let iii = event.target.getAttribute('data-index-input-file');
    const files = event.target.files
    let url='', template='';
    // console.log('change input image');
    // console.log(iii,event);
    for(i = 0; i < files.length; i++){
        // console.log(i,event.target.files[i]);
        url = URL.createObjectURL(event.target.files[i]);
        if($.inArray(event.target.files[i]['type'], accept_mimes['img']) >= 0){
            template += `<img src="`+url+`">`;
        }else{
            template += `
                <div class="paper sharp-fold mx-auto">
                    <b>`+(event.target.files[i]['name']).split('.').pop().toUpperCase()+`</b>
                </div>`;
        }
        template += `<span>`+event.target.files[i]['name']+`</span>`;
    }
    // console.log('template',template)
    $('#input-file-preview-'+iii).html(template);
    $('#input-file-preview-'+iii).removeClass('hidden');
    $('#input-file-none-'+iii).addClass('hidden');
    $('#input-file-btn-'+iii).removeClass('hidden');
}
$('.input-file').on('change', function(event) {
    inputFile(event);
});

const regexExp_slug = /^[a-z][-a-z0-9]*$/;
function checkSlug(str){
    if(regexExp_slug.test(str)){
    $('#slug-info').html('<i class="text-info">Slug valid</i>');
    $('[name="check_validity"]').val(1)
    }else{
    $('#slug-info').html('<b class="text-danger">Slug tidak valid</b>');
    $('[name="check_validity"]').val(0)
    }
    // console.log('check_validity',$('[name="check_validity"]').val() )
}
$('.slug').on('keyup', function(event) {
    checkSlug(event.target.value)
});

function convertToSlug(str) {
    return str.toLowerCase()
      .replace(/[^\w ]+/g, "")
      .replace(/ +/g, "-");
}
$('.convert-to-slug').on('keyup', function(event) {
    // console.log(convertToSlug(event.target.value),$(this).data('affects_to'));
    $('[name="'+$(this).data('affects_to')+'"').val(convertToSlug(event.target.value)); 
});

$('[name="_search"]').on("keyup",function search(e) {
    if(e.which == 13) {
        getData();
    }
});

function display(id,id2){
    // console.log(id,id2);
    let action = $('#'+id).data('display')
    if(action == 'hide'){
    $('#'+id).show()
    $('#'+id2).hide()
    $('#'+id).data('display', 'show')
    $('#'+id+'-action-text').html('Batal Ganti Gambar')
    }else{
    $('#'+id).hide()
    $('#'+id2).show()
    $('#'+id).data('display', 'hide')
    $('#'+id+'-action-text').html('Ganti Gambar')
    }
}

function copyToClipboard(copyText) {
    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText);
    // Alert the copied text
    iziToast.info({
        title: 'Tercopy:',
        message: copyText,
    });
}

function hideLoading(appendTo){
    // console.log(appendTo+'Loading','toHide')
    $(appendTo+'_loading').hide()
}

function changeDir(field){
    let el = $('#th_'+field);
    
    switch (el.data('dir')) {
      case 'asc': // currently ASC to be DESC
        el.data('dir','desc');
        el.find('.fas').addClass('hidden');
        el.find('.fa-sort-down').removeClass('hidden');
        break;
      case 'desc': // currently DESC to be NEUTRAL
        el.data('dir','');
        el.find('.fas').addClass('hidden');
        el.find('.fa-sort').removeClass('hidden');
        break;
      default: // curently NEUTRAL to ASC
        el.data('dir','asc');
        el.find('.fas').addClass('hidden');
        el.find('.fa-sort-up').removeClass('hidden');
        break;
    }
    getData();
}

function shorten(text, maxLength, delimiter, overflow) {
    if(text){
        delimiter = delimiter || "&hellip;";
        overflow = overflow || false;
        var ret = text;
        if (ret.length > maxLength) {
        var breakpoint = overflow ? maxLength + ret.substr(maxLength).indexOf(" ") : ret.substr(0, maxLength).lastIndexOf(" ");
        ret = ret.substr(0, breakpoint) + delimiter;
        }
        return ret;
    }else{
        return "";
    }
}

function reduceArrayObject(arr, aobj) {
    
    for(let key2=0;key2<aobj.length;key2++){
        arr.forEach(function(key) {
            delete aobj[key2][key];
            // console.log('reduce child ____', key2, key);
        });
        aobj[key2]['img_main'] = aobj[key2]['img_main']?baseUrl+aobj[key2]['img_main']:baseUrl+'/asset/images/resource/author-thumb-sample.jpg';
    }
    // console.log('reduce', aobj);
    return aobj;
}


function cleanUrl(str){
    return str.replace(/([^:])(\/\/+)/g, '$1/');
}

$(function (){
    
});
  