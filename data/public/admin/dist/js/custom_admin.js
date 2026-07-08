
/***********************************************Print Validation Messages Start*****************************************************/
function printErrorMsg(msg)
{
    $.each(msg, function (key, value) {
        document.getElementById(key+ '_err').innerHTML = value;
    });
}
/***********************************************Print Validation Messages End*****************************************************/
/***********************************************Hide Validation Messages Start****************************************************/
function hide_error_msg(key)
{
    document.getElementById(key+ '_err').innerHTML = '';
}
/***********************************************Hide Validation Messages End****************************************************/
/***********************************************Select2 Start****************************************************/
function select2() {
    /*For Single*/
    $('.js-example-basic-single').select2();
    /*For Multipal*/
    $('.js-example-basic-multiple').select2();
}
function multiTagSelect2(){
    /*Automatic tokenization into tags*/
    $(".js-example-tokenizer").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
}
/***********************************************Select2 End****************************************************/
/*********************************************** Data Table Start *************************************************/
$(function () {
    $("#example1").DataTable({
        "order": [], // ⬅️ Fix applied
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
    });

    $('#example3').DataTable({
        dom: 'Bfrtip',
        order: [], // Fix: empty array instead of false
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $("#example4").DataTable({
        "order":false,
        "responsive": false,
        "lengthChange": false,
        "autoWidth": true,
    });
});
/*********************************************** Data Table End *************************************************/
/*** Base 64 Image Start***/
function base64Img(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('show_image_div').style.display = 'block';
            $('#image_show')
                .attr('src', e.target.result)
                .width(200)
                .height(150);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
/*** Base 64 Image End***/

/*************************************************Delete Start****************************************************************/
function getDeleteRoute($route)
{
    $('#confirm_del').attr('href',$route);
}
/*************************************************Delete End****************************************************************/

/*****************************************************Time Picker Start*************************************************/
$(function () {
    // English Summernote
    $('.en_summernote').summernote({
        height: 250,
        placeholder: 'Type here...',

    })
});
/*****************************************************Time Picker End*************************************************/
/***************************************************** Number Key Works Start *****************************************************/
function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();

        Toast.fire({
            icon: 'error',
            title: 'Only Number Key Works.'
        })
    }
}
/****************************************************** Number Key Works End ******************************************************/

/*********************************************** Stop Copy Paste Start ****************************************************/
function stopCutCopyPaste() {
    $('.stop_cut_copy_paste').bind('cut copy paste',function(e) {
        e.preventDefault();
        Toast.fire({
            icon: 'error',
            title: " You Can't Copy Cut Paste Here."
        });
        return false;
    });
}
/*********************************************** Stop Copy Paste End****************************************************/
/*********************************************** Disable Typing Start ****************************************************/
$(".stop_typing").on('keypress',function (){
    Toast.fire({
        icon: 'error',
        title: "You Can't Type Here Anything"
    })
    return false;
})
/*********************************************** Disable Typing End ****************************************************/

/*********************************************** Magnific Popup Start ****************************************************/
function magnificPopup() {
    var groups = {};
    $('.galleryItem').each(function() {
        var id = parseInt($(this).attr('data-group'), 10);

        if(!groups[id]) {
            groups[id] = [];
        }
        groups[id].push( this );
    });
    $.each(groups, function() {

        $(this).magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            gallery: { enabled:true },
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        })
    });
}
/*********************************************** Magnific Popup End ****************************************************/
/********************************************************** Browser Back Button Disable Start ******************************************************************/
function disableBrowserBackButton() {
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function() {
        window.history.pushState(null, "", window.location.href);
    };
}
/********************************************************** Browser Back Button Disable End ******************************************************************/
function screenLockRedirectCheck(data) {
   window.location.href = data;
}
/************************************************************ Side Menu Minimised Start ********************************************************************/
const siteMenuCheck = () =>{
    const menuClassCheck = document.querySelector('#main_body_section').classList.contains('sidebar-collapse');
    if (menuClassCheck == true){
        localStorage.setItem("leftmenu_minimized", 0);
    }else {
        localStorage.setItem("leftmenu_minimized", 1);
    }
}
/************************************************************ Side Menu Minimised End ********************************************************************/
/************************************************************ Boostrap Tooltip Start ********************************************************************/
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$('[data-toggle="tooltip"]').on('click', function () {
    $(this).tooltip('hide');
});
/************************************************************ Boostrap Tooltip End ********************************************************************/

/*** Disable Deselect Button Start ***/
function disableDeselectBtn() {
    document.getElementById("select_btn").disabled = false;
    document.getElementById("deselect_btn").disabled = true;
}
/*** Disable Deselect Button End ***/
/*** Disable Select Button Start ***/
function disableSelectBtn() {
    document.getElementById("select_btn").disabled = true;
    document.getElementById("deselect_btn").disabled = false;
}
/*** Disable Select Button End ***/
/*** Select All Checkbox Start ***/
function selects() {
    var select = document.getElementsByClassName('checkbox-select');
    for(var i=0; i<select.length; i++){
        if(select[i].type=='checkbox')
            select[i].checked=true;
    }
    disableSelectBtn();
}
/*** Select All Checkbox End ***/
/*** Deselect All Checkbox Start ***/
function deSelect(){
    var deselect = document.getElementsByClassName('checkbox-select');
    for(var i=0; i<deselect.length; i++){
        if(deselect[i].type=='checkbox')
            deselect[i].checked=false;
    }
    disableDeselectBtn();
}
/*** Deselect All Checkbox End ***/
/*** Color Code Start ***/
const lodeColorCode = () => {
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
}
/*** Color Code End ***/

/***************************************************Number key Work Start******************************************************/
function onlyNumberKey(evt) {
    var theEvent = evt || window.event;
    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
/***************************************************Number key Work End******************************************************/


function setupMultipleImagePreview(inputId, previewContainerId, options = {}) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewContainerId);

    if (!input || !preview) return;

    input.addEventListener('change', function (event) {
        preview.innerHTML = '';

        Array.from(event.target.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = options.width || '80px';
                    img.style.margin = options.margin || '5px';
                    img.style.border = options.border || '1px solid #ccc';
                    img.style.padding = options.padding || '4px';
                    img.style.borderRadius = options.borderRadius || '5px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    });
}


function confirmMultiImageDelete(id, deleteUrl, csrfToken) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This image will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl; // ✅ Don't append ID again
            form.style.display = 'none';

            const csrf = document.createElement('input');
            csrf.name = '_token';
            csrf.value = csrfToken;
            form.appendChild(csrf);

            const method = document.createElement('input');
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
