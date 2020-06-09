// ==================================================
// fancyBox v3.5.7
//
// Licensed GPLv3 for open source use
// or fancyBox Commercial License for commercial use
//
// http://fancyapps.com/fancybox/
// Copyright 2019 fancyApps
//
// ==================================================
!function(t,e,n,o){"use strict";function i(t,e){var o,i,a,s=[],r=0;t&&t.isDefaultPrevented()||(t.preventDefault(),e=e||{},t&&t.data&&(e=h(t.data.options,e)),o=e.$target||n(t.currentTarget).trigger("blur"),(a=n.fancybox.getInstance())&&a.$trigger&&a.$trigger.is(o)||(e.selector?s=n(e.selector):(i=o.attr("data-fancybox")||"",i?(s=t.data?t.data.items:[],s=s.length?s.filter('[data-fancybox="'+i+'"]'):n('[data-fancybox="'+i+'"]')):s=[o]),r=n(s).index(o),r<0&&(r=0),a=n.fancybox.open(s,e,r),a.$trigger=o))}if(t.console=t.console||{info:function(t){}},n){if(n.fn.fancybox)return void console.info("fancyBox already initialized");var a={closeExisting:!1,loop:!1,gutter:50,keyboard:!0,preventCaptionOverlap:!0,arrows:!0,infobar:!0,smallBtn:"auto",toolbar:"auto",buttons:["zoom","slideShow","thumbs","close"],idleTime:3,protect:!1,modal:!1,image:{preload:!1},ajax:{settings:{data:{fancybox:!0}}},iframe:{tpl:'<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen="allowfullscreen" allow="autoplay; fullscreen" src=""></iframe>',preload:!0,css:{},attr:{scrolling:"auto"}},video:{tpl:'<video class="fancybox-video" controls controlsList="nodownload" poster="{{poster}}"><source src="{{src}}" type="{{format}}" />Sorry, your browser doesn\'t support embedded videos, <a href="{{src}}">download</a> and watch with your favorite video player!</video>',format:"",autoStart:!0},defaultType:"image",animationEffect:"zoom",animationDuration:366,zoomOpacity:"auto",transitionEffect:"fade",transitionDuration:366,slideClass:"",baseClass:"",baseTpl:'<div class="fancybox-container" role="dialog" tabindex="-1"><div class="fancybox-bg"></div><div class="fancybox-inner"><div class="fancybox-infobar"><span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span></div><div class="fancybox-toolbar">{{buttons}}</div><div class="fancybox-navigation">{{arrows}}</div><div class="fancybox-stage"></div><div class="fancybox-caption"><div class="fancybox-caption__body"></div></div></div></div>',spinnerTpl:'<div class="fancybox-loading"></div>',errorTpl:'<div class="fancybox-error"><p>{{ERROR}}</p></div>',btnTpl:{download:'<a download data-fancybox-download class="fancybox-button fancybox-button--download" title="{{DOWNLOAD}}" href="javascript:;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.62 17.09V19H5.38v-1.91zm-2.97-6.96L17 11.45l-5 4.87-5-4.87 1.36-1.32 2.68 2.64V5h1.92v7.77z"/></svg></a>',zoom:'<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.7 17.3l-3-3a5.9 5.9 0 0 0-.6-7.6 5.9 5.9 0 0 0-8.4 0 5.9 5.9 0 0 0 0 8.4 5.9 5.9 0 0 0 7.7.7l3 3a1 1 0 0 0 1.3 0c.4-.5.4-1 0-1.5zM8.1 13.8a4 4 0 0 1 0-5.7 4 4 0 0 1 5.7 0 4 4 0 0 1 0 5.7 4 4 0 0 1-5.7 0z"/></svg></button>',close:'<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"/></svg></button>',arrowLeft:'<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}"><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"/></svg></div></button>',arrowRight:'<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}"><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"/></svg></div></button>',smallBtn:'<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{CLOSE}}"><svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"/></svg></button>'},parentEl:"body",hideScrollbar:!0,autoFocus:!0,backFocus:!0,trapFocus:!0,fullScreen:{autoStart:!1},touch:{vertical:!0,momentum:!0},hash:null,media:{},slideShow:{autoStart:!1,speed:3e3},thumbs:{autoStart:!1,hideOnClose:!0,parentEl:".fancybox-container",axis:"y"},wheel:"auto",onInit:n.noop,beforeLoad:n.noop,afterLoad:n.noop,beforeShow:n.noop,afterShow:n.noop,beforeClose:n.noop,afterClose:n.noop,onActivate:n.noop,onDeactivate:n.noop,clickContent:function(t,e){return"image"===t.type&&"zoom"},clickSlide:"close",clickOutside:"close",dblclickContent:!1,dblclickSlide:!1,dblclickOutside:!1,mobile:{preventCaptionOverlap:!1,idleTime:!1,clickContent:function(t,e){return"image"===t.type&&"toggleControls"},clickSlide:function(t,e){return"image"===t.type?"toggleControls":"close"},dblclickContent:function(t,e){return"image"===t.type&&"zoom"},dblclickSlide:function(t,e){return"image"===t.type&&"zoom"}},lang:"en",i18n:{en:{CLOSE:"Close",NEXT:"Next",PREV:"Previous",ERROR:"The requested content cannot be loaded. <br/> Please try again later.",PLAY_START:"Start slideshow",PLAY_STOP:"Pause slideshow",FULL_SCREEN:"Full screen",THUMBS:"Thumbnails",DOWNLOAD:"Download",SHARE:"Share",ZOOM:"Zoom"},de:{CLOSE:"Schlie&szlig;en",NEXT:"Weiter",PREV:"Zur&uuml;ck",ERROR:"Die angeforderten Daten konnten nicht geladen werden. <br/> Bitte versuchen Sie es sp&auml;ter nochmal.",PLAY_START:"Diaschau starten",PLAY_STOP:"Diaschau beenden",FULL_SCREEN:"Vollbild",THUMBS:"Vorschaubilder",DOWNLOAD:"Herunterladen",SHARE:"Teilen",ZOOM:"Vergr&ouml;&szlig;ern"}}},s=n(t),r=n(e),c=0,l=function(t){return t&&t.hasOwnProperty&&t instanceof n},d=function(){return t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||function(e){return t.setTimeout(e,1e3/60)}}(),u=function(){return t.cancelAnimationFrame||t.webkitCancelAnimationFrame||t.mozCancelAnimationFrame||t.oCancelAnimationFrame||function(e){t.clearTimeout(e)}}(),f=function(){var t,n=e.createElement("fakeelement"),o={transition:"transitionend",OTransition:"oTransitionEnd",MozTransition:"transitionend",WebkitTransition:"webkitTransitionEnd"};for(t in o)if(void 0!==n.style[t])return o[t];return"transitionend"}(),p=function(t){return t&&t.length&&t[0].offsetHeight},h=function(t,e){var o=n.extend(!0,{},t,e);return n.each(e,function(t,e){n.isArray(e)&&(o[t]=e)}),o},g=function(t){var o,i;return!(!t||t.ownerDocument!==e)&&(n(".fancybox-container").css("pointer-events","none"),o={x:t.getBoundingClientRect().left+t.offsetWidth/2,y:t.getBoundingClientRect().top+t.offsetHeight/2},i=e.elementFromPoint(o.x,o.y)===t,n(".fancybox-container").css("pointer-events",""),i)},b=function(t,e,o){var i=this;i.opts=h({index:o},n.fancybox.defaults),n.isPlainObject(e)&&(i.opts=h(i.opts,e)),n.fancybox.isMobile&&(i.opts=h(i.opts,i.opts.mobile)),i.id=i.opts.id||++c,i.currIndex=parseInt(i.opts.index,10)||0,i.prevIndex=null,i.prevPos=null,i.currPos=0,i.firstRun=!0,i.group=[],i.slides={},i.addContent(t),i.group.length&&i.init()};n.extend(b.prototype,{init:function(){var o,i,a=this,s=a.group[a.currIndex],r=s.opts;r.closeExisting&&n.fancybox.close(!0),n("body").addClass("fancybox-active"),!n.fancybox.getInstance()&&!1!==r.hideScrollbar&&!n.fancybox.isMobile&&e.body.scrollHeight>t.innerHeight&&(n("head").append('<style id="fancybox-style-noscroll" type="text/css">.compensate-for-scrollbar{margin-right:'+(t.innerWidth-e.documentElement.clientWidth)+"px;}</style>"),n("body").addClass("compensate-for-scrollbar")),i="",n.each(r.buttons,function(t,e){i+=r.btnTpl[e]||""}),o=n(a.translate(a,r.baseTpl.replace("{{buttons}}",i).replace("{{arrows}}",r.btnTpl.arrowLeft+r.btnTpl.arrowRight))).attr("id","fancybox-container-"+a.id).addClass(r.baseClass).data("FancyBox",a).appendTo(r.parentEl),a.$refs={container:o},["bg","inner","infobar","toolbar","stage","caption","navigation"].forEach(function(t){a.$refs[t]=o.find(".fancybox-"+t)}),a.trigger("onInit"),a.activate(),a.jumpTo(a.currIndex)},translate:function(t,e){var n=t.opts.i18n[t.opts.lang]||t.opts.i18n.en;return e.replace(/\{\{(\w+)\}\}/g,function(t,e){return void 0===n[e]?t:n[e]})},addContent:function(t){var e,o=this,i=n.makeArray(t);n.each(i,function(t,e){var i,a,s,r,c,l={},d={};n.isPlainObject(e)?(l=e,d=e.opts||e):"object"===n.type(e)&&n(e).length?(i=n(e),d=i.data()||{},d=n.extend(!0,{},d,d.options),d.$orig=i,l.src=o.opts.src||d.src||i.attr("href"),l.type||l.src||(l.type="inline",l.src=e)):l={type:"html",src:e+""},l.opts=n.extend(!0,{},o.opts,d),n.isArray(d.buttons)&&(l.opts.buttons=d.buttons),n.fancybox.isMobile&&l.opts.mobile&&(l.opts=h(l.opts,l.opts.mobile)),a=l.type||l.opts.type,r=l.src||"",!a&&r&&((s=r.match(/\.(mp4|mov|ogv|webm)((\?|#).*)?$/i))?(a="video",l.opts.video.format||(l.opts.video.format="video/"+("ogv"===s[1]?"ogg":s[1]))):r.match(/(^data:image\/[a-z0-9+\/=]*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg|ico)((\?|#).*)?$)/i)?a="image":r.match(/\.(pdf)((\?|#).*)?$/i)?(a="iframe",l=n.extend(!0,l,{contentType:"pdf",opts:{iframe:{preload:!1}}})):"#"===r.charAt(0)&&(a="inline")),a?l.type=a:o.trigger("objectNeedsType",l),l.contentType||(l.contentType=n.inArray(l.type,["html","inline","ajax"])>-1?"html":l.type),l.index=o.group.length,"auto"==l.opts.smallBtn&&(l.opts.smallBtn=n.inArray(l.type,["html","inline","ajax"])>-1),"auto"===l.opts.toolbar&&(l.opts.toolbar=!l.opts.smallBtn),l.$thumb=l.opts.$thumb||null,l.opts.$trigger&&l.index===o.opts.index&&(l.$thumb=l.opts.$trigger.find("img:first"),l.$thumb.length&&(l.opts.$orig=l.opts.$trigger)),l.$thumb&&l.$thumb.length||!l.opts.$orig||(l.$thumb=l.opts.$orig.find("img:first")),l.$thumb&&!l.$thumb.length&&(l.$thumb=null),l.thumb=l.opts.thumb||(l.$thumb?l.$thumb[0].src:null),"function"===n.type(l.opts.caption)&&(l.opts.caption=l.opts.caption.apply(e,[o,l])),"function"===n.type(o.opts.caption)&&(l.opts.caption=o.opts.caption.apply(e,[o,l])),l.opts.caption instanceof n||(l.opts.caption=void 0===l.opts.caption?"":l.opts.caption+""),"ajax"===l.type&&(c=r.split(/\s+/,2),c.length>1&&(l.src=c.shift(),l.opts.filter=c.shift())),l.opts.modal&&(l.opts=n.extend(!0,l.opts,{trapFocus:!0,infobar:0,toolbar:0,smallBtn:0,keyboard:0,slideShow:0,fullScreen:0,thumbs:0,touch:0,clickContent:!1,clickSlide:!1,clickOutside:!1,dblclickContent:!1,dblclickSlide:!1,dblclickOutside:!1})),o.group.push(l)}),Object.keys(o.slides).length&&(o.updateControls(),(e=o.Thumbs)&&e.isActive&&(e.create(),e.focus()))},addEvents:function(){var e=this;e.removeEvents(),e.$refs.container.on("click.fb-close","[data-fancybox-close]",function(t){t.stopPropagation(),t.preventDefault(),e.close(t)}).on("touchstart.fb-prev click.fb-prev","[data-fancybox-prev]",function(t){t.stopPropagation(),t.preventDefault(),e.previous()}).on("touchstart.fb-next click.fb-next","[data-fancybox-next]",function(t){t.stopPropagation(),t.preventDefault(),e.next()}).on("click.fb","[data-fancybox-zoom]",function(t){e[e.isScaledDown()?"scaleToActual":"scaleToFit"]()}),s.on("orientationchange.fb resize.fb",function(t){t&&t.originalEvent&&"resize"===t.originalEvent.type?(e.requestId&&u(e.requestId),e.requestId=d(function(){e.update(t)})):(e.current&&"iframe"===e.current.type&&e.$refs.stage.hide(),setTimeout(function(){e.$refs.stage.show(),e.update(t)},n.fancybox.isMobile?600:250))}),r.on("keydown.fb",function(t){var o=n.fancybox?n.fancybox.getInstance():null,i=o.current,a=t.keyCode||t.which;if(9==a)return void(i.opts.trapFocus&&e.focus(t));if(!(!i.opts.keyboard||t.ctrlKey||t.altKey||t.shiftKey||n(t.target).is("input,textarea,video,audio,select")))return 8===a||27===a?(t.preventDefault(),void e.close(t)):37===a||38===a?(t.preventDefault(),void e.previous()):39===a||40===a?(t.preventDefault(),void e.next()):void e.trigger("afterKeydown",t,a)}),e.group[e.currIndex].opts.idleTime&&(e.idleSecondsCounter=0,r.on("mousemove.fb-idle mouseleave.fb-idle mousedown.fb-idle touchstart.fb-idle touchmove.fb-idle scroll.fb-idle keydown.fb-idle",function(t){e.idleSecondsCounter=0,e.isIdle&&e.showControls(),e.isIdle=!1}),e.idleInterval=t.setInterval(function(){++e.idleSecondsCounter>=e.group[e.currIndex].opts.idleTime&&!e.isDragging&&(e.isIdle=!0,e.idleSecondsCounter=0,e.hideControls())},1e3))},removeEvents:function(){var e=this;s.off("orientationchange.fb resize.fb"),r.off("keydown.fb .fb-idle"),this.$refs.container.off(".fb-close .fb-prev .fb-next"),e.idleInterval&&(t.clearInterval(e.idleInterval),e.idleInterval=null)},previous:function(t){return this.jumpTo(this.currPos-1,t)},next:function(t){return this.jumpTo(this.currPos+1,t)},jumpTo:function(t,e){var o,i,a,s,r,c,l,d,u,f=this,h=f.group.length;if(!(f.isDragging||f.isClosing||f.isAnimating&&f.firstRun)){if(t=parseInt(t,10),!(a=f.current?f.current.opts.loop:f.opts.loop)&&(t<0||t>=h))return!1;if(o=f.firstRun=!Object.keys(f.slides).length,r=f.current,f.prevIndex=f.currIndex,f.prevPos=f.currPos,s=f.createSlide(t),h>1&&((a||s.index<h-1)&&f.createSlide(t+1),(a||s.index>0)&&f.createSlide(t-1)),f.current=s,f.currIndex=s.index,f.currPos=s.pos,f.trigger("beforeShow",o),f.updateControls(),s.forcedDuration=void 0,n.isNumeric(e)?s.forcedDuration=e:e=s.opts[o?"animationDuration":"transitionDuration"],e=parseInt(e,10),i=f.isMoved(s),s.$slide.addClass("fancybox-slide--current"),o)return s.opts.animationEffect&&e&&f.$refs.container.css("transition-duration",e+"ms"),f.$refs.container.addClass("fancybox-is-open").trigger("focus"),f.loadSlide(s),void f.preload("image");c=n.fancybox.getTranslate(r.$slide),l=n.fancybox.getTranslate(f.$refs.stage),n.each(f.slides,function(t,e){n.fancybox.stop(e.$slide,!0)}),r.pos!==s.pos&&(r.isComplete=!1),r.$slide.removeClass("fancybox-slide--complete fancybox-slide--current"),i?(u=c.left-(r.pos*c.width+r.pos*r.opts.gutter),n.each(f.slides,function(t,o){o.$slide.removeClass("fancybox-animated").removeClass(function(t,e){return(e.match(/(^|\s)fancybox-fx-\S+/g)||[]).join(" ")});var i=o.pos*c.width+o.pos*o.opts.gutter;n.fancybox.setTranslate(o.$slide,{top:0,left:i-l.left+u}),o.pos!==s.pos&&o.$slide.addClass("fancybox-slide--"+(o.pos>s.pos?"next":"previous")),p(o.$slide),n.fancybox.animate(o.$slide,{top:0,left:(o.pos-s.pos)*c.width+(o.pos-s.pos)*o.opts.gutter},e,function(){o.$slide.css({transform:"",opacity:""}).removeClass("fancybox-slide--next fancybox-slide--previous"),o.pos===f.currPos&&f.complete()})})):e&&s.opts.transitionEffect&&(d="fancybox-animated fancybox-fx-"+s.opts.transitionEffect,r.$slide.addClass("fancybox-slide--"+(r.pos>s.pos?"next":"previous")),n.fancybox.animate(r.$slide,d,e,function(){r.$slide.removeClass(d).removeClass("fancybox-slide--next fancybox-slide--previous")},!1)),s.isLoaded?f.revealContent(s):f.loadSlide(s),f.preload("image")}},createSlide:function(t){var e,o,i=this;return o=t%i.group.length,o=o<0?i.group.length+o:o,!i.slides[t]&&i.group[o]&&(e=n('<div class="fancybox-slide"></div>').appendTo(i.$refs.stage),i.slides[t]=n.extend(!0,{},i.group[o],{pos:t,$slide:e,isLoaded:!1}),i.updateSlide(i.slides[t])),i.slides[t]},scaleToActual:function(t,e,o){var i,a,s,r,c,l=this,d=l.current,u=d.$content,f=n.fancybox.getTranslate(d.$slide).width,p=n.fancybox.getTranslate(d.$slide).height,h=d.width,g=d.height;l.isAnimating||l.isMoved()||!u||"image"!=d.type||!d.isLoaded||d.hasError||(l.isAnimating=!0,n.fancybox.stop(u),t=void 0===t?.5*f:t,e=void 0===e?.5*p:e,i=n.fancybox.getTranslate(u),i.top-=n.fancybox.getTranslate(d.$slide).top,i.left-=n.fancybox.getTranslate(d.$slide).left,r=h/i.width,c=g/i.height,a=.5*f-.5*h,s=.5*p-.5*g,h>f&&(a=i.left*r-(t*r-t),a>0&&(a=0),a<f-h&&(a=f-h)),g>p&&(s=i.top*c-(e*c-e),s>0&&(s=0),s<p-g&&(s=p-g)),l.updateCursor(h,g),n.fancybox.animate(u,{top:s,left:a,scaleX:r,scaleY:c},o||366,function(){l.isAnimating=!1}),l.SlideShow&&l.SlideShow.isActive&&l.SlideShow.stop())},scaleToFit:function(t){var e,o=this,i=o.current,a=i.$content;o.isAnimating||o.isMoved()||!a||"image"!=i.type||!i.isLoaded||i.hasError||(o.isAnimating=!0,n.fancybox.stop(a),e=o.getFitPos(i),o.updateCursor(e.width,e.height),n.fancybox.animate(a,{top:e.top,left:e.left,scaleX:e.width/a.width(),scaleY:e.height/a.height()},t||366,function(){o.isAnimating=!1}))},getFitPos:function(t){var e,o,i,a,s=this,r=t.$content,c=t.$slide,l=t.width||t.opts.width,d=t.height||t.opts.height,u={};return!!(t.isLoaded&&r&&r.length)&&(e=n.fancybox.getTranslate(s.$refs.stage).width,o=n.fancybox.getTranslate(s.$refs.stage).height,e-=parseFloat(c.css("paddingLeft"))+parseFloat(c.css("paddingRight"))+parseFloat(r.css("marginLeft"))+parseFloat(r.css("marginRight")),o-=parseFloat(c.css("paddingTop"))+parseFloat(c.css("paddingBottom"))+parseFloat(r.css("marginTop"))+parseFloat(r.css("marginBottom")),l&&d||(l=e,d=o),i=Math.min(1,e/l,o/d),l*=i,d*=i,l>e-.5&&(l=e),d>o-.5&&(d=o),"image"===t.type?(u.top=Math.floor(.5*(o-d))+parseFloat(c.css("paddingTop")),u.left=Math.floor(.5*(e-l))+parseFloat(c.css("paddingLeft"))):"video"===t.contentType&&(a=t.opts.width&&t.opts.height?l/d:t.opts.ratio||16/9,d>l/a?d=l/a:l>d*a&&(l=d*a)),u.width=l,u.height=d,u)},update:function(t){var e=this;n.each(e.slides,function(n,o){e.updateSlide(o,t)})},updateSlide:function(t,e){var o=this,i=t&&t.$content,a=t.width||t.opts.width,s=t.height||t.opts.height,r=t.$slide;o.adjustCaption(t),i&&(a||s||"video"===t.contentType)&&!t.hasError&&(n.fancybox.stop(i),n.fancybox.setTranslate(i,o.getFitPos(t)),t.pos===o.currPos&&(o.isAnimating=!1,o.updateCursor())),o.adjustLayout(t),r.length&&(r.trigger("refresh"),t.pos===o.currPos&&o.$refs.toolbar.add(o.$refs.navigation.find(".fancybox-button--arrow_right")).toggleClass("compensate-for-scrollbar",r.get(0).scrollHeight>r.get(0).clientHeight)),o.trigger("onUpdate",t,e)},centerSlide:function(t){var e=this,o=e.current,i=o.$slide;!e.isClosing&&o&&(i.siblings().css({transform:"",opacity:""}),i.parent().children().removeClass("fancybox-slide--previous fancybox-slide--next"),n.fancybox.animate(i,{top:0,left:0,opacity:1},void 0===t?0:t,function(){i.css({transform:"",opacity:""}),o.isComplete||e.complete()},!1))},isMoved:function(t){var e,o,i=t||this.current;return!!i&&(o=n.fancybox.getTranslate(this.$refs.stage),e=n.fancybox.getTranslate(i.$slide),!i.$slide.hasClass("fancybox-animated")&&(Math.abs(e.top-o.top)>.5||Math.abs(e.left-o.left)>.5))},updateCursor:function(t,e){var o,i,a=this,s=a.current,r=a.$refs.container;s&&!a.isClosing&&a.Guestures&&(r.removeClass("fancybox-is-zoomable fancybox-can-zoomIn fancybox-can-zoomOut fancybox-can-swipe fancybox-can-pan"),o=a.canPan(t,e),i=!!o||a.isZoomable(),r.toggleClass("fancybox-is-zoomable",i),n("[data-fancybox-zoom]").prop("disabled",!i),o?r.addClass("fancybox-can-pan"):i&&("zoom"===s.opts.clickContent||n.isFunction(s.opts.clickContent)&&"zoom"==s.opts.clickContent(s))?r.addClass("fancybox-can-zoomIn"):s.opts.touch&&(s.opts.touch.vertical||a.group.length>1)&&"video"!==s.contentType&&r.addClass("fancybox-can-swipe"))},isZoomable:function(){var t,e=this,n=e.current;if(n&&!e.isClosing&&"image"===n.type&&!n.hasError){if(!n.isLoaded)return!0;if((t=e.getFitPos(n))&&(n.width>t.width||n.height>t.height))return!0}return!1},isScaledDown:function(t,e){var o=this,i=!1,a=o.current,s=a.$content;return void 0!==t&&void 0!==e?i=t<a.width&&e<a.height:s&&(i=n.fancybox.getTranslate(s),i=i.width<a.width&&i.height<a.height),i},canPan:function(t,e){var o=this,i=o.current,a=null,s=!1;return"image"===i.type&&(i.isComplete||t&&e)&&!i.hasError&&(s=o.getFitPos(i),void 0!==t&&void 0!==e?a={width:t,height:e}:i.isComplete&&(a=n.fancybox.getTranslate(i.$content)),a&&s&&(s=Math.abs(a.width-s.width)>1.5||Math.abs(a.height-s.height)>1.5)),s},loadSlide:function(t){var e,o,i,a=this;if(!t.isLoading&&!t.isLoaded){if(t.isLoading=!0,!1===a.trigger("beforeLoad",t))return t.isLoading=!1,!1;switch(e=t.type,o=t.$slide,o.off("refresh").trigger("onReset").addClass(t.opts.slideClass),e){case"image":a.setImage(t);break;case"iframe":a.setIframe(t);break;case"html":a.setContent(t,t.src||t.content);break;case"video":a.setContent(t,t.opts.video.tpl.replace(/\{\{src\}\}/gi,t.src).replace("{{format}}",t.opts.videoFormat||t.opts.video.format||"").replace("{{poster}}",t.thumb||""));break;case"inline":n(t.src).length?a.setContent(t,n(t.src)):a.setError(t);break;case"ajax":a.showLoading(t),i=n.ajax(n.extend({},t.opts.ajax.settings,{url:t.src,success:function(e,n){"success"===n&&a.setContent(t,e)},error:function(e,n){e&&"abort"!==n&&a.setError(t)}})),o.one("onReset",function(){i.abort()});break;default:a.setError(t)}return!0}},setImage:function(t){var o,i=this;setTimeout(function(){var e=t.$image;i.isClosing||!t.isLoading||e&&e.length&&e[0].complete||t.hasError||i.showLoading(t)},50),i.checkSrcset(t),t.$content=n('<div class="fancybox-content"></div>').addClass("fancybox-is-hidden").appendTo(t.$slide.addClass("fancybox-slide--image")),!1!==t.opts.preload&&t.opts.width&&t.opts.height&&t.thumb&&(t.width=t.opts.width,t.height=t.opts.height,o=e.createElement("img"),o.onerror=function(){n(this).remove(),t.$ghost=null},o.onload=function(){i.afterLoad(t)},t.$ghost=n(o).addClass("fancybox-image").appendTo(t.$content).attr("src",t.thumb)),i.setBigImage(t)},checkSrcset:function(e){var n,o,i,a,s=e.opts.srcset||e.opts.image.srcset;if(s){i=t.devicePixelRatio||1,a=t.innerWidth*i,o=s.split(",").map(function(t){var e={};return t.trim().split(/\s+/).forEach(function(t,n){var o=parseInt(t.substring(0,t.length-1),10);if(0===n)return e.url=t;o&&(e.value=o,e.postfix=t[t.length-1])}),e}),o.sort(function(t,e){return t.value-e.value});for(var r=0;r<o.length;r++){var c=o[r];if("w"===c.postfix&&c.value>=a||"x"===c.postfix&&c.value>=i){n=c;break}}!n&&o.length&&(n=o[o.length-1]),n&&(e.src=n.url,e.width&&e.height&&"w"==n.postfix&&(e.height=e.width/e.height*n.value,e.width=n.value),e.opts.srcset=s)}},setBigImage:function(t){var o=this,i=e.createElement("img"),a=n(i);t.$image=a.one("error",function(){o.setError(t)}).one("load",function(){var e;t.$ghost||(o.resolveImageSlideSize(t,this.naturalWidth,this.naturalHeight),o.afterLoad(t)),o.isClosing||(t.opts.srcset&&(e=t.opts.sizes,e&&"auto"!==e||(e=(t.width/t.height>1&&s.width()/s.height()>1?"100":Math.round(t.width/t.height*100))+"vw"),a.attr("sizes",e).attr("srcset",t.opts.srcset)),t.$ghost&&setTimeout(function(){t.$ghost&&!o.isClosing&&t.$ghost.hide()},Math.min(300,Math.max(1e3,t.height/1600))),o.hideLoading(t))}).addClass("fancybox-image").attr("src",t.src).appendTo(t.$content),(i.complete||"complete"==i.readyState)&&a.naturalWidth&&a.naturalHeight?a.trigger("load"):i.error&&a.trigger("error")},resolveImageSlideSize:function(t,e,n){var o=parseInt(t.opts.width,10),i=parseInt(t.opts.height,10);t.width=e,t.height=n,o>0&&(t.width=o,t.height=Math.floor(o*n/e)),i>0&&(t.width=Math.floor(i*e/n),t.height=i)},setIframe:function(t){var e,o=this,i=t.opts.iframe,a=t.$slide;t.$content=n('<div class="fancybox-content'+(i.preload?" fancybox-is-hidden":"")+'"></div>').css(i.css).appendTo(a),a.addClass("fancybox-slide--"+t.contentType),t.$iframe=e=n(i.tpl.replace(/\{rnd\}/g,(new Date).getTime())).attr(i.attr).appendTo(t.$content),i.preload?(o.showLoading(t),e.on("load.fb error.fb",function(e){this.isReady=1,t.$slide.trigger("refresh"),o.afterLoad(t)}),a.on("refresh.fb",function(){var n,o,s=t.$content,r=i.css.width,c=i.css.height;if(1===e[0].isReady){try{n=e.contents(),o=n.find("body")}catch(t){}o&&o.length&&o.children().length&&(a.css("overflow","visible"),s.css({width:"100%","max-width":"100%",height:"9999px"}),void 0===r&&(r=Math.ceil(Math.max(o[0].clientWidth,o.outerWidth(!0)))),s.css("width",r||"").css("max-width",""),void 0===c&&(c=Math.ceil(Math.max(o[0].clientHeight,o.outerHeight(!0)))),s.css("height",c||""),a.css("overflow","auto")),s.removeClass("fancybox-is-hidden")}})):o.afterLoad(t),e.attr("src",t.src),a.one("onReset",function(){try{n(this).find("iframe").hide().unbind().attr("src","//about:blank")}catch(t){}n(this).off("refresh.fb").empty(),t.isLoaded=!1,t.isRevealed=!1})},setContent:function(t,e){var o=this;o.isClosing||(o.hideLoading(t),t.$content&&n.fancybox.stop(t.$content),t.$slide.empty(),l(e)&&e.parent().length?((e.hasClass("fancybox-content")||e.parent().hasClass("fancybox-content"))&&e.parents(".fancybox-slide").trigger("onReset"),t.$placeholder=n("<div>").hide().insertAfter(e),e.css("display","inline-block")):t.hasError||("string"===n.type(e)&&(e=n("<div>").append(n.trim(e)).contents()),t.opts.filter&&(e=n("<div>").html(e).find(t.opts.filter))),t.$slide.one("onReset",function(){n(this).find("video,audio").trigger("pause"),t.$placeholder&&(t.$placeholder.after(e.removeClass("fancybox-content").hide()).remove(),t.$placeholder=null),t.$smallBtn&&(t.$smallBtn.remove(),t.$smallBtn=null),t.hasError||(n(this).empty(),t.isLoaded=!1,t.isRevealed=!1)}),n(e).appendTo(t.$slide),n(e).is("video,audio")&&(n(e).addClass("fancybox-video"),n(e).wrap("<div></div>"),t.contentType="video",t.opts.width=t.opts.width||n(e).attr("width"),t.opts.height=t.opts.height||n(e).attr("height")),t.$content=t.$slide.children().filter("div,form,main,video,audio,article,.fancybox-content").first(),t.$content.siblings().hide(),t.$content.length||(t.$content=t.$slide.wrapInner("<div></div>").children().first()),t.$content.addClass("fancybox-content"),t.$slide.addClass("fancybox-slide--"+t.contentType),o.afterLoad(t))},setError:function(t){t.hasError=!0,t.$slide.trigger("onReset").removeClass("fancybox-slide--"+t.contentType).addClass("fancybox-slide--error"),t.contentType="html",this.setContent(t,this.translate(t,t.opts.errorTpl)),t.pos===this.currPos&&(this.isAnimating=!1)},showLoading:function(t){var e=this;(t=t||e.current)&&!t.$spinner&&(t.$spinner=n(e.translate(e,e.opts.spinnerTpl)).appendTo(t.$slide).hide().fadeIn("fast"))},hideLoading:function(t){var e=this;(t=t||e.current)&&t.$spinner&&(t.$spinner.stop().remove(),delete t.$spinner)},afterLoad:function(t){var e=this;e.isClosing||(t.isLoading=!1,t.isLoaded=!0,e.trigger("afterLoad",t),e.hideLoading(t),!t.opts.smallBtn||t.$smallBtn&&t.$smallBtn.length||(t.$smallBtn=n(e.translate(t,t.opts.btnTpl.smallBtn)).appendTo(t.$content)),t.opts.protect&&t.$content&&!t.hasError&&(t.$content.on("contextmenu.fb",function(t){return 2==t.button&&t.preventDefault(),!0}),"image"===t.type&&n('<div class="fancybox-spaceball"></div>').appendTo(t.$content)),e.adjustCaption(t),e.adjustLayout(t),t.pos===e.currPos&&e.updateCursor(),e.revealContent(t))},adjustCaption:function(t){var e,n=this,o=t||n.current,i=o.opts.caption,a=o.opts.preventCaptionOverlap,s=n.$refs.caption,r=!1;s.toggleClass("fancybox-caption--separate",a),a&&i&&i.length&&(o.pos!==n.currPos?(e=s.clone().appendTo(s.parent()),e.children().eq(0).empty().html(i),r=e.outerHeight(!0),e.empty().remove()):n.$caption&&(r=n.$caption.outerHeight(!0)),o.$slide.css("padding-bottom",r||""))},adjustLayout:function(t){var e,n,o,i,a=this,s=t||a.current;s.isLoaded&&!0!==s.opts.disableLayoutFix&&(s.$content.css("margin-bottom",""),s.$content.outerHeight()>s.$slide.height()+.5&&(o=s.$slide[0].style["padding-bottom"],i=s.$slide.css("padding-bottom"),parseFloat(i)>0&&(e=s.$slide[0].scrollHeight,s.$slide.css("padding-bottom",0),Math.abs(e-s.$slide[0].scrollHeight)<1&&(n=i),s.$slide.css("padding-bottom",o))),s.$content.css("margin-bottom",n))},revealContent:function(t){var e,o,i,a,s=this,r=t.$slide,c=!1,l=!1,d=s.isMoved(t),u=t.isRevealed;return t.isRevealed=!0,e=t.opts[s.firstRun?"animationEffect":"transitionEffect"],i=t.opts[s.firstRun?"animationDuration":"transitionDuration"],i=parseInt(void 0===t.forcedDuration?i:t.forcedDuration,10),!d&&t.pos===s.currPos&&i||(e=!1),"zoom"===e&&(t.pos===s.currPos&&i&&"image"===t.type&&!t.hasError&&(l=s.getThumbPos(t))?c=s.getFitPos(t):e="fade"),"zoom"===e?(s.isAnimating=!0,c.scaleX=c.width/l.width,c.scaleY=c.height/l.height,a=t.opts.zoomOpacity,"auto"==a&&(a=Math.abs(t.width/t.height-l.width/l.height)>.1),a&&(l.opacity=.1,c.opacity=1),n.fancybox.setTranslate(t.$content.removeClass("fancybox-is-hidden"),l),p(t.$content),void n.fancybox.animate(t.$content,c,i,function(){s.isAnimating=!1,s.complete()})):(s.updateSlide(t),e?(n.fancybox.stop(r),o="fancybox-slide--"+(t.pos>=s.prevPos?"next":"previous")+" fancybox-animated fancybox-fx-"+e,r.addClass(o).removeClass("fancybox-slide--current"),t.$content.removeClass("fancybox-is-hidden"),p(r),"image"!==t.type&&t.$content.hide().show(0),void n.fancybox.animate(r,"fancybox-slide--current",i,function(){r.removeClass(o).css({transform:"",opacity:""}),t.pos===s.currPos&&s.complete()},!0)):(t.$content.removeClass("fancybox-is-hidden"),u||!d||"image"!==t.type||t.hasError||t.$content.hide().fadeIn("fast"),void(t.pos===s.currPos&&s.complete())))},getThumbPos:function(t){var e,o,i,a,s,r=!1,c=t.$thumb;return!(!c||!g(c[0]))&&(e=n.fancybox.getTranslate(c),o=parseFloat(c.css("border-top-width")||0),i=parseFloat(c.css("border-right-width")||0),a=parseFloat(c.css("border-bottom-width")||0),s=parseFloat(c.css("border-left-width")||0),r={top:e.top+o,left:e.left+s,width:e.width-i-s,height:e.height-o-a,scaleX:1,scaleY:1},e.width>0&&e.height>0&&r)},complete:function(){var t,e=this,o=e.current,i={};!e.isMoved()&&o.isLoaded&&(o.isComplete||(o.isComplete=!0,o.$slide.siblings().trigger("onReset"),e.preload("inline"),p(o.$slide),o.$slide.addClass("fancybox-slide--complete"),n.each(e.slides,function(t,o){o.pos>=e.currPos-1&&o.pos<=e.currPos+1?i[o.pos]=o:o&&(n.fancybox.stop(o.$slide),o.$slide.off().remove())}),e.slides=i),e.isAnimating=!1,e.updateCursor(),e.trigger("afterShow"),o.opts.video.autoStart&&o.$slide.find("video,audio").filter(":visible:first").trigger("play").one("ended",function(){Document.exitFullscreen?Document.exitFullscreen():this.webkitExitFullscreen&&this.webkitExitFullscreen(),e.next()}),o.opts.autoFocus&&"html"===o.contentType&&(t=o.$content.find("input[autofocus]:enabled:visible:first"),t.length?t.trigger("focus"):e.focus(null,!0)),o.$slide.scrollTop(0).scrollLeft(0))},preload:function(t){var e,n,o=this;o.group.length<2||(n=o.slides[o.currPos+1],e=o.slides[o.currPos-1],e&&e.type===t&&o.loadSlide(e),n&&n.type===t&&o.loadSlide(n))},focus:function(t,o){var i,a,s=this,r=["a[href]","area[href]",'input:not([disabled]):not([type="hidden"]):not([aria-hidden])',"select:not([disabled]):not([aria-hidden])","textarea:not([disabled]):not([aria-hidden])","button:not([disabled]):not([aria-hidden])","iframe","object","embed","video","audio","[contenteditable]",'[tabindex]:not([tabindex^="-"])'].join(",");s.isClosing||(i=!t&&s.current&&s.current.isComplete?s.current.$slide.find("*:visible"+(o?":not(.fancybox-close-small)":"")):s.$refs.container.find("*:visible"),i=i.filter(r).filter(function(){return"hidden"!==n(this).css("visibility")&&!n(this).hasClass("disabled")}),i.length?(a=i.index(e.activeElement),t&&t.shiftKey?(a<0||0==a)&&(t.preventDefault(),i.eq(i.length-1).trigger("focus")):(a<0||a==i.length-1)&&(t&&t.preventDefault(),i.eq(0).trigger("focus"))):s.$refs.container.trigger("focus"))},activate:function(){var t=this;n(".fancybox-container").each(function(){var e=n(this).data("FancyBox");e&&e.id!==t.id&&!e.isClosing&&(e.trigger("onDeactivate"),e.removeEvents(),e.isVisible=!1)}),t.isVisible=!0,(t.current||t.isIdle)&&(t.update(),t.updateControls()),t.trigger("onActivate"),t.addEvents()},close:function(t,e){var o,i,a,s,r,c,l,u=this,f=u.current,h=function(){u.cleanUp(t)};return!u.isClosing&&(u.isClosing=!0,!1===u.trigger("beforeClose",t)?(u.isClosing=!1,d(function(){u.update()}),!1):(u.removeEvents(),a=f.$content,o=f.opts.animationEffect,i=n.isNumeric(e)?e:o?f.opts.animationDuration:0,f.$slide.removeClass("fancybox-slide--complete fancybox-slide--next fancybox-slide--previous fancybox-animated"),!0!==t?n.fancybox.stop(f.$slide):o=!1,f.$slide.siblings().trigger("onReset").remove(),i&&u.$refs.container.removeClass("fancybox-is-open").addClass("fancybox-is-closing").css("transition-duration",i+"ms"),u.hideLoading(f),u.hideControls(!0),u.updateCursor(),"zoom"!==o||a&&i&&"image"===f.type&&!u.isMoved()&&!f.hasError&&(l=u.getThumbPos(f))||(o="fade"),"zoom"===o?(n.fancybox.stop(a),s=n.fancybox.getTranslate(a),c={top:s.top,left:s.left,scaleX:s.width/l.width,scaleY:s.height/l.height,width:l.width,height:l.height},r=f.opts.zoomOpacity,
    "auto"==r&&(r=Math.abs(f.width/f.height-l.width/l.height)>.1),r&&(l.opacity=0),n.fancybox.setTranslate(a,c),p(a),n.fancybox.animate(a,l,i,h),!0):(o&&i?n.fancybox.animate(f.$slide.addClass("fancybox-slide--previous").removeClass("fancybox-slide--current"),"fancybox-animated fancybox-fx-"+o,i,h):!0===t?setTimeout(h,i):h(),!0)))},cleanUp:function(e){var o,i,a,s=this,r=s.current.opts.$orig;s.current.$slide.trigger("onReset"),s.$refs.container.empty().remove(),s.trigger("afterClose",e),s.current.opts.backFocus&&(r&&r.length&&r.is(":visible")||(r=s.$trigger),r&&r.length&&(i=t.scrollX,a=t.scrollY,r.trigger("focus"),n("html, body").scrollTop(a).scrollLeft(i))),s.current=null,o=n.fancybox.getInstance(),o?o.activate():(n("body").removeClass("fancybox-active compensate-for-scrollbar"),n("#fancybox-style-noscroll").remove())},trigger:function(t,e){var o,i=Array.prototype.slice.call(arguments,1),a=this,s=e&&e.opts?e:a.current;if(s?i.unshift(s):s=a,i.unshift(a),n.isFunction(s.opts[t])&&(o=s.opts[t].apply(s,i)),!1===o)return o;"afterClose"!==t&&a.$refs?a.$refs.container.trigger(t+".fb",i):r.trigger(t+".fb",i)},updateControls:function(){var t=this,o=t.current,i=o.index,a=t.$refs.container,s=t.$refs.caption,r=o.opts.caption;o.$slide.trigger("refresh"),r&&r.length?(t.$caption=s,s.children().eq(0).html(r)):t.$caption=null,t.hasHiddenControls||t.isIdle||t.showControls(),a.find("[data-fancybox-count]").html(t.group.length),a.find("[data-fancybox-index]").html(i+1),a.find("[data-fancybox-prev]").prop("disabled",!o.opts.loop&&i<=0),a.find("[data-fancybox-next]").prop("disabled",!o.opts.loop&&i>=t.group.length-1),"image"===o.type?a.find("[data-fancybox-zoom]").show().end().find("[data-fancybox-download]").attr("href",o.opts.image.src||o.src).show():o.opts.toolbar&&a.find("[data-fancybox-download],[data-fancybox-zoom]").hide(),n(e.activeElement).is(":hidden,[disabled]")&&t.$refs.container.trigger("focus")},hideControls:function(t){var e=this,n=["infobar","toolbar","nav"];!t&&e.current.opts.preventCaptionOverlap||n.push("caption"),this.$refs.container.removeClass(n.map(function(t){return"fancybox-show-"+t}).join(" ")),this.hasHiddenControls=!0},showControls:function(){var t=this,e=t.current?t.current.opts:t.opts,n=t.$refs.container;t.hasHiddenControls=!1,t.idleSecondsCounter=0,n.toggleClass("fancybox-show-toolbar",!(!e.toolbar||!e.buttons)).toggleClass("fancybox-show-infobar",!!(e.infobar&&t.group.length>1)).toggleClass("fancybox-show-caption",!!t.$caption).toggleClass("fancybox-show-nav",!!(e.arrows&&t.group.length>1)).toggleClass("fancybox-is-modal",!!e.modal)},toggleControls:function(){this.hasHiddenControls?this.showControls():this.hideControls()}}),n.fancybox={version:"3.5.7",defaults:a,getInstance:function(t){var e=n('.fancybox-container:not(".fancybox-is-closing"):last').data("FancyBox"),o=Array.prototype.slice.call(arguments,1);return e instanceof b&&("string"===n.type(t)?e[t].apply(e,o):"function"===n.type(t)&&t.apply(e,o),e)},open:function(t,e,n){return new b(t,e,n)},close:function(t){var e=this.getInstance();e&&(e.close(),!0===t&&this.close(t))},destroy:function(){this.close(!0),r.add("body").off("click.fb-start","**")},isMobile:/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),use3d:function(){var n=e.createElement("div");return t.getComputedStyle&&t.getComputedStyle(n)&&t.getComputedStyle(n).getPropertyValue("transform")&&!(e.documentMode&&e.documentMode<11)}(),getTranslate:function(t){var e;return!(!t||!t.length)&&(e=t[0].getBoundingClientRect(),{top:e.top||0,left:e.left||0,width:e.width,height:e.height,opacity:parseFloat(t.css("opacity"))})},setTranslate:function(t,e){var n="",o={};if(t&&e)return void 0===e.left&&void 0===e.top||(n=(void 0===e.left?t.position().left:e.left)+"px, "+(void 0===e.top?t.position().top:e.top)+"px",n=this.use3d?"translate3d("+n+", 0px)":"translate("+n+")"),void 0!==e.scaleX&&void 0!==e.scaleY?n+=" scale("+e.scaleX+", "+e.scaleY+")":void 0!==e.scaleX&&(n+=" scaleX("+e.scaleX+")"),n.length&&(o.transform=n),void 0!==e.opacity&&(o.opacity=e.opacity),void 0!==e.width&&(o.width=e.width),void 0!==e.height&&(o.height=e.height),t.css(o)},animate:function(t,e,o,i,a){var s,r=this;n.isFunction(o)&&(i=o,o=null),r.stop(t),s=r.getTranslate(t),t.on(f,function(c){(!c||!c.originalEvent||t.is(c.originalEvent.target)&&"z-index"!=c.originalEvent.propertyName)&&(r.stop(t),n.isNumeric(o)&&t.css("transition-duration",""),n.isPlainObject(e)?void 0!==e.scaleX&&void 0!==e.scaleY&&r.setTranslate(t,{top:e.top,left:e.left,width:s.width*e.scaleX,height:s.height*e.scaleY,scaleX:1,scaleY:1}):!0!==a&&t.removeClass(e),n.isFunction(i)&&i(c))}),n.isNumeric(o)&&t.css("transition-duration",o+"ms"),n.isPlainObject(e)?(void 0!==e.scaleX&&void 0!==e.scaleY&&(delete e.width,delete e.height,t.parent().hasClass("fancybox-slide--image")&&t.parent().addClass("fancybox-is-scaling")),n.fancybox.setTranslate(t,e)):t.addClass(e),t.data("timer",setTimeout(function(){t.trigger(f)},o+33))},stop:function(t,e){t&&t.length&&(clearTimeout(t.data("timer")),e&&t.trigger(f),t.off(f).css("transition-duration",""),t.parent().removeClass("fancybox-is-scaling"))}},n.fn.fancybox=function(t){var e;return t=t||{},e=t.selector||!1,e?n("body").off("click.fb-start",e).on("click.fb-start",e,{options:t},i):this.off("click.fb-start").on("click.fb-start",{items:this,options:t},i),this},r.on("click.fb-start","[data-fancybox]",i),r.on("click.fb-start","[data-fancybox-trigger]",function(t){n('[data-fancybox="'+n(this).attr("data-fancybox-trigger")+'"]').eq(n(this).attr("data-fancybox-index")||0).trigger("click.fb-start",{$trigger:n(this)})}),function(){var t=null;r.on("mousedown mouseup focus blur",".fancybox-button",function(e){switch(e.type){case"mousedown":t=n(this);break;case"mouseup":t=null;break;case"focusin":n(".fancybox-button").removeClass("fancybox-focus"),n(this).is(t)||n(this).is("[disabled]")||n(this).addClass("fancybox-focus");break;case"focusout":n(".fancybox-button").removeClass("fancybox-focus")}})}()}}(window,document,jQuery),function(t){"use strict";var e={youtube:{matcher:/(youtube\.com|youtu\.be|youtube\-nocookie\.com)\/(watch\?(.*&)?v=|v\/|u\/|embed\/?)?(videoseries\?list=(.*)|[\w-]{11}|\?listType=(.*)&list=(.*))(.*)/i,params:{autoplay:1,autohide:1,fs:1,rel:0,hd:1,wmode:"transparent",enablejsapi:1,html5:1},paramPlace:8,type:"iframe",url:"https://www.youtube-nocookie.com/embed/$4",thumb:"https://img.youtube.com/vi/$4/hqdefault.jpg"},vimeo:{matcher:/^.+vimeo.com\/(.*\/)?([\d]+)(.*)?/,params:{autoplay:1,hd:1,show_title:1,show_byline:1,show_portrait:0,fullscreen:1},paramPlace:3,type:"iframe",url:"//player.vimeo.com/video/$2"},instagram:{matcher:/(instagr\.am|instagram\.com)\/p\/([a-zA-Z0-9_\-]+)\/?/i,type:"image",url:"//$1/p/$2/media/?size=l"},gmap_place:{matcher:/(maps\.)?google\.([a-z]{2,3}(\.[a-z]{2})?)\/(((maps\/(place\/(.*)\/)?\@(.*),(\d+.?\d+?)z))|(\?ll=))(.*)?/i,type:"iframe",url:function(t){return"//maps.google."+t[2]+"/?ll="+(t[9]?t[9]+"&z="+Math.floor(t[10])+(t[12]?t[12].replace(/^\//,"&"):""):t[12]+"").replace(/\?/,"&")+"&output="+(t[12]&&t[12].indexOf("layer=c")>0?"svembed":"embed")}},gmap_search:{matcher:/(maps\.)?google\.([a-z]{2,3}(\.[a-z]{2})?)\/(maps\/search\/)(.*)/i,type:"iframe",url:function(t){return"//maps.google."+t[2]+"/maps?q="+t[5].replace("query=","q=").replace("api=1","")+"&output=embed"}}},n=function(e,n,o){if(e)return o=o||"","object"===t.type(o)&&(o=t.param(o,!0)),t.each(n,function(t,n){e=e.replace("$"+t,n||"")}),o.length&&(e+=(e.indexOf("?")>0?"&":"?")+o),e};t(document).on("objectNeedsType.fb",function(o,i,a){var s,r,c,l,d,u,f,p=a.src||"",h=!1;s=t.extend(!0,{},e,a.opts.media),t.each(s,function(e,o){if(c=p.match(o.matcher)){if(h=o.type,f=e,u={},o.paramPlace&&c[o.paramPlace]){d=c[o.paramPlace],"?"==d[0]&&(d=d.substring(1)),d=d.split("&");for(var i=0;i<d.length;++i){var s=d[i].split("=",2);2==s.length&&(u[s[0]]=decodeURIComponent(s[1].replace(/\+/g," ")))}}return l=t.extend(!0,{},o.params,a.opts[e],u),p="function"===t.type(o.url)?o.url.call(this,c,l,a):n(o.url,c,l),r="function"===t.type(o.thumb)?o.thumb.call(this,c,l,a):n(o.thumb,c),"youtube"===e?p=p.replace(/&t=((\d+)m)?(\d+)s/,function(t,e,n,o){return"&start="+((n?60*parseInt(n,10):0)+parseInt(o,10))}):"vimeo"===e&&(p=p.replace("&%23","#")),!1}}),h?(a.opts.thumb||a.opts.$thumb&&a.opts.$thumb.length||(a.opts.thumb=r),"iframe"===h&&(a.opts=t.extend(!0,a.opts,{iframe:{preload:!1,attr:{scrolling:"no"}}})),t.extend(a,{type:h,src:p,origSrc:a.src,contentSource:f,contentType:"image"===h?"image":"gmap_place"==f||"gmap_search"==f?"map":"video"})):p&&(a.type=a.opts.defaultType)});var o={youtube:{src:"https://www.youtube.com/iframe_api",class:"YT",loading:!1,loaded:!1},vimeo:{src:"https://player.vimeo.com/api/player.js",class:"Vimeo",loading:!1,loaded:!1},load:function(t){var e,n=this;if(this[t].loaded)return void setTimeout(function(){n.done(t)});this[t].loading||(this[t].loading=!0,e=document.createElement("script"),e.type="text/javascript",e.src=this[t].src,"youtube"===t?window.onYouTubeIframeAPIReady=function(){n[t].loaded=!0,n.done(t)}:e.onload=function(){n[t].loaded=!0,n.done(t)},document.body.appendChild(e))},done:function(e){var n,o,i;"youtube"===e&&delete window.onYouTubeIframeAPIReady,(n=t.fancybox.getInstance())&&(o=n.current.$content.find("iframe"),"youtube"===e&&void 0!==YT&&YT?i=new YT.Player(o.attr("id"),{events:{onStateChange:function(t){0==t.data&&n.next()}}}):"vimeo"===e&&void 0!==Vimeo&&Vimeo&&(i=new Vimeo.Player(o),i.on("ended",function(){n.next()})))}};t(document).on({"afterShow.fb":function(t,e,n){e.group.length>1&&("youtube"===n.contentSource||"vimeo"===n.contentSource)&&o.load(n.contentSource)}})}(jQuery),function(t,e,n){"use strict";var o=function(){return t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||function(e){return t.setTimeout(e,1e3/60)}}(),i=function(){return t.cancelAnimationFrame||t.webkitCancelAnimationFrame||t.mozCancelAnimationFrame||t.oCancelAnimationFrame||function(e){t.clearTimeout(e)}}(),a=function(e){var n=[];e=e.originalEvent||e||t.e,e=e.touches&&e.touches.length?e.touches:e.changedTouches&&e.changedTouches.length?e.changedTouches:[e];for(var o in e)e[o].pageX?n.push({x:e[o].pageX,y:e[o].pageY}):e[o].clientX&&n.push({x:e[o].clientX,y:e[o].clientY});return n},s=function(t,e,n){return e&&t?"x"===n?t.x-e.x:"y"===n?t.y-e.y:Math.sqrt(Math.pow(t.x-e.x,2)+Math.pow(t.y-e.y,2)):0},r=function(t){if(t.is('a,area,button,[role="button"],input,label,select,summary,textarea,video,audio,iframe')||n.isFunction(t.get(0).onclick)||t.data("selectable"))return!0;for(var e=0,o=t[0].attributes,i=o.length;e<i;e++)if("data-fancybox-"===o[e].nodeName.substr(0,14))return!0;return!1},c=function(e){var n=t.getComputedStyle(e)["overflow-y"],o=t.getComputedStyle(e)["overflow-x"],i=("scroll"===n||"auto"===n)&&e.scrollHeight>e.clientHeight,a=("scroll"===o||"auto"===o)&&e.scrollWidth>e.clientWidth;return i||a},l=function(t){for(var e=!1;;){if(e=c(t.get(0)))break;if(t=t.parent(),!t.length||t.hasClass("fancybox-stage")||t.is("body"))break}return e},d=function(t){var e=this;e.instance=t,e.$bg=t.$refs.bg,e.$stage=t.$refs.stage,e.$container=t.$refs.container,e.destroy(),e.$container.on("touchstart.fb.touch mousedown.fb.touch",n.proxy(e,"ontouchstart"))};d.prototype.destroy=function(){var t=this;t.$container.off(".fb.touch"),n(e).off(".fb.touch"),t.requestId&&(i(t.requestId),t.requestId=null),t.tapped&&(clearTimeout(t.tapped),t.tapped=null)},d.prototype.ontouchstart=function(o){var i=this,c=n(o.target),d=i.instance,u=d.current,f=u.$slide,p=u.$content,h="touchstart"==o.type;if(h&&i.$container.off("mousedown.fb.touch"),(!o.originalEvent||2!=o.originalEvent.button)&&f.length&&c.length&&!r(c)&&!r(c.parent())&&(c.is("img")||!(o.originalEvent.clientX>c[0].clientWidth+c.offset().left))){if(!u||d.isAnimating||u.$slide.hasClass("fancybox-animated"))return o.stopPropagation(),void o.preventDefault();i.realPoints=i.startPoints=a(o),i.startPoints.length&&(u.touch&&o.stopPropagation(),i.startEvent=o,i.canTap=!0,i.$target=c,i.$content=p,i.opts=u.opts.touch,i.isPanning=!1,i.isSwiping=!1,i.isZooming=!1,i.isScrolling=!1,i.canPan=d.canPan(),i.startTime=(new Date).getTime(),i.distanceX=i.distanceY=i.distance=0,i.canvasWidth=Math.round(f[0].clientWidth),i.canvasHeight=Math.round(f[0].clientHeight),i.contentLastPos=null,i.contentStartPos=n.fancybox.getTranslate(i.$content)||{top:0,left:0},i.sliderStartPos=n.fancybox.getTranslate(f),i.stagePos=n.fancybox.getTranslate(d.$refs.stage),i.sliderStartPos.top-=i.stagePos.top,i.sliderStartPos.left-=i.stagePos.left,i.contentStartPos.top-=i.stagePos.top,i.contentStartPos.left-=i.stagePos.left,n(e).off(".fb.touch").on(h?"touchend.fb.touch touchcancel.fb.touch":"mouseup.fb.touch mouseleave.fb.touch",n.proxy(i,"ontouchend")).on(h?"touchmove.fb.touch":"mousemove.fb.touch",n.proxy(i,"ontouchmove")),n.fancybox.isMobile&&e.addEventListener("scroll",i.onscroll,!0),((i.opts||i.canPan)&&(c.is(i.$stage)||i.$stage.find(c).length)||(c.is(".fancybox-image")&&o.preventDefault(),n.fancybox.isMobile&&c.parents(".fancybox-caption").length))&&(i.isScrollable=l(c)||l(c.parent()),n.fancybox.isMobile&&i.isScrollable||o.preventDefault(),(1===i.startPoints.length||u.hasError)&&(i.canPan?(n.fancybox.stop(i.$content),i.isPanning=!0):i.isSwiping=!0,i.$container.addClass("fancybox-is-grabbing")),2===i.startPoints.length&&"image"===u.type&&(u.isLoaded||u.$ghost)&&(i.canTap=!1,i.isSwiping=!1,i.isPanning=!1,i.isZooming=!0,n.fancybox.stop(i.$content),i.centerPointStartX=.5*(i.startPoints[0].x+i.startPoints[1].x)-n(t).scrollLeft(),i.centerPointStartY=.5*(i.startPoints[0].y+i.startPoints[1].y)-n(t).scrollTop(),i.percentageOfImageAtPinchPointX=(i.centerPointStartX-i.contentStartPos.left)/i.contentStartPos.width,i.percentageOfImageAtPinchPointY=(i.centerPointStartY-i.contentStartPos.top)/i.contentStartPos.height,i.startDistanceBetweenFingers=s(i.startPoints[0],i.startPoints[1]))))}},d.prototype.onscroll=function(t){var n=this;n.isScrolling=!0,e.removeEventListener("scroll",n.onscroll,!0)},d.prototype.ontouchmove=function(t){var e=this;return void 0!==t.originalEvent.buttons&&0===t.originalEvent.buttons?void e.ontouchend(t):e.isScrolling?void(e.canTap=!1):(e.newPoints=a(t),void((e.opts||e.canPan)&&e.newPoints.length&&e.newPoints.length&&(e.isSwiping&&!0===e.isSwiping||t.preventDefault(),e.distanceX=s(e.newPoints[0],e.startPoints[0],"x"),e.distanceY=s(e.newPoints[0],e.startPoints[0],"y"),e.distance=s(e.newPoints[0],e.startPoints[0]),e.distance>0&&(e.isSwiping?e.onSwipe(t):e.isPanning?e.onPan():e.isZooming&&e.onZoom()))))},d.prototype.onSwipe=function(e){var a,s=this,r=s.instance,c=s.isSwiping,l=s.sliderStartPos.left||0;if(!0!==c)"x"==c&&(s.distanceX>0&&(s.instance.group.length<2||0===s.instance.current.index&&!s.instance.current.opts.loop)?l+=Math.pow(s.distanceX,.8):s.distanceX<0&&(s.instance.group.length<2||s.instance.current.index===s.instance.group.length-1&&!s.instance.current.opts.loop)?l-=Math.pow(-s.distanceX,.8):l+=s.distanceX),s.sliderLastPos={top:"x"==c?0:s.sliderStartPos.top+s.distanceY,left:l},s.requestId&&(i(s.requestId),s.requestId=null),s.requestId=o(function(){s.sliderLastPos&&(n.each(s.instance.slides,function(t,e){var o=e.pos-s.instance.currPos;n.fancybox.setTranslate(e.$slide,{top:s.sliderLastPos.top,left:s.sliderLastPos.left+o*s.canvasWidth+o*e.opts.gutter})}),s.$container.addClass("fancybox-is-sliding"))});else if(Math.abs(s.distance)>10){if(s.canTap=!1,r.group.length<2&&s.opts.vertical?s.isSwiping="y":r.isDragging||!1===s.opts.vertical||"auto"===s.opts.vertical&&n(t).width()>800?s.isSwiping="x":(a=Math.abs(180*Math.atan2(s.distanceY,s.distanceX)/Math.PI),s.isSwiping=a>45&&a<135?"y":"x"),"y"===s.isSwiping&&n.fancybox.isMobile&&s.isScrollable)return void(s.isScrolling=!0);r.isDragging=s.isSwiping,s.startPoints=s.newPoints,n.each(r.slides,function(t,e){var o,i;n.fancybox.stop(e.$slide),o=n.fancybox.getTranslate(e.$slide),i=n.fancybox.getTranslate(r.$refs.stage),e.$slide.css({transform:"",opacity:"","transition-duration":""}).removeClass("fancybox-animated").removeClass(function(t,e){return(e.match(/(^|\s)fancybox-fx-\S+/g)||[]).join(" ")}),e.pos===r.current.pos&&(s.sliderStartPos.top=o.top-i.top,s.sliderStartPos.left=o.left-i.left),n.fancybox.setTranslate(e.$slide,{top:o.top-i.top,left:o.left-i.left})}),r.SlideShow&&r.SlideShow.isActive&&r.SlideShow.stop()}},d.prototype.onPan=function(){var t=this;if(s(t.newPoints[0],t.realPoints[0])<(n.fancybox.isMobile?10:5))return void(t.startPoints=t.newPoints);t.canTap=!1,t.contentLastPos=t.limitMovement(),t.requestId&&i(t.requestId),t.requestId=o(function(){n.fancybox.setTranslate(t.$content,t.contentLastPos)})},d.prototype.limitMovement=function(){var t,e,n,o,i,a,s=this,r=s.canvasWidth,c=s.canvasHeight,l=s.distanceX,d=s.distanceY,u=s.contentStartPos,f=u.left,p=u.top,h=u.width,g=u.height;return i=h>r?f+l:f,a=p+d,t=Math.max(0,.5*r-.5*h),e=Math.max(0,.5*c-.5*g),n=Math.min(r-h,.5*r-.5*h),o=Math.min(c-g,.5*c-.5*g),l>0&&i>t&&(i=t-1+Math.pow(-t+f+l,.8)||0),l<0&&i<n&&(i=n+1-Math.pow(n-f-l,.8)||0),d>0&&a>e&&(a=e-1+Math.pow(-e+p+d,.8)||0),d<0&&a<o&&(a=o+1-Math.pow(o-p-d,.8)||0),{top:a,left:i}},d.prototype.limitPosition=function(t,e,n,o){var i=this,a=i.canvasWidth,s=i.canvasHeight;return n>a?(t=t>0?0:t,t=t<a-n?a-n:t):t=Math.max(0,a/2-n/2),o>s?(e=e>0?0:e,e=e<s-o?s-o:e):e=Math.max(0,s/2-o/2),{top:e,left:t}},d.prototype.onZoom=function(){var e=this,a=e.contentStartPos,r=a.width,c=a.height,l=a.left,d=a.top,u=s(e.newPoints[0],e.newPoints[1]),f=u/e.startDistanceBetweenFingers,p=Math.floor(r*f),h=Math.floor(c*f),g=(r-p)*e.percentageOfImageAtPinchPointX,b=(c-h)*e.percentageOfImageAtPinchPointY,m=(e.newPoints[0].x+e.newPoints[1].x)/2-n(t).scrollLeft(),v=(e.newPoints[0].y+e.newPoints[1].y)/2-n(t).scrollTop(),y=m-e.centerPointStartX,x=v-e.centerPointStartY,w=l+(g+y),$=d+(b+x),S={top:$,left:w,scaleX:f,scaleY:f};e.canTap=!1,e.newWidth=p,e.newHeight=h,e.contentLastPos=S,e.requestId&&i(e.requestId),e.requestId=o(function(){n.fancybox.setTranslate(e.$content,e.contentLastPos)})},d.prototype.ontouchend=function(t){var o=this,s=o.isSwiping,r=o.isPanning,c=o.isZooming,l=o.isScrolling;if(o.endPoints=a(t),o.dMs=Math.max((new Date).getTime()-o.startTime,1),o.$container.removeClass("fancybox-is-grabbing"),n(e).off(".fb.touch"),e.removeEventListener("scroll",o.onscroll,!0),o.requestId&&(i(o.requestId),o.requestId=null),o.isSwiping=!1,o.isPanning=!1,o.isZooming=!1,o.isScrolling=!1,o.instance.isDragging=!1,o.canTap)return o.onTap(t);o.speed=100,o.velocityX=o.distanceX/o.dMs*.5,o.velocityY=o.distanceY/o.dMs*.5,r?o.endPanning():c?o.endZooming():o.endSwiping(s,l)},d.prototype.endSwiping=function(t,e){var o=this,i=!1,a=o.instance.group.length,s=Math.abs(o.distanceX),r="x"==t&&a>1&&(o.dMs>130&&s>10||s>50);o.sliderLastPos=null,"y"==t&&!e&&Math.abs(o.distanceY)>50?(n.fancybox.animate(o.instance.current.$slide,{top:o.sliderStartPos.top+o.distanceY+150*o.velocityY,opacity:0},200),i=o.instance.close(!0,250)):r&&o.distanceX>0?i=o.instance.previous(300):r&&o.distanceX<0&&(i=o.instance.next(300)),!1!==i||"x"!=t&&"y"!=t||o.instance.centerSlide(200),o.$container.removeClass("fancybox-is-sliding")},d.prototype.endPanning=function(){var t,e,o,i=this;i.contentLastPos&&(!1===i.opts.momentum||i.dMs>350?(t=i.contentLastPos.left,e=i.contentLastPos.top):(t=i.contentLastPos.left+500*i.velocityX,e=i.contentLastPos.top+500*i.velocityY),o=i.limitPosition(t,e,i.contentStartPos.width,i.contentStartPos.height),o.width=i.contentStartPos.width,o.height=i.contentStartPos.height,n.fancybox.animate(i.$content,o,366))},d.prototype.endZooming=function(){var t,e,o,i,a=this,s=a.instance.current,r=a.newWidth,c=a.newHeight;a.contentLastPos&&(t=a.contentLastPos.left,e=a.contentLastPos.top,i={top:e,left:t,width:r,height:c,scaleX:1,scaleY:1},n.fancybox.setTranslate(a.$content,i),r<a.canvasWidth&&c<a.canvasHeight?a.instance.scaleToFit(150):r>s.width||c>s.height?a.instance.scaleToActual(a.centerPointStartX,a.centerPointStartY,150):(o=a.limitPosition(t,e,r,c),n.fancybox.animate(a.$content,o,150)))},d.prototype.onTap=function(e){var o,i=this,s=n(e.target),r=i.instance,c=r.current,l=e&&a(e)||i.startPoints,d=l[0]?l[0].x-n(t).scrollLeft()-i.stagePos.left:0,u=l[0]?l[0].y-n(t).scrollTop()-i.stagePos.top:0,f=function(t){var o=c.opts[t];if(n.isFunction(o)&&(o=o.apply(r,[c,e])),o)switch(o){case"close":r.close(i.startEvent);break;case"toggleControls":r.toggleControls();break;case"next":r.next();break;case"nextOrClose":r.group.length>1?r.next():r.close(i.startEvent);break;case"zoom":"image"==c.type&&(c.isLoaded||c.$ghost)&&(r.canPan()?r.scaleToFit():r.isScaledDown()?r.scaleToActual(d,u):r.group.length<2&&r.close(i.startEvent))}};if((!e.originalEvent||2!=e.originalEvent.button)&&(s.is("img")||!(d>s[0].clientWidth+s.offset().left))){if(s.is(".fancybox-bg,.fancybox-inner,.fancybox-outer,.fancybox-container"))o="Outside";else if(s.is(".fancybox-slide"))o="Slide";else{if(!r.current.$content||!r.current.$content.find(s).addBack().filter(s).length)return;o="Content"}if(i.tapped){if(clearTimeout(i.tapped),i.tapped=null,Math.abs(d-i.tapX)>50||Math.abs(u-i.tapY)>50)return this;f("dblclick"+o)}else i.tapX=d,i.tapY=u,c.opts["dblclick"+o]&&c.opts["dblclick"+o]!==c.opts["click"+o]?i.tapped=setTimeout(function(){i.tapped=null,r.isAnimating||f("click"+o)},500):f("click"+o);return this}},n(e).on("onActivate.fb",function(t,e){e&&!e.Guestures&&(e.Guestures=new d(e))}).on("beforeClose.fb",function(t,e){e&&e.Guestures&&e.Guestures.destroy()})}(window,document,jQuery),function(t,e){"use strict";e.extend(!0,e.fancybox.defaults,{btnTpl:{slideShow:'<button data-fancybox-play class="fancybox-button fancybox-button--play" title="{{PLAY_START}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.5 5.4v13.2l11-6.6z"/></svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.33 5.75h2.2v12.5h-2.2V5.75zm5.15 0h2.2v12.5h-2.2V5.75z"/></svg></button>'},slideShow:{autoStart:!1,speed:3e3,progress:!0}});var n=function(t){this.instance=t,this.init()};e.extend(n.prototype,{timer:null,isActive:!1,$button:null,init:function(){var t=this,n=t.instance,o=n.group[n.currIndex].opts.slideShow;t.$button=n.$refs.toolbar.find("[data-fancybox-play]").on("click",function(){t.toggle()}),n.group.length<2||!o?t.$button.hide():o.progress&&(t.$progress=e('<div class="fancybox-progress"></div>').appendTo(n.$refs.inner))},set:function(t){var n=this,o=n.instance,i=o.current;i&&(!0===t||i.opts.loop||o.currIndex<o.group.length-1)?n.isActive&&"video"!==i.contentType&&(n.$progress&&e.fancybox.animate(n.$progress.show(),{scaleX:1},i.opts.slideShow.speed),n.timer=setTimeout(function(){o.current.opts.loop||o.current.index!=o.group.length-1?o.next():o.jumpTo(0)},i.opts.slideShow.speed)):(n.stop(),o.idleSecondsCounter=0,o.showControls())},clear:function(){var t=this;clearTimeout(t.timer),t.timer=null,t.$progress&&t.$progress.removeAttr("style").hide()},start:function(){var t=this,e=t.instance.current;e&&(t.$button.attr("title",(e.opts.i18n[e.opts.lang]||e.opts.i18n.en).PLAY_STOP).removeClass("fancybox-button--play").addClass("fancybox-button--pause"),t.isActive=!0,e.isComplete&&t.set(!0),t.instance.trigger("onSlideShowChange",!0))},stop:function(){var t=this,e=t.instance.current;t.clear(),t.$button.attr("title",(e.opts.i18n[e.opts.lang]||e.opts.i18n.en).PLAY_START).removeClass("fancybox-button--pause").addClass("fancybox-button--play"),t.isActive=!1,t.instance.trigger("onSlideShowChange",!1),t.$progress&&t.$progress.removeAttr("style").hide()},toggle:function(){var t=this;t.isActive?t.stop():t.start()}}),e(t).on({"onInit.fb":function(t,e){e&&!e.SlideShow&&(e.SlideShow=new n(e))},"beforeShow.fb":function(t,e,n,o){var i=e&&e.SlideShow;o?i&&n.opts.slideShow.autoStart&&i.start():i&&i.isActive&&i.clear()},"afterShow.fb":function(t,e,n){var o=e&&e.SlideShow;o&&o.isActive&&o.set()},"afterKeydown.fb":function(n,o,i,a,s){var r=o&&o.SlideShow;!r||!i.opts.slideShow||80!==s&&32!==s||e(t.activeElement).is("button,a,input")||(a.preventDefault(),r.toggle())},"beforeClose.fb onDeactivate.fb":function(t,e){var n=e&&e.SlideShow;n&&n.stop()}}),e(t).on("visibilitychange",function(){var n=e.fancybox.getInstance(),o=n&&n.SlideShow;o&&o.isActive&&(t.hidden?o.clear():o.set())})}(document,jQuery),function(t,e){"use strict";var n=function(){for(var e=[["requestFullscreen","exitFullscreen","fullscreenElement","fullscreenEnabled","fullscreenchange","fullscreenerror"],["webkitRequestFullscreen","webkitExitFullscreen","webkitFullscreenElement","webkitFullscreenEnabled","webkitfullscreenchange","webkitfullscreenerror"],["webkitRequestFullScreen","webkitCancelFullScreen","webkitCurrentFullScreenElement","webkitCancelFullScreen","webkitfullscreenchange","webkitfullscreenerror"],["mozRequestFullScreen","mozCancelFullScreen","mozFullScreenElement","mozFullScreenEnabled","mozfullscreenchange","mozfullscreenerror"],["msRequestFullscreen","msExitFullscreen","msFullscreenElement","msFullscreenEnabled","MSFullscreenChange","MSFullscreenError"]],n={},o=0;o<e.length;o++){var i=e[o];if(i&&i[1]in t){for(var a=0;a<i.length;a++)n[e[0][a]]=i[a];return n}}return!1}();if(n){var o={request:function(e){e=e||t.documentElement,e[n.requestFullscreen](e.ALLOW_KEYBOARD_INPUT)},exit:function(){t[n.exitFullscreen]()},toggle:function(e){e=e||t.documentElement,this.isFullscreen()?this.exit():this.request(e)},isFullscreen:function(){return Boolean(t[n.fullscreenElement])},enabled:function(){return Boolean(t[n.fullscreenEnabled])}};e.extend(!0,e.fancybox.defaults,{btnTpl:{fullScreen:'<button data-fancybox-fullscreen class="fancybox-button fancybox-button--fsenter" title="{{FULL_SCREEN}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/></svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 16h3v3h2v-5H5zm3-8H5v2h5V5H8zm6 11h2v-3h3v-2h-5zm2-11V5h-2v5h5V8z"/></svg></button>'},fullScreen:{autoStart:!1}}),e(t).on(n.fullscreenchange,function(){var t=o.isFullscreen(),n=e.fancybox.getInstance();n&&(n.current&&"image"===n.current.type&&n.isAnimating&&(n.isAnimating=!1,n.update(!0,!0,0),n.isComplete||n.complete()),n.trigger("onFullscreenChange",t),n.$refs.container.toggleClass("fancybox-is-fullscreen",t),n.$refs.toolbar.find("[data-fancybox-fullscreen]").toggleClass("fancybox-button--fsenter",!t).toggleClass("fancybox-button--fsexit",t))})}e(t).on({"onInit.fb":function(t,e){var i;if(!n)return void e.$refs.toolbar.find("[data-fancybox-fullscreen]").remove();e&&e.group[e.currIndex].opts.fullScreen?(i=e.$refs.container,i.on("click.fb-fullscreen","[data-fancybox-fullscreen]",function(t){t.stopPropagation(),t.preventDefault(),o.toggle()}),e.opts.fullScreen&&!0===e.opts.fullScreen.autoStart&&o.request(),e.FullScreen=o):e&&e.$refs.toolbar.find("[data-fancybox-fullscreen]").hide()},"afterKeydown.fb":function(t,e,n,o,i){e&&e.FullScreen&&70===i&&(o.preventDefault(),e.FullScreen.toggle())},"beforeClose.fb":function(t,e){e&&e.FullScreen&&e.$refs.container.hasClass("fancybox-is-fullscreen")&&o.exit()}})}(document,jQuery),function(t,e){"use strict";var n="fancybox-thumbs";e.fancybox.defaults=e.extend(!0,{btnTpl:{thumbs:'<button data-fancybox-thumbs class="fancybox-button fancybox-button--thumbs" title="{{THUMBS}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14.59 14.59h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76H5.65V5.65z"/></svg></button>'},thumbs:{autoStart:!1,hideOnClose:!0,parentEl:".fancybox-container",axis:"y"}},e.fancybox.defaults);var o=function(t){this.init(t)};e.extend(o.prototype,{$button:null,$grid:null,$list:null,isVisible:!1,isActive:!1,init:function(t){var e=this,n=t.group,o=0;e.instance=t,e.opts=n[t.currIndex].opts.thumbs,t.Thumbs=e,e.$button=t.$refs.toolbar.find("[data-fancybox-thumbs]");for(var i=0,a=n.length;i<a&&(n[i].thumb&&o++,!(o>1));i++);o>1&&e.opts?(e.$button.removeAttr("style").on("click",function(){e.toggle()}),e.isActive=!0):e.$button.hide()},create:function(){var t,o=this,i=o.instance,a=o.opts.parentEl,s=[];o.$grid||(o.$grid=e('<div class="'+n+" "+n+"-"+o.opts.axis+'"></div>').appendTo(i.$refs.container.find(a).addBack().filter(a)),o.$grid.on("click","a",function(){i.jumpTo(e(this).attr("data-index"))})),o.$list||(o.$list=e('<div class="'+n+'__list">').appendTo(o.$grid)),e.each(i.group,function(e,n){t=n.thumb,t||"image"!==n.type||(t=n.src),s.push('<a href="javascript:;" tabindex="0" data-index="'+e+'"'+(t&&t.length?' style="background-image:url('+t+')"':'class="fancybox-thumbs-missing"')+"></a>")}),o.$list[0].innerHTML=s.join(""),"x"===o.opts.axis&&o.$list.width(parseInt(o.$grid.css("padding-right"),10)+i.group.length*o.$list.children().eq(0).outerWidth(!0))},focus:function(t){var e,n,o=this,i=o.$list,a=o.$grid;o.instance.current&&(e=i.children().removeClass("fancybox-thumbs-active").filter('[data-index="'+o.instance.current.index+'"]').addClass("fancybox-thumbs-active"),n=e.position(),"y"===o.opts.axis&&(n.top<0||n.top>i.height()-e.outerHeight())?i.stop().animate({scrollTop:i.scrollTop()+n.top},t):"x"===o.opts.axis&&(n.left<a.scrollLeft()||n.left>a.scrollLeft()+(a.width()-e.outerWidth()))&&i.parent().stop().animate({scrollLeft:n.left},t))},update:function(){var t=this;t.instance.$refs.container.toggleClass("fancybox-show-thumbs",this.isVisible),t.isVisible?(t.$grid||t.create(),t.instance.trigger("onThumbsShow"),t.focus(0)):t.$grid&&t.instance.trigger("onThumbsHide"),t.instance.update()},hide:function(){this.isVisible=!1,this.update()},show:function(){this.isVisible=!0,this.update()},toggle:function(){this.isVisible=!this.isVisible,this.update()}}),e(t).on({"onInit.fb":function(t,e){var n;e&&!e.Thumbs&&(n=new o(e),n.isActive&&!0===n.opts.autoStart&&n.show())},"beforeShow.fb":function(t,e,n,o){var i=e&&e.Thumbs;i&&i.isVisible&&i.focus(o?0:250)},"afterKeydown.fb":function(t,e,n,o,i){var a=e&&e.Thumbs;a&&a.isActive&&71===i&&(o.preventDefault(),a.toggle())},"beforeClose.fb":function(t,e){var n=e&&e.Thumbs;n&&n.isVisible&&!1!==n.opts.hideOnClose&&n.$grid.hide()}})}(document,jQuery),function(t,e){"use strict";function n(t){var e={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;","/":"&#x2F;","`":"&#x60;","=":"&#x3D;"};return String(t).replace(/[&<>"'`=\/]/g,function(t){return e[t]})}e.extend(!0,e.fancybox.defaults,{btnTpl:{share:'<button data-fancybox-share class="fancybox-button fancybox-button--share" title="{{SHARE}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.55 19c1.4-8.4 9.1-9.8 11.9-9.8V5l7 7-7 6.3v-3.5c-2.8 0-10.5 2.1-11.9 4.2z"/></svg></button>'},share:{url:function(t,e){return!t.currentHash&&"inline"!==e.type&&"html"!==e.type&&(e.origSrc||e.src)||window.location},
        tpl:'<div class="fancybox-share"><h1>{{SHARE}}</h1><p><a class="fancybox-share__button fancybox-share__button--fb" href="https://www.facebook.com/sharer/sharer.php?u={{url}}"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m287 456v-299c0-21 6-35 35-35h38v-63c-7-1-29-3-55-3-54 0-91 33-91 94v306m143-254h-205v72h196" /></svg><span>Facebook</span></a><a class="fancybox-share__button fancybox-share__button--tw" href="https://twitter.com/intent/tweet?url={{url}}&text={{descr}}"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m456 133c-14 7-31 11-47 13 17-10 30-27 37-46-15 10-34 16-52 20-61-62-157-7-141 75-68-3-129-35-169-85-22 37-11 86 26 109-13 0-26-4-37-9 0 39 28 72 65 80-12 3-25 4-37 2 10 33 41 57 77 57-42 30-77 38-122 34 170 111 378-32 359-208 16-11 30-25 41-42z" /></svg><span>Twitter</span></a><a class="fancybox-share__button fancybox-share__button--pt" href="https://www.pinterest.com/pin/create/button/?url={{url}}&description={{descr}}&media={{media}}"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m265 56c-109 0-164 78-164 144 0 39 15 74 47 87 5 2 10 0 12-5l4-19c2-6 1-8-3-13-9-11-15-25-15-45 0-58 43-110 113-110 62 0 96 38 96 88 0 67-30 122-73 122-24 0-42-19-36-44 6-29 20-60 20-81 0-19-10-35-31-35-25 0-44 26-44 60 0 21 7 36 7 36l-30 125c-8 37-1 83 0 87 0 3 4 4 5 2 2-3 32-39 42-75l16-64c8 16 31 29 56 29 74 0 124-67 124-157 0-69-58-132-146-132z" fill="#fff"/></svg><span>Pinterest</span></a></p><p><input class="fancybox-share__input" type="text" value="{{url_raw}}" onclick="select()" /></p></div>'}}),e(t).on("click","[data-fancybox-share]",function(){var t,o,i=e.fancybox.getInstance(),a=i.current||null;a&&("function"===e.type(a.opts.share.url)&&(t=a.opts.share.url.apply(a,[i,a])),o=a.opts.share.tpl.replace(/\{\{media\}\}/g,"image"===a.type?encodeURIComponent(a.src):"").replace(/\{\{url\}\}/g,encodeURIComponent(t)).replace(/\{\{url_raw\}\}/g,n(t)).replace(/\{\{descr\}\}/g,i.$caption?encodeURIComponent(i.$caption.text()):""),e.fancybox.open({src:i.translate(i,o),type:"html",opts:{touch:!1,animationEffect:!1,afterLoad:function(t,e){i.$refs.container.one("beforeClose.fb",function(){t.close(null,0)}),e.$content.find(".fancybox-share__button").click(function(){return window.open(this.href,"Share","width=550, height=450"),!1})},mobile:{autoFocus:!1}}}))})}(document,jQuery),function(t,e,n){"use strict";function o(){var e=t.location.hash.substr(1),n=e.split("-"),o=n.length>1&&/^\+?\d+$/.test(n[n.length-1])?parseInt(n.pop(-1),10)||1:1,i=n.join("-");return{hash:e,index:o<1?1:o,gallery:i}}function i(t){""!==t.gallery&&n("[data-fancybox='"+n.escapeSelector(t.gallery)+"']").eq(t.index-1).focus().trigger("click.fb-start")}function a(t){var e,n;return!!t&&(e=t.current?t.current.opts:t.opts,""!==(n=e.hash||(e.$orig?e.$orig.data("fancybox")||e.$orig.data("fancybox-trigger"):""))&&n)}n.escapeSelector||(n.escapeSelector=function(t){return(t+"").replace(/([\0-\x1f\x7f]|^-?\d)|^-$|[^\x80-\uFFFF\w-]/g,function(t,e){return e?"\0"===t?"�":t.slice(0,-1)+"\\"+t.charCodeAt(t.length-1).toString(16)+" ":"\\"+t})}),n(function(){!1!==n.fancybox.defaults.hash&&(n(e).on({"onInit.fb":function(t,e){var n,i;!1!==e.group[e.currIndex].opts.hash&&(n=o(),(i=a(e))&&n.gallery&&i==n.gallery&&(e.currIndex=n.index-1))},"beforeShow.fb":function(n,o,i,s){var r;i&&!1!==i.opts.hash&&(r=a(o))&&(o.currentHash=r+(o.group.length>1?"-"+(i.index+1):""),t.location.hash!=="#"+o.currentHash&&(s&&!o.origHash&&(o.origHash=t.location.hash),o.hashTimer&&clearTimeout(o.hashTimer),o.hashTimer=setTimeout(function(){"replaceState"in t.history?(t.history[s?"pushState":"replaceState"]({},e.title,t.location.pathname+t.location.search+"#"+o.currentHash),s&&(o.hasCreatedHistory=!0)):t.location.hash=o.currentHash,o.hashTimer=null},300)))},"beforeClose.fb":function(n,o,i){i&&!1!==i.opts.hash&&(clearTimeout(o.hashTimer),o.currentHash&&o.hasCreatedHistory?t.history.back():o.currentHash&&("replaceState"in t.history?t.history.replaceState({},e.title,t.location.pathname+t.location.search+(o.origHash||"")):t.location.hash=o.origHash),o.currentHash=null)}}),n(t).on("hashchange.fb",function(){var t=o(),e=null;n.each(n(".fancybox-container").get().reverse(),function(t,o){var i=n(o).data("FancyBox");if(i&&i.currentHash)return e=i,!1}),e?e.currentHash===t.gallery+"-"+t.index||1===t.index&&e.currentHash==t.gallery||(e.currentHash=null,e.close()):""!==t.gallery&&i(t)}),setTimeout(function(){n.fancybox.getInstance()||i(o())},50))})}(window,document,jQuery),function(t,e){"use strict";var n=(new Date).getTime();e(t).on({"onInit.fb":function(t,e,o){e.$refs.stage.on("mousewheel DOMMouseScroll wheel MozMousePixelScroll",function(t){var o=e.current,i=(new Date).getTime();e.group.length<2||!1===o.opts.wheel||"auto"===o.opts.wheel&&"image"!==o.type||(t.preventDefault(),t.stopPropagation(),o.$slide.hasClass("fancybox-animated")||(t=t.originalEvent||t,i-n<250||(n=i,e[(-t.deltaY||-t.deltaX||t.wheelDelta||-t.detail)<0?"next":"previous"]())))})}})}(document,jQuery);
/**
 * SimpleBar.js - v4.2.3
 * Scrollbars, simpler.
 * https://grsmto.github.io/simplebar/
 *
 * Made by Adrien Denat from a fork by Jonathan Nicol
 * Under MIT License
 */

!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):(t=t||self).SimpleBar=e()}(this,function(){"use strict";var t=function(t){if("function"!=typeof t)throw TypeError(String(t)+" is not a function");return t},e=function(t){try{return!!t()}catch(t){return!0}},i={}.toString,r=function(t){return i.call(t).slice(8,-1)},n="".split,s=e(function(){return!Object("z").propertyIsEnumerable(0)})?function(t){return"String"==r(t)?n.call(t,""):Object(t)}:Object,o=function(t){if(null==t)throw TypeError("Can't call method on "+t);return t},a=function(t){return Object(o(t))},l=Math.ceil,c=Math.floor,u=function(t){return isNaN(t=+t)?0:(t>0?c:l)(t)},h=Math.min,f=function(t){return t>0?h(u(t),9007199254740991):0},d=function(t){return"object"==typeof t?null!==t:"function"==typeof t},p=Array.isArray||function(t){return"Array"==r(t)},v="undefined"!=typeof globalThis?globalThis:"undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:{};function g(t,e){return t(e={exports:{}},e.exports),e.exports}var b,m,y,x,E="object"==typeof window&&window&&window.Math==Math?window:"object"==typeof self&&self&&self.Math==Math?self:Function("return this")(),w=!e(function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a}),O=E.document,_=d(O)&&d(O.createElement),S=!w&&!e(function(){return 7!=Object.defineProperty((t="div",_?O.createElement(t):{}),"a",{get:function(){return 7}}).a;var t}),L=function(t){if(!d(t))throw TypeError(String(t)+" is not an object");return t},A=function(t,e){if(!d(t))return t;var i,r;if(e&&"function"==typeof(i=t.toString)&&!d(r=i.call(t)))return r;if("function"==typeof(i=t.valueOf)&&!d(r=i.call(t)))return r;if(!e&&"function"==typeof(i=t.toString)&&!d(r=i.call(t)))return r;throw TypeError("Can't convert object to primitive value")},M=Object.defineProperty,k={f:w?M:function(t,e,i){if(L(t),e=A(e,!0),L(i),S)try{return M(t,e,i)}catch(t){}if("get"in i||"set"in i)throw TypeError("Accessors not supported");return"value"in i&&(t[e]=i.value),t}},W=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}},T=w?function(t,e,i){return k.f(t,e,W(1,i))}:function(t,e,i){return t[e]=i,t},R=function(t,e){try{T(E,t,e)}catch(i){E[t]=e}return e},j=g(function(t){var e=E["__core-js_shared__"]||R("__core-js_shared__",{});(t.exports=function(t,i){return e[t]||(e[t]=void 0!==i?i:{})})("versions",[]).push({version:"3.0.1",mode:"global",copyright:"© 2019 Denis Pushkarev (zloirock.ru)"})}),C=0,N=Math.random(),z=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++C+N).toString(36))},D=!e(function(){return!String(Symbol())}),V=j("wks"),I=E.Symbol,B=function(t){return V[t]||(V[t]=D&&I[t]||(D?I:z)("Symbol."+t))},P=B("species"),H=function(t,e){var i;return p(t)&&("function"!=typeof(i=t.constructor)||i!==Array&&!p(i.prototype)?d(i)&&null===(i=i[P])&&(i=void 0):i=void 0),new(void 0===i?Array:i)(0===e?0:e)},F=function(e,i){var r=1==e,n=2==e,o=3==e,l=4==e,c=6==e,u=5==e||c,h=i||H;return function(i,d,p){for(var v,g,b=a(i),m=s(b),y=function(e,i,r){if(t(e),void 0===i)return e;switch(r){case 0:return function(){return e.call(i)};case 1:return function(t){return e.call(i,t)};case 2:return function(t,r){return e.call(i,t,r)};case 3:return function(t,r,n){return e.call(i,t,r,n)}}return function(){return e.apply(i,arguments)}}(d,p,3),x=f(m.length),E=0,w=r?h(i,x):n?h(i,0):void 0;x>E;E++)if((u||E in m)&&(g=y(v=m[E],E,b),e))if(r)w[E]=g;else if(g)switch(e){case 3:return!0;case 5:return v;case 6:return E;case 2:w.push(v)}else if(l)return!1;return c?-1:o||l?l:w}},q=B("species"),$={}.propertyIsEnumerable,Y=Object.getOwnPropertyDescriptor,X={f:Y&&!$.call({1:2},1)?function(t){var e=Y(this,t);return!!e&&e.enumerable}:$},G=function(t){return s(o(t))},K={}.hasOwnProperty,U=function(t,e){return K.call(t,e)},J=Object.getOwnPropertyDescriptor,Q={f:w?J:function(t,e){if(t=G(t),e=A(e,!0),S)try{return J(t,e)}catch(t){}if(U(t,e))return W(!X.f.call(t,e),t[e])}},Z=j("native-function-to-string",Function.toString),tt=E.WeakMap,et="function"==typeof tt&&/native code/.test(Z.call(tt)),it=j("keys"),rt={},nt=E.WeakMap;if(et){var st=new nt,ot=st.get,at=st.has,lt=st.set;b=function(t,e){return lt.call(st,t,e),e},m=function(t){return ot.call(st,t)||{}},y=function(t){return at.call(st,t)}}else{var ct=it[x="state"]||(it[x]=z(x));rt[ct]=!0,b=function(t,e){return T(t,ct,e),e},m=function(t){return U(t,ct)?t[ct]:{}},y=function(t){return U(t,ct)}}var ut,ht,ft={set:b,get:m,has:y,enforce:function(t){return y(t)?m(t):b(t,{})},getterFor:function(t){return function(e){var i;if(!d(e)||(i=m(e)).type!==t)throw TypeError("Incompatible receiver, "+t+" required");return i}}},dt=g(function(t){var e=ft.get,i=ft.enforce,r=String(Z).split("toString");j("inspectSource",function(t){return Z.call(t)}),(t.exports=function(t,e,n,s){var o=!!s&&!!s.unsafe,a=!!s&&!!s.enumerable,l=!!s&&!!s.noTargetGet;"function"==typeof n&&("string"!=typeof e||U(n,"name")||T(n,"name",e),i(n).source=r.join("string"==typeof e?e:"")),t!==E?(o?!l&&t[e]&&(a=!0):delete t[e],a?t[e]=n:T(t,e,n)):a?t[e]=n:R(e,n)})(Function.prototype,"toString",function(){return"function"==typeof this&&e(this).source||Z.call(this)})}),pt=Math.max,vt=Math.min,gt=(ut=!1,function(t,e,i){var r,n=G(t),s=f(n.length),o=function(t,e){var i=u(t);return i<0?pt(i+e,0):vt(i,e)}(i,s);if(ut&&e!=e){for(;s>o;)if((r=n[o++])!=r)return!0}else for(;s>o;o++)if((ut||o in n)&&n[o]===e)return ut||o||0;return!ut&&-1}),bt=function(t,e){var i,r=G(t),n=0,s=[];for(i in r)!U(rt,i)&&U(r,i)&&s.push(i);for(;e.length>n;)U(r,i=e[n++])&&(~gt(s,i)||s.push(i));return s},mt=["constructor","hasOwnProperty","isPrototypeOf","propertyIsEnumerable","toLocaleString","toString","valueOf"],yt=mt.concat("length","prototype"),xt={f:Object.getOwnPropertyNames||function(t){return bt(t,yt)}},Et={f:Object.getOwnPropertySymbols},wt=E.Reflect,Ot=wt&&wt.ownKeys||function(t){var e=xt.f(L(t)),i=Et.f;return i?e.concat(i(t)):e},_t=function(t,e){for(var i=Ot(e),r=k.f,n=Q.f,s=0;s<i.length;s++){var o=i[s];U(t,o)||r(t,o,n(e,o))}},St=/#|\.prototype\./,Lt=function(t,i){var r=Mt[At(t)];return r==Wt||r!=kt&&("function"==typeof i?e(i):!!i)},At=Lt.normalize=function(t){return String(t).replace(St,".").toLowerCase()},Mt=Lt.data={},kt=Lt.NATIVE="N",Wt=Lt.POLYFILL="P",Tt=Lt,Rt=Q.f,jt=function(t,e){var i,r,n,s,o,a=t.target,l=t.global,c=t.stat;if(i=l?E:c?E[a]||R(a,{}):(E[a]||{}).prototype)for(r in e){if(s=e[r],n=t.noTargetGet?(o=Rt(i,r))&&o.value:i[r],!Tt(l?r:a+(c?".":"#")+r,t.forced)&&void 0!==n){if(typeof s==typeof n)continue;_t(s,n)}(t.sham||n&&n.sham)&&T(s,"sham",!0),dt(i,r,s,t)}},Ct=F(2);jt({target:"Array",proto:!0,forced:!(ht="filter",!e(function(){var t=[];return(t.constructor={})[q]=function(){return{foo:1}},1!==t[ht](Boolean).foo}))},{filter:function(t){return Ct(this,t,arguments[1])}});var Nt=function(t,i){var r=[][t];return!r||!e(function(){r.call(null,i||function(){throw 1},1)})},zt=[].forEach,Dt=F(0),Vt=Nt("forEach")?function(t){return Dt(this,t,arguments[1])}:zt;jt({target:"Array",proto:!0,forced:[].forEach!=Vt},{forEach:Vt});jt({target:"Array",proto:!0,forced:Nt("reduce")},{reduce:function(e){return function(e,i,r,n,o){t(i);var l=a(e),c=s(l),u=f(l.length),h=o?u-1:0,d=o?-1:1;if(r<2)for(;;){if(h in c){n=c[h],h+=d;break}if(h+=d,o?h<0:u<=h)throw TypeError("Reduce of empty array with no initial value")}for(;o?h>=0:u>h;h+=d)h in c&&(n=i(n,c[h],h,l));return n}(this,e,arguments.length,arguments[1],!1)}});var It=k.f,Bt=Function.prototype,Pt=Bt.toString,Ht=/^\s*function ([^ (]*)/;!w||"name"in Bt||It(Bt,"name",{configurable:!0,get:function(){try{return Pt.call(this).match(Ht)[1]}catch(t){return""}}});var Ft=Object.keys||function(t){return bt(t,mt)},qt=Object.assign,$t=!qt||e(function(){var t={},e={},i=Symbol();return t[i]=7,"abcdefghijklmnopqrst".split("").forEach(function(t){e[t]=t}),7!=qt({},t)[i]||"abcdefghijklmnopqrst"!=Ft(qt({},e)).join("")})?function(t,e){for(var i=a(t),r=arguments.length,n=1,o=Et.f,l=X.f;r>n;)for(var c,u=s(arguments[n++]),h=o?Ft(u).concat(o(u)):Ft(u),f=h.length,d=0;f>d;)l.call(u,c=h[d++])&&(i[c]=u[c]);return i}:qt;jt({target:"Object",stat:!0,forced:Object.assign!==$t},{assign:$t});var Yt="\t\n\v\f\r                　\u2028\u2029\ufeff",Xt="["+Yt+"]",Gt=RegExp("^"+Xt+Xt+"*"),Kt=RegExp(Xt+Xt+"*$"),Ut=E.parseInt,Jt=/^[-+]?0[xX]/,Qt=8!==Ut(Yt+"08")||22!==Ut(Yt+"0x16")?function(t,e){var i=function(t,e){return t=String(o(t)),1&e&&(t=t.replace(Gt,"")),2&e&&(t=t.replace(Kt,"")),t}(String(t),3);return Ut(i,e>>>0||(Jt.test(i)?16:10))}:Ut;jt({global:!0,forced:parseInt!=Qt},{parseInt:Qt});var Zt,te,ee=RegExp.prototype.exec,ie=String.prototype.replace,re=ee,ne=(Zt=/a/,te=/b*/g,ee.call(Zt,"a"),ee.call(te,"a"),0!==Zt.lastIndex||0!==te.lastIndex),se=void 0!==/()??/.exec("")[1];(ne||se)&&(re=function(t){var e,i,r,n,s=this;return se&&(i=new RegExp("^"+s.source+"$(?!\\s)",function(){var t=L(this),e="";return t.global&&(e+="g"),t.ignoreCase&&(e+="i"),t.multiline&&(e+="m"),t.unicode&&(e+="u"),t.sticky&&(e+="y"),e}.call(s))),ne&&(e=s.lastIndex),r=ee.call(s,t),ne&&r&&(s.lastIndex=s.global?r.index+r[0].length:e),se&&r&&r.length>1&&ie.call(r[0],i,function(){for(n=1;n<arguments.length-2;n++)void 0===arguments[n]&&(r[n]=void 0)}),r});var oe=re;jt({target:"RegExp",proto:!0,forced:/./.exec!==oe},{exec:oe});var ae=function(t,e,i){return e+(i?function(t,e,i){var r,n,s=String(o(t)),a=u(e),l=s.length;return a<0||a>=l?i?"":void 0:(r=s.charCodeAt(a))<55296||r>56319||a+1===l||(n=s.charCodeAt(a+1))<56320||n>57343?i?s.charAt(a):r:i?s.slice(a,a+2):n-56320+(r-55296<<10)+65536}(t,e,!0).length:1)},le=function(t,e){var i=t.exec;if("function"==typeof i){var n=i.call(t,e);if("object"!=typeof n)throw TypeError("RegExp exec method returned something other than an Object or null");return n}if("RegExp"!==r(t))throw TypeError("RegExp#exec called on incompatible receiver");return oe.call(t,e)},ce=B("species"),ue=!e(function(){var t=/./;return t.exec=function(){var t=[];return t.groups={a:"7"},t},"7"!=="".replace(t,"$<a>")}),he=!e(function(){var t=/(?:)/,e=t.exec;t.exec=function(){return e.apply(this,arguments)};var i="ab".split(t);return 2!==i.length||"a"!==i[0]||"b"!==i[1]}),fe=function(t,i,r,n){var s=B(t),o=!e(function(){var e={};return e[s]=function(){return 7},7!=""[t](e)}),a=o&&!e(function(){var e=!1,i=/a/;return i.exec=function(){return e=!0,null},"split"===t&&(i.constructor={},i.constructor[ce]=function(){return i}),i[s](""),!e});if(!o||!a||"replace"===t&&!ue||"split"===t&&!he){var l=/./[s],c=r(s,""[t],function(t,e,i,r,n){return e.exec===oe?o&&!n?{done:!0,value:l.call(e,i,r)}:{done:!0,value:t.call(i,e,r)}:{done:!1}}),u=c[0],h=c[1];dt(String.prototype,t,u),dt(RegExp.prototype,s,2==i?function(t,e){return h.call(t,this,e)}:function(t){return h.call(t,this)}),n&&T(RegExp.prototype[s],"sham",!0)}};fe("match",1,function(t,e,i){return[function(e){var i=o(this),r=null==e?void 0:e[t];return void 0!==r?r.call(e,i):new RegExp(e)[t](String(i))},function(t){var r=i(e,t,this);if(r.done)return r.value;var n=L(t),s=String(this);if(!n.global)return le(n,s);var o=n.unicode;n.lastIndex=0;for(var a,l=[],c=0;null!==(a=le(n,s));){var u=String(a[0]);l[c]=u,""===u&&(n.lastIndex=ae(s,f(n.lastIndex),o)),c++}return 0===c?null:l}]});var de=Math.max,pe=Math.min,ve=Math.floor,ge=/\$([$&`']|\d\d?|<[^>]*>)/g,be=/\$([$&`']|\d\d?)/g;fe("replace",2,function(t,e,i){return[function(i,r){var n=o(this),s=null==i?void 0:i[t];return void 0!==s?s.call(i,n,r):e.call(String(n),i,r)},function(t,n){var s=i(e,t,this,n);if(s.done)return s.value;var o=L(t),a=String(this),l="function"==typeof n;l||(n=String(n));var c=o.global;if(c){var h=o.unicode;o.lastIndex=0}for(var d=[];;){var p=le(o,a);if(null===p)break;if(d.push(p),!c)break;""===String(p[0])&&(o.lastIndex=ae(a,f(o.lastIndex),h))}for(var v,g="",b=0,m=0;m<d.length;m++){p=d[m];for(var y=String(p[0]),x=de(pe(u(p.index),a.length),0),E=[],w=1;w<p.length;w++)E.push(void 0===(v=p[w])?v:String(v));var O=p.groups;if(l){var _=[y].concat(E,x,a);void 0!==O&&_.push(O);var S=String(n.apply(void 0,_))}else S=r(y,a,x,E,O,n);x>=b&&(g+=a.slice(b,x)+S,b=x+y.length)}return g+a.slice(b)}];function r(t,i,r,n,s,o){var l=r+t.length,c=n.length,u=be;return void 0!==s&&(s=a(s),u=ge),e.call(o,u,function(e,o){var a;switch(o.charAt(0)){case"$":return"$";case"&":return t;case"`":return i.slice(0,r);case"'":return i.slice(l);case"<":a=s[o.slice(1,-1)];break;default:var u=+o;if(0===u)return e;if(u>c){var h=ve(u/10);return 0===h?e:h<=c?void 0===n[h-1]?o.charAt(1):n[h-1]+o.charAt(1):e}a=n[u-1]}return void 0===a?"":a})}});for(var me in{CSSRuleList:0,CSSStyleDeclaration:0,CSSValueList:0,ClientRectList:0,DOMRectList:0,DOMStringList:0,DOMTokenList:1,DataTransferItemList:0,FileList:0,HTMLAllCollection:0,HTMLCollection:0,HTMLFormElement:0,HTMLSelectElement:0,MediaList:0,MimeTypeArray:0,NamedNodeMap:0,NodeList:1,PaintRequestList:0,Plugin:0,PluginArray:0,SVGLengthList:0,SVGNumberList:0,SVGPathSegList:0,SVGPointList:0,SVGStringList:0,SVGTransformList:0,SourceBufferList:0,StyleSheetList:0,TextTrackCueList:0,TextTrackList:0,TouchList:0}){var ye=E[me],xe=ye&&ye.prototype;if(xe&&xe.forEach!==Vt)try{T(xe,"forEach",Vt)}catch(t){xe.forEach=Vt}}var Ee="Expected a function",we=NaN,Oe="[object Symbol]",_e=/^\s+|\s+$/g,Se=/^[-+]0x[0-9a-f]+$/i,Le=/^0b[01]+$/i,Ae=/^0o[0-7]+$/i,Me=parseInt,ke="object"==typeof v&&v&&v.Object===Object&&v,We="object"==typeof self&&self&&self.Object===Object&&self,Te=ke||We||Function("return this")(),Re=Object.prototype.toString,je=Math.max,Ce=Math.min,Ne=function(){return Te.Date.now()};function ze(t,e,i){var r,n,s,o,a,l,c=0,u=!1,h=!1,f=!0;if("function"!=typeof t)throw new TypeError(Ee);function d(e){var i=r,s=n;return r=n=void 0,c=e,o=t.apply(s,i)}function p(t){var i=t-l;return void 0===l||i>=e||i<0||h&&t-c>=s}function v(){var t=Ne();if(p(t))return g(t);a=setTimeout(v,function(t){var i=e-(t-l);return h?Ce(i,s-(t-c)):i}(t))}function g(t){return a=void 0,f&&r?d(t):(r=n=void 0,o)}function b(){var t=Ne(),i=p(t);if(r=arguments,n=this,l=t,i){if(void 0===a)return function(t){return c=t,a=setTimeout(v,e),u?d(t):o}(l);if(h)return a=setTimeout(v,e),d(l)}return void 0===a&&(a=setTimeout(v,e)),o}return e=Ve(e)||0,De(i)&&(u=!!i.leading,s=(h="maxWait"in i)?je(Ve(i.maxWait)||0,e):s,f="trailing"in i?!!i.trailing:f),b.cancel=function(){void 0!==a&&clearTimeout(a),c=0,r=l=n=a=void 0},b.flush=function(){return void 0===a?o:g(Ne())},b}function De(t){var e=typeof t;return!!t&&("object"==e||"function"==e)}function Ve(t){if("number"==typeof t)return t;if(function(t){return"symbol"==typeof t||function(t){return!!t&&"object"==typeof t}(t)&&Re.call(t)==Oe}(t))return we;if(De(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=De(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=t.replace(_e,"");var i=Le.test(t);return i||Ae.test(t)?Me(t.slice(2),i?2:8):Se.test(t)?we:+t}var Ie=function(t,e,i){var r=!0,n=!0;if("function"!=typeof t)throw new TypeError(Ee);return De(i)&&(r="leading"in i?!!i.leading:r,n="trailing"in i?!!i.trailing:n),ze(t,e,{leading:r,maxWait:e,trailing:n})},Be="Expected a function",Pe=NaN,He="[object Symbol]",Fe=/^\s+|\s+$/g,qe=/^[-+]0x[0-9a-f]+$/i,$e=/^0b[01]+$/i,Ye=/^0o[0-7]+$/i,Xe=parseInt,Ge="object"==typeof v&&v&&v.Object===Object&&v,Ke="object"==typeof self&&self&&self.Object===Object&&self,Ue=Ge||Ke||Function("return this")(),Je=Object.prototype.toString,Qe=Math.max,Ze=Math.min,ti=function(){return Ue.Date.now()};function ei(t){var e=typeof t;return!!t&&("object"==e||"function"==e)}function ii(t){if("number"==typeof t)return t;if(function(t){return"symbol"==typeof t||function(t){return!!t&&"object"==typeof t}(t)&&Je.call(t)==He}(t))return Pe;if(ei(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=ei(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=t.replace(Fe,"");var i=$e.test(t);return i||Ye.test(t)?Xe(t.slice(2),i?2:8):qe.test(t)?Pe:+t}var ri=function(t,e,i){var r,n,s,o,a,l,c=0,u=!1,h=!1,f=!0;if("function"!=typeof t)throw new TypeError(Be);function d(e){var i=r,s=n;return r=n=void 0,c=e,o=t.apply(s,i)}function p(t){var i=t-l;return void 0===l||i>=e||i<0||h&&t-c>=s}function v(){var t=ti();if(p(t))return g(t);a=setTimeout(v,function(t){var i=e-(t-l);return h?Ze(i,s-(t-c)):i}(t))}function g(t){return a=void 0,f&&r?d(t):(r=n=void 0,o)}function b(){var t=ti(),i=p(t);if(r=arguments,n=this,l=t,i){if(void 0===a)return function(t){return c=t,a=setTimeout(v,e),u?d(t):o}(l);if(h)return a=setTimeout(v,e),d(l)}return void 0===a&&(a=setTimeout(v,e)),o}return e=ii(e)||0,ei(i)&&(u=!!i.leading,s=(h="maxWait"in i)?Qe(ii(i.maxWait)||0,e):s,f="trailing"in i?!!i.trailing:f),b.cancel=function(){void 0!==a&&clearTimeout(a),c=0,r=l=n=a=void 0},b.flush=function(){return void 0===a?o:g(ti())},b},ni="Expected a function",si="__lodash_hash_undefined__",oi="[object Function]",ai="[object GeneratorFunction]",li=/^\[object .+?Constructor\]$/,ci="object"==typeof v&&v&&v.Object===Object&&v,ui="object"==typeof self&&self&&self.Object===Object&&self,hi=ci||ui||Function("return this")();var fi=Array.prototype,di=Function.prototype,pi=Object.prototype,vi=hi["__core-js_shared__"],gi=function(){var t=/[^.]+$/.exec(vi&&vi.keys&&vi.keys.IE_PROTO||"");return t?"Symbol(src)_1."+t:""}(),bi=di.toString,mi=pi.hasOwnProperty,yi=pi.toString,xi=RegExp("^"+bi.call(mi).replace(/[\\^$.*+?()[\]{}|]/g,"\\$&").replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g,"$1.*?")+"$"),Ei=fi.splice,wi=Wi(hi,"Map"),Oi=Wi(Object,"create");function _i(t){var e=-1,i=t?t.length:0;for(this.clear();++e<i;){var r=t[e];this.set(r[0],r[1])}}function Si(t){var e=-1,i=t?t.length:0;for(this.clear();++e<i;){var r=t[e];this.set(r[0],r[1])}}function Li(t){var e=-1,i=t?t.length:0;for(this.clear();++e<i;){var r=t[e];this.set(r[0],r[1])}}function Ai(t,e){for(var i,r,n=t.length;n--;)if((i=t[n][0])===(r=e)||i!=i&&r!=r)return n;return-1}function Mi(t){return!(!Ri(t)||(e=t,gi&&gi in e))&&(function(t){var e=Ri(t)?yi.call(t):"";return e==oi||e==ai}(t)||function(t){var e=!1;if(null!=t&&"function"!=typeof t.toString)try{e=!!(t+"")}catch(t){}return e}(t)?xi:li).test(function(t){if(null!=t){try{return bi.call(t)}catch(t){}try{return t+""}catch(t){}}return""}(t));var e}function ki(t,e){var i,r,n=t.__data__;return("string"==(r=typeof(i=e))||"number"==r||"symbol"==r||"boolean"==r?"__proto__"!==i:null===i)?n["string"==typeof e?"string":"hash"]:n.map}function Wi(t,e){var i=function(t,e){return null==t?void 0:t[e]}(t,e);return Mi(i)?i:void 0}function Ti(t,e){if("function"!=typeof t||e&&"function"!=typeof e)throw new TypeError(ni);var i=function(){var r=arguments,n=e?e.apply(this,r):r[0],s=i.cache;if(s.has(n))return s.get(n);var o=t.apply(this,r);return i.cache=s.set(n,o),o};return i.cache=new(Ti.Cache||Li),i}function Ri(t){var e=typeof t;return!!t&&("object"==e||"function"==e)}_i.prototype.clear=function(){this.__data__=Oi?Oi(null):{}},_i.prototype.delete=function(t){return this.has(t)&&delete this.__data__[t]},_i.prototype.get=function(t){var e=this.__data__;if(Oi){var i=e[t];return i===si?void 0:i}return mi.call(e,t)?e[t]:void 0},_i.prototype.has=function(t){var e=this.__data__;return Oi?void 0!==e[t]:mi.call(e,t)},_i.prototype.set=function(t,e){return this.__data__[t]=Oi&&void 0===e?si:e,this},Si.prototype.clear=function(){this.__data__=[]},Si.prototype.delete=function(t){var e=this.__data__,i=Ai(e,t);return!(i<0||(i==e.length-1?e.pop():Ei.call(e,i,1),0))},Si.prototype.get=function(t){var e=this.__data__,i=Ai(e,t);return i<0?void 0:e[i][1]},Si.prototype.has=function(t){return Ai(this.__data__,t)>-1},Si.prototype.set=function(t,e){var i=this.__data__,r=Ai(i,t);return r<0?i.push([t,e]):i[r][1]=e,this},Li.prototype.clear=function(){this.__data__={hash:new _i,map:new(wi||Si),string:new _i}},Li.prototype.delete=function(t){return ki(this,t).delete(t)},Li.prototype.get=function(t){return ki(this,t).get(t)},Li.prototype.has=function(t){return ki(this,t).has(t)},Li.prototype.set=function(t,e){return ki(this,t).set(t,e),this},Ti.Cache=Li;var ji=Ti,Ci=function(){if("undefined"!=typeof Map)return Map;function t(t,e){var i=-1;return t.some(function(t,r){return t[0]===e&&(i=r,!0)}),i}return function(){function e(){this.__entries__=[]}return Object.defineProperty(e.prototype,"size",{get:function(){return this.__entries__.length},enumerable:!0,configurable:!0}),e.prototype.get=function(e){var i=t(this.__entries__,e),r=this.__entries__[i];return r&&r[1]},e.prototype.set=function(e,i){var r=t(this.__entries__,e);~r?this.__entries__[r][1]=i:this.__entries__.push([e,i])},e.prototype.delete=function(e){var i=this.__entries__,r=t(i,e);~r&&i.splice(r,1)},e.prototype.has=function(e){return!!~t(this.__entries__,e)},e.prototype.clear=function(){this.__entries__.splice(0)},e.prototype.forEach=function(t,e){void 0===e&&(e=null);for(var i=0,r=this.__entries__;i<r.length;i++){var n=r[i];t.call(e,n[1],n[0])}},e}()}(),Ni="undefined"!=typeof window&&"undefined"!=typeof document&&window.document===document,zi="undefined"!=typeof global&&global.Math===Math?global:"undefined"!=typeof self&&self.Math===Math?self:"undefined"!=typeof window&&window.Math===Math?window:Function("return this")(),Di="function"==typeof requestAnimationFrame?requestAnimationFrame.bind(zi):function(t){return setTimeout(function(){return t(Date.now())},1e3/60)},Vi=2;var Ii=20,Bi=["top","right","bottom","left","width","height","size","weight"],Pi="undefined"!=typeof MutationObserver,Hi=function(){function t(){this.connected_=!1,this.mutationEventsAdded_=!1,this.mutationsObserver_=null,this.observers_=[],this.onTransitionEnd_=this.onTransitionEnd_.bind(this),this.refresh=function(t,e){var i=!1,r=!1,n=0;function s(){i&&(i=!1,t()),r&&a()}function o(){Di(s)}function a(){var t=Date.now();if(i){if(t-n<Vi)return;r=!0}else i=!0,r=!1,setTimeout(o,e);n=t}return a}(this.refresh.bind(this),Ii)}return t.prototype.addObserver=function(t){~this.observers_.indexOf(t)||this.observers_.push(t),this.connected_||this.connect_()},t.prototype.removeObserver=function(t){var e=this.observers_,i=e.indexOf(t);~i&&e.splice(i,1),!e.length&&this.connected_&&this.disconnect_()},t.prototype.refresh=function(){this.updateObservers_()&&this.refresh()},t.prototype.updateObservers_=function(){var t=this.observers_.filter(function(t){return t.gatherActive(),t.hasActive()});return t.forEach(function(t){return t.broadcastActive()}),t.length>0},t.prototype.connect_=function(){Ni&&!this.connected_&&(document.addEventListener("transitionend",this.onTransitionEnd_),window.addEventListener("resize",this.refresh),Pi?(this.mutationsObserver_=new MutationObserver(this.refresh),this.mutationsObserver_.observe(document,{attributes:!0,childList:!0,characterData:!0,subtree:!0})):(document.addEventListener("DOMSubtreeModified",this.refresh),this.mutationEventsAdded_=!0),this.connected_=!0)},t.prototype.disconnect_=function(){Ni&&this.connected_&&(document.removeEventListener("transitionend",this.onTransitionEnd_),window.removeEventListener("resize",this.refresh),this.mutationsObserver_&&this.mutationsObserver_.disconnect(),this.mutationEventsAdded_&&document.removeEventListener("DOMSubtreeModified",this.refresh),this.mutationsObserver_=null,this.mutationEventsAdded_=!1,this.connected_=!1)},t.prototype.onTransitionEnd_=function(t){var e=t.propertyName,i=void 0===e?"":e;Bi.some(function(t){return!!~i.indexOf(t)})&&this.refresh()},t.getInstance=function(){return this.instance_||(this.instance_=new t),this.instance_},t.instance_=null,t}(),Fi=function(t,e){for(var i=0,r=Object.keys(e);i<r.length;i++){var n=r[i];Object.defineProperty(t,n,{value:e[n],enumerable:!1,writable:!1,configurable:!0})}return t},qi=function(t){return t&&t.ownerDocument&&t.ownerDocument.defaultView||zi},$i=Ji(0,0,0,0);function Yi(t){return parseFloat(t)||0}function Xi(t){for(var e=[],i=1;i<arguments.length;i++)e[i-1]=arguments[i];return e.reduce(function(e,i){return e+Yi(t["border-"+i+"-width"])},0)}function Gi(t){var e=t.clientWidth,i=t.clientHeight;if(!e&&!i)return $i;var r=qi(t).getComputedStyle(t),n=function(t){for(var e={},i=0,r=["top","right","bottom","left"];i<r.length;i++){var n=r[i],s=t["padding-"+n];e[n]=Yi(s)}return e}(r),s=n.left+n.right,o=n.top+n.bottom,a=Yi(r.width),l=Yi(r.height);if("border-box"===r.boxSizing&&(Math.round(a+s)!==e&&(a-=Xi(r,"left","right")+s),Math.round(l+o)!==i&&(l-=Xi(r,"top","bottom")+o)),!function(t){return t===qi(t).document.documentElement}(t)){var c=Math.round(a+s)-e,u=Math.round(l+o)-i;1!==Math.abs(c)&&(a-=c),1!==Math.abs(u)&&(l-=u)}return Ji(n.left,n.top,a,l)}var Ki="undefined"!=typeof SVGGraphicsElement?function(t){return t instanceof qi(t).SVGGraphicsElement}:function(t){return t instanceof qi(t).SVGElement&&"function"==typeof t.getBBox};function Ui(t){return Ni?Ki(t)?function(t){var e=t.getBBox();return Ji(0,0,e.width,e.height)}(t):Gi(t):$i}function Ji(t,e,i,r){return{x:t,y:e,width:i,height:r}}var Qi=function(){function t(t){this.broadcastWidth=0,this.broadcastHeight=0,this.contentRect_=Ji(0,0,0,0),this.target=t}return t.prototype.isActive=function(){var t=Ui(this.target);return this.contentRect_=t,t.width!==this.broadcastWidth||t.height!==this.broadcastHeight},t.prototype.broadcastRect=function(){var t=this.contentRect_;return this.broadcastWidth=t.width,this.broadcastHeight=t.height,t},t}(),Zi=function(){return function(t,e){var i,r,n,s,o,a,l,c=(r=(i=e).x,n=i.y,s=i.width,o=i.height,a="undefined"!=typeof DOMRectReadOnly?DOMRectReadOnly:Object,l=Object.create(a.prototype),Fi(l,{x:r,y:n,width:s,height:o,top:n,right:r+s,bottom:o+n,left:r}),l);Fi(this,{target:t,contentRect:c})}}(),tr=function(){function t(t,e,i){if(this.activeObservations_=[],this.observations_=new Ci,"function"!=typeof t)throw new TypeError("The callback provided as parameter 1 is not a function.");this.callback_=t,this.controller_=e,this.callbackCtx_=i}return t.prototype.observe=function(t){if(!arguments.length)throw new TypeError("1 argument required, but only 0 present.");if("undefined"!=typeof Element&&Element instanceof Object){if(!(t instanceof qi(t).Element))throw new TypeError('parameter 1 is not of type "Element".');var e=this.observations_;e.has(t)||(e.set(t,new Qi(t)),this.controller_.addObserver(this),this.controller_.refresh())}},t.prototype.unobserve=function(t){if(!arguments.length)throw new TypeError("1 argument required, but only 0 present.");if("undefined"!=typeof Element&&Element instanceof Object){if(!(t instanceof qi(t).Element))throw new TypeError('parameter 1 is not of type "Element".');var e=this.observations_;e.has(t)&&(e.delete(t),e.size||this.controller_.removeObserver(this))}},t.prototype.disconnect=function(){this.clearActive(),this.observations_.clear(),this.controller_.removeObserver(this)},t.prototype.gatherActive=function(){var t=this;this.clearActive(),this.observations_.forEach(function(e){e.isActive()&&t.activeObservations_.push(e)})},t.prototype.broadcastActive=function(){if(this.hasActive()){var t=this.callbackCtx_,e=this.activeObservations_.map(function(t){return new Zi(t.target,t.broadcastRect())});this.callback_.call(t,e,t),this.clearActive()}},t.prototype.clearActive=function(){this.activeObservations_.splice(0)},t.prototype.hasActive=function(){return this.activeObservations_.length>0},t}(),er="undefined"!=typeof WeakMap?new WeakMap:new Ci,ir=function(){return function t(e){if(!(this instanceof t))throw new TypeError("Cannot call a class as a function.");if(!arguments.length)throw new TypeError("1 argument required, but only 0 present.");var i=Hi.getInstance(),r=new tr(e,i,this);er.set(this,r)}}();["observe","unobserve","disconnect"].forEach(function(t){ir.prototype[t]=function(){var e;return(e=er.get(this))[t].apply(e,arguments)}});var rr=void 0!==zi.ResizeObserver?zi.ResizeObserver:ir,nr=!("undefined"==typeof window||!window.document||!window.document.createElement);function sr(){if("undefined"==typeof document)return 0;var t=document.body,e=document.createElement("div"),i=e.style;i.position="fixed",i.left=0,i.visibility="hidden",i.overflowY="scroll",t.appendChild(e);var r=e.getBoundingClientRect().right;return t.removeChild(e),r}var or=function(){function t(e,i){var r=this;this.onScroll=function(){r.scrollXTicking||(window.requestAnimationFrame(r.scrollX),r.scrollXTicking=!0),r.scrollYTicking||(window.requestAnimationFrame(r.scrollY),r.scrollYTicking=!0)},this.scrollX=function(){r.axis.x.isOverflowing&&(r.showScrollbar("x"),r.positionScrollbar("x")),r.scrollXTicking=!1},this.scrollY=function(){r.axis.y.isOverflowing&&(r.showScrollbar("y"),r.positionScrollbar("y")),r.scrollYTicking=!1},this.onMouseEnter=function(){r.showScrollbar("x"),r.showScrollbar("y")},this.onMouseMove=function(t){r.mouseX=t.clientX,r.mouseY=t.clientY,(r.axis.x.isOverflowing||r.axis.x.forceVisible)&&r.onMouseMoveForAxis("x"),(r.axis.y.isOverflowing||r.axis.y.forceVisible)&&r.onMouseMoveForAxis("y")},this.onMouseLeave=function(){r.onMouseMove.cancel(),(r.axis.x.isOverflowing||r.axis.x.forceVisible)&&r.onMouseLeaveForAxis("x"),(r.axis.y.isOverflowing||r.axis.y.forceVisible)&&r.onMouseLeaveForAxis("y"),r.mouseX=-1,r.mouseY=-1},this.onWindowResize=function(){r.scrollbarWidth=sr(),r.hideNativeScrollbar()},this.hideScrollbars=function(){r.axis.x.track.rect=r.axis.x.track.el.getBoundingClientRect(),r.axis.y.track.rect=r.axis.y.track.el.getBoundingClientRect(),r.isWithinBounds(r.axis.y.track.rect)||(r.axis.y.scrollbar.el.classList.remove(r.classNames.visible),r.axis.y.isVisible=!1),r.isWithinBounds(r.axis.x.track.rect)||(r.axis.x.scrollbar.el.classList.remove(r.classNames.visible),r.axis.x.isVisible=!1)},this.onPointerEvent=function(t){var e,i;r.axis.x.scrollbar.rect=r.axis.x.scrollbar.el.getBoundingClientRect(),r.axis.y.scrollbar.rect=r.axis.y.scrollbar.el.getBoundingClientRect(),(r.axis.x.isOverflowing||r.axis.x.forceVisible)&&(i=r.isWithinBounds(r.axis.x.scrollbar.rect)),(r.axis.y.isOverflowing||r.axis.y.forceVisible)&&(e=r.isWithinBounds(r.axis.y.scrollbar.rect)),(e||i)&&(t.preventDefault(),t.stopPropagation(),"mousedown"===t.type&&(e&&r.onDragStart(t,"y"),i&&r.onDragStart(t,"x")))},this.drag=function(e){var i=r.axis[r.draggedAxis].track,n=i.rect[r.axis[r.draggedAxis].sizeAttr],s=r.axis[r.draggedAxis].scrollbar,o=r.contentWrapperEl[r.axis[r.draggedAxis].scrollSizeAttr],a=parseInt(r.elStyles[r.axis[r.draggedAxis].sizeAttr],10);e.preventDefault(),e.stopPropagation();var l=(("y"===r.draggedAxis?e.pageY:e.pageX)-i.rect[r.axis[r.draggedAxis].offsetAttr]-r.axis[r.draggedAxis].dragOffset)/(n-s.size)*(o-a);"x"===r.draggedAxis&&(l=r.isRtl&&t.getRtlHelpers().isRtlScrollbarInverted?l-(n+s.size):l,l=r.isRtl&&t.getRtlHelpers().isRtlScrollingInverted?-l:l),r.contentWrapperEl[r.axis[r.draggedAxis].scrollOffsetAttr]=l},this.onEndDrag=function(t){t.preventDefault(),t.stopPropagation(),r.el.classList.remove(r.classNames.dragging),document.removeEventListener("mousemove",r.drag,!0),document.removeEventListener("mouseup",r.onEndDrag,!0),r.removePreventClickId=window.setTimeout(function(){document.removeEventListener("click",r.preventClick,!0),document.removeEventListener("dblclick",r.preventClick,!0),r.removePreventClickId=null})},this.preventClick=function(t){t.preventDefault(),t.stopPropagation()},this.el=e,this.flashTimeout,this.contentEl,this.contentWrapperEl,this.offsetEl,this.maskEl,this.globalObserver,this.mutationObserver,this.resizeObserver,this.scrollbarWidth,this.minScrollbarWidth=20,this.options=Object.assign({},t.defaultOptions,i),this.classNames=Object.assign({},t.defaultOptions.classNames,this.options.classNames),this.isRtl,this.axis={x:{scrollOffsetAttr:"scrollLeft",sizeAttr:"width",scrollSizeAttr:"scrollWidth",offsetAttr:"left",overflowAttr:"overflowX",dragOffset:0,isOverflowing:!0,isVisible:!1,forceVisible:!1,track:{},scrollbar:{}},y:{scrollOffsetAttr:"scrollTop",sizeAttr:"height",scrollSizeAttr:"scrollHeight",offsetAttr:"top",overflowAttr:"overflowY",dragOffset:0,isOverflowing:!0,isVisible:!1,forceVisible:!1,track:{},scrollbar:{}}},this.removePreventClickId=null,this.el.SimpleBar||(this.recalculate=Ie(this.recalculate.bind(this),64),this.onMouseMove=Ie(this.onMouseMove.bind(this),64),this.hideScrollbars=ri(this.hideScrollbars.bind(this),this.options.timeout),this.onWindowResize=ri(this.onWindowResize.bind(this),64,{leading:!0}),t.getRtlHelpers=ji(t.getRtlHelpers),this.init())}t.getRtlHelpers=function(){var e=document.createElement("div");e.innerHTML='<div class="hs-dummy-scrollbar-size"><div style="height: 200%; width: 200%; margin: 10px 0;"></div></div>';var i=e.firstElementChild;document.body.appendChild(i);var r=i.firstElementChild;i.scrollLeft=0;var n=t.getOffset(i),s=t.getOffset(r);i.scrollLeft=999;var o=t.getOffset(r);return{isRtlScrollingInverted:n.left!==s.left&&s.left-o.left!=0,isRtlScrollbarInverted:n.left!==s.left}},t.initHtmlApi=function(){this.initDOMLoadedElements=this.initDOMLoadedElements.bind(this),"undefined"!=typeof MutationObserver&&(this.globalObserver=new MutationObserver(function(e){e.forEach(function(e){Array.prototype.forEach.call(e.addedNodes,function(e){1===e.nodeType&&(e.hasAttribute("data-simplebar")?!e.SimpleBar&&new t(e,t.getElOptions(e)):Array.prototype.forEach.call(e.querySelectorAll("[data-simplebar]"),function(e){!e.SimpleBar&&new t(e,t.getElOptions(e))}))}),Array.prototype.forEach.call(e.removedNodes,function(t){1===t.nodeType&&(t.hasAttribute("data-simplebar")?t.SimpleBar&&t.SimpleBar.unMount():Array.prototype.forEach.call(t.querySelectorAll("[data-simplebar]"),function(t){t.SimpleBar&&t.SimpleBar.unMount()}))})})}),this.globalObserver.observe(document,{childList:!0,subtree:!0})),"complete"===document.readyState||"loading"!==document.readyState&&!document.documentElement.doScroll?window.setTimeout(this.initDOMLoadedElements):(document.addEventListener("DOMContentLoaded",this.initDOMLoadedElements),window.addEventListener("load",this.initDOMLoadedElements))},t.getElOptions=function(t){return Array.prototype.reduce.call(t.attributes,function(t,e){var i=e.name.match(/data-simplebar-(.+)/);if(i){var r=i[1].replace(/\W+(.)/g,function(t,e){return e.toUpperCase()});switch(e.value){case"true":t[r]=!0;break;case"false":t[r]=!1;break;case void 0:t[r]=!0;break;default:t[r]=e.value}}return t},{})},t.removeObserver=function(){this.globalObserver.disconnect()},t.initDOMLoadedElements=function(){document.removeEventListener("DOMContentLoaded",this.initDOMLoadedElements),window.removeEventListener("load",this.initDOMLoadedElements),Array.prototype.forEach.call(document.querySelectorAll("[data-simplebar]"),function(e){e.SimpleBar||new t(e,t.getElOptions(e))})},t.getOffset=function(t){var e=t.getBoundingClientRect();return{top:e.top+(window.pageYOffset||document.documentElement.scrollTop),left:e.left+(window.pageXOffset||document.documentElement.scrollLeft)}};var e=t.prototype;return e.init=function(){this.el.SimpleBar=this,nr&&(this.initDOM(),this.scrollbarWidth=sr(),this.recalculate(),this.initListeners())},e.initDOM=function(){var t=this;if(Array.prototype.filter.call(this.el.children,function(e){return e.classList.contains(t.classNames.wrapper)}).length)this.wrapperEl=this.el.querySelector("."+this.classNames.wrapper),this.contentWrapperEl=this.el.querySelector("."+this.classNames.contentWrapper),this.offsetEl=this.el.querySelector("."+this.classNames.offset),this.maskEl=this.el.querySelector("."+this.classNames.mask),this.contentEl=this.el.querySelector("."+this.classNames.contentEl),this.placeholderEl=this.el.querySelector("."+this.classNames.placeholder),this.heightAutoObserverWrapperEl=this.el.querySelector("."+this.classNames.heightAutoObserverWrapperEl),this.heightAutoObserverEl=this.el.querySelector("."+this.classNames.heightAutoObserverEl),this.axis.x.track.el=this.findChild(this.el,"."+this.classNames.track+"."+this.classNames.horizontal),this.axis.y.track.el=this.findChild(this.el,"."+this.classNames.track+"."+this.classNames.vertical);else{for(this.wrapperEl=document.createElement("div"),this.contentWrapperEl=document.createElement("div"),this.offsetEl=document.createElement("div"),this.maskEl=document.createElement("div"),this.contentEl=document.createElement("div"),this.placeholderEl=document.createElement("div"),this.heightAutoObserverWrapperEl=document.createElement("div"),this.heightAutoObserverEl=document.createElement("div"),this.wrapperEl.classList.add(this.classNames.wrapper),this.contentWrapperEl.classList.add(this.classNames.contentWrapper),this.offsetEl.classList.add(this.classNames.offset),this.maskEl.classList.add(this.classNames.mask),this.contentEl.classList.add(this.classNames.contentEl),this.placeholderEl.classList.add(this.classNames.placeholder),this.heightAutoObserverWrapperEl.classList.add(this.classNames.heightAutoObserverWrapperEl),this.heightAutoObserverEl.classList.add(this.classNames.heightAutoObserverEl);this.el.firstChild;)this.contentEl.appendChild(this.el.firstChild);this.contentWrapperEl.appendChild(this.contentEl),this.offsetEl.appendChild(this.contentWrapperEl),this.maskEl.appendChild(this.offsetEl),this.heightAutoObserverWrapperEl.appendChild(this.heightAutoObserverEl),this.wrapperEl.appendChild(this.heightAutoObserverWrapperEl),this.wrapperEl.appendChild(this.maskEl),this.wrapperEl.appendChild(this.placeholderEl),this.el.appendChild(this.wrapperEl)}if(!this.axis.x.track.el||!this.axis.y.track.el){var e=document.createElement("div"),i=document.createElement("div");e.classList.add(this.classNames.track),i.classList.add(this.classNames.scrollbar),e.appendChild(i),this.axis.x.track.el=e.cloneNode(!0),this.axis.x.track.el.classList.add(this.classNames.horizontal),this.axis.y.track.el=e.cloneNode(!0),this.axis.y.track.el.classList.add(this.classNames.vertical),this.el.appendChild(this.axis.x.track.el),this.el.appendChild(this.axis.y.track.el)}this.axis.x.scrollbar.el=this.axis.x.track.el.querySelector("."+this.classNames.scrollbar),this.axis.y.scrollbar.el=this.axis.y.track.el.querySelector("."+this.classNames.scrollbar),this.options.autoHide||(this.axis.x.scrollbar.el.classList.add(this.classNames.visible),this.axis.y.scrollbar.el.classList.add(this.classNames.visible)),this.el.setAttribute("data-simplebar","init")},e.initListeners=function(){var t=this;this.options.autoHide&&this.el.addEventListener("mouseenter",this.onMouseEnter),["mousedown","click","dblclick"].forEach(function(e){t.el.addEventListener(e,t.onPointerEvent,!0)}),["touchstart","touchend","touchmove"].forEach(function(e){t.el.addEventListener(e,t.onPointerEvent,{capture:!0,passive:!0})}),this.el.addEventListener("mousemove",this.onMouseMove),this.el.addEventListener("mouseleave",this.onMouseLeave),this.contentWrapperEl.addEventListener("scroll",this.onScroll),window.addEventListener("resize",this.onWindowResize),this.resizeObserver=new rr(this.recalculate),this.resizeObserver.observe(this.el),this.resizeObserver.observe(this.contentEl)},e.recalculate=function(){var t=this.heightAutoObserverEl.offsetHeight<=1,e=this.heightAutoObserverEl.offsetWidth<=1;this.elStyles=window.getComputedStyle(this.el),this.isRtl="rtl"===this.elStyles.direction,this.contentEl.style.padding=this.elStyles.paddingTop+" "+this.elStyles.paddingRight+" "+this.elStyles.paddingBottom+" "+this.elStyles.paddingLeft,this.wrapperEl.style.margin="-"+this.elStyles.paddingTop+" -"+this.elStyles.paddingRight+" -"+this.elStyles.paddingBottom+" -"+this.elStyles.paddingLeft,this.contentWrapperEl.style.height=t?"auto":"100%",this.placeholderEl.style.width=e?this.contentEl.offsetWidth+"px":"auto",this.placeholderEl.style.height=this.contentEl.scrollHeight+"px",this.axis.x.isOverflowing=this.contentWrapperEl.scrollWidth>this.contentWrapperEl.offsetWidth,this.axis.y.isOverflowing=this.contentWrapperEl.scrollHeight>this.contentWrapperEl.offsetHeight,this.axis.x.isOverflowing="hidden"!==this.elStyles.overflowX&&this.axis.x.isOverflowing,this.axis.y.isOverflowing="hidden"!==this.elStyles.overflowY&&this.axis.y.isOverflowing,this.axis.x.forceVisible="x"===this.options.forceVisible||!0===this.options.forceVisible,this.axis.y.forceVisible="y"===this.options.forceVisible||!0===this.options.forceVisible,this.hideNativeScrollbar(),this.axis.x.track.rect=this.axis.x.track.el.getBoundingClientRect(),this.axis.y.track.rect=this.axis.y.track.el.getBoundingClientRect(),this.axis.x.scrollbar.size=this.getScrollbarSize("x"),this.axis.y.scrollbar.size=this.getScrollbarSize("y"),this.axis.x.scrollbar.el.style.width=this.axis.x.scrollbar.size+"px",this.axis.y.scrollbar.el.style.height=this.axis.y.scrollbar.size+"px",this.positionScrollbar("x"),this.positionScrollbar("y"),this.toggleTrackVisibility("x"),this.toggleTrackVisibility("y")},e.getScrollbarSize=function(t){void 0===t&&(t="y");var e,i=this.scrollbarWidth?this.contentWrapperEl[this.axis[t].scrollSizeAttr]:this.contentWrapperEl[this.axis[t].scrollSizeAttr]-this.minScrollbarWidth,r=this.axis[t].track.rect[this.axis[t].sizeAttr];if(this.axis[t].isOverflowing){var n=r/i;return e=Math.max(~~(n*r),this.options.scrollbarMinSize),this.options.scrollbarMaxSize&&(e=Math.min(e,this.options.scrollbarMaxSize)),e}},e.positionScrollbar=function(e){void 0===e&&(e="y");var i=this.contentWrapperEl[this.axis[e].scrollSizeAttr],r=this.axis[e].track.rect[this.axis[e].sizeAttr],n=parseInt(this.elStyles[this.axis[e].sizeAttr],10),s=this.axis[e].scrollbar,o=this.contentWrapperEl[this.axis[e].scrollOffsetAttr],a=(o="x"===e&&this.isRtl&&t.getRtlHelpers().isRtlScrollingInverted?-o:o)/(i-n),l=~~((r-s.size)*a);l="x"===e&&this.isRtl&&t.getRtlHelpers().isRtlScrollbarInverted?l+(r-s.size):l,s.el.style.transform="x"===e?"translate3d("+l+"px, 0, 0)":"translate3d(0, "+l+"px, 0)"},e.toggleTrackVisibility=function(t){void 0===t&&(t="y");var e=this.axis[t].track.el,i=this.axis[t].scrollbar.el;this.axis[t].isOverflowing||this.axis[t].forceVisible?(e.style.visibility="visible",this.contentWrapperEl.style[this.axis[t].overflowAttr]="scroll"):(e.style.visibility="hidden",this.contentWrapperEl.style[this.axis[t].overflowAttr]="hidden"),this.axis[t].isOverflowing?i.style.display="block":i.style.display="none"},e.hideNativeScrollbar=function(){if(this.offsetEl.style[this.isRtl?"left":"right"]=this.axis.y.isOverflowing||this.axis.y.forceVisible?"-"+(this.scrollbarWidth||this.minScrollbarWidth)+"px":0,this.offsetEl.style.bottom=this.axis.x.isOverflowing||this.axis.x.forceVisible?"-"+(this.scrollbarWidth||this.minScrollbarWidth)+"px":0,!this.scrollbarWidth){var t=[this.isRtl?"paddingLeft":"paddingRight"];this.contentWrapperEl.style[t]=this.axis.y.isOverflowing||this.axis.y.forceVisible?this.minScrollbarWidth+"px":0,this.contentWrapperEl.style.paddingBottom=this.axis.x.isOverflowing||this.axis.x.forceVisible?this.minScrollbarWidth+"px":0}},e.onMouseMoveForAxis=function(t){void 0===t&&(t="y"),this.axis[t].track.rect=this.axis[t].track.el.getBoundingClientRect(),this.axis[t].scrollbar.rect=this.axis[t].scrollbar.el.getBoundingClientRect(),this.isWithinBounds(this.axis[t].scrollbar.rect)?this.axis[t].scrollbar.el.classList.add(this.classNames.hover):this.axis[t].scrollbar.el.classList.remove(this.classNames.hover),this.isWithinBounds(this.axis[t].track.rect)?(this.showScrollbar(t),this.axis[t].track.el.classList.add(this.classNames.hover)):this.axis[t].track.el.classList.remove(this.classNames.hover)},e.onMouseLeaveForAxis=function(t){void 0===t&&(t="y"),this.axis[t].track.el.classList.remove(this.classNames.hover),this.axis[t].scrollbar.el.classList.remove(this.classNames.hover)},e.showScrollbar=function(t){void 0===t&&(t="y");var e=this.axis[t].scrollbar.el;this.axis[t].isVisible||(e.classList.add(this.classNames.visible),this.axis[t].isVisible=!0),this.options.autoHide&&this.hideScrollbars()},e.onDragStart=function(t,e){void 0===e&&(e="y");var i=this.axis[e].scrollbar.el,r="y"===e?t.pageY:t.pageX;this.axis[e].dragOffset=r-i.getBoundingClientRect()[this.axis[e].offsetAttr],this.draggedAxis=e,this.el.classList.add(this.classNames.dragging),document.addEventListener("mousemove",this.drag,!0),document.addEventListener("mouseup",this.onEndDrag,!0),null===this.removePreventClickId?(document.addEventListener("click",this.preventClick,!0),document.addEventListener("dblclick",this.preventClick,!0)):(window.clearTimeout(this.removePreventClickId),this.removePreventClickId=null)},e.getContentElement=function(){return this.contentEl},e.getScrollElement=function(){return this.contentWrapperEl},e.removeListeners=function(){var t=this;this.options.autoHide&&this.el.removeEventListener("mouseenter",this.onMouseEnter),["mousedown","click","dblclick"].forEach(function(e){t.el.removeEventListener(e,t.onPointerEvent,!0)}),["touchstart","touchend","touchmove"].forEach(function(e){t.el.removeEventListener(e,t.onPointerEvent,{capture:!0,passive:!0})}),this.el.removeEventListener("mousemove",this.onMouseMove),this.el.removeEventListener("mouseleave",this.onMouseLeave),this.contentWrapperEl.removeEventListener("scroll",this.onScroll),window.removeEventListener("resize",this.onWindowResize),this.mutationObserver&&this.mutationObserver.disconnect(),this.resizeObserver.disconnect(),this.recalculate.cancel(),this.onMouseMove.cancel(),this.hideScrollbars.cancel(),this.onWindowResize.cancel()},e.unMount=function(){this.removeListeners(),this.el.SimpleBar=null},e.isChildNode=function(t){return null!==t&&(t===this.el||this.isChildNode(t.parentNode))},e.isWithinBounds=function(t){return this.mouseX>=t.left&&this.mouseX<=t.left+t.width&&this.mouseY>=t.top&&this.mouseY<=t.top+t.height},e.findChild=function(t,e){var i=t.matches||t.webkitMatchesSelector||t.mozMatchesSelector||t.msMatchesSelector;return Array.prototype.filter.call(t.children,function(t){return i.call(t,e)})[0]},t}();return or.defaultOptions={autoHide:!0,forceVisible:!1,classNames:{contentEl:"simplebar-content",contentWrapper:"simplebar-content-wrapper",offset:"simplebar-offset",mask:"simplebar-mask",wrapper:"simplebar-wrapper",placeholder:"simplebar-placeholder",scrollbar:"simplebar-scrollbar",track:"simplebar-track",heightAutoObserverWrapperEl:"simplebar-height-auto-observer-wrapper",heightAutoObserverEl:"simplebar-height-auto-observer",visible:"simplebar-visible",horizontal:"simplebar-horizontal",vertical:"simplebar-vertical",hover:"simplebar-hover",dragging:"simplebar-dragging"},scrollbarMinSize:25,scrollbarMaxSize:0,timeout:1e3},nr&&or.initHtmlApi(),or});

!function(a,b){"function"==typeof define&&define.amd?define([],b(a)):"object"==typeof exports?module.exports=b(a):a.inlineSVG=b(a)}("undefined"!=typeof global?global:this.window||this.global,function(a){var b,c={},d=!!document.querySelector&&!!a.addEventListener,e={svgSelector:"img.svg"},f=function(a,b){return function(){if(--a<1)return b.apply(this,arguments)}},g=function(){var a={},b=!1,c=0,d=arguments.length;"[object Boolean]"===Object.prototype.toString.call(arguments[0])&&(b=arguments[0],c++);for(var e=function(c){for(var d in c)Object.prototype.hasOwnProperty.call(c,d)&&(b&&"[object Object]"===Object.prototype.toString.call(c[d])?a[d]=g(!0,a[d],c[d]):a[d]=c[d])};c<d;c++){e(arguments[c])}return a},h=function(){return document.querySelectorAll(b.svgSelector)},i=function(a){var c=h(),d=f(c.length,a);Array.prototype.forEach.call(c,function(a,c){var e=a.src||a.getAttribute("data-src"),f=a.attributes,g=new XMLHttpRequest;g.open("GET",e,!0),g.onload=function(){if(g.status>=200&&g.status<400){var c=new DOMParser,e=c.parseFromString(g.responseText,"text/xml"),h=e.getElementsByTagName("svg")[0];if(h.removeAttribute("xmlns:a"),h.removeAttribute("width"),h.removeAttribute("height"),h.removeAttribute("x"),h.removeAttribute("y"),h.removeAttribute("enable-background"),h.removeAttribute("xmlns:xlink"),h.removeAttribute("xml:space"),h.removeAttribute("version"),Array.prototype.slice.call(f).forEach(function(a){"src"!==a.name&&"alt"!==a.name&&h.setAttribute(a.name,a.value)}),h.classList?h.classList.add("inlined-svg"):h.className+=" inlined-svg",h.setAttribute("role","img"),f.longdesc){var i=document.createElementNS("http://www.w3.org/2000/svg","desc"),j=document.createTextNode(f.longdesc.value);i.appendChild(j),h.insertBefore(i,h.firstChild)}if(f.alt){h.setAttribute("aria-labelledby","title");var k=document.createElementNS("http://www.w3.org/2000/svg","title"),l=document.createTextNode(f.alt.value);k.appendChild(l),h.insertBefore(k,h.firstChild)}a.parentNode&&a.parentNode.replaceChild(h,a),d&&d(b.svgSelector)}else console.error("There was an error retrieving the source of the SVG.")},g.onerror=function(){console.error("There was an error connecting to the origin server.")},g.send()})};return c.init=function(a,c){d&&(b=g(e,a||{}),i(c||function(){}))},c});
// preloader

$(window).on('load', function() {
    var myHash = location.hash;
    //location.hash = '';
    if(myHash[1] != undefined){
      $('html, body').animate({scrollTop: $(myHash).offset().top - 100}, 1000);
    };
    var gets = (function() {
        var a = window.location.search;
        var b = new Object();
        a = a.substring(1).split("&");
        for (var i = 0; i < a.length; i++) {
          c = a[i].split("=");
            b[c[0]] = c[1];
        }
        return b;
    })();

    if(gets['data-id']){

        $('html,body').animate({ scrollTop: $('[data-id="#' + gets['data-id'] +'"]').offset().top - 100 }, 1000);
    }

    $('.preloader').fadeOut();
    $('preloader .pl').delay(350).fadeOut('slow');
});

function aeroBtnOnLoad() {
	setTimeout(() => {
		if ($('.project-build .custom-popup__video').is(':visible')){
			$('.project-photos .custom-popup__video').data('src', $('.project-build .custom-popup__video').data('src'));
			$('.project-photos .custom-popup__video').show();
			console.log('show');
		}
		if ($('.project-build .custom-popup__video').is(':hidden')) {
			$('.project-photos .custom-popup__video').hide();
			console.log('hide');
		}
	}, 1600);
}

function declOfNum(number, titles) { // функция склонения строки
    cases = [2, 0, 1, 1, 1, 2];
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
}


var queryLocalAll = localStorage.getItem('buildQuery');
if(queryLocalAll) {
    queryLocalAll = JSON.parse(queryLocalAll);
    // console.log(queryLocalAll);
}

//

class ApartmentControll {
    constructor() {

        this.dataObject = {
            currentElement: false,
            activeElement: false,
            lastQuery: {
                build: false,
                apartment: false,
            },
            mortgage: {
                items: {},
                itemsShow: {},
                option: {
                    credit: 2500000,
                    first: 1500000,
                    age: 10,
                },
                navOption: {
                    index: 0,
                    step: 5,
                }
            },
            firstOut: {
                load: true,
                list: false,
            },
            controllerBtn: {
                sliderPrevBtn:'<button type="button" class="slider-arrow slider-prev"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>',
                sliderNextBtn:'<button type="button" class="slider-arrow slider-next"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>'
            },
            mapIndexPage: {
                object: false,
                myBalloonLayout: false,
            },
            templates: {
                buildSectionUrl: "/newbuild/",
            },
            sort: {
                field: "price",
                nav: "ASC"
            }
        }
        ;

        this.crollBar = false;
        this.modeLoad = false;
        this.pathPage = document.location.pathname;

        if(this.pathPage.indexOf(`commercial`) != -1) {
            this.modeLoad = "commercial"
        } else if (this.pathPage.indexOf(`newbuild`) != -1 || this.pathPage == "/") {
            this.modeLoad = "flat";
        }

        if(this.modeLoad == "commercial") {
            this.dataObject.templates.buildSectionUrl = "/commercial/";
        }

        if( $(window).width() > 1200 ) {
            if( $('#results-screen').length ) {
                this.crollBar = this.initData().crollBar(`results-screen`);
            }
        }

    }
    initData() {
        let _this = this;
        return {
            map(dataFromAjax = false) {
                return new Promise((resolve, reject) => {
                    if ($('#map_index').length) {
                        function init() {
                            if (_this.dataObject.mapIndexPage.object === false) {

                                _this.dataObject.mapIndexPage.object = new ymaps.Map("map_index", {
                                    center: [59.937123, 30.311470],
                                    zoom: 9,
                                    controls: [/*'zoomControl'*/]
                                });
                                /*_this.dataObject.mapIndexPage.myBalloonLayout = ymaps.templateLayoutFactory.createClass(
                                    '<a class="close" href="#">&times;</a>' +
                                    '<div class="popover-img"><img src="/local/templates/fsk/img/marker.svg"></div>' +
                                    '<div><h3 class="popover-title">$[properties.balloonHeader]</h3>' +
                                    '<div class="popover-content">$[properties.balloonContent]</div>', {
                                    }
                                );*/
                                // Создание макета балуна на основе Twitter Bootstrap.
                                _this.dataObject.mapIndexPage.MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
                                    '<div class="popover top">' +
                                    '<div class="arrow"></div>' +
                                    '<div class="popover-inner">' +
                                    '$[[options.contentLayout observeSize minWidth=235]]' +
                                    '</div>' +
                                    '</div>', {
                                        build: function () {
                                            this.constructor.superclass.build.call(this);
                                            this._$element = $('.popover', this.getParentElement());
                                            this._$element.find('.close')
                                                .on('click', $.proxy(this.onCloseClick, this));
                                        },
                                        onCloseClick: function (e) {
                                            e.preventDefault();
                                            this.events.fire('userclose');
                                        },
                                    }),

                                    // Создание вложенного макета содержимого балуна.
                                    _this.dataObject.mapIndexPage.MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
                                        '<div class="popover-wrap">' +
                                        '<div class="popover-img"><img class = "lazyload" data-src="/local/templates/fsk/img/marker.svg"></div>' +
                                        '<div class="popover-content">' +
                                        /*'<a class="close" href="#">&times;</a>' +*/
                                        `<a href="$[properties.balloonUrl]"><h3 class="popover-title">$[properties.balloonHeader]</h3></a>` +
                                        '<div class="popover-text"><div class="p-metro flex"><div class="p-metro__branch" style="border-color: $[properties.metroColor];"></div><span>$[properties.metroName]</span></div></div>' +
                                        /*'<a class="popover-btn" href="$[properties.balloonUrl]">Подробнее</a>'+               $[properties.balloonContent]*/
                                        '</div>' +
                                        '</div>'
                                    )
                                /*_this.dataObject.mapIndexPage.object.behaviors.disable('scrollZoom');*/

                            }

                            var addresses;
                            reload_data();
                            set_placemarks();

                            function reload_data(success) {
                                let dataFromAjaxString = JSON.stringify(dataFromAjax);
                                let dataToJSONSpb = JSON.parse(dataFromAjaxString, function (key, value) {
                                    if (key == 'id') return +value;
                                    if (key == 'center' && value) {
                                        value = value.replace(/\s/g, '');
                                        let coordNumber = value.split(',');
                                        for (var i = 0; i < coordNumber.length; i++) {
                                            coordNumber[i] = +coordNumber[i];
                                        }
                                        return coordNumber;
                                    }
                                    return value;
                                });
                                addresses = dataToJSONSpb.items;
                            }

                            function set_placemarks() {
                                if (!addresses) return false;
                                _this.dataObject.mapIndexPage.object.geoObjects.removeAll();

                                var i = 0;
                                var myPlacemarks = [];
                                for (var j = 0; j < addresses.length; j++) {
                                    myPlacemarks[i++] = new ymaps.Placemark(addresses[j].center, {
                                        hintContent: addresses[j].name,
                                        dataId: addresses[j].id,
                                        balloonHeader: addresses[j].name,
                                        balloonContent: addresses[j].adress,
                                        balloonUrl: addresses[j].url,
                                        metroName: addresses[j].metro[0].UF_NAME,
                                        metroColor: addresses[j].metro[0].UF_COLOR,
                                    }, {
                                        iconLayout: 'default#image',
                                        iconImageHref: '/local/templates/fsk/img/marker.svg',
                                        iconImageSize: [30, 50],
                                        iconImageOffset: [-3, -35],
                                        balloonPanelMaxMapArea: 0,
                                        balloonShadow: false,
                                        /*balloonLayout: _this.dataObject.mapIndexPage.myBalloonLayout,*/
                                        balloonLayout: _this.dataObject.mapIndexPage.MyBalloonLayout,
                                        balloonContentLayout: _this.dataObject.mapIndexPage.MyBalloonContentLayout,
                                        hideIconOnBalloonOpen: false
                                    });
                                }

                                if (myPlacemarks.length) {
                                    for (var j = 0; j < myPlacemarks.length; j++) {
                                        _this.dataObject.mapIndexPage.object.geoObjects.add(myPlacemarks[j]);
                                    }
                                }
                            }
                        }

                        if (dataFromAjax === false) {
                            _this.getData().buildFilter();
                        } else {
                            ymaps.ready(init);
                        }

                    }
                    else {
                        if (dataFromAjax === false) {
                            _this.getData().buildFilter();
                        }
                    }
                });
            },
            event() {
                try {
                    $(document).ready(function(){
                        $.getJSON('/favourite/data.json', function(data) {
                            if(data != null) {
                                if(Object.keys(data).length){
                                    $('.link-favourite, .mob-link-favourite').addClass('active');
                                }
                            }

                        });
                    })
                } catch (e) {

                }



                $(document).on('keyup', '[data-name="first"] input, [data-name="credit"] input', function(){
                    $(this).val($(this).val().replace(/[^\+\d]/g, ''));
                });

                $(document).on('focus', '[data-name="credit"] input', function(){
                    let inputCredit = $(this);
                    let string = inputCredit.val().replace(/ /g, '');
                    inputCredit.val(string);
                })



                $(document).on('focus', '[data-name="first"] input', function(){
                    let inputFirst = $(this);
                    let string = inputFirst.val().replace(/ /g, '');
                    inputFirst.val(string);


                })




                $(document).on('blur', '[data-name="credit"] input', function(){
                    let inputCredit = $(this);
                    let inputCreditVal = parseInt(inputCredit.val());
                    let sosedInputFirstVal = $('[data-name="first"]').find('input').val().replace(/ /g, '');

                    if(parseInt(inputCreditVal) < parseInt(sosedInputFirstVal)){
                        inputCreditVal = parseInt(sosedInputFirstVal) + 100000;
                    }

                    if (typeof inputCreditVal === "string" || inputCreditVal instanceof String) {
                        inputCreditVal = parseInt(sosedInputFirstVal) + 100000;
                    }


                    inputCredit.val(inputCreditVal);
                    _this.setData().printMortgageData(this);

                    //inputCreditVal = parseInt(parseInt(inputCreditVal) / 100000) * 100000;
                    inputCreditVal = ('' + inputCreditVal).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                    //inputCredit.attr('type', 'text');
                    inputCredit.val(inputCreditVal);




                })



                $(document).on('blur', '[data-name="first"] input', function(){
                    let inputFirst = $(this);
                    let inputFirstVal = parseInt(inputFirst.val());
                    let sosedInputCreditVal = $('[data-name="credit"]').find('input').val().replace(/ /g, '');

                    if(parseInt(inputFirstVal) > parseInt(sosedInputCreditVal)){
                        inputFirstVal = parseInt(sosedInputCreditVal) - 100000;
                    }

                    if(parseInt(inputFirstVal) < 100000){
                        inputFirstVal = 100000;
                    }

                    console.log(inputFirstVal);

                    if (typeof inputFirstVal === "string" || inputFirstVal instanceof String) {
                        inputFirstVal = parseInt(sosedInputCreditVal) - 100000;
                    }

                    inputFirst.val(inputFirstVal);
                    _this.setData().printMortgageData(inputFirst);

                    //inputFirstVal = parseInt(parseInt(inputFirstVal) / 100000) * 100000;

                    inputFirstVal = ('' + inputFirstVal).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

                    inputFirst.val(inputFirstVal);


                })


                /* years ручной ввод */

                $(document).on('keyup', 'input.years', function(){
                    $(this).val($(this).val().replace(/[^\+\d]/g, ''));
                });

                $(document).on('input', 'input.years', function(){
                    let years = parseInt($(this).val().replace (/[^\+\d]/g, ''));
                    $(this).val(years);
                })
                $(document).on('focus', 'input.years', function(){
                    let years = parseInt($(this).val().replace (/[^\+\d]/g, ''));
                    $(this).val(years);
                })


                $(document).on('blur', 'input.years', function(){

                    let years = parseInt($(this).val().replace (/[^\+\d]/g, ''));
                    if($(this).val() > 30) {
                        years = 30;
                    } else if ($(this).val() < 1){
                        years = 1;
                    }
                    $(this).val(years + ' лет');


                    _this.setData().printMortgageData(this);
                })
                /* years ручной ввод конец */


                $(document).on('click','[data-event]',function() {
                    _this.eventList(this,this.getAttribute("data-event"));
                });
                $(document).on('change','[data-event-change]',function() {
                    _this.eventList(this,this.getAttribute("data-event-change"));
                });
                $(document).on('click','[data-plan]',function(e) {
                    $('[data-plan]').removeClass('current');
                    $(this).addClass('current');
                    $('.results__img').find('.img').attr('src', $(this).data('plan'));
                    if( $(window).width() < 1200 ) {
                        e.stopPropagation();
                        $.magnificPopup.open({
                            items: {
                                src: '#card-example',
                            },
                            type: 'inline',
                            callbacks: {
                                open: function() {
                                    $('body').addClass('mfp-card');
                                },
                                close: function() {
                                    $('body').removeClass('mfp-card');
                                }
                            }
                        });
                    }
                });
                $(document).on('click',`.interactive-print, .interactive-download`, function(e) {
                    let ifrm = document.createElement("iframe");
                    let id = this.getAttribute('data-id');
                    ifrm.setAttribute("src", `/print.php?ID=${id}`);
                    ifrm.style.width = "0px";
                    ifrm.style.height = "0px";
                    document.body.appendChild(ifrm);
                    e.preventDefault();
                    return false;
                });
            },
            crollBar(idElement) {
                return new SimpleBar(document.getElementById(idElement), {
                    autoHide: false
                });
            },
            buildStep() {
                try {
                    $('#gallery-2').slick({
                        infinite: false,
                        speed: 800,
                        fade: true,
                        focusOnSelect: false,
                        asNavFor: '#gallery-2-thumbs',
                        prevArrow: _this.dataObject.controllerBtn.sliderPrevBtn,
                        nextArrow: _this.dataObject.controllerBtn.sliderNextBtn,
                        responsive: [
                            {
                                breakpoint: 767,
                                settings: {
                                    arrows: false
                                }
                            }
                        ]
                    });

                    $('#gallery-2-thumbs').slick({
                        infinite: false,
                        slidesToShow: 8,
                        arrows: false,
                        speed: 800,
                        focusOnSelect: true,
                        asNavFor: '#gallery-2',
                        // variableWidth: true,
                        responsive: [
                            {
                                breakpoint: 1199,
                                settings: {
                                    slidesToShow: 6,
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 4,
                                }
                            }
                        ]
                    });

                  /*$('#gallery-2').on('afterChange', function (event) {
                    $('#gallery-2-thumbs').find('.slick-current').removeClass('slick-current');
                    $('#gallery-2-thumbs').find('[data-slick-index="' + $(this).find('.slick-current').data('slickIndex') + '"]').addClass('slick-current');
                  });*/

                } catch (e) {
                    console.log(e);
                }

            },
            mortgagePopup () {
                $('.ipo-table__row').magnificPopup({
                    items: {
                        src: '#ipo-request',
                        type: 'inline'
                    },
                    callbacks: {
                        open: function(e) {

                            let first = _this.dataObject.mortgage.option.first;
                            let credit = _this.dataObject.mortgage.option.credit - first;
                            let age = _this.dataObject.mortgage.option.age;
                            let id = $(this.st.el[0]).data(`id`);
                            let popupMortgage = $(`#ipo-request`);
                            let mortgage = _this.dataObject.mortgage.itemsShow[id];
                            let dataColBlock = $(popupMortgage).find(`.ipo-request__data .data-col`);

                            $(popupMortgage).find(`.ipo-request__header .img`).attr('src', mortgage['PROPERTIES']['UF_IMAGE']['VALUE']);

                            let data = `
                                <div class="data-col">
                                    <div>${mortgage['~NAME']}</div>
                                    <div class="sub-text">Лицензия № ${mortgage['PROPERTIES']['UF_NUMBER']['VALUE']} от ${mortgage['PROPERTIES']['UF_DATE']['VALUE']}</div>
                                </div>
                                <div class="data-row">
                                    <div class="data-col">
                                        <div class="sub-text text-bold">Ставка</div><span>от ${mortgage['PROPERTIES']['UF_VALUE']['VALUE']}%</span>
                                    </div>
                                    <div class="data-col">
                                        <div class="sub-text text-bold">Срок</div><span>${mortgage['PROPERTIES']['UF_STAV']['VALUE']} лет</span>
                                    </div>
                                    <div class="data-col">
                                        <div class="sub-text text-bold">Ежемесячный платёж, р.</div><span>${_this.helper().firstPriceMortgage(credit, mortgage['PROPERTIES']['UF_VALUE']['VALUE'], age)}</span>
                                    </div>
                                </div>
                            `

                            $(popupMortgage).find(`.ipo-request__data`).html(data);
                            $(popupMortgage).find('form [name="FIELDS[BANK_NAME]"]').val(`${mortgage['~NAME']}`);
                            $(popupMortgage).find('form [name="FIELDS[RATE]"]').val(`${mortgage['PROPERTIES']['UF_VALUE']['VALUE']}`);
                            $(popupMortgage).find('form [name="FIELDS[TERM]"]').val(`${mortgage['PROPERTIES']['UF_STAV']['VALUE']}`);
                            $(popupMortgage).find('form [name="FIELDS[PAYMENT]"]').val(`${_this.helper().firstPriceMortgage(credit, mortgage['PROPERTIES']['UF_VALUE']['VALUE'], age)}`);
                            /*$(popupMortgage).find('form [name="FIELDS[CUR_PAGE]"]').val(location.href);*/
                            $('body').addClass('mfp-card mfp-top');
                        },
                        close: function() {
                            $('body').removeClass('mfp-card mfp-top');
                        }
                    }
                });
            }
        }
    }
    getData() {
        let _this = this;
        return {
            mortgageFilter() {
                _this.getDataAjax({}, "Filter.InMortgage").then((request) => {
                    let result = request.result;
                    if(request.isSuccess) {
                        _this.dataObject.mortgage.items = result;
                        $('.show-more-ipoteka').show();
                        _this.setData().moreIpoteka(true);
                    }
                });
            },
            buildFilter (i) {

                let form = $(i).parents('form');
                let prelouder = $(i).parents('.container').find(`.filter-preloader`);
                let data = form.serializeArray();
                let jsonSend = {};

                $(prelouder).show();

                for(let element of data) {

                    if(
                        !$(form).hasClass('filter--toggle') &&
                        (
                            element['name'] == `PROPERTY_builtyear` && !element['value']
                        )
                    ) continue;

                    if(jsonSend[element['name']]) {
                        let type = typeof jsonSend[element['name']];
                        if( type === "string" ) {
                            let temp = jsonSend[element['name']];
                            jsonSend[element['name']] = [];
                            jsonSend[element['name']].push(temp);
                            jsonSend[element['name']].push(element['value']);
                        } else {
                            jsonSend[element['name']].push(element['value']);
                        }
                    } else {
                        jsonSend[element['name']] = element['value'];
                    }
                }

                if(_this.modeLoad === false) {
                    return false;
                }

                jsonSend[`PROPERTY_category`] = _this.modeLoad;

                _this.dataObject.lastQuery.build = jsonSend;

                _this.getDataAjax(jsonSend, "Filter.InBuildFilterCountElement").then((request) => {
                    $(prelouder).hide();
                    let result = request.result;
                    if(request.isSuccess && result.items) {
                        _this.initData().map(result);
                        _this.setData().printBuildLine(result);
                        // console.log(_this.pathPage);
                        if(_this.pathPage == `/commercial/`) {
                            if(!_this.dataObject.firstOut.load && result !== false) {
                                // console.log(`InBuildFilter`);
                                _this.getDataAjax(jsonSend, "Filter.InBuildFilter").then((request) => {
                                    $(prelouder).hide();
                                    let result = request.result;
                                    if(request.isSuccess && result) {
                                        $(`#p-6 .results .results__row.results__header`).show();
                                        $(`#p-6 .results .results__body`).show();
                                        $(`#p-6 .results .results-empty`).hide();
                                        _this.setData().printApartmentLine(result);
                                    } else {
                                        $(`#p-6 .results .results__row.results__header`).hide();
                                        $(`#p-6 .results .results__body`).hide();
                                        $(`#p-6 .results .results-empty`).show();
                                    }
                                });
                            }
                        }

                    } else {
                        _this.initData().map({});
                        _this.setData().printBuildLine(false,_this.dataObject.firstOut.list);
                    }
                    if(result.items) {
                        let endOfStr = declOfNum(result.items.length, ['объект', 'объекта', 'объектов']);
                        // $(`.results-geo__result`).html(`${result.items.length} объекта`);
                        $(`.results-geo__result`).html(result.items.length + ' ' + endOfStr);
                        aeroBtnOnLoad();
                    } else {
                        $(`.results-geo__result`).html(`0 объектов`);
                    }
                });

            },
            filterApartment (i) {
                return new Promise((resolve, reject) => {
                    let form = $(i).parents('form');
                    let prelouder = $(i).parents('.container').find(`.filter-preloader`);
                    let data = form.serializeArray();
                    let jsonSend = {};

                    $(prelouder).show();

                    for (let element of data) {

                        if (
                            !$(form).hasClass('filter--toggle') &&
                            (
                                element['name'] == `<=PROPERTY_kitchenspace` ||
                                element['name'] == `>=PROPERTY_kitchenspace`
                            )
                        ) continue;

                        if (jsonSend[element['name']]) {
                            let type = typeof jsonSend[element['name']];
                            if (type === "string") {
                                let temp = jsonSend[element['name']];
                                jsonSend[element['name']] = [];
                                jsonSend[element['name']].push(temp);
                                jsonSend[element['name']].push(element['value']);
                            } else {
                                jsonSend[element['name']].push(element['value']);
                            }
                        } else {
                            jsonSend[element['name']] = element['value'];
                        }
                    }

                    let queryLocal = localStorage.getItem('buildQuery');
                    if (queryLocal) {
                        queryLocal = JSON.parse(queryLocal);
                        console.log(queryLocal);
                        for (let itemF in queryLocal) {
                            let y = queryLocal[itemF];

                            if (jsonSend[itemF]) {
                                jsonSend[itemF] = y;
                                $(`[name='${itemF}']`).val(y);
                            }
                        }
                        $(`[href="#p-6"]`).trigger(`click`);
                        localStorage.removeItem('buildQuery');
                    }

                    if (_this.modeLoad === false) {
                        return false;
                    }

                    jsonSend[`PROPERTY_category`] = _this.modeLoad;

                    _this.getDataAjax(jsonSend, "Filter.InBuildFilter").then((request) => {
                        $(prelouder).hide();
                        let result = request.result;
                        if (request.isSuccess && result) {
                            $(`#p-6 .results .results__row.results__header`).show();
                            $(`#p-6 .results .results__body`).show();
                            $(`#p-6 .results .results-empty`).hide();
                            _this.setData().printApartmentLine(result);
                        } else {
                            $(`#p-6 .results .results__row.results__header`).hide();
                            $(`#p-6 .results .results__body`).hide();
                            $(`#p-6 .results .results-empty`).show();
                            // _this.setData().apartmentList(`<div style="text-align: center;width: 100%;padding: 25px 0px;font-size: 20px;height: 100%;">По вашему запросу ничего не найдено</div>`);
                        }
                        resolve();
                    });
                });
            }
        }
    }
    eventList(i,e) {
        let _this = this;
        switch (e) {
            case "getFilterBuild":
                _this.getData().buildFilter(i);
                break;
            case "getFilterApartment":
                _this.getData().filterApartment(i);
                break;
            case "updateResult":
                _this.getData().filterApartment(i);
                break;
            case "updatePopup":
                _this.setData().popupData(i);
                break;
            case "showMoreIpoteka":
                _this.setData().moreIpoteka();
                break;
            case "mortgageFilter":
                _this.setData().filterData(i);
                break;
            case "buildRedirect":
                _this.action().buildRedirect(i);
            break;
            case "sortApartmentFun":
                _this.action().sortApartmentFun(i);
                break;
            case "clearfilter":
                _this.action().clearFilter(i);
                break;
            case "loadPDF":
                _this.action().loadPDF(i);
            break;
        }
    }
    action() {
        let _this = this;
        return {
            loadPDF(e) {
                var request = $.ajax({
                    url: `https://api.restpack.io/pdf/preview/convert?url=https://fsknw.ru/print.php?ID=${$(e).data(`id`)}&json=true&pdf_page=A4&emulate_media=print`,
                    method: "GET",
                    dataType: "html"
                });
                request.done(function( msg ) {
                    let data = JSON.parse(msg);
                    window.open(data.file, '_blank');
                });
                return false;
            },
            clearFilter(e) {
                let form = e.closest('form');
                let inputTxt = form.querySelectorAll(`input:not([type="hidden"]):not([type="checkbox"])`);
                let inputCheckbox = form.querySelectorAll(`input:checked[type="checkbox"]:not([type="hidden"])`);

                inputCheckbox.forEach(function(item, i, arr) {
                    item.checked = false;
                });

                inputTxt.forEach(function(item, i, arr) {
                    let uirange = item.closest(`.ui-range`);
                    let name = item.getAttribute(`name`);
                    if(uirange) {
                        let uislider = uirange.querySelectorAll(`.ui-slider`)[0];
                        let value = false;
                        if(name.indexOf(`>=`) != -1) {
                            value = uislider.getAttribute(`data-min`);
                        } else if (name.indexOf(`<=`) != -1) {
                            value = uislider.getAttribute(`data-max`);
                        }
                        $(item).val(value);
                        $(item).trigger(`change`);
                    } else {
                        console.log("не изветсное значение");
                    }
                });
            },
            buildRedirect(e){
                let href = e.getAttribute('data-href');
                localStorage.setItem('buildQuery', JSON.stringify(_this.dataObject.lastQuery.build));
                window.location = href;
            },
            sortApartmentFun(e) {

                $('.sort--active').removeClass('sort--active');
                $(e).addClass('sort--active');
                $(e).removeClass('sort--flip');

                let field = $(e).data(`field`);
                if( _this.dataObject.sort.field == field ) {
                    if(_this.dataObject.sort.nav == "ASC") {
                        _this.dataObject.sort.nav = "DESC";
                        $(e).removeClass('sort--flip');
                    } else {
                        _this.dataObject.sort.nav = "ASC";
                        $(e).addClass('sort--flip');
                    }
                } else {
                    _this.dataObject.sort.field = field;
                    $(e).addClass('sort--flip');
                    _this.dataObject.sort.nav = "ASC";
                }



                _this.setData().printApartmentLine({
                    'arResultCart' : _this.dataObject.currentElement,
                    'cartStaticInfo' : _this.dataObject.cartStaticInfo
                });
            },
            setImgPopupBlock(plan,index, mini){

                let poppupForm = $(`#card-example`);
                let planBlockNew = $(poppupForm).find(`.card__col-2 .card__img`).eq(index);
                if(index == -1) {
                    $(poppupForm).find(`.card__tabs .js-tab`).css('width','360px');
                    $(poppupForm).find(`.card__tabs .js-tab`).eq(index).hide();
                    planBlockNew.hide();
                    //return false;
                } else {
                    if(!mini) {
                        planBlockNew.find(`.img-empty`).show();
                        plan = `/local/templates/fsk/img/svg-logo-gray.svg`;
                        planBlockNew.find(`.img`).hide();
                        planBlockNew.append('<div class="img img-empty"></div>');
                    } else {
                        planBlockNew.find(`.img`).show();
                        planBlockNew.find(`.img`).attr('src', mini);
                        planBlockNew.find(`.img`).attr('data-src', mini);
                        planBlockNew.find(`.img-empty`).hide();
                        planBlockNew.find(`button.zoom-link`).attr('href', plan);
                    }
                }


            }
        }
    }
    setData() {
        let _this = this;
        return {
            filterData(e) {

                let parent = e.closest(`.filter-field`);
                let field =  parent.getAttribute(`data-name`);

                var $_inp = $(e).closest('.ui-quantity').find('input');
                var $_step = +$(e).closest('.ui-quantity').data('step');
                var oldValue = parseInt( $(e).closest('.ui-quantity').find('input').val().replace(/\s/g, '') );
                if( $(e).hasClass('ui-quantity__minus') ) {
                    if(oldValue == $_step){
                        return false
                    } else {
                        var $_val = oldValue - $_step;
                    }

                } else {
                    var $_val = oldValue + $_step;
                }
                let value = $_val;

                $_val = ("" + $_val).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

                if( $_inp.hasClass('years') ) {

                    if (value > 30 || value < 1) {
                        if(value > 30) {
                            $_inp.val( 30 );
                        } else if (value < 1) {
                            $_inp.val( 1 );
                        }
                        return false;
                    }
                    $_inp.val( $_val );
                } else {
                    $_inp.val($_val);
                }

                _this.dataObject.mortgage.option[field] = value;

                if(_this.dataObject.mortgage.option['credit'] <= _this.dataObject.mortgage.option['first']) {
                    $_val = ("" + oldValue).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                    _this.dataObject.mortgage.option[field] = oldValue;
                    $_inp.val($_val);
                    return false;
                }


                let str = ``;

                str += _this.templates().outMortgageHead();

                let items = _this.dataObject.mortgage.items;
                let stringOut = ``;
                let countItems = items.length;

                for( let index in _this.dataObject.mortgage.itemsShow ) {
                    let mortgage = _this.dataObject.mortgage.itemsShow[index];
                    str += _this.templates().outMortgage(mortgage, index);
                }

                $(`.ipo-table`).html(str);

                $_inp.trigger('propertychange');
                _this.initData().mortgagePopup();
                return false;
            },
            moreIpoteka(first = false) {
                let str = ``;
                if(first) {
                    str += _this.templates().outMortgageHead();
                }
                let items = _this.dataObject.mortgage.items;
                let stringOut = ``;
                let countItems = items.length;

                for( let i = 0; i < _this.dataObject.mortgage.navOption.step; i++ ) {

                    let index = _this.dataObject.mortgage.navOption.index;
                    let mortgage = items[index];

                    _this.dataObject.mortgage.itemsShow[index] = mortgage;
                    str += _this.templates().outMortgage(mortgage,index);
                    _this.dataObject.mortgage.navOption.index++;

                    if(countItems <= _this.dataObject.mortgage.navOption.index) {
                        $('.show-more-ipoteka').hide();
                        break;
                    }

                }

                if(first) {
                    //console.log(str, 'moreIpoteka', 'str');
                    $(`.ipo-table`).html(str);
                } else {
                    $(`.ipo-table`).append(str);
                }
                _this.initData().mortgagePopup();
            },
            printBuildLine(result, listEmpty) {
                let stringOut = ``;
                let stringOutTwo = ``;
				let countTypeApartment = 1;
                if(result) {
					countTypeApartment = 0;
                    let sections = result.section;
                    let items  = result.items;
                    let buildInfo = result.info;
                    let i =0;
                    for (let section of sections) {
                        let item = items[i];
						countTypeApartment += section.resultFilterApartment.length;
                        stringOut += _this.templates().outBuildLineOne(section,item);
                        stringOutTwo += _this.templates().outBuildLineTwo(section,item);
                        i++;

                    }
                } else {
                    stringOut = `<div class="results-empty">По вашему запросу ничего не найдено.</div>`;
                    let sections = listEmpty.section;
                    let items  = listEmpty.items;
                    let i =0;
                    for (let section of sections) {
                        let item = items[i];
                        stringOut += _this.templates().outBuildLineOne(section, item);
                        stringOutTwo += _this.templates().outBuildLineTwo(section, item);
                        i++;
                    }
                }
				if(countTypeApartment == 0) {
					let temp = stringOutTwo;
					stringOutTwo = `<div class="results-empty" style="width: 100%;border: 1px dashed #E5E8E8;margin-bottom: 20px;">По вашему запросу ничего не найдено. Ознакомьтесь с доступными вариантами ниже.</div>`;
					stringOutTwo += temp;
				}
                if(_this.dataObject.firstOut.load || result === false) {
                    _this.dataObject.firstOut.load = false;

                    if(result !== false) _this.dataObject.firstOut.list = result;
                    if(_this.pathPage == `/newbuild/` || _this.pathPage == `/commercial/` || _this.pathPage == `/`) {
                        $(`.quarter-list.view-1`).html(stringOut);
                        $(`.quarter-list.view-2 .f-row`).html(``);
                    }
                    if(_this.pathPage == `/commercial/`) {
                        $(`.results.results--nofloors`).hide();
                        $(`.container.section-margin`).show();
                    }
                } else {

                    if(_this.pathPage == `/commercial/`) {
                        $(`.results.results--nofloors`).show();
                        $(`.quarter-list.view-1`).html(``);
                        $(`.container.section-margin`).hide();
                    } else {
                        $(`.quarter-list.view-1`).html(``);
                        $(`.quarter-list.view-2 .f-row`).html(stringOutTwo);
                    }
                }


            },
            printApartmentLine(result) {
                _this.dataObject.currentElement = Object.assign({}, result.arResultCart);
                _this.dataObject.cartStaticInfo = Object.assign({}, result.cartStaticInfo);
                let stringOut = ``;
                let first = false;
                for(let key in result.cartStaticInfo) {
                    let category = result.cartStaticInfo[key];
                    let minArea = Math.min.apply(null, category.area);
                    let maxArea = Math.max.apply(null, category.area);
                    let minPrice = _this.helper().XFormatPrice(Math.min.apply(null, category.price));
                    let maxPrice = _this.helper().XFormatPrice(Math.max.apply(null, category.price));
                    let floorFullName = _this.helper().getFloorNameFull(key);

                    if( _this.modeLoad == "flat" ) {

                        stringOut += `
						<div class="results__row results-screen__header">
                            <div>${floorFullName} от <span class="filter-data">${minArea} </span>до <span class="filter-data">${maxArea} </span>м<sup>2</sup></div>
                        `;
                            if(minPrice !== NaN && minPrice && minPrice != NaN && minPrice != "NaN"){
                                stringOut += `<div>от <span class="filter-data">${minPrice} р.</span></div>`;
                            }
                        stringOut += `</div>`;
                    } else {
                        $(`.results-cell-3`).hide();

                        stringOut += `
						<div class="results__row results-screen__header">
                            <div>${key}</div>
                        `;
                            if(minPrice !== NaN && minPrice && minPrice != NaN && minPrice != "NaN"){
                                stringOut += `<div>от <span class="filter-data">${minPrice} р.</span></div>`;
                            }
                        stringOut += `</div>`;
                    }

                    let nm = {  };
                    var indexInndeSort = 0;

                    Object.keys(result.arResultCart[key]).sort(function (a, b) {
                        let z =  parseFloat(result.arResultCart[key][a].PROPERTIES[_this.dataObject.sort.field].VALUE);
                        let x =  parseFloat(result.arResultCart[key][b].PROPERTIES[_this.dataObject.sort.field].VALUE);

                        if(_this.dataObject.sort.nav == "ASC") {
                            return z - x;
                        } else {
                            return x - z;
                        }

                    }).forEach(function (v) {
                        nm[indexInndeSort] = result.arResultCart[key][v];
                        indexInndeSort++;
                    });

                    result.arResultCart[key] = nm;

                    let countApartment = _this.helper().getFloorName(key);
                    for(let keyCart in result.arResultCart[key]) {
                        let cart = result.arResultCart[key][keyCart];
                        let maxFloor =  Math.max.apply(null, cart['PROPERTIES']['floor']['VALUE']);
                        let minFloor =  Math.min.apply(null, cart['PROPERTIES']['floor']['VALUE']);
                        let stringFloor = ((minFloor != maxFloor) && maxFloor) ? `${minFloor}...${maxFloor}` : minFloor;

                        if(first === false) {
                            first = document.createElement("div");
                            first.setAttribute(`data-count`, key);
                            first.setAttribute(`data-area`, cart['PROPERTIES']['area']['VALUE']);
                            first.setAttribute(`data-area-id`, keyCart);
                            first.setAttribute(`data-plan`, cart['PROPERTIES']['image_out_big']['VALUE']);
                        }

                        if(!cart['PROPERTIES']['image_out']['VALUE']) {
                            cart['PROPERTIES']['image_out']['VALUE'] = `/local/templates/fsk/img/svg-logo-gray.svg`;
                        }
                        if(!cart['PROPERTIES']['image_out_big']['VALUE']) {
                            cart['PROPERTIES']['image_out_big']['VALUE'] = `/local/templates/fsk/img/svg-logo-gray.svg`;
                        }

                        let price = _this.helper().XFormatPrice(cart['PROPERTIES']['price100']['VALUE']);
                                stringOut += `  <div class="results__row" data-area-id="${cart['PROPERTIES']['area_dop']['VALUE']}" data-event="updatePopup" data-count="${key}" data-area="${cart['PROPERTIES']['area']['VALUE']}"  data-id="${result.arResultCart[key][keyCart]['ID']}" data-plan="${cart['PROPERTIES']['image_out_big']['VALUE']}"> `;
                               if(cart['PROPERTIES']['image_out']['VALUE']){
                                   stringOut += ` <div class="results__cell results-cell-1 js-call-card" style="min-height: 60px;"><img class="img plan-thumb lazyload" data-src="${cart['PROPERTIES']['image_out']['VALUE']}" alt="alt"></div> `;
                               }else{
                                   stringOut +='<div class="results__cell results-cell-1 js-call-card" style="min-height: 60px;"><div class="img img-empty"></div></div>';
                               };


                                stringOut += `<div class="results__cell results-cell-2"><span>${cart['PROPERTIES']['area']['VALUE']} м<sup>2</sup></span></div>`;
                                if( _this.modeLoad == "flat" ) stringOut += `<div class="results__cell results-cell-3"><span>${stringFloor}</span></div>`;
                                stringOut += `<div class="results__cell results-cell-4"><span>${cart['PROPERTIES']['builtyear']['VALUE']}</span></div>`;
                                stringOut += `<div class="results__cell results-cell-5">`;

                                if(price !== NaN && price && price != NaN && price != "NaN"){
                                    stringOut += `<span>${price} р.</span>`
                                } else {
                                    stringOut += `<span class="dashed-underline">По запросу</span>`
                                }

                                stringOut +=`        
                                </div>
                                    <div class="results-cell-mob">
                                            <p class="data-1">${countApartment} - ${cart['PROPERTIES']['area']['VALUE']} м<sup>2</sup></p>
                                            ${price !== NaN && price && price != NaN && price != "NaN" ? `<p class="data-2"> <span>${price} </span>р.</p>` : `<p class="data-2"><span class="dashed-underline">По запросу</span></p>`}
                                        </div>
                                        <div class="results-cell-btns">
                                          <button class="interactive-btn interactive-follow" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg ic-arrow inlined-svg" width="20" height="20" role="img" aria-labelledby="title"><title>Перейти</title><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"></path><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"></path></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"></line></g></g></svg></button>
                                        </div>
                                    </div>

                                `;
                    }
                    //<button class="interactive-btn interactive-follow" type="button"><img class="svg ic-arrow" src="/local/templates/fsk/img/icons/ic-arrow.svg" width="20" height="20" alt="Перейти"></button>
                }
                _this.setData().apartmentList(stringOut);
                //_this.setData().popupData(first);
            },
            apartmentList(html) {
                if( $('#results-screen').length ) {
                    $(`#results-screen .simplebar-content`).html(html);
                    _this.crollBar = _this.initData().crollBar(`results-screen`);

                    if( $(window).width() >= 1200 ) {
                        $(`.simplebar-content .results__row:not(.results-screen__header):first`).trigger(`click`);
                    }

                    $('.js-call-card').magnificPopup({
                        items: {
                            src: '#card-example',
                            type: 'inline'
                        },
                        callbacks: {
                            open: function() {
                                $('body').addClass('mfp-card');
                            },
                            close: function() {
                                $('body').removeClass('mfp-card');
                            }
                        }
                    });
                }
            },
            popupData(i){
                let count = $(i).data(`count`);
                let area  = $(i).data(`area-id`);
                let element = _this.dataObject.currentElement[count][area];
                let prop = element['PROPERTIES'];
                let elementArea = prop['area'];
                let poppupForm = $(`#card-example`);
                let maxFloor =  Math.max.apply(null, prop['floor']['VALUE']);
                let minFloor =  Math.min.apply(null, prop['floor']['VALUE']);
                let stringFloor = ((minFloor != maxFloor) && maxFloor) ? `${minFloor}...${maxFloor}` : minFloor;
                //console.log('ID - '+element.ID+', Название - '+element.NAME+'м.кв.');
                document.querySelector('#callback input[name="FIELDS[OBJECT]"]').value = 'ID - '+_this.helper().XFormatPrice(element['CODE'])+', Название - '+element.NAME+'м.кв.';

                let plan = false;
                if(element['PROPERTIES']['image_out_big']['VALUE']) {
                    plan = element['PROPERTIES']['image_out_big']['VALUE'];
                }
                let planBlock = $(poppupForm).find(`.card__col-2 .card__img`).eq(0);
                try {
                    if(element['PROPERTIES']['image_out_new']['VALUE'] == undefined) element['PROPERTIES']['image_out_new']['VALUE'] = {};
                    if(element['PROPERTIES']['image_out_new']['VALUE'].plan == undefined) element['PROPERTIES']['image_out_new']['VALUE'].plan = {};
                        _this.action().setImgPopupBlock(plan, 0, element['PROPERTIES']['image_out_new']['VALUE']['plan']);
                }catch (e) {
                    console.log(e);
                }

                if(element['PROPERTIES']['image_out_big_new'] != undefined) {
                	_this.action().setImgPopupBlock(element['PROPERTIES']['image_out_big_new']['floor_plan'],1,element['PROPERTIES']['image_out_new']['VALUE']['floor_plan']);
                    _this.action().setImgPopupBlock(element['PROPERTIES']['image_out_big_new']['section'],2,element['PROPERTIES']['image_out_new']['VALUE']['section']);
                    _this.action().setImgPopupBlock(element['PROPERTIES']['image_out_big_new']['decoration'],3,element['PROPERTIES']['image_out_new']['VALUE']['decoration']);
                }
                if ( element.PROPERTIES.UF_STATUS.VALUE==='Забронирована'){//изменение кнопки если зарезервирована
                    var btns = document.querySelectorAll('[data-type="reserveBtn"]');
                    for (i = 0; i < btns.length; ++i) {
                        btns[i].style.display = "none";
                    }
                    var reserve = document.querySelectorAll('[data-type="reserved"]');
                    for (i = 0; i < reserve.length; ++i) {
                        reserve[i].style.display = "inline-flex";
                    }
                }else{
                    var btns = document.querySelectorAll('[data-type="reserveBtn"]');
                    for (i = 0; i < btns.length; ++i) {
                        btns[i].style.display = "inline-flex";
                    }
                    var reserve = document.querySelectorAll('[data-type="reserved"]');
                    for (i = 0; i < reserve.length; ++i) {
                        reserve[i].style.display = "none";
                    }
                }
               // console.log(element.PROPERTIES.UF_STATUS.VALUE);
                var reserve = document.querySelectorAll('[data-type="reserveBtn"]');
                for (i = 0; i < reserve.length; ++i) {
                    reserve[i].dataset.id =element.ID;
                }
                //poppupForm.find('[data-type="reserveBtn"]').attr('data-id',element.ID);

                poppupForm.find('[data-event="loadPDF"]').attr('data-id',element.ID);
                poppupForm.find('[data-role="favorite"]').attr('data-id',element.ID);
                let cardInfo = $(poppupForm).find(`.card__info .card-data`);
                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    $(cardInfo).find(`.card-data__title`).html(`Лот ${element.NAME.split(' ').pop()} м<sup>2</sup>`);
                }else{
                    $(cardInfo).find(`.card-data__title`).html(`${element.NAME} м<sup>2</sup>`);
                }


                let listParam = $(cardInfo).find(`.card-data__list li`);
                $(listParam).eq(0).find(`span`).eq(1).html(`${prop['area']['VALUE']} м<sup>2</sup>`);

                if(prop['livingspace']['VALUE']) {
                    $(listParam).eq(1).find(`span`).eq(1).html(`${prop['livingspace']['VALUE']} м<sup>2</sup>`);
                    $(listParam).eq(1).show();
                } else {
                    $(listParam).eq(1).hide();
                }

                if(prop['kitchenspace']['VALUE']){
                    $(listParam).eq(2).find(`span`).eq(1).html(`${prop['kitchenspace']['VALUE']} м<sup>2</sup>`);
                    $(listParam).eq(2).show();
                } else {
                    $(listParam).eq(2).hide();
                }

                $(listParam).eq(3).find(`span`).eq(1).html(`${stringFloor}/${prop['floorstotal']['VALUE']}`);
                $(listParam).eq(4).hide();
                $(listParam).eq(5).hide();
                //$(listParam).eq(4).remove();
                //$(listParam).eq(5).remove();
                if(prop['renovation']['VALUE']) { $(listParam).eq(6).find(`span`).eq(1).html(`${prop['renovation']['VALUE']}`); } else { $(listParam).eq(6).hide(); }
                if(prop['buildingphase']['VALUE']) { $(listParam).eq(7).find(`span`).eq(1).html(`${prop['buildingphase']['VALUE']}`); } else { $(listParam).eq(7).hide(); }
                if(prop['electriccapacity']['VALUE']) { $(listParam).eq(8).find(`span`).eq(1).html(`${prop['electriccapacity']['VALUE']} кВт`); } else { $(listParam).eq(8).hide(); }
                if(prop['watersupply']['VALUE']) { $(listParam).eq(9).find(`span`).eq(1).html(`Есть`); } else { $(listParam).eq(9).hide(); }
                if(prop['commercialtype']['VALUE']) { $(listParam).eq(10).find(`span`).eq(1).html(`${prop['commercialtype']['VALUE']}`); } else { $(listParam).eq(10).hide(); }

                $(`[data-role='favorite']`).attr('data-id',element.ID);
                $('[data-event="loadPDF"]').attr('data-id',element.ID);
                $(`.interactive-print`).attr('data-id',element.ID)
                $(`.interactive-download`).attr('data-id',element.ID)

                let priceOld = _this.helper().XFormatPrice(prop['price']['VALUE']);
                let priceNew = _this.helper().XFormatPrice(prop['price100']['VALUE']);

                if(priceOld !== NaN && priceOld && priceOld != NaN && priceOld != "NaN"){
                    $(cardInfo).find(`.card-data__col-2 .card-price-2`).html(`Стандартная цена: <span>${priceOld}</span>`);
                } else {
                    $(cardInfo).find(`.card-data__col-2 .card-price-2`).html(`Стандартная цена: <span class="dashed-underline">по запросу</span>`);
                }
                if(priceNew !== NaN && priceNew && priceNew != NaN && priceNew != "NaN"){
                    $(cardInfo).find(`.card-data__col-2 .card-price-1`).html(`Цена по акции: <span>${priceNew}</span>`);
                } else {
                    $(cardInfo).find(`.card-data__col-2 .card-price-1`).html(`Цена по акции: <span class="dashed-underline">по запросу</span>`);
                }
                $(cardInfo).find(`.card-data__col-2 .card-id`).html(`ID объекта: ${_this.helper().XFormatPrice(element['CODE'])}`);
                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    $(poppupForm).find(`.card__title`).html(`Лот ${element.NAME.split(' ').pop()} м<sup>2</sup>`);
                }else{
                    $(poppupForm).find(`.card__title`).html(`${element.NAME} м<sup>2</sup>`);
                }


                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    $(`#results-offer-square-text`).html(`Интересует лот ${element.NAME.split(' ').pop()} м<sup>2</sup>?`);
                }else{
                    $(`#results-offer-square-text`).html(`Интересует ${element.NAME} м<sup>2</sup>?`);
                }


                $.getJSON('/favourite/data.json', function(data) {
                    if(data != undefined && data != null) {
                        //console.log(data[element.ID]);
                        if(data[element.ID] != undefined ) {
                            $(`[data-role="favorite"][data-id="${element.ID}"]`).addClass(`active`);
                            return true;
                        }
                    }
                    $(`[data-role="favorite"][data-id="${element.ID}"]`).removeClass(`active`);
                    //$('.link-favourite, .mob-link-favourite').removeClass('active');
                    if($('.results-empty.favourite-empty').length){
                        $('.results-empty.favourite-empty').css('display', 'flex');
                    }

                    //$(`[data-role="favorite"][data-id="${element.ID}"]`).remove(`active`);
                    return false;
                });

            },
            printMortgageData(tr){
                let field = $(tr).closest('.filter__field').data('name');
                let value = parseInt($(tr).val());
                // console.log(value);
                _this.dataObject.mortgage.option[field] = value;


                let str = ``;

                str += _this.templates().outMortgageHead();
                let items = _this.dataObject.mortgage.items;
                let stringOut = ``;
                let countItems = items.length;
                for( let index in _this.dataObject.mortgage.itemsShow ) {
                    let mortgage = _this.dataObject.mortgage.itemsShow[index];
                    str += _this.templates().outMortgage(mortgage, index);
                }
                $('.ipo-table').html(str);
                _this.initData().mortgagePopup();
            }
        }
    }
    helper(){
        let _this = this;
        return {
            firstPriceMortgage (sum, rate, period) {
                let i,koef,result;
                i = (rate / 12) / 100;
                koef = (i * (Math.pow(1 + i, period * 12))) / (Math.pow(1 + i, period * 12) - 1);
                result = sum * koef;
                return this.XFormatPrice(result.toFixed());
                /*
                stavka = stavka/100;
                let a = Math.pow(1+stavka,srok);
                return this.XFormatPrice(summa*stavka*a/(a-1));
                */
            },
            XFormatPrice(_number) {
                var decimal=0;
                var separator=' ';
                var decpoint = '.';
                var format_string = '#';

                var r = parseFloat(_number)

                var exp10=Math.pow(10,decimal);// приводим к правильному множителю
                r=Math.round(r*exp10)/exp10;// округляем до необходимого числа знаков после запятой

                let rr = Number(r).toFixed(decimal).toString().split('.');

                let b=rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);

                r=(rr[1]?b+ decpoint +rr[1]:b);
                return format_string.replace('#', r);
            },
            getFloorName($count) {
                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    return "Лот";
                } else {
                    switch ($count) {
                        case "0":
                            return "Студия";
                            break;
                        case "1":
                            return "1-к квартира";
                            break;
                        case "2":
                            return "2-к квартира";
                            break;
                        case "3":
                            return "3-к квартира";
                            break;
                        case "4":
                            return "4-к квартира";
                            break;
                        case "5":
                            return "5-к квартира";
                            break;
                    }
                }
            },
            getFloorNameFull ($count) {
                if(document.querySelector(`[href="#p-6"]`) && document.querySelector(`[href="#p-6"]`).innerText == "Апартаменты") {
                    return "Апартаменты";
                } else {
                    switch ($count) {
                        case "0": return "Квартиры студии"; break;
                        case "1": return "Однокомнатные квартиры";    break;
                        case "2": return "Двухкомнатные квартиры";    break;
                        case "3": return "Трехкомнатные квартиры";    break;
                        case "4": return "Четырехкомнатные квартиры"; break;
                        case "5": return "Пятикомнатные квартиры";    break;
                    }
                }

            },
            colorIntensive(hex) {
                let rgb = _this.helper().hexToRgb(hex);
                if(hex && rgb !== null) {
                    let intensive = (0.2126 * rgb.r + 0.7152 * rgb.g + 0.0722 * rgb.b);
                    return intensive;
                } else {
                    return false;
                }

            },
            componentToHex(c) {
                let hex = c.toString(16);
                return hex.length == 1 ? "0" + hex : hex;
            },
            rgbToHex(r, g, b) {
                return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
            },
            hexToRgb(hex) {
                let result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                return result ? {
                    r: parseInt(result[1], 16),
                    g: parseInt(result[2], 16),
                    b: parseInt(result[3], 16)
                } : null;
            },
            decodeHtmlEntity(str){
                return str.replace(/&#(\d+);/g, function(match, dec) {
                    return String.fromCharCode(dec);
                });
            },
            encodeHtmlEntity(str){
                var buf = [];
                for (var i=str.length-1;i>=0;i--) {
                    buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
                }
                return buf.join('');
            },
        }
    }
    poppup(){
        let _this = this;
        return {
            show(block) {
                $(block).show();
            },
            hide(block) {
                $(block).hide();
            }
        }
    }
    getDataAjax(data = {}, act = "", callbackFun) {
        return new Promise((resolve, reject) => {
            // console.log(act)
            let request = $.ajax({
                context: this,
                url: `/ajax/?act=${act}`,
                type: "POST",
                cache: false,
                async: true,
                dataType: "json",
                data: data,
            });
            request.done((response) => {
                resolve(response);
            });
            request.fail(( jqXHR, textStatus ) => {
                reject();
                console.log( "Request failed: " + textStatus );
            });
        })
    }
    validation() {
        let _this = this;
        return {
            checkEmpty(v) {
                return (typeof v === "undefined" || v === null || v ===  "");
            },
        }
    }
    templates () {
        let _this = this;
        return {
            outMortgageHead() {
                return `
                     <div class="ipo-table__row ipo-table__header">
                        <div class="ipo-bank">Банк</div>
                        <div class="ipo-info">
                            <div class="ipo-info__col">
                                <span class="hide-on-mob">Ежемес. </span>платёж, от
                            </div>
                            <div class="ipo-info__col">Срок</div>
                            <div class="ipo-info__col">Ставка, от</div>
                        </div>
                    </div>
                `;
            },
            outMortgage(mortgage, index) {
                let stringOut = ``;
                let first = _this.dataObject.mortgage.option.first;
                let credit = _this.dataObject.mortgage.option.credit - first;
                let age = _this.dataObject.mortgage.option.age;
                if(mortgage === undefined) return "";
                if(mortgage['PROPERTIES'] === undefined) return "";
                stringOut += `
                <div class="ipo-table__row ipo-table__item" data-id = "${index}">
                    <div class="ipo-bank">
                        <img class="img lazyload" data-src="${mortgage['PROPERTIES']['UF_IMAGE']['VALUE']}" title="${mortgage['~NAME']}" alt="${mortgage['~NAME']}">
                    </div>
                    <div class="ipo-licence">
                        <div>${mortgage['~NAME']}</div>
                        <span class="sub-text">Лицензия № ${mortgage['PROPERTIES']['UF_NUMBER']['VALUE']} от ${mortgage['PROPERTIES']['UF_DATE']['VALUE']}</span>
                    </div>
                    <div class="ipo-info">
                        <div class="ipo-info__col" data-title="Ежемес. платёж, от">${_this.helper().firstPriceMortgage(credit, mortgage['PROPERTIES']['UF_VALUE']['VALUE'], age)} р.</div>
                        <div class="ipo-info__col" data-title="Срок">до ${mortgage['PROPERTIES']['UF_STAV']['VALUE']} лет</div>
                        <div class="ipo-info__col" data-title="Ставка">${mortgage['PROPERTIES']['UF_VALUE']['VALUE']}%</div>
                    </div>
                </div>
                `;
                return stringOut;
            },
            outBuildLineOne (section,item) {
                // console.log(section)
                let stringOut = ``;
                stringOut += `<div class="quarter">`;
                if (section['UF_PHOTO'] === null || section['UF_PHOTO']===''){}else{
                    section['PICTURE'] = section['UF_PHOTO'];
                }
                    if( section['PICTURE'] === null ) {
                        stringOut += `
                        <a href="${item['url']}"  class="quarter__img-wrap quarter-link">
                            <div class="img img-empty"></div>
                        </a>
                        `;
                    } else {
                        stringOut += `<a href="${item['url']}" class="quarter__img-wrap quarter-link"><img class="quarter__img lazyload" data-src="${section['PICTURE']}" alt="alt">`;
                            if(section['INFO']['PROPERTY']['UF_MAIN_ICON']['VALUE']) {
                                stringOut += `
                                <div class="quarter__overlay">
                                    <img class="img lazyload" data-src="${section['INFO']['PROPERTY']['UF_MAIN_ICON']['VALUE']}" width="277" height="70" alt="alt">
                                </div>
                                `;
                            }
                        stringOut += `</a>`;
                    }

                    stringOut += `<div class="quarter__content">`;
                            stringOut += `<a href="${item['url']}" class="quarter__title">${section['NAME']}</a>`;
                            stringOut += `<div class="quarter__transport flex">`;
                                if(section['INFO']['metro']) {
                                    for (let metro of section['INFO']['metro']) {
                                        stringOut += `
                                        <div class="p-metro flex">
                                            <div class="p-metro__branch" style="border-color: ${metro['UF_COLOR']};"></div>
                                            <span>${metro['UF_NAME']}</span>
                                        </div>
                                        `;
                                    }
                                }
                                if(section['INFO']['PROPERTY']['UF_WALK_TIME']['VALUE']) {
                                    stringOut += `
                                    <div class="p-distance flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 13.201" class="svg inlined-svg" width="8" height="13" role="img" aria-labelledby="title"><title>alt</title>
                                          <path id="Walking_Copy_3" data-name="Walking Copy 3" d="M6.436,13.2a.752.752,0,0,1-.64-.356L3.691,9.583l-.26-.4L2.51,7.753a.949.949,0,0,1-.146-.779l.041-.2.487-2.326a2.978,2.978,0,0,0-1.1.92,3.663,3.663,0,0,0-.281,1.9.53.53,0,1,1-1.059,0A4.54,4.54,0,0,1,.888,4.825a4.127,4.127,0,0,1,1.683-1.41A2.969,2.969,0,0,1,3.9,3.1h.356a.861.861,0,0,1,.665.332.833.833,0,0,1,.162.716L4.687,5.783,4.5,6.571,4.241,7.646l2.826,4.38a.756.756,0,0,1-.6,1.174Zm-5.679,0a.756.756,0,0,1-.565-1.26l1.495-1.727.471-2.249,1.159,1.8-.184.941a.757.757,0,0,1-.17.35L1.335,12.93A.754.754,0,0,1,.757,13.2ZM7.47,7.25a.51.51,0,0,1-.128-.015,4.528,4.528,0,0,1-2.281-.989l-.049-.05.344-1.436a2.119,2.119,0,0,0,.447.73A3.8,3.8,0,0,0,7.584,6.2.529.529,0,0,1,7.47,7.25ZM4.678,2.7A1.349,1.349,0,1,1,6.034,1.349,1.35,1.35,0,0,1,4.678,2.7Z" transform="translate(0)" fill="#fff"></path>
                                        </svg>
                                        <span>${section['INFO']['PROPERTY']['UF_WALK_TIME']['VALUE']}</span>
                                    </div>
                                    `;
                                }
                                if(section['INFO']['PROPERTY']['UF_TRANSPORT_TIME']['VALUE']) {
                                    stringOut += `
                                    <div class="p-distance flex">
                                        <img class="svg lazyload" data-src="/local/templates/fsk/img/icons/ic-transport-dist.svg" width="15" height="16" alt="alt">
                                        <span>${section['INFO']['PROPERTY']['UF_TRANSPORT_TIME']['VALUE']}</span>
                                    </div>
                                    `;
                                }
                            stringOut += `</div>`;

                            if(section['DESCRIPTION']) {
                                stringOut += `<div class="quarter__info my-readmore"><p>${section['DESCRIPTION']}</p></div>`;
                            }

                            if (section['INFO']['PROPERTY']['UF_DISCOUNT_TEXT']['VALUE'] && _this.modeLoad != "commercial") {
                                stringOut += `
                                <div class="p-discount flex">
                                    <div class="p-discount__ic">%</div>
                                    <p class="p-discount__txt">${section['INFO']['PROPERTY']['UF_DISCOUNT_TEXT']['VALUE']}</p>
                                </div>
                                `;
                            }
                            stringOut += `<div class="quarter__footer">`;
                            let nameStingEnd = '';
                            if(_this.modeLoad == "commercial") {
                                nameStingEnd = "Помещения";
                            } else if (item.apartment) {
                                nameStingEnd = "Апартаменты";
                            } else {
                                nameStingEnd = "Квартиры";
                            }
                            stringOut += `
                                <div class="p-key p-key--blue">
                                    <div class="p-key__ic"> </div>
                                    <div class="p-key__txt">${nameStingEnd} от <b>${section['minPriceArray'][0]},${section['minPriceArray'][1][0]} </b>млн/р.</div>
                                </div>
                            `;
                            if (section['INFO']['PROPERTY']['UF_KEYS_DATE']["VALUE"]) {
                                let css_class='';
                                if(section['INFO']['keys']['0']["UF_BACKGROUND"] == '#3399ff'){
                                    css_class = 'p-key--blue';
                                }else{
                                    css_class = 'p-key--green';
                                };
                                stringOut += `
                                <div class="p-key ${css_class}">
                                    <div class="p-key__ic" style="background-image: url(${section['INFO']['keys']['SRC']}); background-color: ${section['INFO']['keys']['0']["UF_BACKGROUND"]};"> </div>
                                    <div class="p-key__txt">${section['INFO']['keys']['0']["UF_NAME"]}</div>
                                </div>
                                `;
                            }
                            stringOut += `
                            <a class="btn btn--bg" href="${item['url']}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg btn__ic ic-arrow inlined-svg" width="20" height="20" role="img" aria-labelledby="title"><title>link</title><g transform="translate(0 20) rotate(-90)"><g transform="translate(20) rotate(90)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"></path><path d="M 10.00000095367432 1.500001907348633 C 5.313080787658691 1.500001907348633 1.500001907348633 5.313080787658691 1.500001907348633 10.00000095367432 C 1.500001907348633 14.68692111968994 5.313080787658691 18.5 10.00000095367432 18.5 C 14.68692111968994 18.5 18.5 14.68692111968994 18.5 10.00000095367432 C 18.5 5.313080787658691 14.68692111968994 1.500001907348633 10.00000095367432 1.500001907348633 M 10.00000095367432 1.9073486328125e-06 C 15.52285099029541 1.9073486328125e-06 20 4.477150917053223 20 10.00000095367432 C 20 15.52285099029541 15.52285099029541 20 10.00000095367432 20 C 4.477150917053223 20 1.9073486328125e-06 15.52285099029541 1.9073486328125e-06 10.00000095367432 C 1.9073486328125e-06 4.477150917053223 4.477150917053223 1.9073486328125e-06 10.00000095367432 1.9073486328125e-06 Z" stroke="none"></path></g><g transform="translate(7.236 5.719)"><g transform="translate(5.504 5.4) rotate(90)"><g transform="translate(0 5.504) rotate(-90)"><path d="M0,0,2.752,2.752,5.5,0" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"></path></g></g><line y2="7.826" transform="translate(2.739)" fill="none" stroke-linecap="round" stroke-width="1.5"></line></g></g></svg>
                                Подробнее
                            </a>
                            `;
                        stringOut += `</div>`;
                    stringOut += `</div>`;
                stringOut += `</div>`;
                return stringOut;
            },
            outBuildLineTwo (section,item) {
                if(section['resultBuildPrice'] == null) return '';
                let stringOut = ``;
                stringOut += `<div class="cols col-1-2">`;
                stringOut += `<div class="quarter">`;
                stringOut += `<a href="${item['url']}" class="quarter__img-wrap quarter-link">`;
                if (section['UF_PHOTO'] === null || section['UF_PHOTO']===''){}else{
                    section['PICTURE'] = section['UF_PHOTO'];
                }
                if( section['PICTURE'] === null ) {
                    stringOut += `<div class="img img-empty"></div>`;
                } else {
                    stringOut += `<img class="quarter__img lazyload" data-src="${section['PICTURE']}" alt="alt">`;
                    if(section['INFO']['PROPERTY']['UF_MAIN_ICON']['VALUE']) {
                        stringOut += ` <div class="quarter__overlay"> <img class="img lazyload" data-src="${section['INFO']['PROPERTY']['UF_MAIN_ICON']['VALUE']}" width="277" height="70" alt="alt"></div>`;
                    }
                }
                stringOut += `</a>`;

                stringOut += `<div class="quarter__content">`;
                stringOut += `<a href="${item['url']}" class="quarter__title">${section['NAME']}</a>`;

                stringOut += `<div class="quarter__transport flex">`;
                if(section['INFO']['metro']) {
                    stringOut += `<div class="p-metro flex">`;
                    for (let metro of section['INFO']['metro']) {
                        stringOut += `<div class="p-metro__branch" style="border-color: ${metro['UF_COLOR']};"></div><span>${metro['UF_NAME']}</span>`;
                    }
                    stringOut += `</div>`;
                }
                stringOut += `</div>`;

                let rBP = section['resultBuildPrice'];
                let rFA = section['resultFilterApartment'];
                let massBuildInfo = false;
                stringOut += `<div class="quarter__info quater__links">`;
                console.log(section,rBP);
                if(item.apartment) {
                    stringOut += `<p><a class="${rBP[1] ? "" : "sub-link none-event"}${rFA[1] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">Апартаменты - ${rBP[1] ? `от ${Math.min.apply(null,rBP[1])} млн /р.` : `нет в продаже`}</a></p>`
                } else {
                    stringOut += ` <p><a class="${rBP[0] ? "" : "sub-link none-event"}${rFA[0] ? " accent-link" : ""}" data-href='${item['url']}' href="javascript:void(0)" data-event="buildRedirect" > Студии -  ${rBP[0] ? `от ${Math.min.apply(null,rBP[0])} млн /р.` : `нет в продаже`} </a></p>`;
                    stringOut += `
                      <p><a class="${rBP[1] ? "" : "sub-link none-event"}${rFA[1] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">1 ккв - ${rBP[1] ? `от ${Math.min.apply(null,rBP[1])} млн /р.` : `нет в продаже`}</a></p>
                      <p><a class="${rBP[2] ? "" : "sub-link none-event"}${rFA[2] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">2 ккв - ${rBP[2] ? `от ${Math.min.apply(null,rBP[2])} млн /р.` : `нет в продаже`}</a></p>
                      <p><a class="${rBP[3] ? "" : "sub-link none-event"}${rFA[3] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">3 ккв - ${rBP[3] ? `от ${Math.min.apply(null,rBP[3])} млн /р.` : `нет в продаже`}</a></p>
                      <p><a class="${rBP[4] ? "" : "sub-link none-event"}${rFA[4] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">4 ккв - ${rBP[4] ? `от ${Math.min.apply(null,rBP[4])} млн /р.` : `нет в продаже`}</a></p>
                    `;
                }

                stringOut += `</div>`;
                //<!--p><a class="${rBP[5] ? "" : "sub-link none-event"}${rFA[5] ? " accent-link" : ""}" data-event="buildRedirect" data-href='${item['url']}' href="javascript:void(0)">5 ккв - ${rBP[5] ? `от ${Math.min.apply(null,rBP[5])} млн /р.` : `нет в продаже`}</a></p-->

                if(section['INFO']['PROPERTY']['UF_DISCOUNT_TEXT']['VALUE']) {
                    stringOut += `
                        <div class="p-discount flex">
                                <div class="p-discount__ic">%</div>
                                <p class="p-discount__txt">${section['INFO']['PROPERTY']['UF_DISCOUNT_TEXT']['VALUE']}</p>
                        </div>
                    `;
                }
                if (section['INFO']['PROPERTY']['UF_KEYS_DATE']["VALUE"]) {

                    let css_class='';
                    if(section['INFO']['keys']['0']["UF_BACKGROUND"] == '#3399ff'){
                        css_class = 'p-key--blue';
                    }else{
                        css_class = 'p-key--green';
                    };
                    stringOut += `<div class="p-discount flex ">
                            <div class="p-key ${css_class}">
                                 <div class="p-key__ic" style="background-image: url(${section['INFO']['keys']['SRC']}); background-color: ${section['INFO']['keys']['0']["UF_BACKGROUND"]};"> </div>
                                <div class="p-key__txt">${section['INFO']['keys'][0]["UF_NAME"]}</div>
                            </div>
                            </div>
                        `;
                }
                stringOut += `</div>`;
                stringOut += `</div>`;
                stringOut += `</div>`;
                return stringOut;
            }
        }
    }
}
try {
    window.controller = new ApartmentControll();
    window.controller.initData().event();
} catch (e) {
    console.log(e);
}

