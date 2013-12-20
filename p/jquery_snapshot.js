
//User agent Redirect Start

//Automatic lang change Start

function browserLanguage() {
  try {
    return (navigator.browserLanguage || navigator.language || navigator.userLanguage).substr(0,2)
  }
  catch(e) {
    return undefined;
  }
}

function setLanguage(default_language, languages) {
		
  var addCSSRule = (document.createStyleSheet)
    ? (function(sheet) {
      return function(selector, declaration) {
        sheet.addRule(selector, declaration);
      };
    })(document.createStyleSheet())
    :
    (function(sheet){
      return function(selector, declaration) {
        sheet.insertRule(selector + '{' + declaration + '}', sheet.cssRules.length);
      };
    })((function(e){
      e.appendChild(document.createTextNode(''));
      (document.getElementsByTagName('head')[0] || (function(h) {
        document.documentElement.insertBefore(h, this.firstChild);
        return h;
      })(document.createElement('head'))).appendChild(e);
      return e.sheet;
    })(document.createElement('style')));



  var array_include = function(ary, v) {
    for (var i in ary) {
      if (ary[i] == v) return true;
    }
    return false;
  };



  var lang = browserLanguage();
  if(array_include(languages,lang)) {
		  addCSSRule("." + default_language, "display: none;");
		  addCSSRule("#click_" + default_language, "color:#a5a5a5;");

  return true;
 } else {
addCSSRule("." + languages[0], "display: none;");
addCSSRule("#click_" + default_language, "color:#a5a5a5;");

    return false;
 }
 
 	/*addCSSRule("." + default_language, "display: none;");
  	removeCSSRule("." + lang);*/

}

/* defo_lang_en */
setLanguage("en",["ja"]);


//change by click

$(function(){
         $("#header #click_en").click(function(){
             $(".ja").css("display","none");
			 $(".en").css("display","inline");
			 $(".sp").css("display","none");
         });
		 $("#header #click_ja").click(function(){
             $(".en").css("display","none");
			 $(".ja").css("display","inline");
			 $(".sp").css("display","none");
         });
 });
