function fix_sidebar(){$("body").hasClass("fixed")&&$(".sidebar").slimscroll({height:$(window).height()-$(".header").height()+"px",color:"rgba(0,0,0,0.2)"})}var left_side_width=220;$(function(){"use strict";function a(){var a=$(window).height()-$("body > .header").height()-($("body > .footer").outerHeight()||0);$(".wrapper").css("min-height",a+"px");var b=$(".wrapper").height();b>a?$(".left-side, html, body").css("min-height",b+"px"):$(".left-side, html, body").css("min-height",a+"px")}$("[data-toggle='offcanvas']").click(function(a){a.preventDefault(),$(window).width()<=992?($(".row-offcanvas").toggleClass("active"),$(".left-side").removeClass("collapse-left"),$(".right-side").removeClass("strech"),$(".row-offcanvas").toggleClass("relative")):($(".left-side").toggleClass("collapse-left"),$(".right-side").toggleClass("strech"))}),$(".btn").bind("touchstart",function(){$(this).addClass("hover")}).bind("touchend",function(){$(this).removeClass("hover")}),$("[data-toggle='tooltip']").tooltip(),$("[data-widget='collapse']").click(function(){var a=$(this).parents(".box").first(),b=a.find(".box-body, .box-footer");a.hasClass("collapsed-box")?(a.removeClass("collapsed-box"),$(this).children(".fa-plus").removeClass("fa-plus").addClass("fa-minus"),b.slideDown()):(a.addClass("collapsed-box"),$(this).children(".fa-minus").removeClass("fa-minus").addClass("fa-plus"),b.slideUp())}),$(".navbar .menu").slimscroll({height:"200px",alwaysVisible:!1,size:"3px"}).css("width","100%"),$('.btn-group[data-toggle="btn-toggle"]').each(function(){var a=$(this);$(this).find(".btn").click(function(b){a.find(".btn.active").removeClass("active"),$(this).addClass("active"),b.preventDefault()})}),$("[data-widget='remove']").click(function(){var a=$(this).parents(".box").first();a.slideUp()}),$(".sidebar .treeview").tree(),a(),$(".wrapper").resize(function(){a(),fix_sidebar()}),fix_sidebar()}),$(window).load(function(){(function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V=[].slice,W={}.hasOwnProperty,X=function(a,b){function c(){this.constructor=a}for(var d in b)W.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},Y=[].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1};for(t={catchupTime:500,initialRate:.03,minTime:500,ghostTime:500,maxProgressPerFrame:10,easeFactor:1.25,startOnPageLoad:!0,restartOnPushState:!0,restartOnRequestAfter:500,target:"body",elements:{checkInterval:100,selectors:["body"]},eventLag:{minSamples:10,sampleCount:3,lagThreshold:3},ajax:{trackMethods:["GET"],trackWebSockets:!1}},B=function(){var a;return null!=(a="undefined"!=typeof performance&&null!==performance&&"function"==typeof performance.now?performance.now():void 0)?a:+new Date},D=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame,s=window.cancelAnimationFrame||window.mozCancelAnimationFrame,null==D&&(D=function(a){return setTimeout(a,50)},s=function(a){return clearTimeout(a)}),F=function(a){var b,c;return b=B(),(c=function(){var d;return d=B()-b,d>=33?(b=B(),a(d,function(){return D(c)})):setTimeout(c,33-d)})()},E=function(){var a,b,c;return c=arguments[0],b=arguments[1],a=3<=arguments.length?V.call(arguments,2):[],"function"==typeof c[b]?c[b].apply(c,a):c[b]},u=function(){var a,b,c,d,e,f,g;for(b=arguments[0],d=2<=arguments.length?V.call(arguments,1):[],f=0,g=d.length;g>f;f++)if(c=d[f])for(a in c)W.call(c,a)&&(e=c[a],null!=b[a]&&"object"==typeof b[a]&&null!=e&&"object"==typeof e?u(b[a],e):b[a]=e);return b},p=function(a){var b,c,d,e,f;for(c=b=0,e=0,f=a.length;f>e;e++)d=a[e],c+=Math.abs(d),b++;return c/b},w=function(a,b){var c,d,e;if(null==a&&(a="options"),null==b&&(b=!0),e=document.querySelector("[data-pace-"+a+"]")){if(c=e.getAttribute("data-pace-"+a),!b)return c;try{return JSON.parse(c)}catch(f){return d=f,"undefined"!=typeof console&&null!==console?console.error("Error parsing inline pace options",d):void 0}}},g=function(){function a(){}return a.prototype.on=function(a,b,c,d){var e;return null==d&&(d=!1),null==this.bindings&&(this.bindings={}),null==(e=this.bindings)[a]&&(e[a]=[]),this.bindings[a].push({handler:b,ctx:c,once:d})},a.prototype.once=function(a,b,c){return this.on(a,b,c,!0)},a.prototype.off=function(a,b){var c,d,e;if(null!=(null!=(d=this.bindings)?d[a]:void 0)){if(null==b)return delete this.bindings[a];for(c=0,e=[];c<this.bindings[a].length;)e.push(this.bindings[a][c].handler===b?this.bindings[a].splice(c,1):c++);return e}},a.prototype.trigger=function(){var a,b,c,d,e,f,g,h,i;if(c=arguments[0],a=2<=arguments.length?V.call(arguments,1):[],null!=(g=this.bindings)?g[c]:void 0){for(e=0,i=[];e<this.bindings[c].length;)h=this.bindings[c][e],d=h.handler,b=h.ctx,f=h.once,d.apply(null!=b?b:this,a),i.push(f?this.bindings[c].splice(e,1):e++);return i}},a}(),null==window.Pace&&(window.Pace={}),u(Pace,g.prototype),C=Pace.options=u({},t,window.paceOptions,w()),S=["ajax","document","eventLag","elements"],O=0,Q=S.length;Q>O;O++)I=S[O],C[I]===!0&&(C[I]=t[I]);i=function(a){function b(){return T=b.__super__.constructor.apply(this,arguments)}return X(b,a),b}(Error),b=function(){function a(){this.progress=0}return a.prototype.getElement=function(){var a;if(null==this.el){if(a=document.querySelector(C.target),!a)throw new i;this.el=document.createElement("div"),this.el.className="pace pace-active",document.body.className=document.body.className.replace("pace-done",""),document.body.className+=" pace-running",this.el.innerHTML='<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>',null!=a.firstChild?a.insertBefore(this.el,a.firstChild):a.appendChild(this.el)}return this.el},a.prototype.finish=function(){var a;return a=this.getElement(),a.className=a.className.replace("pace-active",""),a.className+=" pace-inactive",document.body.className=document.body.className.replace("pace-running",""),document.body.className+=" pace-done"},a.prototype.update=function(a){return this.progress=a,this.render()},a.prototype.destroy=function(){try{this.getElement().parentNode.removeChild(this.getElement())}catch(a){i=a}return this.el=void 0},a.prototype.render=function(){var a,b;return null==document.querySelector(C.target)?!1:(a=this.getElement(),a.children[0].style.width=""+this.progress+"%",(!this.lastRenderedProgress||this.lastRenderedProgress|0!==this.progress|0)&&(a.children[0].setAttribute("data-progress-text",""+(0|this.progress)+"%"),this.progress>=100?b="99":(b=this.progress<10?"0":"",b+=0|this.progress),a.children[0].setAttribute("data-progress",""+b)),this.lastRenderedProgress=this.progress)},a.prototype.done=function(){return this.progress>=100},a}(),h=function(){function a(){this.bindings={}}return a.prototype.trigger=function(a,b){var c,d,e,f,g;if(null!=this.bindings[a]){for(f=this.bindings[a],g=[],d=0,e=f.length;e>d;d++)c=f[d],g.push(c.call(this,b));return g}},a.prototype.on=function(a,b){var c;return null==(c=this.bindings)[a]&&(c[a]=[]),this.bindings[a].push(b)},a}(),N=window.XMLHttpRequest,M=window.XDomainRequest,L=window.WebSocket,v=function(a,b){var c,d,e,f;f=[];for(d in b.prototype)try{e=b.prototype[d],f.push(null==a[d]&&"function"!=typeof e?a[d]=e:void 0)}catch(g){c=g}return f},z=[],Pace.ignore=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?V.call(arguments,1):[],z.unshift("ignore"),c=b.apply(null,a),z.shift(),c},Pace.track=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?V.call(arguments,1):[],z.unshift("track"),c=b.apply(null,a),z.shift(),c},H=function(a){var b;if(null==a&&(a="GET"),"track"===z[0])return"force";if(!z.length&&C.ajax){if("socket"===a&&C.ajax.trackWebSockets)return!0;if(b=a.toUpperCase(),Y.call(C.ajax.trackMethods,b)>=0)return!0}return!1},j=function(a){function b(){var a,c=this;b.__super__.constructor.apply(this,arguments),a=function(a){var b;return b=a.open,a.open=function(d,e){return H(d)&&c.trigger("request",{type:d,url:e,request:a}),b.apply(a,arguments)}},window.XMLHttpRequest=function(b){var c;return c=new N(b),a(c),c},v(window.XMLHttpRequest,N),null!=M&&(window.XDomainRequest=function(){var b;return b=new M,a(b),b},v(window.XDomainRequest,M)),null!=L&&C.ajax.trackWebSockets&&(window.WebSocket=function(a,b){var d;return d=new L(a,b),H("socket")&&c.trigger("request",{type:"socket",url:a,protocols:b,request:d}),d},v(window.WebSocket,L))}return X(b,a),b}(h),P=null,x=function(){return null==P&&(P=new j),P},x().on("request",function(b){var c,d,e,f;return f=b.type,e=b.request,Pace.running||C.restartOnRequestAfter===!1&&"force"!==H(f)?void 0:(d=arguments,c=C.restartOnRequestAfter||0,"boolean"==typeof c&&(c=0),setTimeout(function(){var b,c,g,h,i,j;if(b="socket"===f?e.readyState<2:0<(h=e.readyState)&&4>h){for(Pace.restart(),i=Pace.sources,j=[],c=0,g=i.length;g>c;c++){if(I=i[c],I instanceof a){I.watch.apply(I,d);break}j.push(void 0)}return j}},c))}),a=function(){function a(){var a=this;this.elements=[],x().on("request",function(){return a.watch.apply(a,arguments)})}return a.prototype.watch=function(a){var b,c,d;return d=a.type,b=a.request,c="socket"===d?new m(b):new n(b),this.elements.push(c)},a}(),n=function(){function a(a){var b,c,d,e,f,g,h=this;if(this.progress=0,null!=window.ProgressEvent)for(c=null,a.addEventListener("progress",function(a){return h.progress=a.lengthComputable?100*a.loaded/a.total:h.progress+(100-h.progress)/2}),g=["load","abort","timeout","error"],d=0,e=g.length;e>d;d++)b=g[d],a.addEventListener(b,function(){return h.progress=100});else f=a.onreadystatechange,a.onreadystatechange=function(){var b;return 0===(b=a.readyState)||4===b?h.progress=100:3===a.readyState&&(h.progress=50),"function"==typeof f?f.apply(null,arguments):void 0}}return a}(),m=function(){function a(a){var b,c,d,e,f=this;for(this.progress=0,e=["error","open"],c=0,d=e.length;d>c;c++)b=e[c],a.addEventListener(b,function(){return f.progress=100})}return a}(),d=function(){function a(a){var b,c,d,f;for(null==a&&(a={}),this.elements=[],null==a.selectors&&(a.selectors=[]),f=a.selectors,c=0,d=f.length;d>c;c++)b=f[c],this.elements.push(new e(b))}return a}(),e=function(){function a(a){this.selector=a,this.progress=0,this.check()}return a.prototype.check=function(){var a=this;return document.querySelector(this.selector)?this.done():setTimeout(function(){return a.check()},C.elements.checkInterval)},a.prototype.done=function(){return this.progress=100},a}(),c=function(){function a(){var a,b,c=this;this.progress=null!=(b=this.states[document.readyState])?b:100,a=document.onreadystatechange,document.onreadystatechange=function(){return null!=c.states[document.readyState]&&(c.progress=c.states[document.readyState]),"function"==typeof a?a.apply(null,arguments):void 0}}return a.prototype.states={loading:0,interactive:50,complete:100},a}(),f=function(){function a(){var a,b,c,d,e,f=this;this.progress=0,a=0,e=[],d=0,c=B(),b=setInterval(function(){var g;return g=B()-c-50,c=B(),e.push(g),e.length>C.eventLag.sampleCount&&e.shift(),a=p(e),++d>=C.eventLag.minSamples&&a<C.eventLag.lagThreshold?(f.progress=100,clearInterval(b)):f.progress=100*(3/(a+3))},50)}return a}(),l=function(){function a(a){this.source=a,this.last=this.sinceLastUpdate=0,this.rate=C.initialRate,this.catchup=0,this.progress=this.lastProgress=0,null!=this.source&&(this.progress=E(this.source,"progress"))}return a.prototype.tick=function(a,b){var c;return null==b&&(b=E(this.source,"progress")),b>=100&&(this.done=!0),b===this.last?this.sinceLastUpdate+=a:(this.sinceLastUpdate&&(this.rate=(b-this.last)/this.sinceLastUpdate),this.catchup=(b-this.progress)/C.catchupTime,this.sinceLastUpdate=0,this.last=b),b>this.progress&&(this.progress+=this.catchup*a),c=1-Math.pow(this.progress/100,C.easeFactor),this.progress+=c*this.rate*a,this.progress=Math.min(this.lastProgress+C.maxProgressPerFrame,this.progress),this.progress=Math.max(0,this.progress),this.progress=Math.min(100,this.progress),this.lastProgress=this.progress,this.progress},a}(),J=null,G=null,q=null,K=null,o=null,r=null,Pace.running=!1,y=function(){return C.restartOnPushState?Pace.restart():void 0},null!=window.history.pushState&&(R=window.history.pushState,window.history.pushState=function(){return y(),R.apply(window.history,arguments)}),null!=window.history.replaceState&&(U=window.history.replaceState,window.history.replaceState=function(){return y(),U.apply(window.history,arguments)}),k={ajax:a,elements:d,document:c,eventLag:f},(A=function(){var a,c,d,e,f,g,h,i;for(Pace.sources=J=[],g=["ajax","elements","document","eventLag"],c=0,e=g.length;e>c;c++)a=g[c],C[a]!==!1&&J.push(new k[a](C[a]));for(i=null!=(h=C.extraSources)?h:[],d=0,f=i.length;f>d;d++)I=i[d],J.push(new I(C));return Pace.bar=q=new b,G=[],K=new l})(),Pace.stop=function(){return Pace.trigger("stop"),Pace.running=!1,q.destroy(),r=!0,null!=o&&("function"==typeof s&&s(o),o=null),A()},Pace.restart=function(){return Pace.trigger("restart"),Pace.stop(),Pace.start()},Pace.go=function(){return Pace.running=!0,q.render(),r=!1,o=F(function(a,b){var c,d,e,f,g,h,i,j,k,m,n,o,p,s,t,u,v;for(j=100-q.progress,d=o=0,e=!0,h=p=0,t=J.length;t>p;h=++p)for(I=J[h],m=null!=G[h]?G[h]:G[h]=[],g=null!=(v=I.elements)?v:[I],i=s=0,u=g.length;u>s;i=++s)f=g[i],k=null!=m[i]?m[i]:m[i]=new l(f),e&=k.done,k.done||(d++,o+=k.tick(a));return c=o/d,q.update(K.tick(a,c)),n=B(),q.done()||e||r?(q.update(100),Pace.trigger("done"),setTimeout(function(){return q.finish(),Pace.running=!1,Pace.trigger("hide")},Math.max(C.ghostTime,Math.min(C.minTime,B()-n)))):b()})},Pace.start=function(a){u(C,a),Pace.running=!0;try{q.render()}catch(b){i=b}return document.querySelector(".pace")?(Pace.trigger("start"),Pace.go()):setTimeout(Pace.start,50)},"function"==typeof define&&define.amd?define("theme-app",[],function(){return Pace}):"object"==typeof exports?module.exports=Pace:C.startOnPageLoad&&Pace.start()}).call(this)}),function(a){"use strict";a.fn.boxRefresh=function(b){function e(a){a.append(d),c.onLoadStart.call(a)}function f(a){a.find(d).remove(),c.onLoadDone.call(a)}var c=a.extend({trigger:".refresh-btn",source:"",onLoadStart:function(){},onLoadDone:function(){}},b),d=a('<div class="overlay"></div><div class="loading-img"></div>');return this.each(function(){if(""===c.source)return void(console&&console.log("Please specify a source first - boxRefresh()"));var b=a(this),d=b.find(c.trigger).first();d.click(function(a){a.preventDefault(),e(b),b.find(".box-body").load(c.source,function(){f(b)})})})}}(jQuery),function(a){"use strict";a.fn.tree=function(){return this.each(function(){var b=a(this).children("a").first(),c=a(this).children(".treeview-menu").first(),d=a(this).hasClass("active");d&&(c.show(),b.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down")),b.click(function(a){a.preventDefault(),d?(c.slideUp(),d=!1,b.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-left"),b.parent("li").removeClass("active")):(c.slideDown(),d=!0,b.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down"),b.parent("li").addClass("active"))}),c.find("li > a").each(function(){var b=parseInt(a(this).css("margin-left"))+10;a(this).css({"margin-left":b+"px"})})})}}(jQuery),function(a){"use strict";jQuery.fn.center=function(b){return b=b?this.parent():window,this.css({position:"absolute",top:(a(b).height()-this.outerHeight())/2+a(b).scrollTop()+"px",left:(a(b).width()-this.outerWidth())/2+a(b).scrollLeft()+"px"}),this}}(jQuery),function(a,b,c){function l(){f=b[g](function(){d.each(function(){var b=a(this),c=b.width(),d=b.height(),e=a.data(this,i);(c!==e.w||d!==e.h)&&b.trigger(h,[e.w=c,e.h=d])}),l()},e[j])}var f,d=a([]),e=a.resize=a.extend(a.resize,{}),g="setTimeout",h="resize",i=h+"-special-event",j="delay",k="throttleWindow";e[j]=250,e[k]=!0,a.event.special[h]={setup:function(){if(!e[k]&&this[g])return!1;var b=a(this);d=d.add(b),a.data(this,i,{w:b.width(),h:b.height()}),1===d.length&&l()},teardown:function(){if(!e[k]&&this[g])return!1;var b=a(this);d=d.not(b),b.removeData(i),d.length||clearTimeout(f)},add:function(b){function f(b,e,f){var g=a(this),h=a.data(this,i);h.w=e!==c?e:g.width(),h.h=f!==c?f:g.height(),d.apply(this,arguments)}if(!e[k]&&this[g])return!1;var d;return a.isFunction(b)?(d=b,f):(d=b.handler,void(b.handler=f))}}}(jQuery,this),function(a){jQuery.fn.extend({slimScroll:function(b){var c=a.extend({width:"auto",height:"250px",size:"7px",color:"#000",position:"right",distance:"1px",start:"top",opacity:.4,alwaysVisible:!1,disableFadeOut:!1,railVisible:!1,railColor:"#333",railOpacity:.2,railDraggable:!0,railClass:"slimScrollRail",barClass:"slimScrollBar",wrapperClass:"slimScrollDiv",allowPageScroll:!1,wheelStep:20,touchScrollStep:200,borderRadius:"0px",railBorderRadius:"0px"},b);return this.each(function(){function d(b){if(j){b=b||window.event;var d=0;b.wheelDelta&&(d=-b.wheelDelta/120),b.detail&&(d=b.detail/3),a(b.target||b.srcTarget||b.srcElement).closest("."+c.wrapperClass).is(u.parent())&&e(d,!0),b.preventDefault&&!s&&b.preventDefault(),s||(b.returnValue=!1)}}function e(a,b,d){s=!1;var e=a,f=u.outerHeight()-w.outerHeight();b&&(e=parseInt(w.css("top"))+a*parseInt(c.wheelStep)/100*w.outerHeight(),e=Math.min(Math.max(e,0),f),e=0<a?Math.ceil(e):Math.floor(e),w.css({top:e+"px"})),p=parseInt(w.css("top"))/(u.outerHeight()-w.outerHeight()),e=p*(u[0].scrollHeight-u.outerHeight()),d&&(e=a,a=e/u[0].scrollHeight*u.outerHeight(),a=Math.min(Math.max(a,0),f),w.css({top:a+"px"})),u.scrollTop(e),u.trigger("slimscrolling",~~e),h(),i()}function f(){window.addEventListener?(this.addEventListener("DOMMouseScroll",d,!1),this.addEventListener("mousewheel",d,!1),this.addEventListener("MozMousePixelScroll",d,!1)):document.attachEvent("onmousewheel",d)}function g(){o=Math.max(u.outerHeight()/u[0].scrollHeight*u.outerHeight(),r),w.css({height:o+"px"});var a=o==u.outerHeight()?"none":"block";w.css({display:a})}function h(){g(),clearTimeout(m),p==~~p?(s=c.allowPageScroll,q!=p&&u.trigger("slimscroll",0==~~p?"top":"bottom")):s=!1,q=p,o>=u.outerHeight()?s=!0:(w.stop(!0,!0).fadeIn("fast"),c.railVisible&&x.stop(!0,!0).fadeIn("fast"))}function i(){c.alwaysVisible||(m=setTimeout(function(){c.disableFadeOut&&j||k||l||(w.fadeOut("slow"),x.fadeOut("slow"))},1e3))}var j,k,l,m,n,o,p,q,r=30,s=!1,u=a(this);if(u.parent().hasClass(c.wrapperClass)){var v=u.scrollTop(),w=u.parent().find("."+c.barClass),x=u.parent().find("."+c.railClass);if(g(),a.isPlainObject(b)){if("height"in b&&"auto"==b.height){u.parent().css("height","auto"),u.css("height","auto");var y=u.parent().parent().height();u.parent().css("height",y),u.css("height",y)}if("scrollTo"in b)v=parseInt(c.scrollTo);else if("scrollBy"in b)v+=parseInt(c.scrollBy);else if("destroy"in b)return w.remove(),x.remove(),void u.unwrap();e(v,!1,!0)}}else{c.height="auto"==c.height?u.parent().height():c.height,v=a("<div></div>").addClass(c.wrapperClass).css({position:"relative",overflow:"hidden",width:c.width,height:c.height}),u.css({overflow:"hidden",width:c.width,height:c.height});var x=a("<div></div>").addClass(c.railClass).css({width:c.size,height:"100%",position:"absolute",top:0,display:c.alwaysVisible&&c.railVisible?"block":"none","border-radius":c.railBorderRadius,background:c.railColor,opacity:c.railOpacity,zIndex:90}),w=a("<div></div>").addClass(c.barClass).css({background:c.color,width:c.size,position:"absolute",top:0,opacity:c.opacity,display:c.alwaysVisible?"block":"none","border-radius":c.borderRadius,BorderRadius:c.borderRadius,MozBorderRadius:c.borderRadius,WebkitBorderRadius:c.borderRadius,zIndex:99}),y="right"==c.position?{right:c.distance}:{left:c.distance};x.css(y),w.css(y),u.wrap(v),u.parent().append(w),u.parent().append(x),c.railDraggable&&w.bind("mousedown",function(b){var c=a(document);return l=!0,t=parseFloat(w.css("top")),pageY=b.pageY,c.bind("mousemove.slimscroll",function(a){currTop=t+a.pageY-pageY,w.css("top",currTop),e(0,w.position().top,!1)}),c.bind("mouseup.slimscroll",function(){l=!1,i(),c.unbind(".slimscroll")}),!1}).bind("selectstart.slimscroll",function(a){return a.stopPropagation(),a.preventDefault(),!1}),x.hover(function(){h()},function(){i()}),w.hover(function(){k=!0},function(){k=!1}),u.hover(function(){j=!0,h(),i()},function(){j=!1,i()}),u.bind("touchstart",function(a){a.originalEvent.touches.length&&(n=a.originalEvent.touches[0].pageY)}),u.bind("touchmove",function(a){s||a.originalEvent.preventDefault(),a.originalEvent.touches.length&&(e((n-a.originalEvent.touches[0].pageY)/c.touchScrollStep,!0),n=a.originalEvent.touches[0].pageY)}),g(),"bottom"===c.start?(w.css({top:u.outerHeight()-w.outerHeight()}),e(0,!0)):"top"!==c.start&&(e(a(c.start).position().top,null,!0),c.alwaysVisible||w.hide()),f()}}),this}}),jQuery.fn.extend({slimscroll:jQuery.fn.slimScroll})}(jQuery),function(a){}(window.jQuery||window.Zepto);