function loadPage() {

    // img.svg to inline svg
    inlineSVG.init();

    $("select.ui-select").each(function() {
        var classes = $(this).attr("class"),
            id      = $(this).attr("id"),
            name    = $(this).attr("name");
        var template =  '<div class="' + classes + '">';
        template += '<div class="ui-select__trigger">' + $(this).data("placeholder") + '</div>';
        template += `<div class="ui-select__options" data-link="${name}">`;
        template += '<div class="ui-select__simplebar" data-simplebar data-simplebar-auto-hide="false">';
        $(this).find("option").each(function() {
            template += '<span data-type="'+ $(this).data('type') +'" data-year="'+ $(this).data('year') +'" class="ui-select__option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
        });
        template += '</div></div></div>';
        $(this).addClass('ui-select__select');
        $(this).after(template);
    });
    $(".ui-select__trigger").on("click", function(event) {
        $('html').one('click',function() {
            $(".ui-select").removeClass("opened");
        });
        if( $(this).closest(".ui-select").hasClass('opened') ){
            $(this).closest(".ui-select").removeClass("opened");
        } else {
            $(".ui-select").removeClass("opened");
            $(this).closest(".ui-select").addClass("opened");
        }
        event.stopPropagation();
    });
    $(".ui-select__option").on("click", function() {
        let link = $(this).parents(`.ui-select__options`).data(`link`);
        $(`select[name=${link}]`).val($(this).data("value"));
        $(this).closest(".ui-select").find("select").val($(this).data("value"));
        $(this).closest(".ui-select__options").find(".ui-select__option").removeClass("active");
        $(this).addClass("active");
        $(this).closest(".ui-select").removeClass("opened");
        $(this).closest(".ui-select").find(".ui-select__trigger").text($(this).text());
        console.log($(this).parents(".ui-select"));//.data(`event-change`)

        if($($(this).parents(".ui-select")[0].previousElementSibling).data(`event-change`) == `updateResult`) {
            window.controller.getData().filterApartment(this);
        } else {
            window.controller.getData().buildFilter(this);
        }

        let selectValue = $(`select[name=${link}]`).val(),
        	selectVideo = $(`select[name=${link}] option[value=${selectValue}]`).data(`video`)
        if(selectVideo){
        	$(this).closest(`.gallery-btns.project-build__top`).find('iframe').attr('src', selectVideo)
        }
    });

    // запись значений ренджа в подсказки
    function putResults(val1, val2) {
        $('.ui-range__from').text(val1);
        $('.ui-range__to').text(val2);
    }

    function upadateFilterData (el) {
        let form = $(el).parents('form');
        let temp = $(form).data(`filter-type`);
        if(temp == `build`) {
            window.controller.getData().buildFilter(el);
        } else {
            window.controller.getData().filterApartment(el);
        }
    }

    $(`[name="PROPERTY_rooms"]`).each(function(){
        if(queryLocalAll !== null ) {
            if(queryLocalAll['PROPERTY_rooms'] !== undefined) {
                if(!queryLocalAll['PROPERTY_rooms'].indexOf(this.value)) {
                    $(this).prop("checked", true);
                }
            }
        }
    });

    function initRanges() {
        $('.ui-range__slider').each(function (i, el) {
            let _this = this;
            var min = $(el).data('min');
            var max = $(el).data('max');

            if(queryLocalAll) {
                min = queryLocalAll[`>=${$(this).data('name')}`];
                max = queryLocalAll[`<=${$(this).data('name')}`];
            }


            $(this).slider({
                range: true,
                min: $(el).data('min'),
                max: $(el).data('max'),
                step: $(el).data('step'),
                values: [min, max],
                slide: function (event, ui) {
                    $(el).closest('.ui-range').find('.ui-range__from').val(ui.values[0]);
                    $(el).closest('.ui-range').find('.ui-range__to').val(ui.values[1]);
                },
                change: function( event, ui ) {
                    upadateFilterData(el);
                }
            });
            $(el).closest('.ui-range').find('input').change(function () {
                if ($(this).hasClass('ui-range__from')) {
                    if ($(el).data('min') <= $(this).val()) {
                        $(_this).slider("values", 0, $(this).val());
                    }
                } else if ($(this).hasClass('ui-range__to')) {
                    if ($(el).data('max') >= $(this).val()) {
                        $(_this).slider("values", 1, $(this).val())
                    }
                } else {
                    console.log("Нет такого параметра");
                }
                upadateFilterData(el);
            });
        });
    }

    // Инициализация ползунков в фильтре при наличии таковых на странице
    initRanges();



    $('.ui-range__val').focusin(function () {
        $(this).closest('.ui-range').addClass('ui-range--focus');
    });
    $('.ui-range__val').focusout(function () {
        $(this).closest('.ui-range').removeClass('ui-range--focus');
    });


    // Тогл блок дополнительных фильтров
    $('.filter-additional').click(function (e) {
        $(this).toggleClass('filter-additional--opened');
        $(this).closest('.filter').toggleClass('filter--toggle');
        $(this).closest('.filter').find('.filter__hidden').slideToggle(200);
    });



    // Зaпрет на ввод всего кроме цифр
    $(document).on('focus', '.filter input:not([type="checkbox"])', function(){
        $(this).val(parseInt($(this).val()));
        $(this).attr('type', 'number');
    })

    $(document).on('change', '.filter input:not([type="checkbox"])', function(){
        console.log($(this).closest('.ui-range').find('.ui-range__slider').data('max'));
        if( $(this).closest('.ui-range').find('.ui-range__slider').data('max') < $(this).val() ){
            $(this).val($(this).closest('.ui-range').find('.ui-range__slider').data('max'));
        }
        console.log($(this).closest('.ui-range').find('.ui-range__slider').data('min'));
        if( $(this).closest('.ui-range').find('.ui-range__slider').data('min') > $(this).val() ){
            $(this).val($(this).closest('.ui-range').find('.ui-range__slider').data('min'));
        }
    })
    // Поле ввода срока

    /*
    */





    var sliderPrevBtn = '<button type="button" class="slider-arrow slider-prev"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>',
        sliderNextBtn = '<button type="button" class="slider-arrow slider-next"><svg xmlns="http://www.w3.org/2000/svg" class="svg" width="12.121" height="6.811" viewBox="0 0 12.121 6.811"><g transform="translate(1.061 1.061)"><path d="M0,0,5,5l5-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5"/></g></svg></button>';


    // Слайдеры на главной
    $('.bg-slider').slick({
        speed: 1800,
        autoplay: true,
        autoplaySpeed: 7000,
        asNavFor: '.main-slider',
        prevArrow: sliderPrevBtn,
        nextArrow: sliderNextBtn,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false
                }
            }
        ]
    });

    $('.main-slider').slick({
        arrows: false,
        autoplay: true,
        autoplaySpeed: 7000,
        dots: true,
        dotsClass: 'slider-dots',
        speed: 1800,
        fade: true,
        asNavFor: '.bg-slider',
    });

    // Слайдеры на странице ЖК
    $('#gallery-1').slick({
        infinite: false,
        speed: 800,
        fade: true,
        focusOnSelect: false,
        asNavFor: '#gallery-1-thumbs',
        prevArrow: sliderPrevBtn,
        nextArrow: sliderNextBtn,
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    arrows: false
                }
            }
        ]
    });

    $('#gallery-1-thumbs').slick({
        infinite: false,
        slidesToShow: 8,
        arrows: false,
        speed: 800,
        focusOnSelect: true,
        asNavFor: '#gallery-1',
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 6,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 4,
                }
            }
        ]
    });


    $('#gallery-slider1').slick({
        infinite: false,
        speed: 800,
        fade: true,
        focusOnSelect: false,
        asNavFor: '#gallery-slider1-thumbs',
        prevArrow: sliderPrevBtn,
        nextArrow: sliderNextBtn,
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    arrows: false
                }
            }
        ]
    });

    $('#gallery-slider1-thumbs').slick({
        infinite: false,
        slidesToShow: 8,
        arrows: false,
        speed: 800,
        focusOnSelect: true,
        asNavFor: '#gallery-slider1',
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 6,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 4,
                }
            }
        ]
    });

    $(document).on('click', '.tabs-gallery__btn', function (e) {
    	e.preventDefault();
		let tabContainers = $('.tab-gallery');
		tabContainers.removeClass('active');
		tabContainers.filter(this.hash).addClass('active');
		$('.tabs-gallery__btn').removeClass('btn--bg active').addClass('btn--transp');
		$(this).addClass('btn--bg active').removeClass('btn--transp')
		$('.tab-gallery .slick-initialized').slick('unslick');
		$('#gallery-1').slick({
	        infinite: false,
	        speed: 800,
	        fade: true,
	        focusOnSelect: false,
	        asNavFor: '#gallery-1-thumbs',
	        prevArrow: sliderPrevBtn,
	        nextArrow: sliderNextBtn,
	        lazyLoad: 'ondemand',
	        responsive: [
	            {
	                breakpoint: 767,
	                settings: {
	                    arrows: false
	                }
	            }
	        ]
	    });

	    $('#gallery-1-thumbs').slick({
	        infinite: false,
	        slidesToShow: 8,
	        arrows: false,
	        speed: 800,
	        focusOnSelect: true,
	        asNavFor: '#gallery-1',
	        lazyLoad: 'ondemand',
	        responsive: [
	            {
	                breakpoint: 1199,
	                settings: {
	                    slidesToShow: 6,
	                }
	            },
	            {
	                breakpoint: 767,
	                settings: {
	                    slidesToShow: 4,
	                }
	            }
	        ]
	    });


	    $('#gallery-slider1').slick({
	        infinite: false,
	        speed: 800,
	        fade: true,
	        focusOnSelect: false,
	        asNavFor: '#gallery-slider1-thumbs',
	        prevArrow: sliderPrevBtn,
	        nextArrow: sliderNextBtn,
	        lazyLoad: 'ondemand',
	        responsive: [
	            {
	                breakpoint: 767,
	                settings: {
	                    arrows: false
	                }
	            }
	        ]
	    });

	    $('#gallery-slider1-thumbs').slick({
	        infinite: false,
	        slidesToShow: 8,
	        arrows: false,
	        speed: 800,
	        focusOnSelect: true,
	        asNavFor: '#gallery-slider1',
	        lazyLoad: 'ondemand',
	        responsive: [
	            {
	                breakpoint: 1199,
	                settings: {
	                    slidesToShow: 6,
	                }
	            },
	            {
	                breakpoint: 767,
	                settings: {
	                    slidesToShow: 4,
	                }
	            }
	        ]
	    });
    });



    /*$('#gallery-1').on('afterChange', function (event) {
      $('#gallery-1-thumbs').find('.slick-current').removeClass('slick-current');
      $('#gallery-1-thumbs').find('[data-slick-index="' + $(this).find('.slick-current').data('slickIndex') + '"]').addClass('slick-current');
    });*/

    $('.advantages-slider-img').slick({
        arrows: false,
        speed: 800,
        asNavFor: '.advantages-slider-text',
        dotsClass: 'slider-dots slider-dots--dark'
    });
    $('.advantages-slider-text').slick({
        speed: 800,
        fade: true,
        asNavFor: '.advantages-slider-img',
        arrows: false,
        dotsClass: 'slider-dots slider-dots--dark',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    arrows: false
                }
            },
            {
                breakpoint: 767,
                settings: {
                    adaptiveHeight: true
                }
            }
        ]
    });

    $('.advantages-slider .slider-prev').click(function(){
        $('.advantages-slider-text').slick('slickPrev');
    });
    $('.advantages-slider .slider-next').click(function(){
        $('.advantages-slider-text').slick('slickNext');
    });




    $('#gallery-2').slick({
        infinite: false,
        speed: 800,
        fade: true,
        focusOnSelect: false,
        asNavFor: '#gallery-2-thumbs',
        prevArrow: sliderPrevBtn,
        nextArrow: sliderNextBtn,
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    arrows: false
                }
            }
        ]
    });

    $('#gallery-2-thumbs').slick({
        infinite: false,
        slidesToShow: 8,
        arrows: false,
        speed: 800,
        focusOnSelect: true,
        asNavFor: '#gallery-2',
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 6,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 4,
                }
            }
        ]
    });

  /*$('#gallery-2').on('afterChange', function (event) {
    $('#gallery-2-thumbs').find('.slick-current').removeClass('slick-current');
    $('#gallery-2-thumbs').find('[data-slick-index="' + $(this).find('.slick-current').data('slickIndex') + '"]').addClass('slick-current');
  });*/


    // BEGIN scrollspy в подменю на странице ЖК

    var scrollspyOffset;
    if( $('.scrollspy-menu').length ) {
        scrollspyOffset = $('.scrollspy-menu').offset().top -60;
    }

    $('.scrollspy-menu a, .anchor-scroll').on('click', function(e){
        var id = $(this).attr('href');
        e.preventDefault();
        $('html,body').stop().animate({ scrollTop: $(id).offset().top-150 }, 1000);
    });

    function AnchorActive() {
        $('.scrollspy-item').each(function(e) {
            var dataName = $(this).attr('id');
            var posit = $(this).offset().top - 400;

            var windowPostition = $(window).scrollTop();

            if (windowPostition >= posit) {
                $('.scrollspy-menu a').removeClass('active');
                $('.scrollspy-menu [href="#'+ dataName + '"]').addClass('active');
            }

        });
    }


    function lineFixing() {
        if ( $(window).scrollTop() >= scrollspyOffset ) {
            $('.scrollspy-menu').addClass('scrollspy-menu--fixed');
            $('.wrapper').addClass('scrollspy-padding');
        } else {
            $('.scrollspy-menu').removeClass('scrollspy-menu--fixed');
            $('.wrapper').removeClass('scrollspy-padding');
        }
    }

    $(window).scroll(function() {
        AnchorActive();
        lineFixing();
    });


    // END scrollspy в подменю на странице ЖК


    /* Реинициализация элементов при ресайзе окна */
    $(window).on('load resize orientationchange', function() {
        // слайдер объектов О Компании
        $('.completed-projects').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 1023) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        slidesToShow: 2,
                        variableWidth: true,
                        responsive: [
                            {
                              breakpoint: 768,
                              settings: {
                                slidesToShow: 1
                              }
                            }
                          ]
                    });
                }
            }
        });

        // слайдер Социальная ответственность О Компании
        $('.contacts-social').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 767) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        slidesToShow: 1,
                        variableWidth: true,
                    });
                }
            }
        });

        // слайдер преимуществ на главной
        $('.advantages-list').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 767) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        mobileFirst: true,
                    });
                }
            }
        });


        // ограничение количетсва символов в тексте карточки ЖК
        var symbolsCount;
        if ($(window).width() >= 1200) {
            symbolsCount = 205;
        } else if ($(window).width() < 1200 && $(window).width() > 992) {
            symbolsCount = 330;
        } else if ($(window).width() <= 992 && $(window).width() > 767) {
            symbolsCount = 235;
        } else if ($(window).width() <= 767 && $(window).width() > 575) {
            symbolsCount = 160;
        } else {
            symbolsCount = 130;
        }

        $('.my-readmore').each(function () {
            var str = $(this).find('p').text();
            if( str.length > symbolsCount ) {
                str = str.substr(0,symbolsCount-16) + "... ";

                let linkT = setInterval(()=>{
                    console.log($(this).closest('.quarter').find('.quarter-link').html());
                    var linkHref = $(this).closest('.quarter').find('.quarter-link').attr('href');
                    if (linkHref != undefined && linkHref!= ''){
                        var link = '<a href="' + linkHref + '"' + '>Читать далее</a>';
                        $(this).find('p').append(link);
                        clearInterval(linkT);
                    }
                },200);

                $(this).find('p').text(str);
            }
        });


        // слайдер других объектов
        $('.project-data').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 767) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        mobileFirst: true,
                        rows: 3
                    });
                }
            }
        });

        // слайдер других объектов
        $('.project-other').each(function(){
            var $carousel = $(this);
            if ($(window).width() > 1199) {
                if ($carousel.hasClass('slick-initialized')) {
                    $carousel.slick('unslick');
                }
            }
            else{
                if (!$carousel.hasClass('slick-initialized')) {
                    $carousel.slick({
                        arrows: false,
                        dots: true,
                        dotsClass: 'slider-dots slider-dots--dark',
                        mobileFirst: true,
                    });
                }
            }
        });
        AnchorActive();
        lineFixing();
    });

    // Инициализая кастомного скролбара при ресайзе
    var addEvent = function(object, type, callback) {
        if (object == null || typeof(object) == 'undefined') return;
        if (object.addEventListener) {
            object.addEventListener(type, callback, false);
        } else if (object.attachEvent) {
            object.attachEvent("on" + type, callback);
        } else {
            object["on"+type] = callback;
        }
    };
    addEvent(window, "resize", function(event) {
        if( $('#results-screen').length ) {
            new SimpleBar(document.getElementById('results-screen'), {
                autoHide: false
            });
        }
    });

    // Jquery табы
    $(".js-tab").click(function() {
        var index = $(this).index();
        $(this).closest('.js-tab-wrapper').find(".js-tab").removeClass("js-tab--active").eq(index).addClass("js-tab--active");
        $(this).closest('.js-tab-wrapper').find(".js-tab-item").hide().eq(index).fadeIn("normal");
    });



    // Тогл блок в вакансиях
    $('.btn-vacancy').click(function (e) {
        $(this).closest('.vacancy').toggleClass('vacancy--open');
    });



    // Зум изображения в карточке квартиры
    $('.zoom-link').fancybox({
        buttons: [
            "close"
        ]
    });



    // =============================== ДЛЯ ДЕМО ===============================
    // вызов модального окна благодарности на странице ипотеки
    $('.demo-modal-success').magnificPopup({
        items: {
            src: '#modal-ipo-success',
            type: 'inline'
        }
    });


    // Раскрытие карты в блоке результатов
    $('.results-geo__btn').click(function (e) {
        $('.results-geo').toggleClass('results-geo-map');
    });

    // Тогл блок фильтров в мобильной версии
    $('.filter-mob').click(function (e) {
        $(this).toggleClass('filter-mob-show');
        $('.filter-mob-collapse').slideToggle('100');
    });


    // Инпут с "плюс" "минус"
    // $('.ui-quantity__btn').click(function(){
    //
    // });
    /*
    $('.ui-quantity input').bind('input propertychange', function () {
        var $this = $(this);
        if ( $this.val().length == 0 || parseInt( $this.val() ) <= 0 )
            $this.val(1);
    });
*/




    // Анимации кнопок
    // Кнопки CTA
    var animateCta = function(e) {

        // Для демо
        // e.preventDefault();

        e.target.classList.remove('cta-animate');

        e.target.classList.add('cta-animate');
        setTimeout(function(){
            e.target.classList.remove('cta-animate');
        }, 700);

    };

    var bubblyButtons = document.getElementsByClassName("btn--cta");

    for (var i = 0; i < bubblyButtons.length; i++) {
        bubblyButtons[i].addEventListener('click', animateCta, false);
    }

    // Эффект клика
    [].map.call(document.querySelectorAll('.btn'), el=> {
        el.addEventListener('click',e => {
            e = e.touches ? e.touches[0] : e;
            const r = el.getBoundingClientRect(), d = Math.sqrt(Math.pow(r.width,2)+Math.pow(r.height,2)) * 2;
            el.style.cssText = `--s: 0; --o: 1;`;  el.offsetTop;
            el.style.cssText = `--t: 1; --o: 0; --d: ${d}; --x:${e.clientX - r.left}; --y:${e.clientY - r.top};`
        })
    })




    // Тоггл меню
    $('.menu-trigger').click(function (e) {
        $(this).toggleClass('menu-open');
        $('.toggle-menu').toggleClass('menu-open');
    });

    // FAQ accordion
    $('.js-accordion-btn').click(function() {

        var dropDown = $(this).parent().find('.js-accordion-content');

        $(this).closest('.js-accordion').find('.js-accordion-content').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.js-accordion').find('.js-accordion-btn.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();
    });



	$('.custom-popup__btn').magnificPopup({
		items: {
			src: '#modal-callback',
			type: 'inline'
		},
		callbacks: {
			open: function() {
				$('body').addClass('mfp-card');
			},
			close: function() {
				$('body').removeClass('mfp-card');
			}
		}
	});

	$('.custom-popup__video').magnificPopup({
		items: {
			src: '#modal-videobuild',
			type: 'inline'
		},
		callbacks: {
			open: function() {
				$('body').addClass('mfp-card');
			},
			close: function() {
				$('body').removeClass('mfp-card');
			}
		}
	});


