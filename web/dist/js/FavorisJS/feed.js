$("document").ready(function()  {
    StatusBindings();
    addtags();

   /* $("input#file1").change(function() {
        var ele = document.getElementById($(this).attr('id'));
        var result = ele.files;

        console.log(result.length);
        for(var x = 0;x< result.length;x++){
            var fle = result[x];
            $("#output ul").append("<li>" + fle.name + "(TYPE: " + fle.type + ", SIZE: " + fle.size +  fle + ")</li>");

        }
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8080/Host_Guest/web/app_dev.php/favoris/feed/uploader',
            data: JSON.stringify(result),

            beforeSend: function(){
                console.log('loading DATA FOR UPLOAD TEST')
            },
            success: function(data) {
                console.log('UPDATE OVER');
                console.log(data);
                StatusBindings();
                console.log('Bindings Updated');
            }
        });

    });
*/



});
function LikedStatus(){

}
function find( list, key, test ) {
    test = test || function(e) { return e ? e.key == key : false; };

    for (var i = 0; i < list.length; ++i)
        if (test(list[i])) return i;
    return -1;
}

function addtags() {
    $( function() {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }

        $( "#tags" )
        // don't navigate away from the field on tab when selecting an item
            .on( "keydown", function( event ) {
                if ( event.keyCode === $.ui.keyCode.TAB &&
                    $( this ).autocomplete( "instance" ).menu.active ) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                minLength: 0,
                source: function( request, response ) {
                    // delegate back to autocomplete, but extract the last term
                    response( $.ui.autocomplete.filter(
                        availableTags, extractLast( request.term ) ) );
                },
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                select: function( event, ui ) {
                    var terms = split( this.value );
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( ", " );
                    return false;
                }
            });
    } );
}

