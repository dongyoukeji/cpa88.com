
// 获取class对象方法
function getElementsClass(classnames){ 
	//定义数组 
    var classobj= new Array();

    //定义数组的下标 	
    var classint=0;

    //获取HTML的所有标签 
    var tags=document.getElementsByTagName("*");

    //对标签进行遍历 
    for(var i in tags){

    	//判断节点类型 
        if(tags[i].nodeType==1){

        //判断和需要CLASS名字相同的，并组成一个数组 
            if(tags[i].getAttribute("class") == classnames){
                classobj[classint]=tags[i]; 
                classint++; 
            } 
        } 
    } 
    return classobj;	//返回组成的数组 
} 