/*
    $('.js-call-callback').magnificPopup({
        items: {
            src: '#modal-callback',
            type: 'inline'
        },
        callbacks: {
            open: function() {
                $('body').addClass('mfp-card mfp-top');
            },
            close: function() {
                $('body').removeClass('mfp-card mfp-top');
            }
        }
    });*/

    // =============================== ДЛЯ ДЕМО ===============================
    // вызов модального окна благодарности после заказа звонка
    /*$('#modal-callback .btn').magnificPopup({
        items: {
            src: '#modal-thanks',
            type: 'inline'
        },
        callbacks: {
            open: function() {
                $('body').addClass('mfp-card').removeClass('mfp-top');
            },
            close: function() {
                $('body').removeClass('mfp-card');
            }
        }
    });*/

}

$(document).ready(function() {
    loadPage();

    if( $('#results-screen').length ) {
        window.controller.initData().crollBar(`results-screen`);
    }
    var mortgageInit = false;
    window.controller.getData().filterApartment($(`.filter`).find(`.form-submit`))
        .then(function () {
            console.log(1);
            window.controller.initData().map(false);
            window.controller.getData().mortgageFilter();
        });
        var page = document.location.pathname;
        if(page == "/mortgage/") {
            window.controller.getData().mortgageFilter();
        }

});

