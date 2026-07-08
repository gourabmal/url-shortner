/***********************************************Hide Validation Messages Start****************************************************/
function hide_error_msg(key)
{
    document.getElementById(key+ '_err').innerHTML = '';
}
/***********************************************Hide Validation Messages End****************************************************/
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
