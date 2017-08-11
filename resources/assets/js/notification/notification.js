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