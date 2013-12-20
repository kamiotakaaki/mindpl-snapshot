/**
 * snapshot.js
 *
 * @version    2.00
 * @updated    2012-08-09
 * @author     takaaki kamio <http://mindpl.co.jp>
 * @copyright
 * @license
 *
 * @see
 */

/* -----------------------------------------------------------------------*/
// variables
/* -----------------------------------------------------------------------*/

var HOST = "http://api.snape.ee/v2/snap/web/snapshot";
var QUERY = "0";

var substr = window.location.search.substring(1);
var idx = substr.indexOf("&");

if(idx > 0) {
 QUERY = substr.slice(0,idx);
} else {
 QUERY = substr;
}

/* -----------------------------------------------------------------------*/
// function:remove load amnimation
/* -----------------------------------------------------------------------*/

var stop = function() {
	var dom_obj=document.getElementById("loading_img");
	var dom_obj_parent=dom_obj.parentNode;

	//alert('stop loading');
	dom_obj_parent.removeChild(dom_obj);
}

/* -----------------------------------------------------------------------*/
//JSONP:snapshot
/* -----------------------------------------------------------------------*/

$.ajax({
    url : HOST,
    dataType : "jsonp",
    data : { snapseq : QUERY },
    jsonp : "jsoncallback",
    timeout : 10000,
    success : function(json){

    	//alert(json.photourl);
    	stop();

    	if(json.result == "false") {
		// snap要素を描画
	   	elm1 = document.getElementById("snap_img");
	   	elm1.src = "/img/pb/no_image.jpeg";
    	}
    	else {
	    	// snap要素を描画
	   	elm1 = document.getElementById("snap_img");
	   	elm1.src = json.snap_url

        if(json.userimageurl != "") {
            elm2 = document.getElementById("user_img");
            elm2.src = json.user_image_url;
        }

		elm3 = document.getElementById("user_name");
		elm3.innerHTML = json.user_nm;

		elm4 = document.getElementById("snap_text");
		elm4.innerHTML = json.comment;
		
		var tweetid = json.twitter_user_nm;
		elm5 = document.getElementById("tweetbtn");
		if(json.twitter_user_nm != "") {
			elm5.innerHTML = '<a id="tweetbtn" href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-hashtags="Snapeee" data-text="RT @'+tweetid+'">Tweet</a>';
		} else {
			elm5.innerHTML = '<a id="tweetbtn" href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-hashtags="Snapeee" data-text="RT ">Tweet</a>';
		}
		
		elm9 = document.getElementById("invite_code3");
		elm9.innerHTML = json.invite_cd;
		
		elm10 = document.getElementById("invite_code4");
		elm10.innerHTML = json.invite_cd;
    	}
    },
    error : function(){
        alert('error');

    	// snap要素を描画
	   	elm1 = document.getElementById("snap_img");
	   	elm1.src = "/img/pb/no_image.jpeg";
    }
});
