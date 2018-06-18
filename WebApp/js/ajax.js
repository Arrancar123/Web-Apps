    $('#bookmark').click(function(){

        $.ajax({
            url: 'UploadedComicViewer.php',
            data: {
                issue: "<?php echo $path; ?>",
                name: "<?php echo $comicName; ?>",
                page: index
    
            },
            success: function( data ) {
            console.log( data );
            }
        });
        
    });