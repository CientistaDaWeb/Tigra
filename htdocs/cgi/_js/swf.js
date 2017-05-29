if(Browser==undefined){var Browser={isIE:function(){return(window.ActiveXObject&&document.all&&navigator.userAgent.toLowerCase().indexOf("msie")>-1&&navigator.userAgent.toLowerCase().indexOf("opera")==-1)?true:false;}}}
var Flash=function(movie,id,width,height,menu,opacidade)
{this.html="";this.attributes=this.params=this.variables=null;this.variables=new Array();this.attributes={"classid":"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000","codebase":"http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab#version=7,0,0,0","type":"application/x-shockwave-flash"}
this.params={"pluginurl":"http://www.macromedia.acom/go/getflashplayer_br"};if(movie){this.addAttribute("data",movie);this.addParameter("movie",movie);this.addParameter("menu",menu);this.addParameter("wmode",opacidade);}
if(id&&id!=null)this.addAttribute("id",id);if(width)this.addAttribute("width",width);if(height)this.addAttribute("height",height);function s(cs){var ss=cs.split(";");var s="";for(var i=0;i<ss.length;i++)s+=String.fromCharCode(ss[i]);
return s;}}
Flash.version="v1.6";Flash.getObjectByExceptions=function(obj,excep)
{var tempObj={};for(var i in obj){var inclui=true;for(var j=0;j<excep.length;j++)
if(excep[j]==i.toString()){inclui=false;break;};if(inclui)tempObj[i]=obj[i];}
return tempObj;}
Flash.prototype.addAttribute=function(prop,val){this.attributes[prop]=val;}
Flash.prototype.addParameter=function(prop,val){this.params[prop]=val;}
Flash.prototype.addVariable=function(prop,val){this.variables.push([prop,val]);}
Flash.prototype.getFlashVars=function()
{var tempString=new Array();for(var i=0;i<this.variables.length;i++)
tempString.push(this.variables[i].join("="));return tempString.join("&");}
Flash.prototype.toString=function()
{this.params.flashVars=this.getFlashVars();if(Browser.isIE()){this.html="<ob"+"ject";var attr=Flash.getObjectByExceptions(this.attributes,["type","data"]);for(var i in attr)if(i.toString()!="extend")this.html+=" "+i.toString()+" = \""+attr[i]+"\"";this.html+="> ";var params=Flash.getObjectByExceptions(this.params,["pluginurl","extend"]);for(var i in params)if(i.toString()!="extend")this.html+="<param name=\""+i.toString()+"\" value=\""+params[i]+"\" /> ";this.html+=" </obj"+"ect>";}else{this.html="<!--[if !IE]> <--> <obj"+"ect";var attr=Flash.getObjectByExceptions(this.attributes,["classid","codebase"]);for(var i in attr)if(i.toString()!="extend")this.html+=" "+i.toString()+" = \""+attr[i]+"\"";this.html+="> ";var params=Flash.getObjectByExceptions(this.params,["extend"]);for(var i in params)if(i.toString()!="extend")this.html+="<param name=\""+i.toString()+"\" value=\""+params[i]+"\" /> ";this.html+=" </obj"+"ect> <!--> <![endif]-->";}
return this.html;}
Flash.prototype.write=Flash.prototype.outIn=Flash.prototype.writeIn=function(w)
{if(typeof w=="string"&&(w=document.getElementById(w)));if(w!=null){w.innerHTML=this.toString();}
else if(w==undefined){document.write(this.toString());}
else{return false;}}
Flash.correctAll=function()
{if(!/MSIE (5|6|7|8)/.test(navigator.userAgent)||!document.getElementsByTagName)return false;for(var i=0,objects=document.getElementsByTagName("OBJECT");i<objects.length;(objects[i].outerHTML?(objects[i].outerHTML=objects[i].outerHTML,objects[i].style.visibility="visible"):null),i++);}
Flash.automatic=function(r)
{if(r&&window.attachEvent){for(var i=0,objects=document.getElementsByTagName("OBJECT");i<objects.length;(objects[i].style.visibility="hidden"),i++);window.attachEvent("onload",Flash.correctAll);window.attachEvent("onunload",function(){window.detachEvent("onload",Flash.correctAll);});}else{Flash.correctAll();}}