$(document).ready(function(){
    var myHash = location.hash;
    $(document).on('click', 'a:not(.tabs-navigation-item):not(.tabs-gallery__btn)', function () {
      if($(this.hash).length){
        $('html,body').animate({scrollTop: $(this.hash).offset().top - 100}, 1000);
      }
    });

    $(document).on('click touchend','[data-role="favorite"]',function(e){
        console.log(e.type);
        favorite(this);
        e.preventDefault();
    });

    if($('.map-salepoint').length){
        $('.map-salepoint').each(function (index, item, array) {
            let coordsSalePoint = $(item).attr('data-coordinate');
            let zoom = $(item).attr('data-zoom');
            if(coordsSalePoint) {
                let coordNumber = coordsSalePoint.split(','),
                    mapId = $(item).attr('id');
                for (var i = 0; i < coordNumber.length; i++) {
                    coordNumber[i] = +coordNumber[i];
                }
                ymaps.ready(init);
                function init(){
                    var myMap = new ymaps.Map(mapId, {
                        center: coordNumber,
                        zoom: zoom !== ""? zoom : 10,
                        controls: [/*'zoomControl'*/],
                    });
                    /*myMap.behaviors.disable('scrollZoom');*/
                    var myPlacemark = new ymaps.Placemark(coordNumber, {}, {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/fsk/img/marker.svg',
                        iconImageSize: [30, 50],
                        iconImageOffset: [-3, -35],
                    });

                    myMap.geoObjects.add(myPlacemark);

                }
            }
        });
    }

    if($('.advantages-new-slider').length){
      $('.advantages-new-slider').slick({
        //slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        variableWidth: true,
        prevArrow: $('.advantages-new-slider__prev'),
        nextArrow: $('.advantages-new-slider__next'),
        slidesToShow: 2,
        infinite: true,
        lazyLoad: 'progressive',
        responsive: [{
          breakpoint: 1023,
          settings: {
            arrows: false,
          }
        },{
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            variableWidth: false,
            arrows: false,
          }
        }]
      })
    }

    /*    $(document).find('.slick-cloned').removeAttr('data-fancybox');*/


    if($('.types-block-tabs-tab-slider').length){
    	$('.types-block-tabs-tab.active .types-block-tabs-tab-slider').slick({
    		slidesToScroll: 1,
        	arrows: true,
        	responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        arrows: false,
			        dots: true
			      }
			    }
			]
    	});
    }
});


