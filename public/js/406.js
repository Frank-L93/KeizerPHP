"use strict";(self.webpackChunkvue_3=self.webpackChunkvue_3||[]).push([[406],{3744:(e,t)=>{t.Z=(e,t)=>{const n=e.__vccOpts||e;for(const[e,o]of t)n[e]=o;return n}},406:(e,t,n)=>{n.r(t),n.d(t,{default:()=>m});var o=n(821),r={class:"text-center pt-20 md:pt-0 max-w-xl my-5 mx-auto"},i={class:"w-full bg-gray-300 border-t border-b overflow-hidden relative border-gray-200 px-5 py-16 md:py-24 text-gray-800"},a={class:"w-full max-w-md mx-auto"},l={class:"mt-1 rounded-md shadow-sm"},s=(0,o.createElementVNode)("div",{class:"mt-6"},[(0,o.createElementVNode)("span",{class:"block w-full rounded-md shadow-sm"},[(0,o.createElementVNode)("button",{type:"submit",class:"flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-md hover:bg-orange-500 focus:outline-none focus:border-orange-700 focus:shadow-outline-orange active:bg-orange-700 transition duration-150 ease-in-out"}," Stuur een nieuw wachtwoord ")])],-1);var c=n(5980),u=n(7891),f=n(4891),d=n(5322);const p={name:"Login",components:{LoadingButton:c.Z,MainLogo:u.Z,TextInput:f.Z,Guestmenu:d.Z},props:{errors:{type:Object,default:function(){return{}}}},data:function(){return{sending:!1,form:{email:"",token:this.rndStr(20)}}},methods:{resetPassword:function(){var e=this,t={email:this.form.email,token:this.form.token};this.$inertia.post(this.route("password.resetting"),t,{onStart:function(){return e.sending=!0},onFinish:function(){return e.sending=!1}})},rndStr:function(e){for(var t=" ",n="123456789abcdefghijklmnopqrstuvwxyz",o=0;o<e;o++)t+=n.charAt(Math.floor(Math.random()*n.length));return t}}};const m=(0,n(3744).Z)(p,[["render",function(e,t,n,c,u,f){var d=(0,o.resolveComponent)("MainLogo"),p=(0,o.resolveComponent)("Guestmenu"),m=(0,o.resolveComponent)("flash-messages"),h=(0,o.resolveComponent)("text-input");return(0,o.openBlock)(),(0,o.createElementBlock)("div",null,[((0,o.openBlock)(),(0,o.createBlock)(o.Teleport,{to:"head"},[(0,o.createElementVNode)("title",null,(0,o.toDisplayString)(e.title("Reset wachtwoord")),1)])),(0,o.createElementVNode)("div",r,[(0,o.createVNode)(d),(0,o.createVNode)(p)]),(0,o.createElementVNode)("div",i,[(0,o.createElementVNode)("div",a,[(0,o.createVNode)(m),(0,o.createElementVNode)("form",{onSubmit:t[2]||(t[2]=(0,o.withModifiers)((function(){return f.resetPassword&&f.resetPassword.apply(f,arguments)}),["prevent"]))},[(0,o.withDirectives)((0,o.createElementVNode)("input",{"onUpdate:modelValue":t[0]||(t[0]=function(e){return u.form.token=e}),type:"hidden"},null,512),[[o.vModelText,u.form.token]]),(0,o.createElementVNode)("div",null,[(0,o.createElementVNode)("div",l,[(0,o.createVNode)(h,{error:n.errors.email,modelValue:u.form.email,"onUpdate:modelValue":t[1]||(t[1]=function(e){return u.form.email=e}),modelModifiers:{lazy:!0},id:"email",type:"email",required:"",autofocus:"",class:"mt-10",label:"Email"},null,8,["error","modelValue"])])]),(0,o.createTextVNode)(" "+(0,o.toDisplayString)(this.$page.props.flash.status)+" ",1),s],32)])])])}]])},8968:(e,t,n)=>{n.d(t,{Z:()=>ve});var o=n(821),r={key:0};function i(e){if(null==e)return window;if("[object Window]"!==e.toString()){var t=e.ownerDocument;return t&&t.defaultView||window}return e}function a(e){return e instanceof i(e).Element||e instanceof Element}function l(e){return e instanceof i(e).HTMLElement||e instanceof HTMLElement}function s(e){return"undefined"!=typeof ShadowRoot&&(e instanceof i(e).ShadowRoot||e instanceof ShadowRoot)}var c=Math.max,u=Math.min,f=Math.round;function d(e,t){void 0===t&&(t=!1);var n=e.getBoundingClientRect(),o=1,r=1;if(l(e)&&t){var i=e.offsetHeight,a=e.offsetWidth;a>0&&(o=f(n.width)/a||1),i>0&&(r=f(n.height)/i||1)}return{width:n.width/o,height:n.height/r,top:n.top/r,right:n.right/o,bottom:n.bottom/r,left:n.left/o,x:n.left/o,y:n.top/r}}function p(e){var t=i(e);return{scrollLeft:t.pageXOffset,scrollTop:t.pageYOffset}}function m(e){return e?(e.nodeName||"").toLowerCase():null}function h(e){return((a(e)?e.ownerDocument:e.document)||window.document).documentElement}function v(e){return d(h(e)).left+p(e).scrollLeft}function g(e){return i(e).getComputedStyle(e)}function w(e){var t=g(e),n=t.overflow,o=t.overflowX,r=t.overflowY;return/auto|scroll|overlay|hidden/.test(n+r+o)}function y(e,t,n){void 0===n&&(n=!1);var o,r,a=l(t),s=l(t)&&function(e){var t=e.getBoundingClientRect(),n=f(t.width)/e.offsetWidth||1,o=f(t.height)/e.offsetHeight||1;return 1!==n||1!==o}(t),c=h(t),u=d(e,s),g={scrollLeft:0,scrollTop:0},y={x:0,y:0};return(a||!a&&!n)&&(("body"!==m(t)||w(c))&&(g=(o=t)!==i(o)&&l(o)?{scrollLeft:(r=o).scrollLeft,scrollTop:r.scrollTop}:p(o)),l(t)?((y=d(t,!0)).x+=t.clientLeft,y.y+=t.clientTop):c&&(y.x=v(c))),{x:u.left+g.scrollLeft-y.x,y:u.top+g.scrollTop-y.y,width:u.width,height:u.height}}function x(e){var t=d(e),n=e.offsetWidth,o=e.offsetHeight;return Math.abs(t.width-n)<=1&&(n=t.width),Math.abs(t.height-o)<=1&&(o=t.height),{x:e.offsetLeft,y:e.offsetTop,width:n,height:o}}function b(e){return"html"===m(e)?e:e.assignedSlot||e.parentNode||(s(e)?e.host:null)||h(e)}function k(e){return["html","body","#document"].indexOf(m(e))>=0?e.ownerDocument.body:l(e)&&w(e)?e:k(b(e))}function E(e,t){var n;void 0===t&&(t=[]);var o=k(e),r=o===(null==(n=e.ownerDocument)?void 0:n.body),a=i(o),l=r?[a].concat(a.visualViewport||[],w(o)?o:[]):o,s=t.concat(l);return r?s:s.concat(E(b(l)))}function V(e){return["table","td","th"].indexOf(m(e))>=0}function B(e){return l(e)&&"fixed"!==g(e).position?e.offsetParent:null}function O(e){for(var t=i(e),n=B(e);n&&V(n)&&"static"===g(n).position;)n=B(n);return n&&("html"===m(n)||"body"===m(n)&&"static"===g(n).position)?t:n||function(e){var t=-1!==navigator.userAgent.toLowerCase().indexOf("firefox");if(-1!==navigator.userAgent.indexOf("Trident")&&l(e)&&"fixed"===g(e).position)return null;for(var n=b(e);l(n)&&["html","body"].indexOf(m(n))<0;){var o=g(n);if("none"!==o.transform||"none"!==o.perspective||"paint"===o.contain||-1!==["transform","perspective"].indexOf(o.willChange)||t&&"filter"===o.willChange||t&&o.filter&&"none"!==o.filter)return n;n=n.parentNode}return null}(e)||t}var N="top",j="bottom",M="right",C="left",z="auto",H=[N,j,M,C],D="start",S="end",L="viewport",P="popper",A=H.reduce((function(e,t){return e.concat([t+"-"+D,t+"-"+S])}),[]),T=[].concat(H,[z]).reduce((function(e,t){return e.concat([t,t+"-"+D,t+"-"+S])}),[]),Z=["beforeRead","read","afterRead","beforeMain","main","afterMain","beforeWrite","write","afterWrite"];function R(e){var t=new Map,n=new Set,o=[];function r(e){n.add(e.name),[].concat(e.requires||[],e.requiresIfExists||[]).forEach((function(e){if(!n.has(e)){var o=t.get(e);o&&r(o)}})),o.push(e)}return e.forEach((function(e){t.set(e.name,e)})),e.forEach((function(e){n.has(e.name)||r(e)})),o}var W={placement:"bottom",modifiers:[],strategy:"absolute"};function $(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return!t.some((function(e){return!(e&&"function"==typeof e.getBoundingClientRect)}))}function _(e){void 0===e&&(e={});var t=e,n=t.defaultModifiers,o=void 0===n?[]:n,r=t.defaultOptions,i=void 0===r?W:r;return function(e,t,n){void 0===n&&(n=i);var r,l,s={placement:"bottom",orderedModifiers:[],options:Object.assign({},W,i),modifiersData:{},elements:{reference:e,popper:t},attributes:{},styles:{}},c=[],u=!1,f={state:s,setOptions:function(n){var r="function"==typeof n?n(s.options):n;d(),s.options=Object.assign({},i,s.options,r),s.scrollParents={reference:a(e)?E(e):e.contextElement?E(e.contextElement):[],popper:E(t)};var l=function(e){var t=R(e);return Z.reduce((function(e,n){return e.concat(t.filter((function(e){return e.phase===n})))}),[])}(function(e){var t=e.reduce((function(e,t){var n=e[t.name];return e[t.name]=n?Object.assign({},n,t,{options:Object.assign({},n.options,t.options),data:Object.assign({},n.data,t.data)}):t,e}),{});return Object.keys(t).map((function(e){return t[e]}))}([].concat(o,s.options.modifiers)));return s.orderedModifiers=l.filter((function(e){return e.enabled})),s.orderedModifiers.forEach((function(e){var t=e.name,n=e.options,o=void 0===n?{}:n,r=e.effect;if("function"==typeof r){var i=r({state:s,name:t,instance:f,options:o}),a=function(){};c.push(i||a)}})),f.update()},forceUpdate:function(){if(!u){var e=s.elements,t=e.reference,n=e.popper;if($(t,n)){s.rects={reference:y(t,O(n),"fixed"===s.options.strategy),popper:x(n)},s.reset=!1,s.placement=s.options.placement,s.orderedModifiers.forEach((function(e){return s.modifiersData[e.name]=Object.assign({},e.data)}));for(var o=0;o<s.orderedModifiers.length;o++)if(!0!==s.reset){var r=s.orderedModifiers[o],i=r.fn,a=r.options,l=void 0===a?{}:a,c=r.name;"function"==typeof i&&(s=i({state:s,options:l,name:c,instance:f})||s)}else s.reset=!1,o=-1}}},update:(r=function(){return new Promise((function(e){f.forceUpdate(),e(s)}))},function(){return l||(l=new Promise((function(e){Promise.resolve().then((function(){l=void 0,e(r())}))}))),l}),destroy:function(){d(),u=!0}};if(!$(e,t))return f;function d(){c.forEach((function(e){return e()})),c=[]}return f.setOptions(n).then((function(e){!u&&n.onFirstUpdate&&n.onFirstUpdate(e)})),f}}var q={passive:!0};function F(e){return e.split("-")[0]}function I(e){return e.split("-")[1]}function U(e){return["top","bottom"].indexOf(e)>=0?"x":"y"}function G(e){var t,n=e.reference,o=e.element,r=e.placement,i=r?F(r):null,a=r?I(r):null,l=n.x+n.width/2-o.width/2,s=n.y+n.height/2-o.height/2;switch(i){case N:t={x:l,y:n.y-o.height};break;case j:t={x:l,y:n.y+n.height};break;case M:t={x:n.x+n.width,y:s};break;case C:t={x:n.x-o.width,y:s};break;default:t={x:n.x,y:n.y}}var c=i?U(i):null;if(null!=c){var u="y"===c?"height":"width";switch(a){case D:t[c]=t[c]-(n[u]/2-o[u]/2);break;case S:t[c]=t[c]+(n[u]/2-o[u]/2)}}return t}var X={top:"auto",right:"auto",bottom:"auto",left:"auto"};function Y(e){var t,n=e.popper,o=e.popperRect,r=e.placement,a=e.variation,l=e.offsets,s=e.position,c=e.gpuAcceleration,u=e.adaptive,d=e.roundOffsets,p=e.isFixed,m=l.x,v=void 0===m?0:m,w=l.y,y=void 0===w?0:w,x="function"==typeof d?d({x:v,y}):{x:v,y};v=x.x,y=x.y;var b=l.hasOwnProperty("x"),k=l.hasOwnProperty("y"),E=C,V=N,B=window;if(u){var z=O(n),H="clientHeight",D="clientWidth";if(z===i(n)&&"static"!==g(z=h(n)).position&&"absolute"===s&&(H="scrollHeight",D="scrollWidth"),z=z,r===N||(r===C||r===M)&&a===S)V=j,y-=(p&&B.visualViewport?B.visualViewport.height:z[H])-o.height,y*=c?1:-1;if(r===C||(r===N||r===j)&&a===S)E=M,v-=(p&&B.visualViewport?B.visualViewport.width:z[D])-o.width,v*=c?1:-1}var L,P=Object.assign({position:s},u&&X),A=!0===d?function(e){var t=e.x,n=e.y,o=window.devicePixelRatio||1;return{x:f(t*o)/o||0,y:f(n*o)/o||0}}({x:v,y}):{x:v,y};return v=A.x,y=A.y,c?Object.assign({},P,((L={})[V]=k?"0":"",L[E]=b?"0":"",L.transform=(B.devicePixelRatio||1)<=1?"translate("+v+"px, "+y+"px)":"translate3d("+v+"px, "+y+"px, 0)",L)):Object.assign({},P,((t={})[V]=k?y+"px":"",t[E]=b?v+"px":"",t.transform="",t))}const K={name:"offset",enabled:!0,phase:"main",requires:["popperOffsets"],fn:function(e){var t=e.state,n=e.options,o=e.name,r=n.offset,i=void 0===r?[0,0]:r,a=T.reduce((function(e,n){return e[n]=function(e,t,n){var o=F(e),r=[C,N].indexOf(o)>=0?-1:1,i="function"==typeof n?n(Object.assign({},t,{placement:e})):n,a=i[0],l=i[1];return a=a||0,l=(l||0)*r,[C,M].indexOf(o)>=0?{x:l,y:a}:{x:a,y:l}}(n,t.rects,i),e}),{}),l=a[t.placement],s=l.x,c=l.y;null!=t.modifiersData.popperOffsets&&(t.modifiersData.popperOffsets.x+=s,t.modifiersData.popperOffsets.y+=c),t.modifiersData[o]=a}};var J={left:"right",right:"left",bottom:"top",top:"bottom"};function Q(e){return e.replace(/left|right|bottom|top/g,(function(e){return J[e]}))}var ee={start:"end",end:"start"};function te(e){return e.replace(/start|end/g,(function(e){return ee[e]}))}function ne(e,t){var n=t.getRootNode&&t.getRootNode();if(e.contains(t))return!0;if(n&&s(n)){var o=t;do{if(o&&e.isSameNode(o))return!0;o=o.parentNode||o.host}while(o)}return!1}function oe(e){return Object.assign({},e,{left:e.x,top:e.y,right:e.x+e.width,bottom:e.y+e.height})}function re(e,t){return t===L?oe(function(e){var t=i(e),n=h(e),o=t.visualViewport,r=n.clientWidth,a=n.clientHeight,l=0,s=0;return o&&(r=o.width,a=o.height,/^((?!chrome|android).)*safari/i.test(navigator.userAgent)||(l=o.offsetLeft,s=o.offsetTop)),{width:r,height:a,x:l+v(e),y:s}}(e)):a(t)?function(e){var t=d(e);return t.top=t.top+e.clientTop,t.left=t.left+e.clientLeft,t.bottom=t.top+e.clientHeight,t.right=t.left+e.clientWidth,t.width=e.clientWidth,t.height=e.clientHeight,t.x=t.left,t.y=t.top,t}(t):oe(function(e){var t,n=h(e),o=p(e),r=null==(t=e.ownerDocument)?void 0:t.body,i=c(n.scrollWidth,n.clientWidth,r?r.scrollWidth:0,r?r.clientWidth:0),a=c(n.scrollHeight,n.clientHeight,r?r.scrollHeight:0,r?r.clientHeight:0),l=-o.scrollLeft+v(e),s=-o.scrollTop;return"rtl"===g(r||n).direction&&(l+=c(n.clientWidth,r?r.clientWidth:0)-i),{width:i,height:a,x:l,y:s}}(h(e)))}function ie(e,t,n){var o="clippingParents"===t?function(e){var t=E(b(e)),n=["absolute","fixed"].indexOf(g(e).position)>=0&&l(e)?O(e):e;return a(n)?t.filter((function(e){return a(e)&&ne(e,n)&&"body"!==m(e)})):[]}(e):[].concat(t),r=[].concat(o,[n]),i=r[0],s=r.reduce((function(t,n){var o=re(e,n);return t.top=c(o.top,t.top),t.right=u(o.right,t.right),t.bottom=u(o.bottom,t.bottom),t.left=c(o.left,t.left),t}),re(e,i));return s.width=s.right-s.left,s.height=s.bottom-s.top,s.x=s.left,s.y=s.top,s}function ae(e){return Object.assign({},{top:0,right:0,bottom:0,left:0},e)}function le(e,t){return t.reduce((function(t,n){return t[n]=e,t}),{})}function se(e,t){void 0===t&&(t={});var n=t,o=n.placement,r=void 0===o?e.placement:o,i=n.boundary,l=void 0===i?"clippingParents":i,s=n.rootBoundary,c=void 0===s?L:s,u=n.elementContext,f=void 0===u?P:u,p=n.altBoundary,m=void 0!==p&&p,v=n.padding,g=void 0===v?0:v,w=ae("number"!=typeof g?g:le(g,H)),y=f===P?"reference":P,x=e.rects.popper,b=e.elements[m?y:f],k=ie(a(b)?b:b.contextElement||h(e.elements.popper),l,c),E=d(e.elements.reference),V=G({reference:E,element:x,strategy:"absolute",placement:r}),B=oe(Object.assign({},x,V)),O=f===P?B:E,C={top:k.top-O.top+w.top,bottom:O.bottom-k.bottom+w.bottom,left:k.left-O.left+w.left,right:O.right-k.right+w.right},z=e.modifiersData.offset;if(f===P&&z){var D=z[r];Object.keys(C).forEach((function(e){var t=[M,j].indexOf(e)>=0?1:-1,n=[N,j].indexOf(e)>=0?"y":"x";C[e]+=D[n]*t}))}return C}function ce(e,t,n){return c(e,u(t,n))}const ue={name:"preventOverflow",enabled:!0,phase:"main",fn:function(e){var t=e.state,n=e.options,o=e.name,r=n.mainAxis,i=void 0===r||r,a=n.altAxis,l=void 0!==a&&a,s=n.boundary,f=n.rootBoundary,d=n.altBoundary,p=n.padding,m=n.tether,h=void 0===m||m,v=n.tetherOffset,g=void 0===v?0:v,w=se(t,{boundary:s,rootBoundary:f,padding:p,altBoundary:d}),y=F(t.placement),b=I(t.placement),k=!b,E=U(y),V="x"===E?"y":"x",B=t.modifiersData.popperOffsets,z=t.rects.reference,H=t.rects.popper,S="function"==typeof g?g(Object.assign({},t.rects,{placement:t.placement})):g,L="number"==typeof S?{mainAxis:S,altAxis:S}:Object.assign({mainAxis:0,altAxis:0},S),P=t.modifiersData.offset?t.modifiersData.offset[t.placement]:null,A={x:0,y:0};if(B){if(i){var T,Z="y"===E?N:C,R="y"===E?j:M,W="y"===E?"height":"width",$=B[E],_=$+w[Z],q=$-w[R],G=h?-H[W]/2:0,X=b===D?z[W]:H[W],Y=b===D?-H[W]:-z[W],K=t.elements.arrow,J=h&&K?x(K):{width:0,height:0},Q=t.modifiersData["arrow#persistent"]?t.modifiersData["arrow#persistent"].padding:{top:0,right:0,bottom:0,left:0},ee=Q[Z],te=Q[R],ne=ce(0,z[W],J[W]),oe=k?z[W]/2-G-ne-ee-L.mainAxis:X-ne-ee-L.mainAxis,re=k?-z[W]/2+G+ne+te+L.mainAxis:Y+ne+te+L.mainAxis,ie=t.elements.arrow&&O(t.elements.arrow),ae=ie?"y"===E?ie.clientTop||0:ie.clientLeft||0:0,le=null!=(T=null==P?void 0:P[E])?T:0,ue=$+re-le,fe=ce(h?u(_,$+oe-le-ae):_,$,h?c(q,ue):q);B[E]=fe,A[E]=fe-$}if(l){var de,pe="x"===E?N:C,me="x"===E?j:M,he=B[V],ve="y"===V?"height":"width",ge=he+w[pe],we=he-w[me],ye=-1!==[N,C].indexOf(y),xe=null!=(de=null==P?void 0:P[V])?de:0,be=ye?ge:he-z[ve]-H[ve]-xe+L.altAxis,ke=ye?he+z[ve]+H[ve]-xe-L.altAxis:we,Ee=h&&ye?function(e,t,n){var o=ce(e,t,n);return o>n?n:o}(be,he,ke):ce(h?be:ge,he,h?ke:we);B[V]=Ee,A[V]=Ee-he}t.modifiersData[o]=A}},requiresIfExists:["offset"]};const fe={name:"arrow",enabled:!0,phase:"main",fn:function(e){var t,n=e.state,o=e.name,r=e.options,i=n.elements.arrow,a=n.modifiersData.popperOffsets,l=F(n.placement),s=U(l),c=[C,M].indexOf(l)>=0?"height":"width";if(i&&a){var u=function(e,t){return ae("number"!=typeof(e="function"==typeof e?e(Object.assign({},t.rects,{placement:t.placement})):e)?e:le(e,H))}(r.padding,n),f=x(i),d="y"===s?N:C,p="y"===s?j:M,m=n.rects.reference[c]+n.rects.reference[s]-a[s]-n.rects.popper[c],h=a[s]-n.rects.reference[s],v=O(i),g=v?"y"===s?v.clientHeight||0:v.clientWidth||0:0,w=m/2-h/2,y=u[d],b=g-f[c]-u[p],k=g/2-f[c]/2+w,E=ce(y,k,b),V=s;n.modifiersData[o]=((t={})[V]=E,t.centerOffset=E-k,t)}},effect:function(e){var t=e.state,n=e.options.element,o=void 0===n?"[data-popper-arrow]":n;null!=o&&("string"!=typeof o||(o=t.elements.popper.querySelector(o)))&&ne(t.elements.popper,o)&&(t.elements.arrow=o)},requires:["popperOffsets"],requiresIfExists:["preventOverflow"]};function de(e,t,n){return void 0===n&&(n={x:0,y:0}),{top:e.top-t.height-n.y,right:e.right-t.width+n.x,bottom:e.bottom-t.height+n.y,left:e.left-t.width-n.x}}function pe(e){return[N,M,j,C].some((function(t){return e[t]>=0}))}var me=_({defaultModifiers:[{name:"eventListeners",enabled:!0,phase:"write",fn:function(){},effect:function(e){var t=e.state,n=e.instance,o=e.options,r=o.scroll,a=void 0===r||r,l=o.resize,s=void 0===l||l,c=i(t.elements.popper),u=[].concat(t.scrollParents.reference,t.scrollParents.popper);return a&&u.forEach((function(e){e.addEventListener("scroll",n.update,q)})),s&&c.addEventListener("resize",n.update,q),function(){a&&u.forEach((function(e){e.removeEventListener("scroll",n.update,q)})),s&&c.removeEventListener("resize",n.update,q)}},data:{}},{name:"popperOffsets",enabled:!0,phase:"read",fn:function(e){var t=e.state,n=e.name;t.modifiersData[n]=G({reference:t.rects.reference,element:t.rects.popper,strategy:"absolute",placement:t.placement})},data:{}},{name:"computeStyles",enabled:!0,phase:"beforeWrite",fn:function(e){var t=e.state,n=e.options,o=n.gpuAcceleration,r=void 0===o||o,i=n.adaptive,a=void 0===i||i,l=n.roundOffsets,s=void 0===l||l,c={placement:F(t.placement),variation:I(t.placement),popper:t.elements.popper,popperRect:t.rects.popper,gpuAcceleration:r,isFixed:"fixed"===t.options.strategy};null!=t.modifiersData.popperOffsets&&(t.styles.popper=Object.assign({},t.styles.popper,Y(Object.assign({},c,{offsets:t.modifiersData.popperOffsets,position:t.options.strategy,adaptive:a,roundOffsets:s})))),null!=t.modifiersData.arrow&&(t.styles.arrow=Object.assign({},t.styles.arrow,Y(Object.assign({},c,{offsets:t.modifiersData.arrow,position:"absolute",adaptive:!1,roundOffsets:s})))),t.attributes.popper=Object.assign({},t.attributes.popper,{"data-popper-placement":t.placement})},data:{}},{name:"applyStyles",enabled:!0,phase:"write",fn:function(e){var t=e.state;Object.keys(t.elements).forEach((function(e){var n=t.styles[e]||{},o=t.attributes[e]||{},r=t.elements[e];l(r)&&m(r)&&(Object.assign(r.style,n),Object.keys(o).forEach((function(e){var t=o[e];!1===t?r.removeAttribute(e):r.setAttribute(e,!0===t?"":t)})))}))},effect:function(e){var t=e.state,n={popper:{position:t.options.strategy,left:"0",top:"0",margin:"0"},arrow:{position:"absolute"},reference:{}};return Object.assign(t.elements.popper.style,n.popper),t.styles=n,t.elements.arrow&&Object.assign(t.elements.arrow.style,n.arrow),function(){Object.keys(t.elements).forEach((function(e){var o=t.elements[e],r=t.attributes[e]||{},i=Object.keys(t.styles.hasOwnProperty(e)?t.styles[e]:n[e]).reduce((function(e,t){return e[t]="",e}),{});l(o)&&m(o)&&(Object.assign(o.style,i),Object.keys(r).forEach((function(e){o.removeAttribute(e)})))}))}},requires:["computeStyles"]},K,{name:"flip",enabled:!0,phase:"main",fn:function(e){var t=e.state,n=e.options,o=e.name;if(!t.modifiersData[o]._skip){for(var r=n.mainAxis,i=void 0===r||r,a=n.altAxis,l=void 0===a||a,s=n.fallbackPlacements,c=n.padding,u=n.boundary,f=n.rootBoundary,d=n.altBoundary,p=n.flipVariations,m=void 0===p||p,h=n.allowedAutoPlacements,v=t.options.placement,g=F(v),w=s||(g===v||!m?[Q(v)]:function(e){if(F(e)===z)return[];var t=Q(e);return[te(e),t,te(t)]}(v)),y=[v].concat(w).reduce((function(e,n){return e.concat(F(n)===z?function(e,t){void 0===t&&(t={});var n=t,o=n.placement,r=n.boundary,i=n.rootBoundary,a=n.padding,l=n.flipVariations,s=n.allowedAutoPlacements,c=void 0===s?T:s,u=I(o),f=u?l?A:A.filter((function(e){return I(e)===u})):H,d=f.filter((function(e){return c.indexOf(e)>=0}));0===d.length&&(d=f);var p=d.reduce((function(t,n){return t[n]=se(e,{placement:n,boundary:r,rootBoundary:i,padding:a})[F(n)],t}),{});return Object.keys(p).sort((function(e,t){return p[e]-p[t]}))}(t,{placement:n,boundary:u,rootBoundary:f,padding:c,flipVariations:m,allowedAutoPlacements:h}):n)}),[]),x=t.rects.reference,b=t.rects.popper,k=new Map,E=!0,V=y[0],B=0;B<y.length;B++){var O=y[B],S=F(O),L=I(O)===D,P=[N,j].indexOf(S)>=0,Z=P?"width":"height",R=se(t,{placement:O,boundary:u,rootBoundary:f,altBoundary:d,padding:c}),W=P?L?M:C:L?j:N;x[Z]>b[Z]&&(W=Q(W));var $=Q(W),_=[];if(i&&_.push(R[S]<=0),l&&_.push(R[W]<=0,R[$]<=0),_.every((function(e){return e}))){V=O,E=!1;break}k.set(O,_)}if(E)for(var q=function(e){var t=y.find((function(t){var n=k.get(t);if(n)return n.slice(0,e).every((function(e){return e}))}));if(t)return V=t,"break"},U=m?3:1;U>0;U--){if("break"===q(U))break}t.placement!==V&&(t.modifiersData[o]._skip=!0,t.placement=V,t.reset=!0)}},requiresIfExists:["offset"],data:{_skip:!1}},ue,fe,{name:"hide",enabled:!0,phase:"main",requiresIfExists:["preventOverflow"],fn:function(e){var t=e.state,n=e.name,o=t.rects.reference,r=t.rects.popper,i=t.modifiersData.preventOverflow,a=se(t,{elementContext:"reference"}),l=se(t,{altBoundary:!0}),s=de(a,o),c=de(l,r,i),u=pe(s),f=pe(c);t.modifiersData[n]={referenceClippingOffsets:s,popperEscapeOffsets:c,isReferenceHidden:u,hasPopperEscaped:f},t.attributes.popper=Object.assign({},t.attributes.popper,{"data-popper-reference-hidden":u,"data-popper-escaped":f})}}]});const he={props:{placement:{type:String,default:"bottom-end"},boundary:{type:String,default:"scrollParent"},autoClose:{type:Boolean,default:!0}},data:function(){return{show:!1}},watch:{show:function(e){var t=this;e&&this.$nextTick((function(){me(t.$el,t.$refs.dropdown,{placement:t.placement,modifiers:[{name:"preventOverflow",options:{boundariesElement:t.boundary}}]})}))}},mounted:function(){var e=this;document.addEventListener("keydown",(function(t){27===t.keyCode&&(e.show=!1)}))}};const ve=(0,n(3744).Z)(he,[["render",function(e,t,n,i,a,l){return(0,o.openBlock)(),(0,o.createElementBlock)("button",{type:"button",onClick:t[2]||(t[2]=function(e){return a.show=!0})},[(0,o.renderSlot)(e.$slots,"default"),((0,o.openBlock)(),(0,o.createBlock)(o.Teleport,{to:"body"},[a.show?((0,o.openBlock)(),(0,o.createElementBlock)("div",r,[(0,o.createElementVNode)("div",{style:{position:"fixed",top:"0",right:"0",left:"0",bottom:"0","z-index":"99998",background:"black",opacity:".2"},onClick:t[0]||(t[0]=function(e){return a.show=!1})}),(0,o.createElementVNode)("div",{ref:"dropdown",style:{position:"absolute","z-index":"99999"},onClick:t[1]||(t[1]=(0,o.withModifiers)((function(e){return a.show=!n.autoClose}),["stop"]))},[(0,o.renderSlot)(e.$slots,"dropdown")],512)])):(0,o.createCommentVNode)("",!0)]))])}]])},5322:(e,t,n)=>{n.d(t,{Z:()=>g});var o=n(821),r={class:"block md:inline-flex top-0 w-full overflow-auto border-gray-200"},i=(0,o.createElementVNode)("div",{class:"text-center"},[(0,o.createElementVNode)("span",{class:"block text-sm leading-none"},"Login")],-1),a=(0,o.createElementVNode)("div",{class:"text-center"},[(0,o.createElementVNode)("span",{class:"block text-sm leading-none"},"Home")],-1),l=(0,o.createElementVNode)("div",{class:"text-center"},[(0,o.createElementVNode)("span",{class:"block text-sm leading-none"},"Registreer je vereniging")],-1),s=(0,o.createElementVNode)("div",{class:"text-center"},[(0,o.createElementVNode)("span",{class:"block text-sm leading-none"},"Over SchaakManager")],-1),c=(0,o.createElementVNode)("div",{class:"text-center"},[(0,o.createElementVNode)("span",{class:"block text-sm leading-none"},"Help")],-1),u={key:0},f=(0,o.createElementVNode)("div",{class:"text-center"},[(0,o.createElementVNode)("span",{class:"block text-sm leading-none"},"Kies je favoriete club")],-1),d={class:"mt-2 py-2 shadow-xl bg-white rounded text-sm"},p=["onClick"];var m=n(8968),h=n(1516);const v={props:{current:String},components:{Icon:h.Z,Dropdown:m.Z},data:function(){return{club:null}},mounted:function(){var e=this.$cookies.get("club");return this.club=e},methods:{setFavoriteClub:function(e){this.$inertia.visit(this.route("setFavoriteClub"),{data:{favoriteClub:e}})}},name:"Guestmenu"};const g=(0,n(3744).Z)(v,[["render",function(e,t,n,m,h,v){var g=(0,o.resolveComponent)("inertia-link"),w=(0,o.resolveComponent)("icon"),y=(0,o.resolveComponent)("dropdown");return(0,o.openBlock)(),(0,o.createElementBlock)("div",r,[(0,o.withDirectives)((0,o.createVNode)(g,{href:e.route("login"),class:"flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"},{default:(0,o.withCtx)((function(){return[i]})),_:1},8,["href"]),[[o.vShow,"login"!=n.current]]),(0,o.withDirectives)((0,o.createVNode)(g,{href:e.route("home"),class:"flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"},{default:(0,o.withCtx)((function(){return[a]})),_:1},8,["href"]),[[o.vShow,"home"!=n.current]]),(0,o.withDirectives)((0,o.createVNode)(g,{href:e.route("register"),class:"flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"},{default:(0,o.withCtx)((function(){return[l]})),_:1},8,["href"]),[[o.vShow,"registerClub"!=n.current]]),(0,o.withDirectives)((0,o.createVNode)(g,{href:e.route("about"),class:"flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"},{default:(0,o.withCtx)((function(){return[s]})),_:1},8,["href"]),[[o.vShow,"about"!=n.current]]),(0,o.withDirectives)((0,o.createVNode)(g,{href:e.route("help"),class:"flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"},{default:(0,o.withCtx)((function(){return[c]})),_:1},8,["href"]),[[o.vShow,"help"!=n.current]]),null===this.club?((0,o.openBlock)(),(0,o.createElementBlock)("div",u,[(0,o.createVNode)(y,{class:"flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500",placement:"bottom-end"},{dropdown:(0,o.withCtx)((function(){return[(0,o.createElementVNode)("div",d,[((0,o.openBlock)(!0),(0,o.createElementBlock)(o.Fragment,null,(0,o.renderList)(e.$page.props.clubs.clubs,(function(e){return(0,o.openBlock)(),(0,o.createElementBlock)("div",{key:e.id},[(0,o.createElementVNode)("button",{class:"block px-6 py-2 hover:bg-orange-500 hover:text-white",onClick:function(t){return v.setFavoriteClub(e.id)}},(0,o.toDisplayString)(e.name),9,p)])})),128))])]})),default:(0,o.withCtx)((function(){return[f,(0,o.createVNode)(w,{class:"w-5 h-5 group-hover:fill-orange-600 fill-gray-700 focus:fill-orange-600",name:"cheveron-down"})]})),_:1})])):(0,o.createCommentVNode)("",!0)])}]])},1516:(e,t,n)=>{n.d(t,{Z:()=>W});var o=n(821),r={key:0,xmlns:"http://www.w3.org/2000/svg",width:"100",height:"100",viewBox:"0 0 100 100"},i=[(0,o.createElementVNode)("g",{"fill-rule":"nonzero"},[(0,o.createElementVNode)("path",{d:"M46.173 19.967C49.927-1.838 19.797-.233 14.538.21c-.429.035-.648.4-.483.8 2.004 4.825 14.168 31.66 32.118 18.957zm13.18 1.636c1.269-.891 1.35-1.614.047-2.453l-2.657-1.71c-.94-.607-1.685-.606-2.532.129-5.094 4.42-7.336 9.18-8.211 15.24 1.597.682 3.55.79 5.265.328 1.298-4.283 3.64-8.412 8.088-11.534z"}),(0,o.createElementVNode)("path",{d:"M88.588 67.75c9.65-27.532-13.697-45.537-35.453-32.322-1.84 1.118-4.601 1.118-6.441 0-21.757-13.215-45.105 4.79-35.454 32.321 5.302 15.123 17.06 39.95 37.295 29.995.772-.38 1.986-.38 2.758 0 20.235 9.955 31.991-14.872 37.295-29.995z"})],-1)],a={key:1,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},l=[(0,o.createElementVNode)("path",{d:"M6 4H5a1 1 0 1 1 0-2h11V1a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V5a1 1 0 0 0-1-1h-7v8l-2-2-2 2V4z"},null,-1)],s={key:2,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},c=[(0,o.createElementVNode)("path",{d:"M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"},null,-1)],u={key:3,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},f=[(0,o.createElementVNode)("polygon",{points:"12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707"},null,-1)],d={key:4,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},p=[(0,o.createElementVNode)("path",{d:"M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"},null,-1)],m={key:5,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},h=[(0,o.createElementVNode)("path",{d:"M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"},null,-1)],v={key:6,xmlns:"http://www.w3.org/2000/svg",width:"100",height:"100",viewBox:"0 0 100 100"},g=[(0,o.createElementVNode)("path",{"fill-rule":"evenodd",d:"M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"},null,-1)],w={key:7,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},y=[(0,o.createElementVNode)("path",{d:"M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"},null,-1)],x={key:8,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},b=[(0,o.createElementVNode)("path",{d:"M4 2h16l-3 9H4a1 1 0 1 0 0 2h13v2H4a3 3 0 0 1 0-6h.33L3 5 2 2H0V0h3a1 1 0 0 1 1 1v1zm1 18a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"},null,-1)],k={key:9,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},E=[(0,o.createElementVNode)("path",{d:"M18 9.87V20H2V9.87a4.25 4.25 0 0 0 3-.38V14h10V9.5a4.26 4.26 0 0 0 3 .37zM3 0h4l-.67 6.03A3.43 3.43 0 0 1 3 9C1.34 9 .42 7.73.95 6.15L3 0zm5 0h4l.7 6.3c.17 1.5-.91 2.7-2.42 2.7h-.56A2.38 2.38 0 0 1 7.3 6.3L8 0zm5 0h4l2.05 6.15C19.58 7.73 18.65 9 17 9a3.42 3.42 0 0 1-3.33-2.97L13 0z"},null,-1)],V={key:10,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},B=[(0,o.createElementVNode)("path",{d:"M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"},null,-1)],O={key:11,class:"h-5 w-5",viewBox:"0 0 20 20",fill:"currentColor"},N=[(0,o.createElementVNode)("path",{d:"M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"},null,-1)],j={key:12,xmlns:"http://www.w3.org/2000/svg",class:"h-5 w-5",viewBox:"0 0 20 20",fill:"currentColor"},M=[(0,o.createElementVNode)("path",{"fill-rule":"evenodd",d:"M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z","clip-rule":"evenodd"},null,-1)],C={key:13,xmlns:"http://www.w3.org/2000/svg",class:"h-5 w-5",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},z=[(0,o.createElementVNode)("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M15 19l-7-7 7-7"},null,-1)],H={key:14,xmlns:"http://www.w3.org/2000/svg",class:"h-5 w-5",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},D=[(0,o.createElementVNode)("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M9 5l7 7-7 7"},null,-1)],S={key:15,class:"w-3 h-3",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},L=[(0,o.createElementVNode)("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"},null,-1)],P={key:16,class:"w-6 h-6",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},A=[(0,o.createElementVNode)("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"},null,-1)],T={key:17,xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},Z=[(0,o.createElementVNode)("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"},null,-1)];const R={props:{name:String}};const W=(0,n(3744).Z)(R,[["render",function(e,t,n,R,W,$){return"apple"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",r,i)):"book"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",a,l)):"cheveron-down"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",s,c)):"cheveron-right"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",u,f)):"dashboard"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",d,p)):"location"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",m,h)):"office"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",v,g)):"printer"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",w,y)):"shopping-cart"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",x,b)):"store-front"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",k,E)):"trash"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",V,B)):"users"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",O,N)):"user"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",j,M)):"chevron-left"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",C,z)):"chevron-right"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",H,D)):"lookup"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",S,L)):"cake"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",P,A)):"pencil"===n.name?((0,o.openBlock)(),(0,o.createElementBlock)("svg",T,Z)):(0,o.createCommentVNode)("",!0)}]])},5980:(e,t,n)=>{n.d(t,{Z:()=>s});var o=n(821),r=["disabled"],i={key:0,class:"mr-2"},a=[(0,o.createElementVNode)("svg",{class:"animate-spin -ml-1 mr-3 h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24"},[(0,o.createElementVNode)("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"}),(0,o.createElementVNode)("path",{class:"opacity-75",fill:"currentColor",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"})],-1)];const l={props:{loading:Boolean}};const s=(0,n(3744).Z)(l,[["render",function(e,t,n,l,s,c){return(0,o.openBlock)(),(0,o.createElementBlock)("button",{disabled:n.loading,class:"flex items-center"},[n.loading?((0,o.openBlock)(),(0,o.createElementBlock)("div",i,a)):(0,o.createCommentVNode)("",!0),(0,o.renderSlot)(e.$slots,"default")],8,r)}]])},7891:(e,t,n)=>{n.d(t,{Z:()=>l});var o=n(821),r={class:"flex justify-center items-center mx-auto my-auto"},i=[(0,o.createElementVNode)("img",{src:"/assets/logo/logo.svg"},null,-1)];const a={},l=(0,n(3744).Z)(a,[["render",function(e,t){return(0,o.openBlock)(),(0,o.createElementBlock)("div",r,i)}]])},4891:(e,t,n)=>{n.d(t,{Z:()=>d});var o=n(821);function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,o)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function a(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var l=["for"],s=(0,o.createElementVNode)("br",null,null,-1),c=["id","type","value"],u={key:1,class:"form-error"};const f={props:{id:{type:String,default:function(){return"select-input-".concat(1e3*Math.random())}},type:{type:String,default:"text"},modelValue:"",label:String,error:String},methods:{focus:function(){this.$refs.input.focus()},select:function(){this.$refs.input.select()},setSelectionRange:function(e,t){this.$refs.input.setSelectionRange(e,t)}}};const d=(0,n(3744).Z)(f,[["render",function(e,t,n,r,a,f){return(0,o.openBlock)(),(0,o.createElementBlock)("div",{class:(0,o.normalizeClass)(e.$attrs.class)},[n.label?((0,o.openBlock)(),(0,o.createElementBlock)("label",{key:0,class:"form-label",for:n.id},(0,o.toDisplayString)(n.label)+":",9,l)):(0,o.createCommentVNode)("",!0),s,(0,o.createElementVNode)("input",(0,o.mergeProps)({id:n.id,ref:"input"},i(i({},e.$attrs),{},{class:null}),{class:["form-input",{error:n.error}],type:n.type,value:n.modelValue,onInput:t[0]||(t[0]=function(t){return e.$emit("update:modelValue",t.target.value)})}),null,16,c),n.error?((0,o.openBlock)(),(0,o.createElementBlock)("div",u,(0,o.toDisplayString)(n.error),1)):(0,o.createCommentVNode)("",!0)],2)}]])}}]);
//# sourceMappingURL=406.js.map?id=b0b50ef863a5a073