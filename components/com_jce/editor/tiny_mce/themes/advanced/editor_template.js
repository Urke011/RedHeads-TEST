/* jce - 2.9.19 | 2022-01-26 | https://www.joomlacontenteditor.net | Copyright (C) 2006 - 2021 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){var DOM=tinymce.DOM,Event=tinymce.dom.Event,extend=tinymce.extend,each=tinymce.each,Storage=tinymce.util.Storage,Delay=tinymce.util.Delay,explode=tinymce.explode;tinymce.create("tinymce.themes.AdvancedTheme",{controls:{bold:["bold_desc","Bold"],italic:["italic_desc","Italic"],underline:["underline_desc","Underline"],strikethrough:["striketrough_desc","Strikethrough"],justifyleft:["justifyleft_desc","JustifyLeft"],justifycenter:["justifycenter_desc","JustifyCenter"],justifyright:["justifyright_desc","JustifyRight"],justifyfull:["justifyfull_desc","JustifyFull"],outdent:["outdent_desc","Outdent"],indent:["indent_desc","Indent"],undo:["undo_desc","Undo"],redo:["redo_desc","Redo"],unlink:["unlink_desc","unlink"],cleanup:["cleanup_desc","mceCleanup"],code:["code_desc","mceCodeEditor"],removeformat:["removeformat_desc","RemoveFormat"],sub:["sub_desc","subscript"],sup:["sup_desc","superscript"],forecolor:["forecolor_desc","ForeColor"],forecolorpicker:["forecolor_desc","mceForeColor"],backcolor:["backcolor_desc","HiliteColor"],backcolorpicker:["backcolor_desc","mceBackColor"],visualaid:["visualaid_desc","mceToggleVisualAid"],newdocument:["newdocument_desc","mceNewDocument"],blockquote:["blockquote_desc","mceBlockQuote"]},stateControls:["bold","italic","underline","strikethrough","justifyleft","justifycenter","justifyright","justifyfull","sub","sup","blockquote"],init:function(ed,url){var s,v,self=this;self.editor=ed,self.url=url,self.onResolveName=new tinymce.util.Dispatcher(this),self.onResize=new tinymce.util.Dispatcher(this),s=ed.settings,s.theme_buttons1||(s=extend({theme_buttons1:"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect",theme_buttons2:"bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",theme_buttons3:"hr,removeformat,visualaid,|,sub,sup,|,charmap"},s)),self.settings=s=extend({theme_path:!0,theme_toolbar_location:"top",theme_blockformats:"p,address,pre,h1,h2,h3,h4,h5,h6",theme_toolbar_align:"left",theme_statusbar_location:"bottom",theme_fonts:"Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats",theme_more_colors:1,theme_row_height:23,theme_resize_horizontal:1,theme_font_sizes:"1,2,3,4,5,6,7",theme_font_selector:"span",theme_show_current_color:0,readonly:ed.settings.readonly},s),(v=s.theme_path_location)&&"none"!=v&&(s.theme_statusbar_location=s.theme_path_location),"none"==s.theme_statusbar_location&&(s.theme_statusbar_location=0),ed.onInit.add(function(){ed.settings.readonly||(ed.onNodeChange.add(self._nodeChanged,self),ed.onKeyUp.add(self._updateUndoStatus,self),ed.onMouseUp.add(self._updateUndoStatus,self),ed.dom.bind(ed.dom.getRoot(),"dragend",function(){self._updateUndoStatus(ed)}),ed.addShortcut("alt+F10,F10","",function(){self.toolbarGroup.focus()}),ed.addShortcut("alt+F11","",function(){DOM.get(ed.id+"_path_row").focus()}))}),ed.onPostRender.add(function(){var el=ed.getElement();DOM.setStyle(ed.id+"_tbl","width","");var e=DOM.get(ed.id+"_parent"),ifr=DOM.get(ed.id+"_ifr"),width=s.width||el.style.width,height=s.height||el.style.height;height&&DOM.setStyle(ifr,"height",height),width&&(DOM.setStyle(e.parentNode,"max-width",width),DOM.setStyle(ifr,"max-width",width))}),ed.onSetProgressState.add(function(ed,b,ti){var co,tb,id=ed.id;b?self.progressTimer=setTimeout(function(){co=ed.getContainer(),co=co.insertBefore(DOM.create("DIV",{style:"position:relative"}),co.firstChild),tb=DOM.get(ed.id+"_tbl"),DOM.add(co,"div",{id:id+"_blocker",class:"mceBlocker",style:{width:tb.clientWidth+2,height:tb.clientHeight+2}}),DOM.add(co,"div",{id:id+"_progress",class:"mceProgress",style:{left:tb.clientWidth/2,top:tb.clientHeight/2}})},ti||0):(DOM.remove(id+"_blocker"),DOM.remove(id+"_progress"),clearTimeout(self.progressTimer))}),ed.settings.compress.css||ed.settings.content_css===!1||ed.contentCSS.push(ed.baseURI.toAbsolute(url+"/skins/"+ed.settings.skin+"/content.css"))},createControl:function(n,cf){var c=cf.createControl(n);if(c)return c;var cd=this.controls[n];return cd?cf.createButton(n,{title:"advanced."+cd[0],cmd:cd[1],ui:cd[2],value:cd[3]}):void 0},execCommand:function(cmd,ui,val){var f=this["_"+cmd];return!!f&&(f.call(this,ui,val),!0)},renderUI:function(o){var n,ic,sc,p,self=this,ed=self.editor,s=self.settings;ed.settings&&(ed.settings.aria_label=s.aria_label+ed.getLang("advanced.help_shortcut")),"mobile"===ed.settings.skin&&(ed.settings.skin="default",s.skin_variant="touch");var skin="mce"+self._ufirst(ed.settings.skin)+"Skin";return s.skin_variant&&(skin+=" "+skin+self._ufirst(s.skin_variant)),"default"!==ed.settings.skin&&(skin="mceDefaultSkin "+skin),"rtl"==ed.settings.skin_directionality&&(skin+=" mceRtl"),ed.settings.skin_class=skin,n=p=DOM.create("div",{role:"application","aria-label":s.aria_label,id:ed.id+"_parent",class:"mceEditor "+skin}),n=sc=DOM.add(n,"div",{role:"presentation",id:ed.id+"_tbl",class:"mceLayout"}),ic=self._createLayout(s,n,o,p),n=o.targetNode,DOM.insertAfter(p,n),Event.add(ed.id+"_path_row","click",function(e){if(e=DOM.getParent(e.target,"a"),e&&"A"==e.nodeName)return self._sel(e.className.replace(/^.*mcePath_([0-9]+).*$/,"$1")),!1}),"external"==s.theme_toolbar_location&&(o.deltaHeight=0),self.deltaHeight=o.deltaHeight,o.targetNode=null,{iframeContainer:ic,editorContainer:ed.id+"_parent",sizeContainer:sc,deltaHeight:o.deltaHeight}},resizeBy:function(dw,dh){var e=DOM.get(this.editor.id+"_ifr");this.resizeTo(e.clientWidth+dw,e.clientHeight+dh)},resizeTo:function(w,h,store){var ed=this.editor,s=this.settings,e=DOM.get(ed.id+"_parent"),ifr=DOM.get(ed.id+"_ifr");w=Math.max(s.theme_resizing_min_width||100,w),h=Math.max(s.theme_resizing_min_height||100,h),w=Math.min(s.theme_resizing_max_width||65535,w),h=Math.min(s.theme_resizing_max_height||65535,h),DOM.setStyle(ifr,"height",h),s.theme_resize_horizontal&&(DOM.setStyle(e.parentNode,"max-width",w+"px"),DOM.setStyle(ifr,"max-width",w+"px")),store&&s.use_state_cookies!==!1&&Storage.setHash("wf_editor_size_"+ed.id,{cw:w,ch:h}),this.onResize.dispatch()},destroy:function(){var id=this.editor.id;Event.clear(id+"_resize"),Event.clear(id+"_path_row"),Event.clear(id+"_external_close")},_createLayout:function(s,tb,o,p){var ic,self=this,lo=s.theme_toolbar_location,sl=s.theme_statusbar_location;return s.readonly?ic=DOM.add(tb,"div",{class:"mceIframeContainer"}):("top"==lo&&self._addToolbars(tb,o),"top"==sl&&self._addStatusBar(tb,o),ic=DOM.add(tb,"div",{class:"mceIframeContainer"}),"bottom"==lo&&self._addToolbars(tb,o),"bottom"==sl&&self._addStatusBar(tb,o),ic)},_addControls:function(v,tb){var di,self=this,s=self.settings,cf=self.editor.controlManager;s.theme_disable&&!self._disabled?(di={},each(explode(s.theme_disable),function(v){di[v]=1}),self._disabled=di):di=self._disabled,each(explode(v),function(n){var c;di&&di[n]||(c=self.createControl(n,cf),c&&tb.add(c))})},_addToolbars:function(c,o){var i,tb,v,n,a,toolbarGroup,self=this,ed=self.editor,s=self.settings,cf=ed.controlManager,h=[],toolbarsExist=!1;for(toolbarGroup=cf.createToolbarGroup("toolbargroup",{name:ed.getLang("advanced.toolbar"),tab_focus_toolbar:ed.getParam("theme_tab_focus_toolbar"),class:"ToolbarGroup"}),self.toolbarGroup=toolbarGroup,a=s.theme_toolbar_align.toLowerCase(),a=cf.classPrefix+self._ufirst(a),n=DOM.add(c,"div",{class:cf.classPrefix+"Toolbar "+a,role:"toolbar"}),i=1;v=s["theme_buttons"+i];i++)toolbarsExist=!0,tb=cf.createToolbar("toolbar"+i,{class:"mceToolbarRow"+i,"aria-label":"Toolbar Row "+i}),s["theme_buttons"+i+"_add"]&&(v+=","+s["theme_buttons"+i+"_add"]),s["theme_buttons"+i+"_add_before"]&&(v=s["theme_buttons"+i+"_add_before"]+","+v),self._addControls(v,tb),toolbarGroup.add(tb),o.deltaHeight-=s.theme_row_height;toolbarsExist||(o.deltaHeight-=s.theme_row_height),h.push(toolbarGroup.renderHTML()),DOM.setHTML(n,h.join(""))},_addStatusBar:function(tb,o){var n,td,self=this,ed=self.editor,s=self.settings;n=td=DOM.add(tb,"div",{class:"mceStatusbar"}),s.theme_path&&(n=DOM.add(n,"div",{id:ed.id+"_path_row",role:"group","aria-labelledby":ed.id+"_path_voice",class:"mcePathRow"}),DOM.add(n,"span",{id:ed.id+"_path_voice",class:"mcePathLabel"},ed.translate("advanced.path")+": ")),s.theme_resizing&&(DOM.add(td,"div",{id:ed.id+"_resize",class:"mceResize",tabIndex:"-1"},'<span class="mceIcon mce_resize"></span>'),s.use_state_cookies!==!1&&ed.onPostRender.add(function(){var o=Storage.getHash("wf_editor_size_"+ed.id);o&&self.resizeTo(o.cw,o.ch,!1)}),ed.onPostRender.add(function(){if(Event.add(ed.id+"_resize","click",function(e){e.preventDefault()}),Event.add(ed.id+"_resize","mousedown",function(e){function resizeOnMove(e){e.preventDefault(),width=startWidth+(e.screenX-startX),height=startHeight+(e.screenY-startY),self.resizeTo(width,height)}function endResize(e){Event.remove(DOM.doc,"mousemove",mouseMoveHandler1),Event.remove(ed.getDoc(),"mousemove",mouseMoveHandler2),Event.remove(DOM.doc,"mouseup",mouseUpHandler1),Event.remove(ed.getDoc(),"mouseup",mouseUpHandler2),width=startWidth+(e.screenX-startX),height=startHeight+(e.screenY-startY),self.resizeTo(width,height,!0),ed.nodeChanged()}var mouseMoveHandler1,mouseMoveHandler2,mouseUpHandler1,mouseUpHandler2,startX,startY,startWidth,startHeight,width,height,ifrElm;e.preventDefault(),startX=e.screenX,startY=e.screenY,ifrElm=DOM.get(self.editor.id+"_ifr"),startWidth=width=ifrElm.clientWidth,startHeight=height=ifrElm.clientHeight,mouseMoveHandler1=Event.add(DOM.doc,"mousemove",resizeOnMove),mouseMoveHandler2=Event.add(ed.getDoc(),"mousemove",resizeOnMove),mouseUpHandler1=Event.add(DOM.doc,"mouseup",endResize),mouseUpHandler2=Event.add(ed.getDoc(),"mouseup",endResize)}),ed.settings.floating_toolbar){var elm=ed.getContainer(),parent=elm.parentNode;Event.add(window,"scroll",Delay.debounce(function(){ed.settings.fullscreen_enabled||(window.pageYOffset>parent.offsetTop?DOM.addClass(elm,"mceToolbarFixed"):DOM.removeClass(elm,"mceToolbarFixed"))},128))}})),o.deltaHeight-=21,n=tb=null},_updateUndoStatus:function(ed){var cm=ed.controlManager,um=ed.undoManager;cm.setDisabled("undo",!um.hasUndo()&&!um.typing),cm.setDisabled("redo",!um.hasRedo())},_nodeChanged:function(ed,cm,n,co,ob){function getParent(name){var i,parents=ob.parents,func=name;for("string"==typeof name&&(func=function(node){return node.nodeName==name}),i=0;i<parents.length;i++)if(func(parents[i]))return parents[i]}var p,v,self=this,de=0,s=self.settings;if(tinymce.each(self.stateControls,function(c){cm.setActive(c,ed.queryCommandState(self.controls[c][1]))}),cm.setActive("visualaid",ed.hasVisual),self._updateUndoStatus(ed),cm.setDisabled("outdent",!ed.queryCommandState("Outdent")),s.theme_path&&s.theme_statusbar_location){p=DOM.get(ed.id+"_path")||DOM.add(ed.id+"_path_row","span",{id:ed.id+"_path",class:"mcePathPath"}),self.statusKeyboardNavigation&&(self.statusKeyboardNavigation.destroy(),self.statusKeyboardNavigation=null),DOM.setHTML(p,""),getParent(function(n){var pi,na=n.nodeName.toLowerCase(),ti="",cls=n.className||"";if(1==n.nodeType&&!n.getAttribute("data-mce-bogus")&&"br"!==na&&!/mce-(item|object)-(hidden|removed|shim)/i.test(cls)){switch(na=na.replace(/mce\:/g,"")){case"b":na="strong";break;case"img":(v=DOM.getAttrib(n,"src"))&&(ti+="src: "+v+" ");break;case"a":(v=DOM.getAttrib(n,"href"))&&(ti+="href: "+v+" ");break;case"font":(v=DOM.getAttrib(n,"face"))&&(ti+="font: "+v+" "),(v=DOM.getAttrib(n,"size"))&&(ti+="size: "+v+" "),(v=DOM.getAttrib(n,"color"))&&(ti+="color: "+v+" ");break;case"span":(v=DOM.getAttrib(n,"style"))&&(ti+="style: "+v+" ")}(v=DOM.getAttrib(n,"id"))&&(ti+="id: "+v+" "),ed.settings.theme_path_show_classnames!==!1&&(v=DOM.getAttrib(n,"class"),v&&(v=v.replace(/mce-item-[\w]+/g,""),v=tinymce.trim(v),v&&(ti+="class: "+v+" ",(ed.dom.isBlock(n)||"img"==na||"span"==na)&&(na+="."+v)))),na=na.replace(/(html:)/g,"");var args={name:na,node:n,title:ti};self.onResolveName.dispatch(self,args),ti=args.title,na=args.name,na&&(pi=DOM.create("span",{class:"mceText"},na),args.disabled||(pi=DOM.create("a",{href:"#",role:"button",title:ti,class:"mcePath_"+de++},pi)),p.hasChildNodes()?(p.insertBefore(DOM.create("span",{"aria-hidden":"true"}," » "),p.firstChild),p.insertBefore(pi,p.firstChild)):p.appendChild(pi))}},ed.getBody()),DOM.select("a",p).length>0&&(self.statusKeyboardNavigation=new tinymce.ui.KeyboardNavigation({root:ed.id+"_path_row",items:DOM.select("a",p),excludeFromTabOrder:!0,onCancel:function(){ed.focus()}},DOM));var row=DOM.get(ed.id+"_path_row"),status=row.parentNode,mod=20;tinymce.each(status.childNodes,function(n){return!!DOM.hasClass(n,"mcePathRow")||void(mod+=n.offsetWidth)}),tinymce.each(DOM.select("a",p),function(n){DOM.removeClass(n,"mcePathHidden"),p.offsetWidth+mod+DOM.getPrev(p,".mcePathLabel").offsetWidth>status.offsetWidth&&DOM.addClass(n,"mcePathHidden")})}},_sel:function(v){this.editor.execCommand("mceSelectNodeDepth",!1,v)},_mceNewDocument:function(){var ed=this.editor;ed.windowManager.confirm("advanced.newdocument",function(s){s&&ed.execCommand("mceSetContent",!1,"")})},_ufirst:function(s){return s.substring(0,1).toUpperCase()+s.substring(1)}}),tinymce.ThemeManager.add("advanced",tinymce.themes.AdvancedTheme)}();