/*Табы на апартаментах*/
$(document).on('click', '.tabs-navigation-item', function (e) {
	e.preventDefault();
	let tabContainers = $(this).closest('.tabs').find('.tabs-tab');
	tabContainers.removeClass('active');
	tabContainers.filter(this.hash).addClass('active');
	$(this).closest('.tabs').find('.tabs-navigation-item').removeClass('active');
	$(this).addClass('active');
	$('.types-block-tabs-tab-slider.slick-initialized').slick('unslick');
	$('.types-block-tabs-tab.active .types-block-tabs-tab-slider').slick({
    	slidesToScroll: 1,
        arrows: true,
        responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        arrows: false,
		        dots: true
		      }
		    }
		]
    });
});
$(document).on('click', '.types-block-tabs-tab-nav__item', function (e) {
	$('.types-block-tabs-tab.active .types-block-tabs-tab-nav__item').removeClass('active');
	$(this).addClass('active');
	if($(this).hasClass('plan')){
		$(this).closest('.types-block-tabs-tab').find('.types-block-tabs-tab-slider').hide();
		$(this).closest('.types-block-tabs-tab').find('.types-block-tabs-tab-scheme').show().css('display', 'flex');
	} else {
		$(this).closest('.types-block-tabs-tab').find('.types-block-tabs-tab-slider').show();
		$(this).closest('.types-block-tabs-tab').find('.types-block-tabs-tab-scheme').hide();
		$('.types-block-tabs-tab-slider.slick-initialized').slick('unslick');
		$('.types-block-tabs-tab.active .types-block-tabs-tab-slider').slick({
	    	slidesToScroll: 1,
	        arrows: true,
	        responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        arrows: false,
			        dots: true
			      }
			    }
			]
	    });
	}
});
/*Табы на апартаментах Конец*/


