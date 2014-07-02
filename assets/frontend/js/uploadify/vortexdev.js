// created by vortexdev.netii.net
$(document).ready(function() {
    
  var base_url = $('#hiddenBaseUrl').val();
  var uploadfolder = $('#uploadfolder').val();  
  $('#file_upload').uploadify({
    'uploader'  : base_url + 'assets/frontend/flash/uploadify/uploadify.swf',
    'script'    : base_url + 'user/uploadifyUploader/',
    'cancelImg' : base_url + 'assets/frontend/css/uploadify/cancel.png',
    'folder'    : uploadfolder,
    'fileExt'     : '*.jpg;*.gif;*.png;*.zip;*.rar;*.flv;*.mp4;*.mp3',
    'auto'      : false,
    'multi'     : true,
    
     'onComplete'  : function(event, ID, fileObj, response, data) {
         console.log(fileObj);
         
         // here i'm gonna resize the images and display it in the main page 
         $.ajax({
             url : base_url + 'user/filemanipulation/' + fileObj.type +'/' + fileObj.name,
             success : function(response){
               
                if(response == 'image')
                  {
                    
                    var images = $('<a target="_blank" class="gallery_thumb" href="'+base_url+'images/gallery/bigs/'+fileObj.size+fileObj.name+'"><img src="'+base_url + 'images/gallery/bigs/' +fileObj.size+fileObj.name+'" alt=""/><input type="hidden" name="gallery_imgs[]" value="'+fileObj.size+fileObj.name+'"/>');
                    $(images).hide().insertBefore('#displayFiles').slideDown('slow')
                  }
                  else 
                  {
                    var files = $('<a class="gallery_thumb" href="'+base_url + 'images/gallery/bigs/' +fileObj.name+'" target="_blank">'+fileObj.name+'</a>');
                    $(files).hide().insertBefore('#displayFiles').slideDown('slow')
                  }
                  
             }
         })
    }
  });
  
 
});