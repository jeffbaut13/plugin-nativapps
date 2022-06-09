jQuery(document).ready(function($){

 


    $("#btnnuevo").click(function(){

        $("#modalnuevo").modal("show");

    });


    $(document).on('click','.btn_remove',function(){
        var button_id = $(this).attr('id');
        $("#row" +button_id+"").remove();
        return false;
    });



    $(document).on('click',"a[data-id]",function(){
            var id = this.dataset.id;          
            var url = SolicitudesAjax.url;
            $.ajax({
                type: "POST",
                url: url,
                data:{
                    action : "peticioneliminar",
                    nonce : SolicitudesAjax.seguridad,
                    id: id,
                },
                success:function(){
                    
                    location.reload();
                }
            });
    });

    var mediaUploader;

	$('#upload-button').click(function(e) {
		e.preventDefault();

	  // If the uploader object has already been created, reopen the dialog
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}

	  // Extend the wp.media object
	  mediaUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
			}, multiple: false });

	  // When a file is selected, grab the URL and set it as the text field's value
	  mediaUploader.on('select', function() {
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#txtimage').val(attachment.url);
		});

	  // Open the uploader dialog
	  mediaUploader.open();
	});

});