  var params = jQuery.extend(true, {}, $params);
  params['limit'] = 1134;
  $.post('/list',params,function(data){
    console.log(data = JSON.parse(data));
    });


  var params = jQuery.extend(true, {}, $params);
  params['limit'] = 1134;
  delete params.geo
  $.post('/list',params,function(data){
    data = JSON.parse(data);
    console.log(data);
      $.each(data.list,function(i,e){
        console.log(e.match(/<li data-id='[0-9]*'>/g));
      });
  });
  
  var details = [];
  for(i=0; i<ids.length;i++)
  {
    $.post('/details',{id:ids[i]},function(data){
      details[ids[i]] = data;
    });
  }
  
  
  var details = [];
   
   ids.foreach(logElements);
   
   function logElements(myElement, index, array){
     $.post('/details',{id:element},function(data){
       doSomething(data,myElement);
     });
   }
   
   function doSomething(data,id){
     details[id] = data;
   }