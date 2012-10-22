/** Hanzen Model **/
HM = new Object();
HM = {
	/**
	 * Data for find module transaction
	 **/
	search: HZ.create('HZ.data.JsonStore', {
		autoDestroy: true,
		pageSize: 5,
		storeId: 'searchResult',
		proxy: {
			type: 'ajax',
			url: HF.jsonRequest('widget/find'),
			reader: {
				root: 'result',
				idProperty: 'id',
				totalProperty:'total',
			}
		},
		fields: [{name:'name',type:'string'},{name:'id',type:'string'},{name:'description',type:'string'}]
	}),
	/**
	 * Data for module tree
	 **/
	module: HZ.create('HZ.data.TreeStore',{
		proxy:{type:'ajax',url:HF.jsonRequest('widget/tree_modules')},
		root:{id:'1',text:d.name,expanded:true,}
	}),
	history: HZ.create('HZ.data.JsonStore',{
		autoDestroy:true,
		storeId:'history',
		proxy:{
			type:'ajax',
			url:HF.jsonRequest('widget/history'),
			reader:{
				root:'history',
			}
		},
		fields:[{name:'date', type:'string'},{name:'module_id',type:'string'},{name:'referance_id',type:'string'},{name:'info'}]
	}).load(),
	ping: function(){
		HZ.Ajax.request({
			url: HF.jsonRequest('hanzen/ping'),
			success: function(r){
				var resp = Ext.decode(r.responseText);
				if(resp.is_login){HM.ping();}
				else{HF.logout();}
			},
			failure:HM.ping
		});
	},
};