function StatusBindings(){

    $(".add_comment").keyup(function(e){
        if(e.keyCode === 13 && $(this).val()){
            console.log('Requete Ajax Ajout commentaire');
            $comment = $('#id'+e.target.id).find('.add_comment').val();
            $('#id'+e.target.id).find('.add_comment').val("");
            $.ajax({
                type: 'POST',
                url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/add_comment/'+e.target.id+'/'+$comment,
                beforeSend: function(){
                    console.log('loading DATA for Status: '+e.target.id);
                    $('#id'+e.target.id).find('.add_comment').val("");
                },
                success: function(data) {
                    $('#id'+e.target.id).find('.post-content-wrapper').html(data);
                    $('#id'+e.target.id).find('.comments-container').slideToggle();
                    console.log('UPDATE OVER');
                    StatusBindings();
                    console.log('Bindings Updated');
                }
            });
        } else if(e.keyCode === 13 && !$(this).val()) {
            console.log('hhhh matit3adéch :p');
        }
    });
////////////////////////////////////////



    $(".add_status").keyup(function(e){
        if(e.keyCode === 13 && $(this).val().trim())
        {
            console.log('Requete Ajax Ajout status');

            var status = $('.add_status').val();
            $.ajax({
                type: 'POST',
                url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/addstatus',
                data: {'status':status},
                dataType: "html",
                beforeSend: function(){
                    console.log('loading DATA FOR FEED UPDATE')
                },
                success: function(data) {
                    console.log('UPDATE OVER');
                    $('.blog-infinite').prepend(data);
                    $('.add_status').val("");
                    StatusBindings();
                    console.log('Bindings Updated');
                }
            });
        } else if(e.keyCode === 13 && !$(this).val()) {
            console.log('Champs vide');
        }



    });

    $(".comm_visibility").click(function(e){
        console.log('Click Commentaire Count Action');
        $('#id'+e.target.id).find('.comments-container').slideToggle();
    });
    $(".delete").click(function(e){
        console.log('Delete action detected for status '+e.target.id);
        $( "#dialog-confirm-delete" ).dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Delete": function() {

                    $.ajax({
                        type: 'get',
                        url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/removestatus',
                        data: {'id' : e.target.id},

                        beforeSend: function(){
                            console.log('loading DATA FOR Status removal');
                            $('#id'+e.target.id).slideToggle();
                        },
                        success: function(data) {
                            console.log('SUPPRESSION DONE');
                            console.log('refresh a terminer');

                        }
                    });
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    $(".report").click(function(e){
        console.log('Report action detected for status '+e.target.id);


    });
    $(".remove_stat").click(function(e){
        console.log('supp detected for status '+e.target.id);
        $.ajax({
            type: 'get',
            url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/removestatus',
            data: {'id' : e.target.id},

            beforeSend: function(){
                console.log('loading DATA FOR Status removal');

            },
            success: function(data) {
                $('tr').find('#'+e.target.id).hide;
                console.log('refresh a terminer');

            }
        });
    });


    $(".like_btn").click(function(e){
        console.log('Click Like Count Action');
        var nb =  $('#id'+e.target.id).find('.nb_likes').val();
        if($('#id'+e.target.id).find('.entry-action').find('.liked').length==0)
        {
            console.log('ajout like');
            $('#id'+e.target.id).find('.like_btn').find('.nb_likes').addClass('liked');
            $('#id'+e.target.id).find('.like_btn').addClass('liked');
            $('#id'+e.target.id).find('.like_btn').attr("style","background: #01b7f2;color:#fff;");
            $('#id'+e.target.id).find('.like_btn').find('i').addClass('white-color');

            $.ajax({
                type: "get",
                url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/likepost',
                data: {'id' : e.target.id},
                beforeSend: function(){

                    $('#id'+e.target.id).find('.entry-action').find('.like_btn').find('span').html((parseInt(nb)+1)+" LIKE(S)");
                    $('#id'+e.target.id).find('.nb_likes').val(nb+1);
                    console.log('loading DATA for Status: '+e.target.id)
                },
                success: function(data) {
                    console.log('+1 LIKE');
                },
                error:function () {
                    console.log('fail add');
                }
            });
        }else{
            console.log('Remove like');
            $('#id'+e.target.id).find('.like_btn').find('.nb_likes').removeClass('liked');
            $('#id'+e.target.id).find('.like_btn').removeClass('liked');
            $('#id'+e.target.id).find('.like_btn').removeAttr("style","background: #01b7f2;color:#fff;");
            $('#id'+e.target.id).find('.like_btn').find('i').removeClass('white-color');
            $.ajax({
                type: "get",
                url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/unlikepost',
                data: {'id':e.target.id},
                dataType : "html",
                beforeSend: function(){
                    $('#id'+e.target.id).find('.entry-action').find('.like_btn').find('span').html((parseInt(nb)-1)+" LIKE(S)");
                    $('#id'+e.target.id).find('.nb_likes').val(nb-1);
                    console.log('-1 for Status: '+e.target.id)
                },
                success: function(data) {
                    console.log('-1 LIKE');
                },
                error:function () {
                    console.log('fail remove');
                }
            });

        }

    });


    $('input[type=file]').change(function() {
        console.log('File upload');
        var file = this.files[0];
        name = file.name;
        size = file.size;
        type = file.type;
        if(file.name.length < 1) {
        }
        else if(file.size > 100000) {
            alert("The file is too big");
        }
        else if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg' ) {
            alert("The file does not match png, jpg or gif");
        }
        else {
            $(':submit').click(function(){
                var formData = new FormData($('*formId*')[0]);
                $.ajax({
                    url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/uploader',  //server script to process data
                    type: 'POST',
                    xhr: function() {  // custom xhr
                        myXhr = $.ajaxSettings.xhr();
                        if(myXhr.upload){ // if upload property exists
                            myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // progressbar
                        }
                        return myXhr;
                    },
                    // Ajax events
                    success: completeHandler = function(data) {
                        /*
                         * Workaround for Chrome browser // Delete the fake path
                         */
                        if(navigator.userAgent.indexOf('Chrome')) {
                            var catchFile = $(":file").val().replace(/C:\\fakepath\\/i, '');
                        }
                        else {
                            var catchFile = $(":file").val();
                        }
                        var writeFile = $(":file");
                        writeFile.html(writer(catchFile));
                        $("*setIdOfImageInHiddenInput*").val(data.logo_id);
                    },
                    error: errorHandler = function() {
                        alert("Something went wrong!");
                    },
                    // Form data
                    data: formData,
                    // Options to tell jQuery not to process data or worry about the content-type
                    cache: false,
                    contentType: false,
                    processData: false
                }, 'json');
            });
        }

    });

    $("#btn-input").keyup(function(e){

        if(e.keyCode === 13 && $(this).val().trim()) {
            $content = $(this).val();
            $(this).val("");
            console.log('chitchat');
            $.ajax({
                type: "get",
                url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/sendmessage',
                data: {'content':$content},
                dataType : "html",
                beforeSend: function(){
                    console.log('Sending message')
                },
                success: function(data) {
                    console.log('message sent');

                    $('.panel-body').append(data);
                },
                error:function () {
                    console.log('fail send');
                }
            });
            $(this).val("");
        }
    });
  /*  setInterval(function() {
        $.ajax({
            type: "get",
            url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/refresh',
            dataType : "html",
            beforeSend: function(){
                console.log('refreshing')
            },
            success: function(data) {
                console.log('refreshed');

                $('.panel-body').replaceWith(data);
            },
            error:function () {
                console.log('fail send');
            }
        });
    }, 1000);*/



}