/*Тултипы апартаменты*/
$(document).on('click', '.scheme-tooltip', function (e) {
	if($(this).hasClass('active')){
		$(this).find('span').hide();
		$(this).removeClass('active');
	} else {
		$(document).find('.scheme-tooltip span').hide();
		$(document).find('.scheme-tooltip').removeClass('active');
		$(this).find('span').show();
		$(this).addClass('active');
	}

});
$(document).on('click', function (e) {
	if(!$('.scheme-tooltip.active').is(e.target) && $('.scheme-tooltip.active').has(e.target).length === 0){
		$(document).find('.scheme-tooltip').removeClass('active');
		$(document).find('.scheme-tooltip span').hide();
	}
});
/*Тултипы апартаменты Конец*/


/*Подмена последнего пункта меню апартаментов*/
$(document).ready(function(){
	if (document.documentElement.clientWidth >= 1200) {
		$(document).find('.scrollspy-menu.apart-menu a:last-child').text('Док...');
	}
});
/*Подмена последнего пункта меню апартаментов Конец*/


/*Выпадающий список типов номеров*/
if (document.documentElement.clientWidth < 1300) {
	$(document).on('click', '.types-block-nav__active', function (e) {
		$(this).closest('.types-block-nav-wrap').find('.types-block-nav').toggle();
		$(this).toggleClass('active');
	});
	$(document).on('click', '.types-block-nav__item', function (e) {
		$('.types-block-nav').hide();
		$('.types-block-nav__active').removeClass('active').html($(this).html());
	});
	$(document).on('click', function (e) {
		if(!$('.types-block-nav-wrap').is(e.target) && $('.types-block-nav-wrap').has(e.target).length === 0){
			$('.types-block-nav').hide();
			$('.types-block-nav__active').removeClass('active');
		}
	});
}
/*Выпадающий список типов номеров Конец*/


