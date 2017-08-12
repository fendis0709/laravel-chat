var site_url = document.querySelector('meta[name="site-url"]').getAttribute('content');

module.exports  = {
    main : function(title, body, link){
        if(!("Notification" in window)){
            return swal('This browser doesn\'t support notification', '', 'warning');
        }
        if(Notification.permission == 'granted'){
            console.info('Granted');
            return showNotification({title: title, body: body, link: link});
        } else if(Notification.permission != 'denied'){
            console.warn('Permission');
            Notification.requestPermission(function(){
                return showNotification({title: title, body: body, link: link});
            });
        } else if(Notification.permission == 'denied'){
            console.error('Denied');
            return swal('You have been deny notification popup', '', 'warning');
        }
    }
};

function showNotification(parameters){
    var title   = parameters.title;
    var body    = parameters.body;
    var link    = parameters.link;
    var notification = null;
    var options = {
        body    : body,
        icon    : site_url + '/assets/images/logo.png'
    };
    notification = new Notification(title, options);
    notification.onclick = function(){
        if(link !== null){
            window.open(link, '_blank');
            notification.close();
        }
    };

    var audioogg        = new Audio('asset/plugins/audios/chat.ogg');
    var audiomp3        = new Audio('asset/plugins/audios/chat.mp3');
    if(eval(localStorage.sound) || true){
        //audiomp3.play();
        audioogg.play();
    }
}