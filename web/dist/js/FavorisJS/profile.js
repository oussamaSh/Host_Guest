$("document").ready(function()  {
    $( function() {
        var dialog, form,
            name = $( "#name" );
        function addAlbum() {
            $.ajax({
                type: 'get',
                url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/addalbum',
                data: {'name' : name.val()},

                beforeSend: function(){
                    console.log(name.val());
                },
                success: function(data) {
                    console.log('Ajout DONE');
                $('.user_albums').append(data);
                    dialog.dialog( "close" );
                }
            });
        }
        dialog = $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 200,
            width: 350,
            modal: true,
            buttons: {
                "Create an Album": addAlbum,
                Cancel: function() {
                    dialog.dialog( "close" );
                }
            },
            close: function() {
                form[ 0 ].reset();
                name.removeClass( "ui-state-error" );
            }
        });

            form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
                addAlbum();
        });

        $( "#add_album" ).click(function(){
            dialog.dialog( "open" );
        });
    } );
$('.user_album').click(function(e){
        console.log('iddd'+this.id);
    $.ajax({
        type: 'get',
        url: 'http://localhost/Host_Guest/web/app_dev.php/favoris/feed/openalbum',
        data: {'id' : e.target.id},

        beforeSend: function(){
            console.log(e.target.id);
        },
        success: function(data) {
            console.log('Ouverture album');
            $('#gallery').fadeOut("slow");
            $('#gallery').html(data);
            $('#gallery').fadeIn("slow");

        }
    });
});
$('.following').click(function(e){
console.log('unfollow');

});
$('.follow').click(function(e){
console.log('follow');

});
    $('input[type=file]').change(function() {
        var file_name = $(this).files;

        $.ajax({
            url: "http://localhost/Host_Guest/web/app_dev.php/favoris/feed/addmedia",
            type: "get",
            data:file_name,
            contentType: false,
            processData:false,
            success: function(data)
            {
                $("#gallery").html(data);
                alert("Image Uploaded");
            }
        });

    });
   /* $('#multipleupload').on('change', function(e){
        console.log('test upload');
        e.preventDefault();
        $.ajax({
            url: "http://localhost/Host_Guest/web/app_dev.php/favoris/feed/addmedia",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData:false,
            success: function(data)
            {
                $("#gallery").html(data);
                alert("Image Uploaded");
            }
        });
    });*/


});