/*
 * @Discription:  
 * @Author: Hannibal·Lee
 * @Date: 2020-02-21 11:04:52
 * @LastEditTime: 2020-10-14 18:33:28
 */

var PieOption = {
	dknum:{
		tooltip : {
			trigger: 'item',
		},
		legend: {
			data:['打卡','未打卡'],
			// selectedMode: 'single',
			selected:{
				'未打卡' : false,
			}
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 70, y2:30, x2:20,width:'90%',borderWidth:'0'},
		xAxis : [
			{
				type : 'category',
				data : [],
			}
		],
		yAxis: [
			{
				type: 'value'
			}
		],
		series : [
			{
				name:'打卡',
				type:'line',
				typess:1,
				stack: '总数',
				barWidth: 40,
				itemStyle: {normal: {color:'rgba(65, 202, 192,1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			{
				name:'未打卡',
				type:'line',
				typess:3,
				stack: '总数',
				barWidth: 40,
				itemStyle: {normal: {color:'rgba(138, 138, 138, 1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
		]
	},
	tiwennum:{
		tooltip: {
			trigger: 'axis'
		},
		xAxis: {
			type: 'category',
			boundaryGap: false,
			data: [],
			show:false
		},
		grid: {y: 3,x:2, y2:4, x2:5,width:'90%'},
		yAxis: {
			type: 'value',
			show:false

		},
		series: [{
			data: [],
			type: 'line',
			areaStyle: {
				color : "#1890ff"
			},
			//控制线条的颜色
			itemStyle : {
				normal : {
					borderColor : '#1890ff',
				}
			},
		   	lineStyle: {
				color : "#1890ff"
			},
			smooth: true
		}]
	},
	notiwennum:{
		tooltip: {
			trigger: 'axis'
		},
		xAxis: {
			type: 'category',
			boundaryGap: false,
			data: [],
			show:false
		},
		grid: {y: 3,x:2, y2:4, x2:5,width:'90%'},
		yAxis: {
			type: 'value',
			show:false

		},
		series: [{
			data: [],
			type: 'line',
			areaStyle: {
				color : "#f98a69"
			},
			//控制线条的颜色
			itemStyle : {
				normal : {
					borderColor : '#f98a69',
				}
			},
		   	lineStyle: {
				color : "#f98a69"
			},
			smooth: true
		}]
	},
	d : { //异常症状
		tooltip: {
			trigger: 'item',
			formatter: '{a} <br/>{b}: {c}'
		},
		legend: {
			orient: 'vertical',
			left: 10,
			data: []
		},
		series: [
			{
				name: '症状比例',
				type: 'pie',
				radius: ['50%', '70%'],
				avoidLabelOverlap: false,
				label: {
					normal: {
						show: false,
						position: 'center'
					},
					emphasis: {
						show: true,
						textStyle: {
							fontSize: '30',
							fontWeight: 'bold'
						}
					}
				},
				labelLine: {
					normal: {
						show: false
					}
				},
				itemStyle: {
					emphasis: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					 },
					normal:{
						color:function(params) {
						//自定义颜色
						var colorList = [          
								'#6197FE', '#5FCBCA', '#61CE73', '#F6D942', '#EA637D', '#993FE5', '#43C2C1', '#354559',
							];
							return colorList[params.dataIndex]
						 }
					}
			  	},
				data: []
			}
		]
	},
	a : { //是否离开本市
		title: {
			text: '某站点用户访问来源',
			subtext: '实时数据',
			left: 'center'
		},
		tooltip: {
			trigger: 'item',
			formatter: '{a} <br/>{b} : {c}'
		},
		legend: {
			orient: 'vertical',
			left: 'left',
			data: ['是',  '否']
		},
		series: [
			{
				name: '是否离开',
				type: 'pie',
				radius: '55%',
				center: ['50%', '60%'],
				itemStyle: {
					emphasis: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					 },
					normal:{
						color:function(params) {
						//自定义颜色
						var colorList = [          
								'#6197FE', '#5FCBCA', '#61CE73', '#F6D942'
							];
							return colorList[params.dataIndex]
						 }
					}
			  	},
				data: [
					{value: 335, name: '是'},
					{value: 1548, name: '否'}
				],
			}
		]
	},
	b : { //是否离开本市
		title: {
			text: '某站点用户访问来源',
			subtext: '实时数据',
			left: 'center'
		},
		tooltip: {
			trigger: 'item',
			formatter: '{a} <br/>{b} : {c}'
		},
		legend: {
			orient: 'vertical',
			left: 'left',
			data: ['是',  '否']
		},
		series: [
			{
				name: '是否离开',
				type: 'pie',
				radius: '55%',
				center: ['50%', '60%'],
				itemStyle: {
					emphasis: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					 },
					normal:{
						color:function(params) {
						//自定义颜色
						var colorList = [          
								'#6197FE', '#5FCBCA', '#61CE73', '#F6D942'
							];
							return colorList[params.dataIndex]
						 }
					}
			  	},
				data: [
					{value: 335, name: '是'},
					{value: 1548, name: '否'}
				],
			}
		]
	},
	c : { //是否离开本市
		title: {
			text: '某站点用户访问来源',
			subtext: '实时数据',
			left: 'center'
		},
		tooltip: {
			trigger: 'item',
			formatter: '{a} <br/>{b} : {c}'
		},
		legend: {
			orient: 'vertical',
			left: 'left',
			data: ['是',  '否']
		},
		series: [
			{
				name: '是否离开',
				type: 'pie',
				radius: '55%',
				center: ['50%', '60%'],
				itemStyle: {
					emphasis: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					 },
					normal:{
						color:function(params) {
						//自定义颜色
						var colorList = [          
								'#6197FE', '#5FCBCA', '#61CE73', '#F6D942'
							];
							return colorList[params.dataIndex]
						 }
					}
			  	},
				data: [
					{value: 335, name: '是'},
					{value: 1548, name: '否'}
				],
			}
		]
	},
	zz : {
		grid: {y: 3,x:10, y2:10, x2:5,width:'90%',containLabel: true,},
		xAxis: {
			type: 'value',
			show:false
		},
		yAxis: {
			type: 'category',
			data: [],
			"axisTick":{
			  "show":false
			},
			"axisLine":{
			  "show":false
			},
		   
		},
		series: [
			{
				type: 'bar',
				label: {
					show: true,
					position: 'insideRight'
				},
				itemStyle: {
					normal: {
						color: function(params) { 
							var colorList = ['#f1a976','#b087ff','#94de7e', '#f99aa0','#f0b1ff','#6ce2dd','#80beff']; 
							return colorList[params.dataIndex] 
						}
					},
				},                
				data: []
			},
			
		]
	},
	zzfb : { //症状分布情况柱状图表
		legend: {
			type: 'scroll',
			orient: 'vertical',
			right: 10,
			top:10,
			data: []
		},
		series: [
			{
				type: 'pie',
				radius: '65%',
				center: ['28%', '50%'],
				label: {
					normal: {
						show: false,
						position: 'center'
					},
					emphasis: {
						show: true,
						textStyle: {
							fontSize: '30',
							fontWeight: 'bold'
						}
					}
				},
				data: [],
				itemStyle: {
					normal:{
						color:function(params) {
						var colorList = ['#529CD9', '#5AC0E9', '#7AE0E6', '#9BF3DD','#F9E05F','#F7A081','#F1111A','#4BFF9E'];
							return colorList[params.dataIndex]
						}
					}
			  	},
				emphasis: {
					itemStyle: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					}
				}
			}
		]
	},
	trend:{
		tooltip : {
			trigger: 'item',
		},
		legend: {
			data:[]
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 60, x:30,width:'86%'},
		xAxis : [
			{
				type : 'category',
				data : [],
				axisLabel : {
					rotate : -10
				},
			},
		],
		yAxis: [
			{
				type: 'value',
				axisLabel :{
					rotate : -30
				},
				splitLine:{
					show:true,
					lineStyle:{
						type:'dashed'
					}
				}
			},
			
		],
		series : [
			{
				name:'',
				type:'line',
				typess:1,
				itemStyle: {normal: {label:{show:true,formatter:function(c){return c.value;}}}},
				data:[],
				smooth: true
			},
			{
				name:'',
				type:'line',
				typess:2,
				itemStyle: {normal: {label:{show:true,formatter:function(c){return c.value;}}}},
				data:[],
				smooth: true
			},
			{
				name:'',
				type:'line',
				typess:2,
				itemStyle: {normal: {label:{show:true,formatter:function(c){return c.value;}}}},
				data:[],
				smooth: true
			},
			{
				name:'',
				type:'line',
				typess:2,
				itemStyle: {normal: {label:{show:true,formatter:function(c){return c.value;}}}},
				data:[],
				smooth: true
			},
			{
				name:'',
				type:'line',
				typess:2,
				itemStyle: {normal: {label:{show:true,formatter:function(c){return c.value;}}}},
				data:[],
				smooth: true
			},
			{
				name:'',
				type:'line',
				typess:2,
				itemStyle: {normal: {label:{show:true,formatter:function(c){return c.value;}}}},
				data:[],
				smooth: true
			},
			{
				name:'',
				type:'line',
				typess:2,
				itemStyle: {normal: {label:{show:true,formatter:function(c){return c.value;}}}},
				data:[],
				smooth: true
			},
		]
	},

	kqecharts : { //症状分布情况柱状图表
		legend: {
			type: 'scroll',
			orient: 'vertical',
			right: 10,
			top:10,
			data: []
		},
		series: [
			{
				type: 'pie',
				radius: '65%',
				center: ['28%', '50%'],
				label: {
					normal: {
						show: false,
						position: 'center'
					},
					emphasis: {
						show: true,
						textStyle: {
							fontSize: '30',
							fontWeight: 'bold'
						}
					}
				},
				data: [],
				itemStyle: {
					normal:{
						color:function(params) {
						var colorList = ['#529CD9', '#9BF3DD', '#F7A081'];
							return colorList[params.dataIndex]
						}
					}
			  	},
				emphasis: {
					itemStyle: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					}
				}
			}
		]
	},

	bar:{ //培训模式，柱状图
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.series.name+"</br>"+c.value+"节";}else if(c.series.typess==6){return c.series.name+"</br>"+c.value+"元";}else{return c.series.name+"</br>"+c.value+"人次";}}
		},
		legend: {
			data:['课时安排','签到人次','请假人次','缺勤人次','新增报名人数','新增收入/元']
		},

        calculable : false,
		grid: {y: 70, y2:100, x2:20,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : []
			},
			{
				type : 'category',
				axisLine: {show:false},
				axisTick: {show:false},
				axisLabel: {show:false},
				splitArea: {show:false},
				splitLine: {show:false},
				data : []
			}
		],
		yAxis: [{
			type: 'value',
			scale: true,
			name: '单位:课时（人次）',
			min: 0,
			},{
			type: 'value',
			scale: true,
			name: '单位:元',
			}],
		series : [
			{
				name:'',
				type:'bar',
				typess:1,
				barWidth: 40,
				itemStyle: {normal: {color:'#529CD9', label:{show:true,formatter:function(c){}}}},
				data:[]
			},
			{
				name:'签到人次',
				type:'bar',
				typess:2,
				barWidth: 40,
				itemStyle: {normal: {color:'#5AC0E9', label:{show:true,formatter:function(c){return "签到:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'请假人次',
				type:'bar',
				typess:3,
				barWidth: 40,
				itemStyle: {normal: {color:'#7AE0E6', label:{show:true,formatter:function(c){return "请假:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'缺勤人次',
				type:'bar',
				typess:4,
				barWidth: 40,
				itemStyle: {normal: {color:'#9BF3DD', label:{show:true,formatter:function(c){return "缺勤:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'新增报名人数',
				type:'bar',
				typess:5,
				barWidth: 40,
				itemStyle: {normal: {color:'#F9E05F', label:{show:true,formatter:function(c){return "新增报名:\n"+c.value+"人";}}}},
				data:[]
			},
		
			{
				name:'新增收入/元',
				type:'bar',
				typess:6,
				yAxisIndex: 1,
				barWidth: 40,
				itemStyle: {normal: {color:'#F7A081', label:{show:true,formatter:function(c){return "新增收入:\n"+c.value+"元";}}}},
				data:[]
			},
			
		]
	},
}
