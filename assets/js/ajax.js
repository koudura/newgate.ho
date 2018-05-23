
var JAX = {
    callajax : function (params,path,callback){
    
        const jax = new XMLHttpRequest();
        jax.open('POST',path,true);
        jax.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        jax.send(serializeAjaxPost(params));
        jax.onreadystatechange = function() {//Call a function when the state changes.
            if(jax.readyState == XMLHttpRequest.DONE){
                if(jax.status == 200){
                    callback(JSON.parse(jax.responseText));
                }else{
                    callback({'false':'false'});
                }
            }
        }
    },
    serializeAjaxPost: function (arr){
        return Object.keys(arr).map(function(keys){return encodeURIComponent(keys)+'='+ encodeURIComponent(arr[keys]);}).join('&');
    }

}

