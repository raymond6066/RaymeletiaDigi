!function(t){var n={};function r(e){if(n[e])return n[e].exports;var o=n[e]={i:e,l:!1,exports:{}};return t[e].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=t,r.c=n,r.d=function(t,n,e){r.o(t,n)||Object.defineProperty(t,n,{enumerable:!0,get:e})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,n){if(1&n&&(t=r(t)),8&n)return t;if(4&n&&"object"==typeof t&&t&&t.__esModule)return t;var e=Object.create(null);if(r.r(e),Object.defineProperty(e,"default",{enumerable:!0,value:t}),2&n&&"string"!=typeof t)for(var o in t)r.d(e,o,function(n){return t[n]}.bind(null,o));return e},r.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(n,"a",n),n},r.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},r.p="/",r(r.s=823)}({10:function(t,n,r){var e=r(4),o=r(15),i=r(14),u=r(19),c=r(22),f=function(t,n,r){var a,p,s,l,v=t&f.F,y=t&f.G,m=t&f.S,d=t&f.P,b=t&f.B,g=y?e:m?e[n]||(e[n]={}):(e[n]||{}).prototype,x=y?o:o[n]||(o[n]={}),h=x.prototype||(x.prototype={});for(a in y&&(r=n),r)s=((p=!v&&g&&void 0!==g[a])?g:r)[a],l=b&&p?c(s,e):d&&"function"==typeof s?c(Function.call,s):s,g&&u(g,a,s,t&f.U),x[a]!=s&&i(x,a,l),d&&h[a]!=s&&(h[a]=s)};e.core=o,f.F=1,f.G=2,f.S=4,f.P=8,f.B=16,f.W=32,f.U=64,f.R=128,t.exports=f},11:function(t,n){t.exports=function(t){try{return!!t()}catch(t){return!0}}},12:function(t,n,r){t.exports=!r(11)((function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a}))},13:function(t,n,r){var e=r(9);t.exports=function(t){if(!e(t))throw TypeError(t+" is not an object!");return t}},14:function(t,n,r){var e=r(16),o=r(31);t.exports=r(12)?function(t,n,r){return e.f(t,n,o(1,r))}:function(t,n,r){return t[n]=r,t}},15:function(t,n){var r=t.exports={version:"2.6.12"};"number"==typeof __e&&(__e=r)},16:function(t,n,r){var e=r(13),o=r(50),i=r(36),u=Object.defineProperty;n.f=r(12)?Object.defineProperty:function(t,n,r){if(e(t),n=i(n,!0),e(r),o)try{return u(t,n,r)}catch(t){}if("get"in r||"set"in r)throw TypeError("Accessors not supported!");return"value"in r&&(t[n]=r.value),t}},17:function(t,n){var r={}.hasOwnProperty;t.exports=function(t,n){return r.call(t,n)}},18:function(t,n,r){"use strict";var e=r(10),o=r(44)(1);e(e.P+e.F*!r(88)([].map,!0),"Array",{map:function(t){return o(this,t,arguments[1])}})},19:function(t,n,r){var e=r(4),o=r(14),i=r(17),u=r(21)("src"),c=r(62),f=(""+c).split("toString");r(15).inspectSource=function(t){return c.call(t)},(t.exports=function(t,n,r,c){var a="function"==typeof r;a&&(i(r,"name")||o(r,"name",n)),t[n]!==r&&(a&&(i(r,u)||o(r,u,t[n]?""+t[n]:f.join(String(n)))),t===e?t[n]=r:c?t[n]?t[n]=r:o(t,n,r):(delete t[n],o(t,n,r)))})(Function.prototype,"toString",(function(){return"function"==typeof this&&this[u]||c.call(this)}))},20:function(t,n){var r={}.toString;t.exports=function(t){return r.call(t).slice(8,-1)}},21:function(t,n){var r=0,e=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++r+e).toString(36))}},22:function(t,n,r){var e=r(43);t.exports=function(t,n,r){if(e(t),void 0===n)return t;switch(r){case 1:return function(r){return t.call(n,r)};case 2:return function(r,e){return t.call(n,r,e)};case 3:return function(r,e,o){return t.call(n,r,e,o)}}return function(){return t.apply(n,arguments)}}},23:function(t,n,r){var e=r(35),o=Math.min;t.exports=function(t){return t>0?o(e(t),9007199254740991):0}},25:function(t,n,r){var e=r(15),o=r(4),i=o["__core-js_shared__"]||(o["__core-js_shared__"]={});(t.exports=function(t,n){return i[t]||(i[t]=void 0!==n?n:{})})("versions",[]).push({version:e.version,mode:r(32)?"pure":"global",copyright:"© 2020 Denis Pushkarev (zloirock.ru)"})},28:function(t,n){t.exports=function(t){if(null==t)throw TypeError("Can't call method on  "+t);return t}},29:function(t,n,r){var e=r(28);t.exports=function(t){return Object(e(t))}},31:function(t,n){t.exports=function(t,n){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:n}}},32:function(t,n){t.exports=!1},35:function(t,n){var r=Math.ceil,e=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?e:r)(t)}},36:function(t,n,r){var e=r(9);t.exports=function(t,n){if(!e(t))return t;var r,o;if(n&&"function"==typeof(r=t.toString)&&!e(o=r.call(t)))return o;if("function"==typeof(r=t.valueOf)&&!e(o=r.call(t)))return o;if(!n&&"function"==typeof(r=t.toString)&&!e(o=r.call(t)))return o;throw TypeError("Can't convert object to primitive value")}},4:function(t,n){var r=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=r)},43:function(t,n){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},44:function(t,n,r){var e=r(22),o=r(46),i=r(29),u=r(23),c=r(63);t.exports=function(t,n){var r=1==t,f=2==t,a=3==t,p=4==t,s=6==t,l=5==t||s,v=n||c;return function(n,c,y){for(var m,d,b=i(n),g=o(b),x=e(c,y,3),h=u(g.length),w=0,_=r?v(n,h):f?v(n,0):void 0;h>w;w++)if((l||w in g)&&(d=x(m=g[w],w,b),t))if(r)_[w]=d;else if(d)switch(t){case 3:return!0;case 5:return m;case 6:return w;case 2:_.push(m)}else if(p)return!1;return s?-1:a||p?p:_}}},45:function(t,n,r){var e=r(9),o=r(4).document,i=e(o)&&e(o.createElement);t.exports=function(t){return i?o.createElement(t):{}}},46:function(t,n,r){var e=r(20);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==e(t)?t.split(""):Object(t)}},5:function(t,n,r){var e=r(25)("wks"),o=r(21),i=r(4).Symbol,u="function"==typeof i;(t.exports=function(t){return e[t]||(e[t]=u&&i[t]||(u?i:o)("Symbol."+t))}).store=e},50:function(t,n,r){t.exports=!r(12)&&!r(11)((function(){return 7!=Object.defineProperty(r(45)("div"),"a",{get:function(){return 7}}).a}))},52:function(t,n,r){var e=r(20);t.exports=Array.isArray||function(t){return"Array"==e(t)}},62:function(t,n,r){t.exports=r(25)("native-function-to-string",Function.toString)},63:function(t,n,r){var e=r(64);t.exports=function(t,n){return new(e(t))(n)}},64:function(t,n,r){var e=r(9),o=r(52),i=r(5)("species");t.exports=function(t){var n;return o(t)&&("function"!=typeof(n=t.constructor)||n!==Array&&!o(n.prototype)||(n=void 0),e(n)&&null===(n=n[i])&&(n=void 0)),void 0===n?Array:n}},823:function(t,n,r){t.exports=r(824)},824:function(t,n,r){"use strict";r.r(n);r(18);var e=wp.i18n.__,o=wp.blocks.registerBlockType,i=wp.components.SelectControl,u=wp.element.createElement("svg",{width:20,height:20},wp.element.createElement("path",{d:"M15.57,0H4.43A4.43,4.43,0,0,0,0,4.43V15.57A4.43,4.43,0,0,0,4.43,20H15.57A4.43,4.43,0,0,0,20,15.57V4.43A4.43,4.43,0,0,0,15.57,0ZM12.82,14a2.36,2.36,0,0,1-1.66.68H6.5A2.31,2.31,0,0,1,7.18,13a2.36,2.36,0,0,1,1.66-.68l4.66,0A2.34,2.34,0,0,1,12.82,14Zm3.3-3.46a2.36,2.36,0,0,1-1.66.68H3.21a2.25,2.25,0,0,1,.68-1.64,2.36,2.36,0,0,1,1.66-.68H16.79A2.25,2.25,0,0,1,16.12,10.53Zm0-3.73a2.36,2.36,0,0,1-1.66.68H3.21a2.25,2.25,0,0,1,.68-1.64,2.36,2.36,0,0,1,1.66-.68H16.79A2.25,2.25,0,0,1,16.12,6.81Z"}));o("wppayform/guten-block",{title:e("Paymattic"),icon:u,category:"formatting",keywords:[e("Paymattic"),e("Gutenberg Block"),e("wppayform-gutenberg-block")],attributes:{formId:{type:"string"}},edit:function(t){var n=t.attributes,r=t.setAttributes,o=window.wpf_tinymce_vars;return React.createElement("div",{className:"wppayform-guten-wrapper"},React.createElement("div",{className:"wppayform-logo"},React.createElement("img",{src:o.logo,alt:"Paymattic"}),"Paymattic"),React.createElement(i,{label:e("Select a Form"),value:n.formId,options:o.forms.map((function(t){return{value:t.value,label:t.text}})),onChange:function(t){return r({formId:t})}}))},save:function(t){return'[wppayform id="'+t.attributes.formId+'"]'}})},88:function(t,n,r){"use strict";var e=r(11);t.exports=function(t,n){return!!t&&e((function(){n?t.call(null,(function(){}),1):t.call(null)}))}},9:function(t,n){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}}});