/*Всплывашка КоронаВирус*/
/*
$(document).on('click', '.corona-popup__close, .corona-popup-info-btns .btn', function (e) {
	$('.corona').fadeOut();
	$('html').css({
        	'overflow': 'visible',
        	'margin-right': '0'
        })
});
$(document).on('click', '.corona', function (e) {
	var div = $('.corona-popup');
	if(!div.is(e.target) && div.has(e.target).length === 0){
		$('.corona').fadeOut();
		$('html').css({
        	'overflow': 'visible',
        	'margin-right': '0'
        })
	}
});
$(document).on('click', '.corona-popup-info-accordeon__title', function (e) {
	$(this).next('.corona-popup-info-accordeon__text').slideToggle();
});
$(function() {
    if (!$.cookie('hideModal')) {
        var delay_popup = 100;
        setTimeout("document.querySelector('.corona').style.display='block'", delay_popup);
        $('html').css({
        	'overflow': 'hidden',
        	'margin-right': '17px'
        })
    }
    $.cookie('hideModal', true, {

        expires: 1,
        path: '/'
    });
});*/
/*Всплывашка КоронаВирус Конец*/


function favorite(item){
    let ids = item.getAttribute('data-id');//$(item).data('ids');
    let to  = 'FAVORITE';
    let data = {"TO":to,"ID":ids};
    $.ajax({
        url:'/favourite/',
        type:'POST',
        data: data,
        success:function(result){
            if(location.pathname == '/favourite/') {
                let r = $(result).find('[data-entity="container-1"]').html();
                if(r === undefined) {
                    r = ``;
                }
                $(document).find('[data-entity="container-1"]').html(r);

            };


            //$('.results__header').find('.interactive-favorite').toggleClass('active');
            //$('.card__info').find('.interactive-favorite').toggleClass('active');

            $.getJSON('/favourite/data.json', function(data) {
                if(data != undefined && data != null && (Object.keys(data).length > 0)){
                    $(`[data-role="favorite"][data-id="${ids}"]`).toggleClass(`active`);
                    $('.link-favourite, .mob-link-favourite').addClass('active');
                } else {
                    $(`[data-role="favorite"][data-id="${ids}"]`).removeClass(`active`);
                    $('.link-favourite, .mob-link-favourite').removeClass('active');
                    if($('.results-empty.favourite-empty').length){
                        $('.results-empty.favourite-empty').css('display', 'flex');
                    }
                }
            });

            //favorite();
            inlineSVG.init();
        }
    });
}

$(document).on('click', '.reserve-info__close, .reserve-info__close svg', function (e) {
    e.preventDefault();
    $('.reserve-info').hide();
    $('.page.reservation.reserv-info-padding').removeClass('reserv-info-padding');
    $('.page.page-project.flat').removeClass('reserv-padding');
});


$(document).ready(function(){
    if($('.page.page-project.flat').length && $('.reserve-info').length ){
        $('.page.page-project.flat').addClass('reserv-padding');
    }
    if($('.contacts-today-content').innerHeight() > 290){
        $('.contacts-today-content').addClass('hide')
    }
});

$(document).on('click', '.contacts-today-content__btn', function (e) {
    $('.contacts-today-content').removeClass('hide')
});
