$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

    var imgUpload = document.getElementById('upload_imgs');
    var imgPreview = document.getElementById('img_preview');
    var imgUploadForm = document.getElementById('img-upload-form');
    var totalFiles;
    var previewTitle;
    var previewTitleText;
    var img;

    $(".js-borrar-foto").click(function(){
        var clicked = $(this);
        var id = $(this).data('id');
        $.ajax({
            type:'POST',
            url:'/borrarFoto',
            data:{id:id},
            success:function(data){
                $('#imagen'+id).remove();
            }
        });
    });

    // Si se cargan imágenes cargo las fotos como preview
    imgUpload.addEventListener('change', previewImgs, false);
    imgUploadForm.addEventListener('submit', function (e) {
      
    }, false);

    // Lista las imágenes cargadas
    function previewImgs(event) {
      totalFiles = imgUpload.files.length;
      
      if(!!totalFiles) {
        imgPreview.classList.remove('quote-imgs-thumbs--hidden');
        previewTitle = document.createElement('p');
        previewTitle.style.fontWeight = 'bold';
        previewTitleText = document.createTextNode(totalFiles + ' Imágenes seleccionadas');
        previewTitle.appendChild(previewTitleText);
        imgPreview.appendChild(previewTitle);
      }
      
      for(var i = 0; i < totalFiles; i++) {
        img = document.createElement('img');
        img.src = URL.createObjectURL(event.target.files[i]);
        img.classList.add('img-preview-thumb');
        imgPreview.appendChild(img);
      }
    }
});