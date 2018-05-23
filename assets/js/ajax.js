
//associative array and path to php
function callajax(params,path,handleOut){
    
    const jax = new XMLHttpRequest();
    jax.open('POST',path,true);
    jax.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    jax.send(serializeAjaxPost(params));
    jax.onreadystatechange = function() {//Call a function when the state changes.
        if(jax.readyState == XMLHttpRequest.DONE){
            if(jax.status == 200){
                handleOut(JSON.parse(jax.responseText));
            }else{
                handleOut({'link':false,'value':'Something went wrong. Try again'});
            }
        }
    }
}
function serializeAjaxPost(arr){
    return Object.keys(arr).map(function(keys){return encodeURIComponent(keys)+'='+ encodeURIComponent(arr[keys]);}).join('&');
}