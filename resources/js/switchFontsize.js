var size = 1;

function setFontSize(s) {
    size = s;
    $('body').css('font-size', '' + size + 'em');
}


function increaseFontSize() {
    setFontSize(size + .05);
}

function decreaseFontSize() {
    if(size > 1)
        setFontSize(size - .05);
}

$(document).ready(() => {
    $('#inc').click(increaseFontSize);
    $('#dec').click(decreaseFontSize);
})
setFontSize(size);
