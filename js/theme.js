function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
jQuery(document).ready(function($){
    $('.tabs').tabs()
    if($(window).width() <= 768) $( ".tabs" ).tabs( "option", "event", "click" )
    else $( ".tabs" ).tabs( "option", "event", "mouseover" );
    $(window).on('resize',function(){
       if($(this).width() <= 768) $( ".tabs" ).tabs( "option", "event", "click" )
    else $( ".tabs" ).tabs( "option", "event", "mouseover" ); 
    })
})