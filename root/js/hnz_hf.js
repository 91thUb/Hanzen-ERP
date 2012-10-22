/** Hanzen Function **/
var HF = new Object();
HF = {
	/**
	 * Generate Url and token
	 * #param url string
	 * #return string 
	 **/
	token: function(url){return d.base_url+url+'?token='+d.token;},
	jsonRequest:function(url){return HF.token(url)+'&dataType=json';},
	moduleRequest: function(module){return {url: HF.token('modules/'+module)+'&dataType=module',scripts:true};},
	/**
	 * About Hanzen ERP
	 **/
	about:function(){HZ.Msg.show({title:d.lang.about,msg:d.about});},
	/**
	 * Logout user
	 **/
	logout:function(){document.location = HF.token('security/destroy');},
	/**
	 * Open tab for module
	 * #param d array('id','name')
	 **/
	open:function(tab){
		var i = HZ.getCmp(tab.id);
		if(!i){
			HZ.getCmp('tab').add({
				iconCls:'application',
				title:tab.name,id:tab.id,bodyPadding:5,
				closable:true,autoLoad:HF.moduleRequest(tab.id),
				listeners:{
					beforerender:function(t,e){
						HF.msg(d.lang.loading+'...',t.title);
					}
				}
			}).show();
		}
		else{i.show();}
	},
	createBox:function(t, s){
       return '<div class="msg"><h3>' + t + '</h3><p>' + s + '</p></div>';
    },
	msg:function(title,format){
		var msgCt;
		if(!msgCt){
			msgCt = Ext.DomHelper.insertFirst(document.body, {id:'msg-div'}, true);
		}
		var s = Ext.String.format.apply(String, Array.prototype.slice.call(arguments, 1));
		var m = Ext.DomHelper.append(msgCt, HF.createBox(title, s), true);
		m.hide();
		m.slideIn('t').ghost("t", { delay: 3000, remove: true});
	},
};