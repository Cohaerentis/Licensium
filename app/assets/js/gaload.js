function gaload(win,doc,tag,src,name){
    win['GoogleAnalyticsObject'] = name;
    win[name] = win[name] || function(){
        (win[name].q = win[name].q || []).push(arguments)},
         win[name].l= 1 * new Date();
    var a = doc.createElement(tag),
        m = doc.getElementsByTagName(tag)[0];
    a.async = 1;
    a.src = src;
    m.parentNode.insertBefore(a, m);
}
