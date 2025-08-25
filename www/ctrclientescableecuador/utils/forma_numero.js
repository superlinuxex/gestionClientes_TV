    function formatNumber(num,prefix){
    prefix = prefix || ”;
    num += ”;
    var splitStr = num.split(‘.’);
    var splitLeft = splitStr[0];
    var splitRight = splitStr.length > 1 ? ‘.’ + splitStr[1] : ”;
    var regx = /(\d+)(\d{3})/;
    while (regx.test(splitLeft)) {
    splitLeft = splitLeft.replace(regx, ‘$1' + ‘,’ + ‘$2');
    }
    return prefix + splitLeft + splitRight;
    }

    function unformatNumber(num) {
    return num.replace(/([^0-9\.\-])/g,”)*1;
    } 