var basicEditor = new Quill('#editor', {
  modules: {
    'toolbar': { container: '#toolbar' }
  },
  theme: 'snow'
  });

$(function(){
    $('#save').click(function () {
        var mysave = $('#editor').html();
        $('#topic_text').val(mysave);
    });
});