/** Hanzen init **/
HZ.onReady(function(){
	HZ.tip.QuickTipManager.init();
	HZ.create('Ext.container.Viewport',{
		layout:'border',
		items:[
			{
				xtype:'box',
				id:'app-header',
				region:'north',
				height:38,
				html:'<img src="'+d.base_url+'root/img/logo-hanzen-erp.png"/>',
			},
			{
				xtype:'treepanel',
				iconCls:'application_side_tree',
				title:d.lang.transactions,
				region:'west',
				tbar:[
				{
					xtype:'combo',emptyText:d.lang.search,
					hideTrigger:true,hideLabel: true,typeAhead: false,
					store:HM.search,
					width:250,
					pageSize: 5,minChars:3,
					listeners:{
						select:{fn:function(c,r,i){
							this.clearValue();
							HF.open(r[0].data);
						}}
					},
					listConfig: {
						loadingText: d.lang.searching,
						emptyText: d.lang.search_not_found,
						getInnerTpl: function() {
							return '<div><b>{id} - {name}</b><br /><i>{description}</i></div>';
						}
					}
				}
				,'->','-',{iconCls:'cog',text:d.lang.menu,menu:[
					{iconCls:'user',text:d.lang.user,menu:[{iconCls:'lock',text:d.lang.logout,handler:HF.logout}]},
					{iconCls:'help',text:d.lang.help,menu:[
					{iconCls:'book',text:d.lang.documentation},
					{iconCls:'exclamation_octagon_fram',text:d.lang.troubleshooting},
					{iconCls:'bug',text:d.lang.report,handler:function(){HF.open({title:'report',id:'1'});}},
					{iconCls:'exclamation',text:d.lang.about,handler:HF.about}
				]}
				]}],
				store: HM.module,
				padding:'0 0 0 5',
				minWidth:350,
				maxWidth:450,
				split:true,
				autoScroll: true,
				scroll:true,
				collapsible:true,
				listeners:{
					itemdblclick:{
						fn:function(view, record, item, index, event) {
							if(record.data.leaf==true){
								var node = {id: record.data.id,	name: record.data.text};
								HF.open(node);
							}
						}
					}
				}
			},
			{
				xtype:'tabpanel',
				region:'center',
				id:'tab',
				padding:'0 5 0 0',
				items:[{
					title:d.lang.home,
					layout:'border',
					iconCls:'house',
					autoScroll:true,
					defaults:{padding:3},
					items:[
						{xtype:'toolbar',region:'north',items:[{xtype:'textfield'}]},{
						xtype:'gridpanel',
						iconCls:'script',
						title:d.lang.history,
						region:'center',
						autoScroll:true,
						store:HM.history,
						columns:[
							{id:'date',text:d.lang.date_time,flex:1,sortable : true,dataIndex: 'date'},
							{id: 'module_id',width:65,text:d.lang.module_id,dataIndex:'module_id'},
							{id:'referance_id',width:75,text:d.lang.id_referance,dataIndex:'referance_id'},
							{id:'info',width:350,text:d.lang.description,dataIndex:'info'}
						],
						tbar:[{xtype:'button',iconCls:'arrow_refresh',text:d.lang.refresh,handler:function(){HM.history.load()}}]},
						{iconCls:'star_1',collapsible:true,title:d.lang.short_cut, width:400,region:'west'},
						{title:d.lang.news,collapsible:true,height:200,region:'south',tbar:[{iconCls:'arrow_refresh',text:d.lang.check,xtype:'button'}]},
					]
				}]
			},{
				region:'south',
				id:'app-footer',
				xtype:'box',
				height:20,
				html:'Hanzen ERP &copy; 2012 | Ver 1.0.1'
			}
		]
	});
	progress('Loading... 4/4');
	HZ.get('mask-loading').fadeOut({duration:1000,remove:true});
	HM.ping();
	/**
	 * Checking error for data main
	 **/
	if(d.is_error){
		alert('Something Error');
		console.log(d.error);
	}
});