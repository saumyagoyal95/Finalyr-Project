
$(function(){
    if(val<50){
    $('#bar').animate({ width: '300px' }, 
    {
        duration:1000,
        easing:'linear',
        step:function(a,b){
            var pc = Math.ceil(b.now*255/b.end);
            var blue = pc.toString(16);
            var red = (255-pc).toString(16);
            var rgb=red+"00"+blue;
            $('#bar').css({
                backgroundColor:"#"+rgb
            });            
        }
    })
    }
    else{
      $('#bar').animate({ width: '300px' }, 
    {
        duration:1000,
        easing:'linear',
        step:function(a,b){
            var pc = Math.ceil(b.now*255/b.end);
            var blue = pc.toString(16);
            var red = (255-pc).toString(16);
            var rgb=blue+"00"+red;
            $('#bar').css({
                backgroundColor:"#"+rgb
            });            
        }
    })
    }
});